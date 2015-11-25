<!DOCTYPE html>
<!-- Insert header -->
<?php include 'assets/includes/header.php';  includeHeader("Picryption - Image Obscure"); ?>
<?php include 'assets/includes/nav.php'; ?>
<body>
		<div class="container">
			<div class="page-header">
				<h1 class="red">Picryption<small> obscure image</small></h1>
			</div>
			<div>
				<p class="big"> Picryption's obscure feature allows you to hide your image in plain sight. Upload your image, and Picryption will return a blank image, with the RGB values of each pixel changed according to an algorithm. You can then upload that image to Picryption and retrieve the original image.</p>
			</div>
			<br><br>
		</div>
<div class="dark">
	<div class="container">
		<div class="page-header">
			<h2>Obscure image <small>so you can choose who sees it</small></h2>
		</div>
			<div class ="center-block text-left uploadContent">
				<FORM METHOD='post' enctype="multipart/form-data"  class="form-style-1" ACTION='./assets/php/obscure.php'>
					<div class= "text-left center-block col-sm-12">
						<p class="big">Please upload the image that you would like to obscure.</p>
						<input id="uploadFileOne" placeholder="Choose Image" disabled="disabled" />
						<div class="fileUpload btn btn-danger">
							<span>Upload Image</span>
							<INPUT TYPE='file' class="upload" id="uploadBtnOne" name='imageUploaded'/>
						</div>
						<br><br>
					</div>						
					<div class= "text-left center-block col-sm-12">
						<input type="submit" value="Obscure Image" class="btn btn-danger" name="submit">
					</div>
				</FORM>
			</P>
		</div>
	</div>
</div>
<div class="container">
	<div class="page-header">
		<h2>Recover Image <small>that was obscured</small></h2>
	</div>
	<FORM METHOD='post' enctype="multipart/form-data"  ACTION='/assets/php/removeObscurity.php'>
		<div class= "text-left center-block col-sm-12">
			<p class="big">Upload an image that has been obscured by Picryption. The image will be downloaded.</p>
			<input id="uploadFileTwo" placeholder="Choose Image" disabled="disabled" />
			<div class="fileUpload btn btn-danger">
				<span>Upload Image</span>
				<INPUT TYPE='file' class="upload" id="uploadBtnTwo" NAME='imageUploaded'/>
			</div>
			<br><br>
		</div>
		<div class= "text-left center-block col-sm-12">
			<input type="submit" value="Decrypt Image" class="btn btn-danger" name="submit">
		</div>
	</FORM>
	<br>
</div>

	<!-- Insert Footer -->
	<?php include 'assets/includes/footer.php'; ?>
</body>
</html>