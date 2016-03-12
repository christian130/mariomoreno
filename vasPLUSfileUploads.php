<?php
/**************************************************************
* This script is brought to you by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
****************************************************************/

session_start();
$upload_location = "uploads/twitter/";
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	$name = $_FILES['vasPhoto_uploads']['name'];
	$size = $_FILES['vasPhoto_uploads']['size'];
	
	$allowedExtensions = array("jpg","jpeg","gif","png");  //Allowed file types
	foreach ($_FILES as $file) 
	{
	  if ($file['tmp_name'] > '' && strlen($name)) 
	  {
		  if (!in_array(end(explode(".", strtolower($file['name']))), $allowedExtensions)) 
		  {
			  echo '<div class="info" style="width:500px;">Sorry, you attempted to upload an invalid file format. <br>Only jpg, jpeg, gif and png image files are allowed. Thanks.</div><br clear="all" />';
		  }
		  else 
		  {
			  if($size<(1024*1024))
			  {
				  $actual_image_name = $name; // This could be a random name such as rand(125678,098754).'.gif';
					 
				  if(move_uploaded_file($_FILES['vasPhoto_uploads']['tmp_name'], $upload_location.$actual_image_name)) 
				  {
                                      $_SESSION['media_name'] = $actual_image_name;
					  //Run your SQL Query here to insert the new image file named $actual_image_name if you deem it necessary
					  echo '<span class="uploadeFileWrapper"><img src="'.$upload_location.$actual_image_name.'" width="120" height="90"></span><br clear="all" /><br clear="all" />';
				  }
				  else 
				  {
					  echo "<div class='info' style='width:500px;'>Sorry, Your Image File could not be uploaded at the moment. <br>Please try again or contact the site admin if this problem persist. Thanks.</div><br clear='all' />";
				  }
			  }
			  else 
			  {
				  echo "<div class='info' style='width:400px;'>File exceeded 1MB max allowed file size. <br>Please upload a file at 1MB in size to proceed. Thanks.</div><br clear='all' />";
			  }
		  }
	  }
	  else 
	  {
		  echo "<div class='info' style='width:400px;'>You have just canceled your file upload process. Thanks.</div><br clear='all' />";
	  }
   }
}
?>