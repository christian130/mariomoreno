<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL & ~E_NOTICE);
include_once("../config.php");
require_once '../instagramoauth/instagram.class.php';
require_once '../classes/Session.class.php';
require_once '../classes/Util.class.php';
$session = new Session();
$oauth_token = $session->getSession("auth_token_instagram");
$min_postid = $_POST['lastIGpost'];
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
$inst_more = $instagram->getUserMoreFeeds($limit = 20, $oauth_token, $min_postid);
if (count($inst_more->data) > 0) {
    $div_txt = "<div class='WhiteboardGrey'><a href='javascript:void(0);' onclick='load_new_ig_post();'>" . count($inst_more->data) . " new posts</a></div>";
    $success = array("divtxt" => $div_txt, "title" => "(" . count($inst_more->data) . ")");
    echo json_encode($success);
} else {

}
?>
