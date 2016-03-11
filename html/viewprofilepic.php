<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript">
$(window).load(function(){

	var button = $('#change_button');
	var spinner = $('#spinner');

	//set the opacity to 0...
	button.css('opacity', 0);
	spinner.css('top', ($('.profile_pic').height() - spinner.height()) / 2)
	spinner.css('left', ($('.profile_pic').width() - spinner.width()) / 2)

	//On mouse over those thumbnail
	$('.profile_pic').hover(function() {
		button.css('opacity', .5);
		button.stop(false,true).fadeIn(200);
	},
	function() {
		button.stop(false,true).fadeOut(200);
	});

    new AjaxUpload(button,{
    	action: 'update_upload.php',
		name: 'myfile',
		onSubmit : function(file, ext){
			spinner.css('display', 'block');
			// you can disable upload button
			this.disable();
			},
		onComplete: function(file, response){
			button.stop(false,true).fadeOut(200);
			spinner.css('display', 'none');
			$('#profile_img').attr('src', response);
                        $('#hprofile_img').attr('src', response);
			// enable upload button
			this.enable();
		}
	});

});

</script>
<style type="text/css">

</style>

