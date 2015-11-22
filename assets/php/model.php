<?php

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

// universal creation of image wihtout regards to filetype. 
function imagecreatefromfile( $filename ) {
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "'.$filename.'" not found.');
    }
    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
            break;

        case 'png':
            return imagecreatefrompng($filename);
            break;

        case 'gif':
        case 'GIF':
            return imagecreatefromgif($filename);
            break;

        default:
            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
            break;
    }
}

function encodeBitInColor($c, $currentBit) {
  $newC = $c;
  if($c % 2 == 0 && $currentBit == '1') {
    if($c >= 255) {
      $newC = $c-1;
    } else {
      $newC = $c+1;
    }
  } elseif ($c % 2 == 1 && $currentBit == '0') {
    if($c >= 255) {
      $newC = $c-1;
    } else {
      $newC = $c+1;
    }
  }
  return $newC;
}

function giveErrorPopup($e) {
  echo '<script type="text/javascript"> alert ("There was an error: ' . $e->getMessage() . '"); window.history.back()</script>';
}


?>
