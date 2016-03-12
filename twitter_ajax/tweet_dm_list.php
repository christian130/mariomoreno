<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");

$screenname = $_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);


$DM = $connection->get('https://api.twitter.com/1.1/direct_messages.json',array("since_id"=>354910634598621184,"include_entities" => true,"skip_status"=>false));
echo '<pre>';
print_r($DM);
?>