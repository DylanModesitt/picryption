<?php
ini_set('max_execution_time', 0);
// Model.php holds a variety of functions used across multiple scripts in picryption.
include 'model.php';

// Upload image to ../uploads/(file) so it can be encoded with a message

$target_dir = "../uploads/";
$target_img = $target_dir . $_FILES["imageUploaded"]["name"];
$img_result = move_uploaded_file($_FILES["imageUploaded"]["tmp_name"], $target_img);
$givenMessage = $_POST["secretMessage"];

try {
  imagepng(imagecreatefromfile($target_img) , $target_img);
}
catch(Exception $e) {
  giveErrorPopup($e);
}

function obscureImage($image)
{
	
  $imageToObscure = imagecreatefrompng($image);
  imagepalettetotruecolor($imageToObscure);
  list($width, $height) = getimagesize($image);
  
  $x = 0;
  $y = 0;

  for($y=0;$y<$height;$y++) {
    for($x=0;$x<$width;$x++) {
      $colors = imagecolorat($imageToObscure, $x, $y);
      $r = ($colors >> 16) & 0xFF;
      $g = ($colors >> 8) & 0xFF;
      $b = $colors & 0xFF;

      $rseed = $r/6;
      mt_srand($rseed);
      $newRed = mt_rand(0,255);

      $bseed = $b/6;
      mt_srand($bseed);
      $newBlue = mt_rand(0,255);

      $gseed = $g/6;
      mt_srand($gseed);
      $newGreen = mt_rand(0,255);

      $newColor = imagecolorallocate($imageToObscure, $newRed, $newGreen, $newBlue);
      imagesetpixel($imageToObscure, $x, $y, $newColor);
    }
  }

  return $imageToObscure;
}


try {
  $im = obscureImage($target_img);
}
catch(Exception $e) {
  giveErrorPopup($e);
}

// Set the content type header - in this case image/jpeg 
header('Content-Description: File Transfer');
header("Content-Type: application/octet-stream");
header('Content-Disposition: attachment; filename=' . $_FILES["imageUploaded"]["name"]);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

// Output the image
imagepng($im);

// Free up memory
unlink($target_img);
imagedestroy($im);
?>