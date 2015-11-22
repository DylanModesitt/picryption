<!DOCTYPE html>
<!-- Insert header -->
<?php include 'assets/includes/header.php';  includeHeader("Picryption"); ?>

<body>
<?php include 'assets/includes/nav.php'; ?>
	<div class="wrapper">
		<div class="container">
			<div class="page-header">
				<h2>Picryption<small> message in image</small></h2>
			</div>
			<div>
				<p class="big"> Picryption is a way to hide content inside an image. You can choose an image file and write out a secret message. Encrypting the image will give you back a new image, identical to the one you gave, but now encoded with your message. You can also decode any image that has been encoded using Picryption by uploading it and decrypting it. Thank you for using Picrytpion! </p>
			</div>

			<div class="page-header">
				<h2>Encrypt image <small>with your message</small></h2>
			</div>
			<P>
				<div class ="center-block text-center uploadContent">
					<FORM METHOD='post' enctype="multipart/form-data"  class="form-style-1" ACTION='./assets/php/encode.php'>
						<div class= "text-center center-block col-sm-6">
							<p class="big">Please upload an image that you would like to hide a secret message inside. Then type your message into the text field</p>
							<input id="uploadFileOne" placeholder="Choose Image" disabled="disabled" />
							<div class="fileUpload btn btn-primary">
								<span>Upload Image</span>
								<INPUT TYPE='file' class="upload" id="uploadBtnOne" name='imageUploaded'/>
							</div>
							<br><br>
						</div>

						<div class= "text-center center-block col-sm-6">
							<p class="big">Please paste the message you want to encode in the image below. </p>
							<textarea cols="40" rows="5" class="secretMessage" name="secretMessage" placeholder="Your secret message"></textarea>
							<p>
								<span>Characters remaining: <span id="count" title="1000"></span></span>
							</p>
							<br><br>
						</div>
						<div class="col-xs-12 text-left checkbox">
							<h3> Options: </h3>
							<br>
							<label>
								<input type="checkbox" name="self-destruct" > Message self-destructs after date:
								<input type="text" name="days" placeholder="Days till destruction">
							</label>
							<br>
							<br>
							<label>
								<input type="checkbox" name="pass-protect" > Password Protect Image:
								<input type="text" name="password" placeholder="password">
							</label>
							<br>
							<br>
							<label>
								<input type="checkbox"> Message supports HTML
							</label>
						</div>

						<input type="submit" value="Encrypt Image" class="btn btn-danger" name="submit">
					</FORM>
				</P>
			</div>
		</div>
	</P>
</div>
</div>

<div class="wrapper">
	<div class="container">
		<div class="page-header">
			<h2>Read Image <small>with encypted message</small></h2>
		</div>
		<FORM METHOD='post' enctype="multipart/form-data"  ACTION='/assets/php/decode.php'>
			<div class= "text-center center-block col-sm-6">
				<p class="big">Upload an image that has had a message encoded in it by Picryption. The message will open in a new page.</p>
				<input id="uploadFileTwo" placeholder="Choose Image" disabled="disabled" />
				<div class="fileUpload btn btn-primary">
					<span>Upload Image</span>
					<INPUT TYPE='file' class="upload" id="uploadBtnTwo" NAME='imageUploaded'/>
				</div>
				<br><br>
			</div>
			<div class= "text-center center-block col-sm-6">
				<input type="submit" value="Decrypt Image" class="btn btn-danger" name="submit">
			</div>
		</FORM>
	</P>
	<br>
</div>	
</P>
</div>
</div>
<!-- Insert Footer -->
<?php include 'assets/includes/footer.php'; ?>
</body>
</html>