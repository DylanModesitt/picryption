var selectedFile;

document.getElementById("uploadBtnOne").onchange = function () {
	document.getElementById("uploadFileOne").value = this.value.replace(/^.*\\/, "");
};

$(".secretMessage").keyup(function(){
	var width = $('#uploadBtnOne').files[0].width;
	var height = $('#uploadBtnOne').files[0].height;
  $("#count").text(width*height - $(this).val().length);
});

document.getElementById("uploadBtnTwo").onchange = function () {
	document.getElementById("uploadFileTwo").value = this.value.replace(/^.*\\/, "");
};