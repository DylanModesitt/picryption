<!DOCTYPE html>
<!-- Insert header -->
<?php include 'assets/includes/header.php';  includeHeader("Picryption - Info"); ?>

<body>
<?php include 'assets/includes/nav.php'; ?>
	<div class="wrapper">
		<div class="container">
			<div class="page-header">
				<h1 class="red">Picryption<small> information</small></h2>
			</div>
			<div>
				<p class="big"> Steganography is the practice of concealing a file, message, image, or video within another file, message, image, or video. Picryption is a Stenography service that allows the hiding of content inside images through several methods. </p>

				<P> The advantage of steganography over cryptography alone is that the intended secret message does not attract attention to itself as an object of scrutiny. Plainly visible encrypted messages—no matter how unbreakable—arouse interest, and may in themselves be incriminating in countries where encryption <https://en.wikipedia.org/wiki/Encryption> is illegal.[2] <https://en.wikipedia.org/wiki/Steganography#cite_note-2> Thus, whereas cryptography is the practice of protecting the contents of a message alone, steganography is concerned with concealing the fact that a secret message is being sent, as well as concealing the contents of the message.</p>
			</div>

			<div class="page-header">
				<h2>Technical <small>information</small></h2>
			</div>
			<P>
			Picritpion is written in HTML and uses CSS for styling. JQuery and boostrap are used for javascript and CSS respectively. The Picryption scripts are written in PHP and use standard methods of seganography. The code is avaliable and open source <a href="https://github.com/DylanModesitt/picryption"> github. </a>
			</P>
			<div class="page-header">
				<h2>Contact <small>information</small></h2>
			</div>
			<P>
			Picritpion is developed and maintained by Dylan Modesitt, William Johnson, and Finn Banks. If you would like to work on the project or contact us for ideas or concerns, please do so in the form below. Thank you for using Picryption.
			</P>
			<br>
			<br>
			 <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="col-xs-12">
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="col-xs-12 ">
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="col-xs-12">
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" id="send" class="btn btn-default">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>	
	</div>	
<!-- Insert Footer -->
<?php include 'assets/includes/footer.php'; ?>
<script src="assets/js/jqBootstrapValidation.js"></script>
<script src="assets/js/contact_me.js"></script>
</body>
</html>