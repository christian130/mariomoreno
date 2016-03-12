<style>
    #tabs{
        font-size: 60%;
    }
    #tabs-1{
        font-size: 60%;
    }

    a, u {
        text-decoration: none;
    }
    .wrapper{width:660px; margin-left:auto;margin-right:auto;}
    .welcome_txt{
        margin: 20px;
        background-color: #EBEBEB;
        padding: 10px;
        border: #D6D6D6 solid 1px;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border-radius:5px;
    }
    .latest_tweets
    {
        margin: 20px;
        background-color: #EBEBEB;
        padding: 10px;
        border: #D6D6D6 solid 1px;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border-radius:5px;
        text-align: center;
    }
    .tweet_box{
        margin: 20px;
        background-color: #FFF0DD;
        padding: 10px;
        border: #F7CFCF solid 1px;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border-radius:5px;
    }
    .tweet_box textarea{
        width: 500px;
        border: #F7CFCF solid 1px;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border-radius:5px;
    }
    .tweet_list{
        margin: 20px;
        padding:20px;
        /*background-color: #E2FFF9;
        border: #CBECCE solid 1px;*/
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border-radius:5px;
    }
    .tweet_list div.tweet-outer{
        border-bottom: 1px dashed silver;
        clear: both;
        color: #5C5C5C;
        display: block;
        font-family: verdana;
        font-size: 12px;
        list-style: none;
        overflow: hidden;
        padding: 5px;

    }
    .tweet_list div.tweet-txt{
        position: relative;

    }
    .ui-widget-content
    {
        border : 0px !important;
    }
    .loading-text{
        background: #40A0A0;
        color: #FFFFFF;
        width:100%;
        margin: 0 auto;
    }
    .popup_footer{
        text-align: center;  

        height: 28px;
    }
    .btn-cmt {
        background-color: #525B69;
        border-color: #AAB0BB #525A69 #333842;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        color: #FFFFFF;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    }
    .btn-cmt, .btn-del, .btn-dbl, .btn-add, .btn-credit, .btn-throbber {
        -moz-user-select: none;
        background-clip: padding-box;
        border-radius: 2px 2px 2px 2px;
        border-style: solid;
        border-width: 1px;
        cursor: pointer;
        display: inline-block;
        font-size: 12px;
        font-weight: bold;
        line-height: 15px;
        margin-left: 16px;
        padding: 0 13px 7px 12px;
        white-space: nowrap;
    }
    ._userInfoActions{
        background: none repeat scroll 0 0 #3D3D3D;
        bottom: 0;
        padding: 1px;
        position: absolute;
        width: 100%;
    }
</style>
<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$Keywor = $_GET['q'];
$Keyword = explode('#', $Keywor);
$screenname = $_SESSION['screen_name_twitter']; //$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

//$search_result = $connection->get('search/tweets', array('q' => $Keyword, "count" => 100));

$search_result = $connection->get('https://api.twitter.com/1.1/search/tweets.json?q=' . $Keyword[1] . '&count=100');

echo '<div style="padding: 1em 1.4em;">';
foreach ($search_result->statuses as $k => $my_tweet) {


    $image_are = '';

    $fav = '';
    $RT = '';
    if ($my_tweet->retweeted_status->id == '') {


        $text = htmlentities($my_tweet->text, ENT_QUOTES, 'utf-8');
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);

        $text = preg_replace('/\s#(\w+)/', ' <a href="https://twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
        echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';
        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
        echo '<i class="dogear"></i>';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
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
        $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);
        $text = preg_replace('/\s#(\w+)/', ' <a href="https://twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
        echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';
        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
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
echo "</div>";
?>