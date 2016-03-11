<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">    <head>        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        <title>:WHATSDADILLY:</title>        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />        <link rel="stylesheet" href="css/style.css" type="text/css" />        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>        <script type="text/javascript" src="js/jquery.validate.js"></script>        <script type="text/javascript" src="js/jquery.form.js"></script>    </head>    <body  class="nobg">                 <?php include 'header.php'; ?>        <!--<script type="text/javascript" src="js/home_header.js"></script>-->        <script type="text/javascript" src="js/albums_header.js"></script> 

<?php
$userid=base64_decode($_GET['id']);
//echo $userid;
$userid1= $session->getSession("userid");
?>

       <div class="midwht">       <div class="hommid" style="width:1000px !important;"><div class="friend_lists">                                                                        <h3 style="color:#333;font-weight:bold;font-size:16px;"><i class="fa fa-users"></i>&nbsp;Friends List</h3>  
										<?php
										if($userid != "")
										{
 echo $messages->getFriendsAll($entityManager, $userid, 10000); 
 }
 else{
 echo $messages->getFriendsAll($entityManager, $userid1, 10000); 
 }
 ?>                                                                        </div>                                  </div>                                </body>                                </html>