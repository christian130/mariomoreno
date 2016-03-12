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
$insta_media_id = $_POST['mediaid'];
$action = $_POST['action'];
if ($action === 'like') {
    $like_result = $instagram->likeMedia($insta_media_id);
    if ($like_result->meta->code == 200) {
        $success = array("success" => 1, "action" => 'like');
    }
} else if ($action === 'unlike') {
    $like_result = $instagram->deleteLikedMedia($insta_media_id);
    if ($like_result->meta->code == 200) {
        $success = array("success" => 1, "action" => 'unlike');
    }
}
echo json_encode($success);
?>
