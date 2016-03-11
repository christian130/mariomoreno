<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
require_once 'model/Friends.php';
require_once 'entities/Friend.php';
$session = new Session();
$profid=$_GET['profileid'];
$profid2=base64_decode($profid);
//echo $profid2;

if($profid2!= $_SESSION['userid']){
$img_p = $session->getSession("profile_pic");
$userid= $profid2;
}else $userid= $session->getSession("userid");
$img_p = $_SESSION['proid'];
?>
<!--img src="uploads/<!?php echo $_SESSION['proid']; ?>" alt="" style="border-radius:4px;border:2px solid white;" id="profile_img" width="200px" height="200px"/-->
<?php
$messages = new Friends();
include 'html/friend_list.php';
