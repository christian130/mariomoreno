/**************************************************************
* This script is brought to you by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
****************************************************************/


//Automatic Uploader
$(document).ready(function() 
{
	$('#vasPhoto_uploads').on('change', function()
	{
		$("#vasPLUS_Programming_Blog_Form").vPB({
			url: 'vasPLUSfileUploads.php',
			beforeSubmit: function() 
			{
				$("#preview").show();
				$("#preview").html('');
				$("#preview").html('<div style="font-family: Verdana, Geneva, sans-serif; font-size:12px; color:black;" align="center">Upload <img src="images/loadings.gif" align="absmiddle" alt="Upload...." title="Upload...."/></div><br clear="all">');
			},
			success: function(response) 
			{
				$("#preview").hide().fadeIn('slow').html(response);
			}
		}).submit();
	});          
}); 