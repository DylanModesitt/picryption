<?php
// Upload image to ../uploads/(file) so it can be encoded with a message
$target_dir="../uploads/";
$target_img = $target_dir.$_FILES["imageUploaded"]["name"];
$img_result = move_uploaded_file($_FILES["imageUploaded"]["tmp_name"], $target_img);
$givenMessage = $_POST["secretMessage"];

if ($img_result == FALSE) {  } else { }

    function forceImageAsPNG($img_path) {
        $extension = pathinfo($img_path, PATHINFO_EXTENSION);
        $image;
        switch($extension) {
            case 'jpg':
            case 'jpeg':
            case 'JPG':
            case 'JPEG':
                $image = imagecreatefromjpeg($img_path);
                imagepng($image, $img_path);
                break;
            case 'gif':
            case 'GIF':
                $image = imagecreatefromgif($img_path);
                imagepng($image, $img_path);
                break;
            case 'png':
            case 'PNG':
                $image = imagecreatefrompng($img_path);
                imagepng($image, $img_path);
                break;
            default :
                break;
        }
    }

    forceImageAsPNG($target_img);

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


$im = encodeImageWithMessage($givenMessage, $target_img);
// Set the content type header - in this case image/jpeg
header('Content-Disposition: attachment; filename='.$_FILES["imageUploaded"]["name"]);
header('Content-type: image/png'); 
//Output the image
imagepng($im);
// Free up memory
unlink($target_img);
imagedestroy($im);

?>
