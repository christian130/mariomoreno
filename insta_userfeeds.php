<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL & ~E_NOTICE);
include_once("config.php");
require_once "bootstrap.php";
require_once 'model/SocialNetworks.php';
require_once 'classes/Session.class.php';
require_once 'classes/Util.class.php';
require_once 'instagramoauth/instagram.class.php';
$session = new Session();
if ($session->getSession("userid") != "" || $session->getSession("userid") != null) {
    if (isset($_GET['profileid'])){
    $data = array("userid" => base64_decode($_GET['profileid']),"networkname" => "instagram");
    $screen_name = SocialNetworks::getSocialAccount($data, $entityManager);
    $_SESSION['ig_photo_section'] = $screen_name[0]['screen_name'];
    }else {
    $data = array("userid" => $session->getSession("userid"),"networkname" => "instagram");
    $screen_name = SocialNetworks::getSocialAccount($data, $entityManager);
    $_SESSION['ig_photo_section'] = $screen_name[0]['screen_name'];
    }
    $oauth_token = $session->getSession("auth_token_instagram");
    $oauth_token_secret = $session->getSession("auth_secret_instagram");
    $url = $_SERVER['REQUEST_URI'];
    $str = explode("/", $url);
    $cur_url = $str[count($str) - 1] . '?';
    $pcur_url = $str[count($str) - 1];
    //echo $pcur_url;
    $cover_photo = 'images/banner.jpg';
    include 'html/insta_userfeeds.php';
} else {
    header("Location:index.php");
}
?>
