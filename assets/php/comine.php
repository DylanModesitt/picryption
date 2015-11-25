<?php
ini_set('max_execution_time', 0);
// Model.php holds a variety of functions used across multiple scripts in picryption.
include 'model.php';

// Upload image to ../uploads/(file) so it can be encoded with a message

$target_dir = "../uploads/";
$target_img1 = $target_dir . $_FILES["imageUploaded1"]["name"];
$target_img2 = $target_dir . $_FILES["imageUploaded2"]["name"];
$target_img3 = $target_dir . $_FILES["imageUploaded3"]["name"];
$img_result1 = move_uploaded_file($_FILES["imageUploaded1"]["tmp_name"], $target_img);
$img_result1 = move_uploaded_file($_FILES["imageUploaded2"]["tmp_name"], $target_img);
$img_result3 = move_uploaded_file($_FILES["imageUploaded3"]["tmp_name"], $target_img);
$givenMessage = $_POST["secretMessage"];

try {
  imagepng(imagecreatefromfile($target_img1) , $target_img1);
  imagepng(imagecreatefromfile($target_img2) , $target_img2);
  imagepng(imagecreatefromfile($target_img3) , $target_img3);
}
catch(Exception $e) {
  giveErrorPopup($e);
}

function combineImage($image1,$image2,$image3)
{
  $imageToCombineOne = imagecreatefrompng($image);
  imagepalettetotruecolor($imageToObscure);
  list($width, $height) = getimagesize($image);
  
  $x = 0;
  $y = 0;
  /*  old manipulation
  
  for($y=0;$y<$height;$y++) {
    for($x=0;$x<$width;$x++) {
      $colors = imagecolorat($imageToObscure, $x, $y);
      $r = ($colors >> 16) & 0xFF;

      $newColor = imagecolorallocate($imageToObscure, $r/10,rand(0,255), rand(0,255));
      imagesetpixel($imageToObscure, $x, $y, $newColor);
    }
  }
  */

  // new seeded manipulation

  for($y=0;$y<$height;$y++) {
    for($x=0;$x<$width;$x++) {
      $colors = imagecolorat($imageToObscure, $x, $y);
      $r = ($colors >> 16) & 0xFF;
      $g = ($colors >> 8) & 0xFF;
      $b = $colors & 0xFF;

      $rseed = $r/3;
      mt_srand($rseed);
      $newRed = mt_rand(0,255);

      $bseed = $b/3;
      mt_srand($bseed);
      $newBlue = mt_rand(0,255);

      $gseed = $g/3;
      mt_srand($gseed);
      $newGreen = mt_rand(0,255);

      $newColor = imagecolorallocate($imageToObscure, $newRed, $newGreen, $newBlue);
      imagesetpixel($imageToObscure, $x, $y, $newColor);
    }
  }

  return $imageToObscure;
}


try {
  $im = obscureImage($target_img1,$target_img2,$target_img3);
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