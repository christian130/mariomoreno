<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

$tweet_id = $_POST['tweets_id'];
//echo $tweet_id;
//https://api.twitter.com/1/related_results/show/335153058394828800.json8056396998
 $RT = $connection->get('https://api.twitter.com/1.1/statuses/retweets/'.$tweet_id.'.json');
 //$RTC = $connection->get('https://api.twitter.com/1.1/statuses/'.$tweet_id.'/activity/summary.json');
 //$RTC = $connection->get('https://api.twitter.com/1.1/statuses/retweets/'.$tweet_id.'.json');
 $res_reply = $connection->get("https://api.twitter.com/1.1/related_results/show/" . $tweet_id.".json");

//echo '<pre>';
//print_r($res_reply);
//ive_timeline = $connection->get('statuses/user_timeline', array('id' => $RTC->repliers[0],'in_reply_to_status_id'=>'311806756617609217', "count" => 1 ,  "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));

if($RT[0]->retweeted_status->retweet_count !=0)
    {
        $rtr .= '<div class="js-tweet-stats-container tweet-stats-container already-open">';
        $rtr .= '<ul class="stats">';
        $rtr .= '<li class="js-stat-count js-stat-retweets stat-count">';
        $rtr .= '<a data-activity-popup-title="Retweeted '.$RT[0]->retweeted_status->retweet_count.' times" class="request-retweeted-popup" tabindex="0">';
        $rtr .= 'RETWEETS<br/><strong style="color:#66AFE9 !important;font-size:14px;">'.$RT[0]->retweeted_status->retweet_count.'</strong> </a>';
        $rtr .= '</li>';
        $rtr .= '<li class="js-stat-count js-stat-favorites stat-count">';
        $rtr .= '<a data-activity-popup-title="Favorited '.$RT[0]->retweeted_status->favorite_count.' times" class="request-favorited-popup" tabindex="0" style="border-right: 1px solid #E8E8E8;">';
        $rtr .= 'FAVORITES<br/><strong style="color:#66AFE9 !important;font-size:14px;">'.$RT[0]->retweeted_status->favorite_count.'</strong> ';
        $rtr .= '</a>';
        $rtr .= '</li>';
        $rtr .= '<li class="avatar-row js-face-pile-container">';
            for($i=0;$i<count($RT);$i++)
            {
            if($i < 7){
                $rtr .= '<a title="'.$RT[$i]->user->screen_name.'" original-title="'.$RT[$i]->user->screen_name.'" data-user-id="'.$RT[$i]->user->id_str.'" href="twitter_search.php?q='.$RT[$i]->user->screen_name.'" class="js-profile-popup-actionable js-user-tipsy">';
                $rtr .= '<img alt="'.$RT[$i]->user->screen_name.'" src="'.$RT[$i]->user->profile_image_url.'" class="avatar size24 js-user-profile-link js-tooltip" data-original-title="'.$RT[$i]->user->screen_name.'">';
                $rtr .= '</a>';
            }
            }
        $rtr .= '</li>';
        $rtr .= '</ul>';
        $rtr .= '</div>';
    }

// for($ij=0;$ij<count($res_reply[0]->results);$ij++)
// {
//    $text = htmlentities($res_reply[0]->results[$ij]->value->text, ENT_QUOTES, 'utf-8');
//    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
//    $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);
//    $text = preg_replace('/\s#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
//    $mdata .= '<div class="tweet-outer" id="tweet-outer' . $k . '">';
//    $mdata .= "<div class='tweet-pic'><img src='" . $res_reply[0]->results[$ij]->value->user->profile_image_url . "' title='" . $res_reply[0]->results[$ij]->value->user->name . "' class='profile_pic'></div>";
//    $mdata .= '<div class="tweet-content">' . $text . ' <br />-<span>' . $res_reply[0]->results[$ij]->value->created_at . '</span></div>';
//    $mdata .= '<div class="tweet-counts">';
//    $mdata .= '</div>';
//    $mdata .= '</div>';
// }
 $success = array("msg" => 1,"rtr" => $rtr,'replr' =>$mdata);
 echo json_encode($success);
?>