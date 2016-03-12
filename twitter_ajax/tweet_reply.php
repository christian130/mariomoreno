<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");

$screenname = $_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

if (isset($_POST["reply_id"])) {

    $reply_id = $_POST["reply_id"];
    $screen_name = $_POST["screen_name"];
    $message = $_POST["reply_message"];
    $reply_message = $message;

    $reply = $connection->post('statuses/update', array('status' => $reply_message, 'in_reply_to_status_id' => $reply_id));

    if ($reply->id_str != '') {
        $success = array("success" => 1);
        echo json_encode($success);
    } else {
        $success = array("success" => 0);
        echo json_encode($success);
    }
}
?>