<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL & ~E_NOTICE);
include_once("../config.php");
require_once '../instagramoauth/instagram.class.php';
require_once '../classes/Session.class.php';
$session = new Session();
$oauth_token = $session->getSession("auth_token_instagram");
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
$post_id = $_POST['post_id'];
$comment_text = $_POST['comments'];
$comment_result = $instagram->addMediaComment($post_id, $comment_text);
echo '<pre>';
print_r($comment_result);
?>