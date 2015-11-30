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
				<p> Picryption's obscure feature allows you to hide your image in plain sight. Upload your image, and Picryption will return a blank image, with the RGB values of each pixel changed according to an algorithm. You can then upload that image to Picryption and retrieve the original image.</p>
			</div>
			<br><br>
		</div>
<div class="dark">
	<div class="container">
		<div class="page-header">
			<h2>Obscure image <small><a href="#obscureImage" data-toggle="modal"> ? </a></small></h2>
		</div>
			<div class ="center-block text-left uploadContent">
				<FORM METHOD='post' enctype="multipart/form-data"  class="form-style-1" ACTION='./assets/php/obscure.php'>
					<div class= "text-left center-block col-sm-12">
						<p>Please upload the image that you would like to obscure.</p>
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
		<h2>Recover Image<small><a href="#recoverImage" data-toggle="modal"> ? </a></small></h2>
	</div>
	<FORM METHOD='post' enctype="multipart/form-data"  ACTION='/assets/php/removeObscurity.php'>
		<div class= "text-left center-block col-sm-12">
			<p>Upload an image that has been obscured by Picryption. The image will be downloaded.</p>
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



	<!-- info Modals -->

    <div class="info-modal modal fade" id="obscureImage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Obscure Image</h2>
                            <br>
                            <div class="DMblock-line"></div>
                            <br>
                            <p>
                            	Picryption uses randomization to rearrange the color values of each pixel upon obscuring it.
                            	This returns an unrecognizable image to the user that can be transmitted without worry of its content. 
                            	Upload an image, and hit obscure to be returned the obscured image. You can later recover the image.
                            </p>
                            <ul class="list-inline item-details">
                                <li>Code:
                                    <strong><a href="https://github.com/DylanModesitt/picryption">Github</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info-modal modal fade" id="recoverImage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Recover Image</h2>
                            <br>
                            <div class="DMblock-line"></div>
                            <br>
                            <p>
                            	Picryption uses randomization to rearrange the color values of each pixel upon obscuring it.
                            	This returns an unrecognizable image to the user that can be transmitted without worry of its content. 
                            	Upload an image, and hit recover to be returned the returned image from one obscured using Picryption. 
                            	You can also obscure new images.
                            </p>
                            <ul class="list-inline item-details">
                                <li>Code:
                                    <strong><a href="https://github.com/DylanModesitt/picryption">Github</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
</html>