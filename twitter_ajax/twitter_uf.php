<?php

session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$screenname_b = $_POST['screenname'];
$oauth_token = $_SESSION['request_vars']['oauth_token'];
$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
$screenname_a = $_SESSION['request_vars']['screen_name'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$ret = $connection->get('http://api.twitter.com/1/friendships/exists.json', array('screen_name_a' => $screenname_a, 'screen_name_b' => $screenname_b));
if ($ret == true) {
    $connection->post('friendships/destroy', array('screen_name' => $screenname_b));
    $status = true;
} else {
    $status = false;
}
if ($status == true) {
    $success = array("success" => 1);
    echo json_encode($success);
} else {
    $success = array("success" => "Your not following " . $screenname_b);
    echo json_encode($success);
}
?>