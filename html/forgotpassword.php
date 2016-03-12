<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>:WHATSDADILLY:</title>
<link rel="stylesheet" href="css/reset-min.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/Landingstyle.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

          $("#ForgotForm").validate({
            rules: {
                log_username:{
                    required:true,
                    validusername:true
                }
            },
            messages: {
                log_username:{
                    required:"Enter username",
                    validusername:"Email address not found"
                }
            }
        });

    });$.validator.addMethod('validusername',function(value){
                var getURL = "validusername.php";
                var log_username = $("#log_username").val();
                var result;
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       'email='+log_username,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 1)
                        {
                            result = true;
                        }
                        else if(data.success == 0)
                        {
                            result = false;
                        }
                    }
                });
                return result;
            }, '');
</script>
</head>

<body>
<div id="container">
<div class="forget_outer">
<div class="top_logo_main">
<div class="container">
<div class="col-sm-4"><div id="logo"><a href=""><img src="images/logo.png" alt="WHATSDADILLY" /></a></div></div>
<div class="col-sm-8">
<div class="right_text">
 <span class="amember2"><a href="index.php">Log In</a></span>
     <span class="amember">Already a WDD Member?</span>
</div>
</div>
</div>
</div>
<div class="email_box_main">
<div class="container pad_main">
<div class="email_box_ttp">
<div class="email_box_down">
 	<h1>Find out what’s happening, right now,</h1>
		<h2>with all your social netwroks, all-in-on.</h2>
<form id="ForgotForm" class="Form FancyForm AuthForm" action="forgotpassword.php" method="POST" accept-charset="utf-8">
   <div class="signbgwrap">
   	<div class="signbg">
    	<h3>- Forgot Password</h3>
        <!--<input type="text" value="" class="locinput2"  name="login_username" placeholder="Enter your email id" />-->
        <input type="text" class="locinput2" name="log_username" id="log_username" value="" placeholder="Username" />
        <input type="submit" value="Forgot password" class="btn_signup" />   
         </div>
   </div>
  </form></div> 

</div>
</div>
</div>
</div>

<div id="footer">
		<div class="landing_footer">
	<div class="container">
        <a href="#">About</a>     
        <a href="#">Help</a>  
        <a href="#">Blog</a>  
        <a href="#">Status</a>    
        <a href="#">Teams</a>
        <a href="#">Privacy</a> 
        <a href="#">Advertisers</a> 
        <a href="#">Businesses</a>
        <a href="#">Directory</a>
        <a href="#">@WhatsDaDilly 2016</a>
    </div>
</div>
</div>
</div>


</body>
</html>
