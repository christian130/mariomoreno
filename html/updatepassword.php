<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:WHATSDADILLY:</title>
<link rel="stylesheet" href="css/reset-min.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

          $("#ForgotForm").validate({
            rules: {
                log_password:{
                    required:true
                }
            },
            messages: {
                log_password:{
                    required:"Enter password"
                }
            }
        });

    });
</script>
</head>

<body>
<div id="topblack">
	<div class="topinner">
     <div id="logo"><a href=""><img src="images/logo.png" alt="WHATSDADILLY" /></a></div>
     <span class="amember2"><a href="index.php">Log In</a></span>
     <span class="amember">Already a WDD Member?</span>

    	</div>
	</div>
<div id="logincontainer">
	<div class="logleft">
    	<h1>Find out what’s happening, right now,</h1>
		<h2>with all your social netwroks, all-in-on.</h2>
        <div id="sicons">
	<ul>
   <li><a href="#">Facebook</a></li>
   <li><a href="#">Tweeter</a></li>
   <li><a href="#">LIn</a></li>
   <li><a href="#">Gplus</a></li>
   <li><a href="#">Facebook</a></li>
   <li><a href="#">Tweeter</a></li>
   <li><a href="#">LIn</a></li>
   <li class="nomargR"><a href="#">Gplus</a></li>
    </ul>
	</div>
    <div class="orngtxt orngmarg">Mix all your social networks in one</div>
    <div class="orngtxt">Share what’s new in your life on your Timeline</div>
    <div class="orngtxt">See all updates from friends in one News Feed</div>
			    			</div>
  <form id="ForgotForm" class="Form FancyForm AuthForm" action="updatepassword.php" method="POST" accept-charset="utf-8">
   <div class="signbgwrap">
   	<div class="signbg">
    	<h3>- Forgot Password</h3>
        <!--<input type="text" value="" class="locinput2"  name="login_username" placeholder="Enter your email id" />-->
        <input type="password" class="locinput2" name="log_password" id="log_password" value="" placeholder="Password" />
         <input type="text" class="locinput2" name="token" id="token" value="<?php echo $_GET['token']; ?>" placeholder="Password" />
        <input type="submit" value="Update password" class="btn_signup" />
         </div>
   </div>
  </form>
  <div class="logfoot">
  	<div class="fmenu">
      <ul>
   <li><a href="#">About</a></li>
   <li><a href="#">Help</a></li>
   <li><a href="#">Blog</a></li>
   <li><a href="#">Status</a></li>
   <li><a href="#">Terms</a></li>
   <li><a href="#">Privacy</a></li>
   <li><a href="#">Advertisers</a></li>
   <li><a href="#">Businesses</a></li>
   <li><a href="#">Directory</a></li>
      </ul>
    	</div>
  <span class="toimg"><img src="images/tobg.png" alt="" /></span>
  <p>Copyright 2013 whatsdadilly. All Rights Reserved.</p>
  				</div>
	</div>
</body>
</html>
