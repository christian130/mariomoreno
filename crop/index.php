<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Crop Image And Upload Using Jquery, HTML5 and PHP</title>
<!-- Javascripts -->
<link type="text/css" rel="stylesheet" href="style.css">
<link href="css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js"></script>
<script src="js/jquery.Jcrop.min.js"></script>
 <script src="js/script.js"></script>
</head><body>

<div id="main_header">
	<div id="header">
		<div id="logo">
			<span style="font-size:32px;">Crop Image And Upload Using Jquery, HTML5 and PHP</span>
		</div>
			</div>
</div><div id="wrapper">
<div id="left_content" style="float:left;width:158px;height:auto;">

<div id="profile_pic">
<img src="images/pro.jpg" id="thumb"/>
</div>
<br/>

<strong>W : </strong><input type="text" id="w1" name="w1" style="width:50px;"/>
&nbsp;
<strong>H : </strong><input type="text" id="h1" name="h1" style="width:50px;"/>
<br/><br/>

<div style="width:155px;float:left;">
<div id="menu_header">Menus</div>
<div id="blueblock">
<ul>


<li class="cat-item cat-item-4"><a href="#">My Account</a></li>
<li class="cat-item cat-item-4"><a href="#">Manage Connections</a></li>
<li class="cat-item cat-item-4"><a href="#">Manage Groups</a></li>
<li class="cat-item cat-item-4"><a href="#">My Friends</a></li>
<li class="cat-item cat-item-4"><a href="#">Change Password</a></li>
<li class="cat-item cat-item-4"><a href="#">Logout</a></li>

</ul>
</div>
<div id="menu_bottom"></div>
</div>
</div>
<div style="float:right;width:804px;">
<form id="upload_form" enctype="multipart/form-data" method="post" action="upload.php" onsubmit="return validateForm();" >
	<input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />
    <input type="hidden" id="x1" name="x1" />
    <input type="hidden" id="y1" name="y1" />
    <input type="hidden" id="x2" name="x2" />
    <input type="hidden" id="y2" name="y2" />
<h1>Change Profile Picture</h1>
<div class="file_field">
<strong>Select An Image: </strong>
<input type="file" style="width:220px;" id="image_file" name="image_file">
<input type="submit" value="Upload"/>
</div>
<br/>
<div class="error" style="display: none;">
Manish Kumar Jangir
</div>
<br/>
<div id="image_div" style="display:none;">
<img src="" id="load_img"/>
<br/>

</div>
</form>
</div>

<div style="clear: both"></div>
</div>
<div id="footer">
	<div id="footer_nav">
		Copyright &copy; 2012. All rights reserved to <a href="http://www.blogaddition.com/">Manish Jangir Production</a>
	</div>
</div></body></html>