<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
require_once 'model/Signup.php';
$session = new Session();
$img_p = $session->getSession("profile_pic");
unset($_SESSION['id_album']);
unset($_SESSION['send_photos']);
    $other = false;
if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
    $other = true;
   
   // echo  base64_decode($_GET['profileid']);
    $params = array('id_owner' => base64_decode($_GET['profileid']));
} else $params = array('id_owner' => $_SESSION['userid']);
if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
    $data = array(
            "userid" => base64_decode($_GET['profileid'])
        );
     $ig_url = "insta_userfeeds.php?profileid=".$_GET['profileid'];
} else {
 $data = array(
            "userid" => $session->getSession("userid")
        );
  $ig_url = "insta_userfeeds.php?profileid=".  base64_encode($session->getSession("userid"));
}
$user_det = Signup::profileView($data, $entityManager);
    if (count($user_det) != 0) {
        $current_city = Signup::getTown($user_det[0]['current_city'], $entityManager);
        $home_city = Signup::getTown($user_det[0]['home_city'], $entityManager);
        if ($user_det[0]['cover_photo'] != '') {
            //$cover_photo = $user_det[0]['cover_photo'];
            $cover_photo = 'images/banner.jpg';
        } else {
            $cover_photo = 'images/banner.jpg';
        }
    }
include 'html/albums.php';
