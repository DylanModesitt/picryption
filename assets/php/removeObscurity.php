<?php
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

function generateSeeds()
{
  $arr = array();
  for ($i=0; $i<27; $i++){
    mt_srand($i);
    $result = mt_rand(0,255);
    array_push($arr, $result);
  }
  return $arr;
}


function retrieveImage($image)
{

  $imageToRetrieve = imagecreatefrompng($image);
  imagepalettetotruecolor($imageToRetrieve);
  list($width, $height) = getimagesize($image);
  $x = 0;
  $y = 0;

    // find seeds and reset rgb values to original
    $seeds = generateSeeds();

    for($y=0;$y<$height;$y++) {
          for($x=0;$x<$width;$x++) {

            // get rgb values at pixel x,y
            $colors = imagecolorat($imageToRetrieve, $x, $y);
            $r = ($colors >> 16) & 0xFF;
            $g = ($colors >> 8) & 0xFF;
            $b = $colors & 0xFF;

            $rseed = array_search($r, $seeds);
            $bseed = array_search($b, $seeds);
            $gseed = array_search($g, $seeds);

            $newGreen = 6*$gseed;
            $newBlue = 6*$bseed;
            $newRed = 6*$rseed;


            //apply new rgb values to image
            $newColor = imagecolorallocate($imageToRetrieve, $newRed, $newGreen, $newBlue);
            imagesetpixel($imageToRetrieve, $x, $y, $newColor);
          }
      }
    return $imageToRetrieve;
    }


try {
  $im = retrieveImage($target_img);

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
  imagedestroy($im);
}
catch(Exception $e) {
  giveErrorPopup($e);
}

unlink($target_img);

?>