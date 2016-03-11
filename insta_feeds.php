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
require_once 'model/Twitter.php';
require_once 'model/Wall.php';
require_once 'model/PhotosModel.php';
require_once 'model/Comments.php';
include 'html/wall/functions.php';
require_once 'instagramoauth/instagram.class.php';
$session = new Session();
if ($session->getSession("userid") != "" || $session->getSession("userid") != null) {
    $messages = new Friends();
    $data = array("userid" => $session->getSession("userid"));
    $screen_name = Twitter::getAllTwitterAccounts($data, $entityManager);
    $data = array("userid" => $session->getSession("userid"), "networkname" => "instagram");
    $screen_names = SocialNetworks::getSocialAccount($data, $entityManager);
    $screenname = $session->getSession("screen_name_instagram");
    $twitterid = $session->getSession("screen_id_instagram");
    $oauth_token = $session->getSession("auth_token_instagram");
    $oauth_token_secret = $session->getSession("auth_secret_instagram");

    $url = $_SERVER['REQUEST_URI'];
    $str = explode("/", $url);
    $cur_url = $str[count($str) - 1] . '?';
    $pcur_url = $str[count($str) - 1];
    include 'html/insta_feeds.php';
} else {
    header("Location:index.php");
}
?>
