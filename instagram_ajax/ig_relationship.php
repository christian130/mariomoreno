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
$userid = $_POST['userid'];
$action = $_POST['action'];
if ($action === 'follow') {
    $like_result = $instagram->modifyRelationship($action, $userid);
//     echo '<pre>';
//    print_r($like_result);
    if ($like_result->data->outgoing_status == 'follows') {
        $success = array("success" => 1, "action" => 'follow');
    }else if ($like_result->data->outgoing_status == 'requested') {
        $success = array("success" => 1, "action" => 'requested');
    }
} else if ($action === 'unfollow') {
    $like_result = $instagram->modifyRelationship($action, $userid);
    echo '<pre>';
    print_r($like_result);
    if ($like_result->meta->code == 200) {
        $success = array("success" => 1, "action" => 'unfollow');
    }
}
echo json_encode($success);
?>
