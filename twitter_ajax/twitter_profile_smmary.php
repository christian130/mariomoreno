<?php

session_start();
include_once("config.php");
include_once("inc/twitteroauth.php");
$screenname = $_GET['screenname'];
$screenname = $_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$live_timeline = $connection->get('statuses/user_timeline', array('screen_name' => $screenname, "count" => 150));
foreach ($live_timeline as $k => $my_tweet) {


    $image_are = '';

    $fav = '';
    $RT = '';
    if ($my_tweet->retweeted_status->id == '') {

        echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->in_reply_to_status_id_str . "'>";
        $text = htmlentities($my_tweet->text, ENT_QUOTES, 'utf-8');
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1"  class="fancybox fancybox.ajax">@$1</a>', $text);

        $text = preg_replace('/\s#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);

        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
        echo '<i class="dogear"></i>';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
        echo '<div class="tweet-counts">' . ($my_tweet->retweet_count != 0 ? $my_tweet->retweet_count . 'Retweets' : false);
        echo '</div>';
        echo '</div>';



        echo '<div class="tweet-options"></div>';
        echo $image_are;
        echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
        echo '<table><tr>';
        $mentions = '';
        for ($jk = 0; $jk < count($my_tweet->entities->user_mentions); $jk++) {
            $mentions .= '@' . $my_tweet->entities->user_mentions[$jk]->screen_name . ' ';
        }
        echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->user->screen_name . ' ' . $mentions . '</textarea></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right"><input type="button" value="Tweet" onclick="reply(' . $k . ')"/></td>';
        echo '</tr></table>';
        echo '</div>';
        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";
    } else {



        echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->retweeted_status->in_reply_to_status_id_str . "'>";
        $text = htmlentities($my_tweet->retweeted_status->text, ENT_QUOTES, 'utf-8');
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);
        $text = preg_replace('/\s#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);

        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
        echo '<div class="tweet-counts">Retweet By ' . $my_tweet->user->name;
        echo '</div>';
        echo '</div>';


        echo '<div class="tweet-options"></div>';
        echo $image_are;
        echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
        echo '<table><tr>';
        $mentions = '';
        for ($jk = 0; $jk < count($my_tweet->retweeted_status->entities->user_mentions); $jk++) {
            $mentions .= '@' . $my_tweet->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
        }
        echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->retweeted_status->user->screen_name . ' ' . $mentions . '</textarea></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right"><input type="button" value="Tweet" onclick="reply(' . $k . ')"/></td>';
        echo '</tr></table>';
        echo '</div>';
        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";
    }
}
?>