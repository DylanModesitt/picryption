<?php
ini_set('max_execution_time', 0);
// Modal.php holds a variety of functions used across multiple scripts in picryption.

include 'model.php';

// Upload image to ../uploads/(file) so it can be encoded with a message

$target_dir = "../uploads/";
$target_img = $target_dir . $_FILES["imageUploaded"]["name"];
$img_result = move_uploaded_file($_FILES["imageUploaded"]["tmp_name"], $target_img);
$givenMessage = $_POST["secretMessage"];

if ($img_result == FALSE) { giveUploadErrorPopup(); } 
// Check if image is valid and overwrite it as a PNG

try {
  // Read header in image to check for modifcation that needs to be done
  readExifData($target_img);
  imagepng(imagecreatefromfile($target_img) , $target_img);
}
catch(Exception $e) {
  giveErrorPopup($e);
}

function encodeImageWithMessage($message, $image)
{
  ini_set('memory_limit', '128M');
  $imageToModify = imagecreatefrompng($image);
  imagepalettetotruecolor($imageToModify);
  list($width, $height) = getimagesize($image);
  if(!isset($_POST['HTML-support'])) {
    $message = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($message))))));
  }
  $binaryGiven = messageToBinary($message);
  $x = 0;
  $y = 0;

  $startLoop = 0;
  // check if message is too long for image size:
  if(strlen($binaryGiven) > $width * $height) {
    throw new InvalidArgumentException('Message is too long to encode in this image.');
  }

  // add self destruction codon if requested 
  // check if check box for that option is checked
  if (isset($_POST['self-destruct'])) {
    $daysLeft = $_POST["days"];
    $dayGood = date("d") + $daysLeft;
    $dateGood = date("m.".$dayGood.".Y");
    // get the binary message that includes a notice codon and a date
    $binaryToAdd = "00000001".messageToBinary(strval($dateGood));
    $binaryGiven = $binaryToAdd.$binaryGiven;
  }

  // hide bit in r value
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
        $newR = encodeBitInColor($r,$currentBit);
        
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
       $newR = encodeBitInColor($r,"0"); 

      $newColor = imagecolorallocate($imageToModify, $newR, $g, $b);
      imagesetpixel($imageToModify, $x, $y, $newColor);
  }
  return $imageToModify;
}


try {
  $im = encodeImageWithMessage($givenMessage, $target_img);
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