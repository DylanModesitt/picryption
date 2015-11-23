<?php
ini_set('max_execution_time', 0);
// Modal.php holds a variety of functions used across multiple scripts in picryption.
include 'model.php';

// Upload image to ../uploads/(file) so it can be encoded with a message
$target_dir="../uploads/";
$target_img = $target_dir . "image.png";
$img_result = move_uploaded_file($_FILES["imageUploaded"]["tmp_name"], $target_img);

// Test for sucessful file upload
if ($img_result == FALSE) { echo "<h4 class='col-xs-12'>Image was <B>NOT</B> uploaded to the picryption for processing.</h4>\n";
}
else { echo "<h4 class='col-xs-12'>Image was uploaded to picryption.</h4>\n";
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
				        	echo "matched";
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

echo decodeImageWithMessage($target_img);
unlink($target_img);


?>
