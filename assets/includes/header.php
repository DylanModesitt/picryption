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
				<meta name="keywords" content="dylanmodesitt, Dylan Modesitt, picryption">
				<title>'.$title.'</title>

				<!-- Bootstrap Core CSS - Uses Bootswatch Paper Theme: http://bootswatch.com/paper/ -->
				<link href="assets/css/bootstrap.min.css" rel="stylesheet">

				<!-- Custom CSS -->
				<link href="assets/css/the.css" rel="stylesheet">

			</head>';

}

?>