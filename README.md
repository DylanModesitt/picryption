# picryption

Picryption is a website that is a way to encode content inside images.

<h2> About Steganography </h2>
Steganography is the practice of concealing a file, message, image, or video within another file, message, image, or video. Picryption is a Stenography service that allows the hiding of content inside images through several methods.

The advantage of steganography over cryptography alone is that the intended secret message does not attract attention to itself as an object of scrutiny. Plainly visible encrypted messages—no matter how unbreakable—arouse interest, and may in themselves be incriminating in countries where encryption is illegal.[2] Thus, whereas cryptography is the practice of protecting the contents of a message alone, steganography is concerned with concealing the fact that a secret message is being sent, as well as concealing the contents of the message.

<h2> How Picryption Works </h2>
The scripts of Picryption are located in /assets/php/ with various scripts that operate mostly by changing the RGB values of the pixels of the image to be binary based on the even or odd nature of the color. This binary can be read as a string, and similarly any image can have a string written into it by tweaking slgihtly the colors of each pixel to match the binary representation of the string to later be read back. Picryption also allows the obscuring and de-obscuring of images.

<h4> Libraries </h4>
Piryption uses bootsrap for the CSS grid layout, and JQeury for some functions. PHP is the language that the encoding scripts are written in. <a href="https://reactiveraven.github.io/jqBootstrapValidation/"> jqBootsrapValidation </a> is used for the contact page.

<h2> How to locally setup Picryption </h2>
You can download all the files on this github and move them on to a server of your choice to run Picryption locally. If you would like to work on the project, please contact me.
<br><br><br>
<h2> QED </h2>
