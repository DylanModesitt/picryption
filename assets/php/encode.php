<?php
// Upload image to ../uploads/(file) so it can be encoded with a message
$target_dir="../uploads/";
$target_img = $target_dir . "image.png";
$img_result = move_uploaded_file($_FILES["imageUploaded"]["tmp_name"], $target_img);
$givenMessage = $_POST["secretMessage"];

if ($img_result == FALSE) { //echo "<h4 class='col-xs-12'>Image was <B>NOT</B> uploaded to the picryption for processing.</h4>\n";
}
else { //echo /<h4 class='col-xs-12'>Image was uploaded to picryption.</h4>\n";
}

function encodeImageWithMessage($message, $image) {
	$imageToModify = imagecreatefrompng($image);
	list($width, $height) = getimagesize($image);
	$binaryGiven = messageToBinary($message);
	$x = 0;
	$y = 0;

	//encode the given binary into the image
	for($i=0;$i<strlen($binaryGiven);$i++) {

        if($i == 0) {
        	$x = 0;
        } else {
        	$x = $i % $width;
        }

        if($i == 0) {
        	$y = 0;
        } else {
        	$y = $i / $width;
        }

        $colors = imagecolorat($imageToModify, $x, $y);
        $r = ($colors >> 16) & 0xFF;
        $g = ($colors >> 8) & 0xFF;
        $b = $colors & 0xFF;

        $currentIndexOfBit = $i;
        $currentBit = $binaryGiven{$currentIndexOfBit};
        $newR = $r;
        if($r % 2 == 0 && $currentBit == '1') {
        	if($r >= 255) {
        		$newR = $r-1;
        	} else {
        		$newR = $r+1;
        	}
        } elseif ($r % 2 == 1 && $currentBit == '0') {
        	if($r >= 255) {
        		$newR = $r-1;
        	} else {
        		$newR = $r+1;
        	}
        }
        $newColor = imagecolorallocate($imageToModify, $newR, $g, $b);
        imagesetpixel($imageToModify, $x, $y, $newColor);

    }

    // Make a stop codon of 00000000
    for($i=strlen($binaryGiven);$i<strlen($binaryGiven) + 8;$i++){
    	if($i == 0) {
        	$x = 0;
        } else {
        	$x = $i % $width;
        }

        if($i == 0) {
        	$y = 0;
        } else {
        	$y = $i / $width;
        }


    	$colors = imagecolorat($imageToModify, $x, $y);
        $r = ($colors >> 16) & 0xFF;
        $g = ($colors >> 8) & 0xFF;
        $b = $colors & 0xFF;
		$newR = $r;
        if($r % 2 != 0) {
        	if($r >= 255) {
        		$newR = $r-1;
        	} else {
        		$newR = $r+1;
        	}
        } 

        $newColor = imagecolorallocate($imageToModify, $newR, $g, $b);
        imagesetpixel($imageToModify, $x, $y, $newColor);
    }

    //print("message hidden ".binaryToMessage($binaryGiven));
    return $imageToModify;

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

//echo messageToBinary("test")."\n";
$im = encodeImageWithMessage($givenMessage, $target_img);
// Set the content type header - in this case image/jpeg
header('Content-Disposition: Attachment;filename=image.png'); 
header('Content-type: image/png'); 
//Output the image
imagepng($im);
// Free up memory
imagedestroy($im);

?>
