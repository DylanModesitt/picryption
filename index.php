<!DOCTYPE html>
<!-- Insert header -->
<?php include 'assets/includes/header.php';  includeHeader("Picryption"); ?>

<body>
	<?php include 'assets/includes/nav.php'; ?>
		<div class="">
			<div class="container">
				<div class="page-header">
					<h1 class="red">Picryption<small> message in image</small></h1>
				</div>
				<div>
					<p class="big"> Picryption is a way to hide content inside an image. You can choose an image file and write out a secret message. Encrypting the image will give you back a new image, identical to the one you gave, but now encoded with your message. You can also decode any image that has been encoded using Picryption by uploading it and decrypting it. Thank you for using Picrytpion! </p>
				</div>
				<br>
				<br>
			</div>
		</div>
		<div class="dark">
			<div class="container">
				<div class="page-header">
					<h2>Encrypt image <small>with your message</small></h2>
				</div>
				<div class ="center-block text-left uploadContent">
					<FORM METHOD='post' enctype="multipart/form-data"  class="form-style-1" ACTION='./assets/php/encodeMessage.php'>
						<div class= "text-left left-block col-sm-6">
							<p class="big">Please upload an image that you would like to hide a secret message inside. Then type your message into the text field</p>
							<input id="uploadFileOne" placeholder="Choose Image" class="field" disabled="disabled" />
							<div class="fileUpload btn btn-danger">
								<span>Upload Image</span>
								<INPUT TYPE='file' class="field upload" id="uploadBtnOne" name='imageUploaded'/>
							</div>
							<h3 class="text-left"> Options: </h3>
							<br>
							<input type="checkbox" name="self-destruct" > Message self-destructs after date:&nbsp;&nbsp;&nbsp;
							<input type="text" name="days" class="field" placeholder="Days till destruction">
								<br>
								<br>
								<input type="checkbox" name="HTML-support" checked > Message Supports HTML&nbsp;&nbsp;&nbsp;
							<br><br><br>
						</div>

						<div class= "text-left center-block col-sm-6">
							<p class="big">Please paste the message you want to encode in the image below.
							<br><span>Characters remaining: <span id="count" title="1000"></span></span> </p>
							<textarea cols="40" rows="5" id="secretMessage" class="secretMessage" name="secretMessage" placeholder="Your secret message"></textarea>
						</div>
						<div class="col-xs-12">
							<input type="submit" value="Encrypt Image" class="btn btn-danger" name="submit">
						</div>
						<br><br>
					</FORM>
					
			</div>
		</div>
	</div>

<div class="">
		<div class="container">
			<div class="page-header">
				<h2>Read Image <small>with encypted message</small></h2>
			</div>
			<FORM METHOD='post' enctype="multipart/form-data"  ACTION='/assets/php/decodeMessage.php'>
				<div class= "text-left left-block col-sm-6">
					<p class="big">Upload an image that has had a message encoded in it by Picryption. The message will open in a new page.</p>
					<input id="uploadFileTwo" placeholder="Choose Image" disabled="disabled" />
					<div class="fileUpload btn btn-danger">
						<span>Upload Image</span>
						<INPUT TYPE='file' class="upload" id="uploadBtnTwo" NAME='imageUploaded'/>
					</div>
					<br><br>
				</div>
				<div class= "text-left left-block col-sm-12">
					<input type="submit" value="Decrypt Image" class="btn btn-danger" name="submit">
				</div>
			</FORM>
		<br>
	</div>
	<?php include 'assets/includes/footer.php'; ?>
</div>
</body>
</html>