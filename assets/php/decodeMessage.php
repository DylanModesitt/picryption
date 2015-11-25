<?php include '../includes/headerForScript.php';  includeHeader("Picryption - Image Decryption"); ?>
<body>
<?php include '../includes/navForScript.php'; ?>
<?php
// Modal.php holds a variety of functions used across multiple scripts in picryption.
include 'model.php';

// Upload image to ../uploads/(file) so it can be encoded with a message
$target_dir="../uploads/";
$target_img = $target_dir . "image.png";
$img_result = move_uploaded_file($_FILES["imageUploaded"]["tmp_name"], $target_img);

// Test for sucessful file upload
if ($img_result == FALSE) { echo '<script type="text/javascript"> alert ("There was an error uploading your image. Please try again."); window.history.back()</script>';}

try {
  imagepng(imagecreatefromfile($target_img) , $target_img);
}
catch(Exception $e) {
  giveErrorPopup($e);
}

// Given an image, get the hidden message encoded using encode.php 
function decodeImageWithMessage($image) {
	$imageToModify = imagecreatefrompng($image);
	list($width, $height) = getimagesize($image);
	$binaryRecieved = "";
	$shouldCheckForExpiery = FALSE;

	// count the number of zeros to look for the stop codon of a message.
	$zeroInARowCounter = 0;
	for($y=0;$y<$height;$y++) {
		for($x=0;$x<$width;$x++) {
			// check for date expirey 
			if (strcmp($binaryRecieved,"00000001")==0) {
				$binaryRecieved = "";
				$shouldCheckForExpiery = TRUE;
			}

			if($shouldCheckForExpiery) {
				if(strlen($binaryRecieved) == 48) {
					$shouldCheckForExpiery = false;
					$validByDate = binaryToMessage($binaryRecieved);
						if (date("m.d.y") > $validByDate) {
							return "This image's message self destructed.";
						} 
				}
			}


			$colors = imagecolorat($imageToModify, $x, $y);
			 $r = ($colors >> 16) & 0xFF;
			// get bit from red value
			if($r % 2 == 0) {
				$binaryRecieved=$binaryRecieved."0";
				$zeroInARowCounter++;
			} else {
				$binaryRecieved=$binaryRecieved."1";
				$zeroInARowCounter = 0;
			}

			// Break out of first loop given the 00000000 (Stop message)
			if ($zeroInARowCounter >= 8) {
                break;
			}
		}
		// Break out of second loop given the 00000000 (Stop message)
		if ($zeroInARowCounter >= 8) {
                break;
		}
	}
	return binaryToMessage($binaryRecieved);
}
echo '<div class="wrapper">
		<div class="container">
			<div class="page-header">
				<h1 class="red">Picryption <small>steganography message decoded</small></h1>
			</div>';
if(strlen(decodeImageWithMessage($target_img)) > 0) {
	echo '<h3><small>Showing message decoded in image '.$_FILES["imageUploaded"]["name"].':</small></h3>';
	echo '<br><br>';
	echo decodeImageWithMessage($target_img);
} else {
	echo '<h3><small>There was no Picryption message in image '.$_FILES["imageUploaded"]["name"].':</small></h3>';
}
unlink($target_img);


?>
