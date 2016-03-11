<?php

session_start();
//include_once("../config.php");
////include_once("inc/twitteroauth.php");
//require '../inc/tmhOAuth.php';
//require '../inc/tmhUtilities.php';
//$screenname = $_SESSION['request_vars']['screen_name'];
//$twitterid = $_SESSION['request_vars']['user_id'];
include_once("../config.php");
include_once("../twitteroauth/twitteroauth.php");
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];

// $tmhOAuth = new tmhOAuth(array(
//                'consumer_key' => CONSUMER_KEY,
//                'consumer_secret' => CONSUMER_SECRET,
//                'user_token' => $oauth_token,
//                'user_secret' => $oauth_token_secret,
//            ));
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
if (isset($_POST["updateme"]) && $_SESSION['media_name'] == '') {
    $my_update = $connection->post("statuses/update", array('status' => $_POST["updateme"]), true, false);
    // $my_update = $tmhOAuth->request('POST','https://api.twitter.com/1.1/statuses/update.json', array('status' => $_POST["updateme"]),true,false);

    if (count($my_update->user) == 1) {
        $success = array("success" => 1);
        echo json_encode($success);
    } else {
        $success = array("success" => 0);
        echo json_encode($success);
    }
} else {

$msg = "teststststst";
$tweet_img = "../uploads/twitter/".$_SESSION['media_name'];
$handle = fopen($tweet_img,'rb');
$image = fread($handle,filesize($tweet_img));
fclose($handle);

$parameters = array('media[]' => "{$image};type=image/jpeg;filename={$tweet_img}",'status' => $_POST["updateme"]);



$code = $connection->post('statuses/update_with_media', $parameters, true);

//$parameters = array(
//            'media[]'  => "{$image};type=image/jpeg",
//            'status'   => "{$msg}"
//        );
//
//$code = $connection->post('statuses/update_with_media', $parameters,true);
//$result = $tweet->post('statuses/update_with_media',array('media[]' => "@{$image};type={$file_type};filename={$file_temp}",'status' => 'test'), true);
//var_dump($returnT);

    unset($_SESSION['media_name']);
    if ($code->id_str != '') {
        $success = array("success" => 1);
        echo json_encode($success);
    } else {
        $success = array("success" => 0);
        echo json_encode($success);
    }
}
?>