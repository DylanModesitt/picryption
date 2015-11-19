<?php
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
	$zeroInARowCounter = 0;
	for($y=0;$y<$height;$y++) {
		for($x=0;$x<$width;$x++) {
			$colors = imagecolorat($imageToModify, $x, $y);
			$r = ($colors >> 16) & 0xFF;
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


// Turn string into a string of bits
function messageToBinary($message) {
	// Get length of message
    $len = strlen($message);
    // Variable for the binary to be added to
    $binaryRecieved = '';
    // Loop through the string
    for ($i = 0; $i < $len; $i++) {
    	// Ord will give the character code of the given character and then sprintf() converts that to a binary number
        $binaryRecieved .= sprintf("%08b", ord($message[$i]));
    }
    return $binaryRecieved;
}
// Turn string of bits into its text equivalent
function binaryToMessage($binary) {
	// Get length of message
    $len = strlen($binary);
    // Variable for the binary to be added to
    $messageDecoded = '';
    // Extract 8-bit segments of the string
    for ($i = 0; $i < $len; $i += 8) {
    	// get the substring segment for current iteration
        $n = substr($binary, $i, 8);
        // Turn the binary into a decimal back to a character and add it
        $messageDecoded .= chr(bindec($n));
    }
    return $messageDecoded;
}

echo decodeImageWithMessage($target_img);
unlink($target_img);

?>
