<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    <body>
        <?php //include 'header.php'; ?>
        <div id="logincontainer">
            <div id="logincontainer">
                <div class="thankyou">
                    <div class="log_error">Please re-enter your password<br/>
                        <p class="err_msg">The password you entered is incorrect. Please try again (make sure your caps lock is off).<br/>
                        Forgot your password? Request a new one.</p>
                    </div><br>
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
                                <input type="text" id="login_password"></input>
                            </td>
                            <td style="text-align: left !important;padding-left:10px;width:40%;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right" style="padding-right:387px !important;"><input id="login_btn" type="button" value="Login" /></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
