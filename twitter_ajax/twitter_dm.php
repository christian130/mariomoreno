<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$screenname = $_POST['screenname'];
$dm_text = $_POST['dm_text'];
//$screenname = $_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);


$DM = $connection->post('direct_messages/new', array('text' => $dm_text, 'screen_name' => $screenname));

if ($DM->recipient_id_str != '') {
        $success = array("success" => 1);
        echo json_encode($success);
    } else {
        $success = array("success" => $DM->errors[0]->message);
        echo json_encode($success);
    }
?>