<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");

$screenname = $_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

if (isset($_POST["retweet_id"])) {
    
    
    $id = $_POST["retweet_id"];
    if($_POST['action'] == 'delete')
    {
        $my_update = $connection->post("statuses/destroy/".$id);
        
    }else if($_POST['action'] == 'undofav') {
        $my_update = $connection->post("favorites/destroy", array("id" => $id));
    }
    else {
        $my_update = $connection->post("statuses/destroy/".$id);
    }
    if ($my_update->id_str != '' || $my_update->user->id != '') {
        $success = array("success" => 1);
        echo json_encode($success);
    } else {
        $success = array("success" => 0);
        echo json_encode($success);
    }

}
?>