//Make global variables for selected image for further usage
var selectImgWidth,selectImgHeight,jcrop_api, boundx, boundy,isError=false;
$(document).ready(function(){
	$("#image_file").change(function(){
		var previewId = document.getElementById('load_img');
	    var thumbId = document.getElementById('thumb');
	    previewId.src = '';
		$('#image_div').hide();
	    var flag = 0;
	    
	    // Get selected file parameters
	    var selectedImg = $('#image_file')[0].files[0];
	    
	    //Check the select file is JPG,PNG or GIF image
	    var regex = /^(image\/jpeg|image\/png)$/i;
	    if (! regex.test(selectedImg.type)) {
	        $('.error').html('Please select a valid image file (jpg and png are allowed)').fadeIn(500);
	        flag++;
	        isError = true;
	    }
	    
	    // Check the size of selected image if it is greater than 250 kb or not
	    else if (selectedImg.size > 250 * 1024) {
	        $('.error').html('The file you selected is too big. Max file size limit is 250 KB').fadeIn(500);
	        flag++;
	        isError = true;
	    }
	    
	    if(flag==0){
	    isError=false;
	    $('.error').hide(); //if file is correct then hide the error message
	    
	    
	    // Preview the selected image with object of HTML5 FileReader class
	    // Make the HTML5 FileReader Object
	    var oReader = new FileReader();
	        oReader.onload = function(e) {

	        // e.target.result is the DataURL (temporary source of the image)
	        	thumbId.src = previewId.src=e.target.result;
	        	
	        	// FileReader onload event handler
	        	previewId.onload = function () {

	            // display the image with fading effect
	            $('#image_div').fadeIn(500);
	            selectImgWidth = previewId.naturalWidth; //set the global image width
	        	selectImgHeight = previewId.naturalHeight;//set the global image height
	        	
	            // Create variables (in this scope) to hold the Jcrop API and image size
	           
	            // destroy Jcrop if it is already existed
	            if (typeof jcrop_api != 'undefined') 
	                jcrop_api.destroy();

	            // initialize Jcrop Plugin on the selected image
	            $('#load_img').Jcrop({
	                minSize: [32, 32], // min crop size
	               // aspectRatio : 1, // keep aspect ratio 1:1
	                bgFade: true, // use fade effect
	                bgOpacity: .3, // fade opacity
	                onChange: showThumbnail,
	                onSelect: showThumbnail
	            }, function(){

	                // use the Jcrop API to get the real image size
	                var bounds = this.getBounds();
	                boundx = bounds[0];
	                boundy = bounds[1];

	                // Store the Jcrop API in the jcrop_api variable
	                jcrop_api = this;
	            });
	        };
	    };

	    // read selected file as DataURL
	    oReader.readAsDataURL(selectedImg);
	}
	})
})

function showThumbnail(e)
{
	var rx = 155 / e.w; //155 is the width of outer div of your profile pic
	var ry = 190 / e.h; //190 is the height of outer div of your profile pic
	$('#w').val(e.w);
    $('#h').val(e.h);
    $('#w1').val(e.w);
    $('#h1').val(e.h);
    $('#x1').val(e.x);
    $('#y1').val(e.y);
    $('#x2').val(e.x2);
    $('#y2').val(e.y2);
	$('#thumb').css({
		width: Math.round(rx * selectImgWidth) + 'px',
		height: Math.round(ry * selectImgHeight) + 'px',
		marginLeft: '-' + Math.round(rx * e.x) + 'px',
		marginTop: '-' + Math.round(ry * e.y) + 'px'
	});
}

function validateForm(){
	if ($('#image_file').val()=='') {
        $('.error').html('Please select an image').fadeIn(500);
        return false;
    }else if(isError){
    	return false;
    }else {
    	return true;
    }
}