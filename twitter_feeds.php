<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once "bootstrap.php";
require_once 'model/Twitter.php';
require_once 'classes/Session.class.php';
include_once("config.php");
include_once("twitteroauth/twitteroauth.php");
$session = new Session();
if ($session->getSession("userid") != "" || $session->getSession("userid") != null) {
    $data = array("userid" => $session->getSession("userid"));
    $screen_name = Twitter::getAllTwitterAccounts($data, $entityManager);
    $screenname = $session->getSession("screen_name_twitter");
    $twitterid = $session->getSession("screen_id_twitter");
    $oauth_token = $session->getSession("auth_token_twitter");
    $oauth_token_secret = $session->getSession("auth_secret_twitter");
    $url = $_SERVER['REQUEST_URI'];
    $str = explode("/", $url);
    $cur_url = $str[count($str) - 1] . '?';
    $pcur_url = $str[count($str) - 1];
    include 'html/twitter_feeds.php';
} else {
    header("Location:index.php");
}
?>