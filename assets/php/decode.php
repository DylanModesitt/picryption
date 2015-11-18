<?php
// Upload image to ../uploads/(file) so it can be encoded with a message
$target_dir="../uploads/";
$target_img = $target_dir . "image.png";
$img_result = move_uploaded_file($_FILES["imageUploaded"]["tmp_name"], $target_img);

if ($img_result == FALSE) { echo "<h4 class='col-xs-12'>Image was <B>NOT</B> uploaded to the picryption for processing.</h4>\n";
}
else { echo "<h4 class='col-xs-12'>Image was uploaded to picryption.</h4>\n";
}

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

			if ($zeroInARowCounter >= 8) {
                break;
			}
		}
		if ($zeroInARowCounter >= 8) {
                break;
		}
	}

	print(binaryToMessage($binaryRecieved));
	return binaryToMessage($binaryRecieved);
}


// Turn string into a string of bits
function messageToBinary($message) {
	$value = unpack('H*', $message);
	return base_convert($value[1], 16, 2);
}
// Turn string of bits into its text equivalent
function binaryToMessage($binary) {
	return pack('H*', base_convert($binary, 2, 16));
}
decodeImageWithMessage($target_img);

?>
