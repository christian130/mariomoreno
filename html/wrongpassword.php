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
                $("#AuthForm_log").validate({
                    rules: {
                        login_password:{
                            required:true
                        }
                    },
                    messages: {
                        login_password:{
                            required:"Enter password"

                        }
                    }
                });
                $('#login_btn').click( function() {
                    if($("#AuthForm_log").valid()){
                        $( "#AuthForm_log" ).submit();
                    }


                });
            });
        </script>
    </head>
    <body>
        <?php //include 'header.php'; ?>
		
		
		<div id="container">
<div class="forget_outer">
<div class="top_logo_main">
<div class="container">
<div class="col-sm-4"><div id="logo"><a href=""><img src="images/logo.png" alt="WHATSDADILLY" /></a></div></div>

</div>
</div>
<div class="email_box_main">
<div class="container pad_main">
<div class="email_box_ttp">
<div class="email_box_down">
 	<div class="log_error">Please re-enter your password<br/>
                        <p class="err_msg">The password you entered is incorrect. Please try again (make sure your caps lock is off).<br/>
                            Forgot your password? Request a new one.</p>
                    </div>
<form id="AuthForm_log" class="Form FancyForm AuthForm" action="userlogin.php" method="POST">
<div class="profile_boder">
<span class="login_text"> Login as</span>
<span class="user_img"><img style="border-radius:4px;" src="uploads/<?php echo $result_user[0]['profile_pic']; ?>"  /></span>
                                
<span class="user_name"><p><?php echo ucfirst($result_user[0]['firstname']); ?></p>
<p class="err_msg"><?php echo $result_user[0]['email']; ?></p></span></div>
                               
                               <div class="password_text">
                                 
                                  <span class="login_text1">      Password</span>
                               
                                
                                      <span class="input_box_mian">  <input type="hidden" name="login_username" id="login_username" value="<?php echo $result_user[0]['email']; ?>" placeholder="Username">
                                            <input type="password" name="login_password" id="login_password" value="" placeholder="Password"></input></span>
                               
                                  
                              
                        
                                       <span class="button_logon"> <input id="login_btn" type="button" value="Login" /></span></div>
                            
                        
                        </form>
						
						<div class="Forgottenyourpassword1"><a href="forgotpassword.php">Forgot your password?</a></div> 
						</div>

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
		
		
		
		
		
		
		
		
		
		
		
        <!--<div id="logincontainer">
            <div id="logincontainer">
                <div class="thankyou">
                    <div class="log_error">Please re-enter your password<br/>
                        <p class="err_msg">The password you entered is incorrect. Please try again (make sure your caps lock is off).<br/>
                            Forgot your password? Request a new one.</p>
                    </div><br>
                        <form id="AuthForm_log" class="Form FancyForm AuthForm" action="userlogin.php" method="POST">
                            <table width="100%" class="wd_wrong" style="padding-left: 100px;">
                                <tr>
                                    <td width="40%">
                                        Login as
                                    </td>
                                    <td style="text-align: left !important;padding-left:90px;width:20%;">
                                        <img style="border-radius:4px;" src="uploads/<?php echo $result_user[0]['profile_pic']; ?>" width="100px" height="100px" />
                                    </td>
                                    <td style="text-align: left !important;padding-left:10px;width:40%;">
                                        <p><?php echo ucfirst($result_user[0]['firstname']); ?></p>
                                        <p class="err_msg"><?php echo $result_user[0]['email']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Password
                                    </td>
                                    <td style="text-align: left !important;padding-left:10px;width:20%;">
                                        <input type="hidden" name="login_username" id="login_username" value="<?php echo $result_user[0]['email']; ?>" placeholder="Username">
                                            <input type="password" name="login_password" id="login_password" value=""></input>
                                    </td>
                                    <td style="text-align: left !important;padding-left:10px;width:40%;">

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right" style="padding-right:387px !important;">
                                        <input id="login_btn" type="button" value="Login" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                </div>
            </div>
        </div>-->
    </body>
</html>
