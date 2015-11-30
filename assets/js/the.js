var size;
var toShowCharacters = false;

$("#uploadBtnOne").change(function (e) {
	document.getElementById("uploadFileOne").value = this.value.replace(/^.*\\/, "");
    var file = this.files[0];
     var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
 
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    toShowCharacters = true;
                    size = (height*width) / 8;
                };
            }
});

$(".secretMessage").keyup(function(){
    if(size && toShowCharacters) {
        var str1 = "Characters remaining: ";
        var str2 = size - $(this).val().length
        $("#count").text(str1 + str2);
    }
});

document.getElementById("uploadBtnTwo").onchange = function () {
	document.getElementById("uploadFileTwo").value = this.value.replace(/^.*\\/, "");
};
document.getElementById("uploadBtnThree").onchange = function () {
    document.getElementById("uploadFileThree").value = this.value.replace(/^.*\\/, "");
};
document.getElementById("uploadBtnFour").onchange = function () {
    document.getElementById("uploadFileFour").value = this.value.replace(/^.*\\/, "");
};





