<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>:WHATSDADILLY:</title>
     <!--   <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" /> -->



        <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min1.css" rel="stylesheet">
 <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/registration-process1.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


        <script type="text/javascript">
            $(document).ready( function() {
                $(".delbutton").click(function(){

                    //Save the link in a variable called element
                    var element = $(this);

                    //Find the id of the link that was clicked
                    var del_id = element.attr("id");

                    //Built a url to send
                    var info = 'account_id=' + del_id;
                    if(confirm("Sure you want to delete this account? There is NO undo!"))
                    {

                        $.ajax({
                            type: "GET",
                            url: "delete_account.php",
                            data: info,
                            success: function(){

                            }
                        });
                        $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                        .animate({ opacity: "hide" }, "slow");

                    }

                    return false;

                });
            });
        </script>
<style>

#topblack
{
top:0px;
}

body
{
background:#fff !important;
padding-top: 0px !important;
}
td
{
color:#333 !important;
}

</style>
    </head>
    <body>
        <?php include 'header.php' ?>

<?php

require 'instagramoauth/instagram.class.php';

// initialize class
$instagram = new Instagram(array(
  'apiKey'      => '5b610f1450884e93b4511629141a74af',
  'apiSecret'   => 'abebe7c0cd504e64ae885c85b18cd33f',
  'apiCallback' => 'http://whatsdadilly.com/betaPhase/instagram_add.php' // must point to success.php
));

// create login URL
$loginUrl = $instagram->getLoginUrl();

?>

<div class="cols-xs">
  <br/>
<p class="InviteYourFrieds"><i>Add Your Social Media and Email Accounts</i></p>
<div class="SocialNetworksEmailTabs">

            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#SocialNetworks" data-toggle="tab">Social Networks</a></li>
              <li class=""><a href="#Email" data-toggle="tab">Email</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="SocialNetworks">
<table width="100%" border="0" class="">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Social Network</td>
    <td>Account Name</td>
  </tr>
  <tr>
    <td> <img src="rgimages/facebook.png">Connect your Facebook account</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> <img src="rgimages/twtr.png">Connect yourTwitter account</td>
    <td>
        <?php foreach($accounts as $acc) { if($acc['networkname'] == 'twitter'){?>
        <a href="#" id="<?php echo $acc["token_id"]; ?>"  class="delbutton" style="color:#555;float:right;">@<?php echo $acc['screen_name']; ?> &nbsp;<i class="fa fa-times"></i></a>
        <?php } } ?>
    </td>
  </tr>
  <tr>
    <td> <img src="rgimages/pinterest.png">Connect your Pinterest account</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td><img src="rgimages/instagram-icon.png"><a class="login" href="<?php echo $loginUrl ?>">Connect your Instagram account</a></td>
    <td>
         <?php foreach($accounts as $acc) { if($acc['networkname'] == 'instagram'){?>
        <a href="#" id="<?php echo $acc["token_id"]; ?>"  class="delbutton" style="color:#555;float:right;">@<?php echo $acc['screen_name']; ?> &nbsp;<i class="fa fa-times"></i></a>
        <?php } } ?>
    </td>
  </tr>
     <tr  style="border-bottom:none;">
    <td> <img src="rgimages/tumblr.jpg"><a href="tumblr_add.php">Connect your Tumblr account</a></td>
    <td>&nbsp;</td>
  </tr>
</table>


              </div>
              <div class="tab-pane fade" id="Email">
             <table width="100%" border="0">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email Provider</td>
    <td>Account Name</td>
  </tr>
  <tr>
    <td><img src="rgimages/gmail-login-icon.png">Connect your Gmail account</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="rgimages/outlook-login-icon.png">Connect your Outlook account</td>
    <td>@Whatsdadilly</td>
  </tr>
  <tr>
    <td><img src="rgimages/yahoo-login-icon.png" style="padding-right:10px;">Connect your Yahoo! account</td>
    <td>&nbsp;</td>
  </tr>
   <tr style="border-bottom:none;">
    <td><img src="rgimages/other-email-icon.png">Connect your Other Email account</td>
    <td>&nbsp;</td>
  </tr>
</table>

            </div>


</div>



</div>
<!-- -->

<div class="SaveOrSkip merge"><span style="margin-left:20px; padding-top:20px;vertical-align:middle;"><a href="http://whatsdadilly.com/beta/home.php" style="color:#cccccc;"> <img src="rgimages/back-icon.png"> Back</a></span> <div class="fright"></div></div>





</div>
<div class="FooterBelowHints">
Keep all of your social outlets and email accounts in one convenient location for easy access and to ensure you won't miss a thing! </div>

<p>&nbsp;</p>
<p>&nbsp;</p>






 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>