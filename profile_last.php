<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'model/Twitter.php';
require_once 'classes/Session.class.php';
include_once("config.php");
include_once("twitteroauth/twitteroauth.php");
$session = new Session();
//$data = array("userid"=>$session->getSession("userid"));
if ($session->getSession("userid") != "" || $session->getSession("userid") != null) {
    if (isset($_GET['profileid']) && $_GET['acc'] == null) {
        $twitt_val = '2';
        $data = array(
            "userid" => base64_decode($_GET['profileid'])
        );
        $screen_name = Twitter::getAllTwitterAccounts($data, $entityManager);
        $screen_length = count($screen_name);
        $function_following = 'load_usersfollowing()';
        $function_followers = 'load_usersfollower()';
        $function_fav = 'load_userfav()';
        $function_mention = 'load_usermentions()';
        $screenname = $screen_name[0]['screen_name']; //$session->getSession("screen_name_twitter");
        $twitterid = $screen_name[0]['screen_id']; //$session->getSession("screen_id_twitter");
        $oauth_token = $screen_name[0]['auth_token']; //$session->getSession("auth_token_twitter");
        $oauth_token_secret = $screen_name[0]['auth_secret']; //$session->getSession("auth_secret_twitter");
        $url = $_SERVER['REQUEST_URI'];
        $str = explode("/", $url);
        $cur_url = $str[count($str) - 1] . '&';
        $pcur_url = $str[count($str) - 1];
    } else if (isset($_GET['acc'])) {
        $twitt_val = '2';
        $data = array(
            "userid" => base64_decode($_GET['profileid'])
        );
        $screen_name = Twitter::getAllTwitterAccounts($data, $entityManager);
        $screen_length = count($screen_name);
        $function_following = 'load_usersfollowing()';
        $function_followers = 'load_usersfollower()';
        $function_fav = 'load_userfav()';
        $function_mention = 'load_usermentions()';
        $screenname = $session->getSession("screen_name_twitter");
        $twitterid = $session->getSession("screen_id_twitter");
        $oauth_token = $session->getSession("auth_token_twitter");
        $oauth_token_secret = $session->getSession("auth_secret_twitter");
        $url = $_SERVER['REQUEST_URI'];
        $str = explode("/", $url);
        $cur_url = $str[count($str) - 1] . '?';
        $pcur_url = $str[count($str) - 1];
    } else {
        $twitt_val = '1';
        $data = array(
            "userid" => $session->getSession("userid")
        );
        $screen_name = Twitter::getAllTwitterAccounts($data, $entityManager);
        //echo '<pre>';
        // print_r($screen_name);
        $screen_length = count($screen_name);
        $function_following = 'load_following()';
        $function_followers = 'load_followers()';
        $function_fav = 'load_userfav()';
        $function_mention = 'load_mentions()';
        $screenname = $session->getSession("screen_name_twitter");
        $twitterid = $session->getSession("screen_id_twitter");
        $oauth_token = $session->getSession("auth_token_twitter");
        $oauth_token_secret = $session->getSession("auth_secret_twitter");
        $url = $_SERVER['REQUEST_URI'];
        $str = explode("/", $url);
        $cur_url = $str[count($str) - 1] . '?';
        $pcur_url = $str[count($str) - 1];
    }
    $user_det = Signup::profileView($data, $entityManager);
    if (count($user_det) != 0) {
        $current_city = Signup::getTown($user_det[0]['current_city'], $entityManager);
        $home_city = Signup::getTown($user_det[0]['home_city'], $entityManager);
        if ($user_det[0]['cover_photo'] != '') {
            $cover_photo = $user_det[0]['cover_photo'];
        } else {
            $cover_photo = 'images/banner.jpg';
        }
    } else {
        header('HTTP/1.0 404 Not Found');
        include 'html/error.php';
    }
    include 'html/profile.php';
} else {
    header("Location:index.php");
}
?>