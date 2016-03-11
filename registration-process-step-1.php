<!DOCTYPE html>
<html>
<head>
    <title>Registration Process Step1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/registration-process.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
       <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/albums_header.js"></script>
        <link rel="stylesheet" href="js/colorbox/colorbox.css" />        
        <script src="js/colorbox/jquery.colorbox.js"></script>
      <script>$(document).ready(function(){ 
            $("#openBox").colorbox({  rel:'openBox',iframe:true, width:"55%", height:"85%",
                onClosed:function(){ }
            });
        });             
        </script>
<div class="cols-xs">
  <div class="StepProgresses">
  <div class="Step1Process">
  Step 1 <br/>
  <small>Invie Your Friends</small>

  </div>
    <div class="Step2Process">
 Step 2 <br/>
  <small>Invie Your Friends</small>

  </div>
    <div class="Step3Process">
Step 3 <br/>
  <small>Invie Your Friends</small>
 
  </div>
    <div class="Step4Process">
 Step 4 <br/>
  <small>Invie Your Friends</small>

  </div>
  
  </div>
  <div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
   <span class="fright" style="margin-right:20px;"><strong>25%</strong> Complete</span>
  </div>
</div>
<p class="InviteYourFrieds"><i>Invite Your Frieds</i></p>
<div class="InviteFriendsInputs">
<div class="gmailLogin ActiveLogin"> <span class="MailLoginIcon"><img src="rgimages/gmail-login-icon.png" class="Login-Social-Icon"/></span><span class="FormTitleText">Gmail</span> 
    <form class="form-inline" role="form" action="inviteGoogle.php" >
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Type In Your Email Address">
  </div>
         <a class="btn btn-default" id="openBox"  href="inviteGoogle.php" title="Invites Contacts on Gmail" style="margin-bottom: 4px;"> Find Friends</a>
  <!--<button type="submit" class="btn btn-default">Find Friends</button>-->
</form>
</div>
<div class="Outlook-Hotmail"><span class="MailLoginIcon"> <img src="rgimages/outlook-login-icon.png" class="Login-Social-Icon"/></span> <span class="FormTitleText">Outlook (Hotmail) </span> <form class="form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Type In Your Email Address">
  </div>

  <button type="submit" class="btn btn-default">Find Friends</button>
</form>
</div>
<div class="YahooLogin"><span class="MailLoginIcon"> <img src="rgimages/yahoo-login-icon.png" class="Login-Social-Icon"/></span> <span class="FormTitleText">Yahoo! </span> <form class="form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Type In Your Email Address">
  </div>

  <button type="submit" class="btn btn-default">Find Friends</button>
</form>
</div>
<div class="OtherEmailService"><span class="MailLoginIcon"> <img src="rgimages/other-email-icon.png" class="Login-Social-Icon"/></span><span class="FormTitleText">Other Email Service </span> <form class="form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Type In Your Email Address">
  </div>

  <button type="submit" class="btn btn-default">Find Friends</button>
</form>
</div>
</div>

<div class="SaveOrSkip"> <div class="fright">or <a href="">Skip This Step</a> <a href="registration-process-step-2.html"><button type="button" class="btn btn-default">Save & Continue</button></a></div></div>





</div>
<div class="FooterBelowHints">Keep all of your social outlets and email accounts in one convenient location for easy access and to ensure you won't miss a thing!</div>

<p>&nbsp;</p>
<p>&nbsp;</p>


 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
