<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");

$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$id = $_POST['tweet_id'];
$screen_name = $_POST['screen_name'];

$live_timeline = $connection->get('statuses/home_timeline', array('screen_name' => $screen_name, 'count' => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true,"since_id" => $id));
$new_tweet = count($live_timeline);
if($new_tweet != 0 && $live_timeline->errors[0]->message == '')
{   
    $div_txt = "<div class='WhiteboardGrey'><a href='javascript:void(0);' onclick='load_new_tweets(".$new_tweet.");'>".$new_tweet." new posts</a></div>";
    $success = array("divtxt" => $div_txt,"title"=>"(".$new_tweet.")");
    echo json_encode($success);
   // echo "<div class='latest_tweets'><a href='javascript:void(0);' onclick='load_new_tweets();'>".$new_tweet." new tweets</a></div>";
} else {
  //  echo "<div class='latest_tweets'>".$new_tweet."</div>";
}
?>
