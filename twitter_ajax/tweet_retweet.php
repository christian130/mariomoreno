<?php
session_start();
include_once("../config.php");
include_once("../twitteroauth/twitteroauth.php");

$screenname = $_POST["screen"];//$_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

if (isset($_POST["retweet_id"])) {

    $id = $_POST["retweet_id"];
    $my_update = $connection->post("https://api.twitter.com/1.1/statuses/retweet/".$id.".json");
	
	//$reply = $connection->post('statuses/update', array('status' => 'how are you??', 'in_reply_to_status_id' => $id));

    if ($my_update->id_str != '') {
        $success = array("success" => 1);
        echo json_encode($success);
    } else {
        $success = array("success" => 0);
        echo json_encode($success);
    }

}
?>