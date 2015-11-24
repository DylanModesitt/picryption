<?php

function includeHeader($title) {
	echo '<html lang="en">
			<head>
				<!-- MSC -->
				<meta http-equiv="content-type" content="text/html;charset=utf-8" />
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">

				<!-- SEO -->
				<meta name="author" content="Dylan Modesitt">
				<meta name="Description" content="Picryption allows the hiding of content (messages, images, files) inside images using steganography. Hide or "encrypt" anything in a photo or image using Picryption.">
				<meta name="Keywords" content="picryption, steganography, picture encryption, message in picture, message in image, image encryption, encryption, obscure image, modify image, filter image, picryption tool, image modification, dylan modesitt, will johnson, finn banks, image encryption tool, way to encrypt images, way to decode image, steganography encoder, hide message, secret image.">

				<title>'.$title.'</title>

				<!-- Bootstrap Core CSS - Uses Bootswatch Paper Theme: http://bootswatch.com/paper/ -->
				<link href="../css/bootstrap.min.css" rel="stylesheet">

				<!-- Custom CSS -->
				<link href="../css/the.css" rel="stylesheet">

				<!-- Icons and Branding -->

    			<link rel="shortcut icon" href="./../img/icon.png"> 
    			<link rel="apple-touch-icon" href="./../img/icon.png">
    			
    			<script>
				  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

				  ga("create", "UA-70492626-1", "auto");
				  ga("send", "pageview");

				</script>

			</head>';

}




?>