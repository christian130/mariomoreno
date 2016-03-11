<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$screenname_b = $_POST['screenname'];
$screenname_a = $_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$ret = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=' . $screenname_a . '&target_screen_name=' . $screenname_b);
//echo '<pre>';
//print_r($ret);
        if ($ret->relationship->source->following == 1) {
//$ret = $connection->get('http://api.twitter.com/1/friendships/exists.json',array('screen_name_a' => $screenname_a,'screen_name_b'=>$screenname_b));
//if($ret == true)

   $status = false; 
} else {
$connection->post('friendships/create', array('screen_name' => $screenname_b));
$status = true;
}
if ($status == true) {
        $success = array("success" => 1);
        echo json_encode($success);
    } else {
        $success = array("success" => "Aready your following ". $screenname_b);
        echo json_encode($success);
    }
?>