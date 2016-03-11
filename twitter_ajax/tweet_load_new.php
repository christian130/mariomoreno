<?php

session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$screenname = $_POST['screen_name']; //$_SESSION['request_vars']['screen_name'];
$twitterid = $_SESSION['request_vars']['user_id'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$since_id = $_POST['since_id'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);



$live_timeline = $connection->get('statuses/home_timeline', array('screen_name' => $screen_name, 'count' => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true, "since_id" => $since_id));


$tweet_count = count($live_timeline) - 1;
echo '<input type="hidden" name="tcount" id="tcount" value="' . $tweet_count . '" />';
echo '<input type="hidden" name="oauthscreen_name" id="oauthscreen_name" value="' . $screenname . '" />';
$k = $_POST['count'] - count($live_timeline);
if($live_timeline->errors[0]->message == ''){
  
foreach ($live_timeline as $my_tweet) {
    $media_flag = '';
    $image_are = '';
    $conversation = '';
    $RT_link = '';
    $Delete_link = '';
    $fav = '';
    $RT = '';
    $disp_url = '';
    $html = '';
    $img_name = '';
    echo "<input type='hidden' name='tweet_id$k' id='tweet_id$k' value='$my_tweet->id_str'>";
    echo "<input type='hidden' name='screen_name$k' id='screen_name$k' value='" . $my_tweet->user->screen_name . "'>";
    echo "<input type='hidden' name='uretweet_id$k' id='uretweet_id$k' value='" . $my_tweet->current_user_retweet->id_str . "'>";

    if ($my_tweet->retweeted_status->id == '') {

        echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='$my_tweet->id_str'>";

        if ($twitterid == $my_tweet->user->id_str) {
            $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i><b>Delete</b></a>';
        }

        if ($my_tweet->current_user_retweet->id_str != '') {
            $RT = 'retweeted';
            $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
        } else {
            $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
        }
        if ($my_tweet->favorited != '') {
            $fav = 'favorited';
            $Fav_link = '<a href="javascript:void(0);" onclick="undofavorite_tweet(' . $k . ')"><i class="sm-fav"></i><b>Favorited</b></a>';
        } else {
            $Fav_link = '<a href="javascript:void(0)" onclick="favorite(' . $k . ')"><i class="sm-fav"></i><b>Favorite</b></a>';
        }
        if ($my_tweet->entities->urls[0]->display_url != '') {
            $disp_url = $my_tweet->entities->urls[0]->display_url;
        } else if ($my_tweet->entities->media[0]->display_url != '') {
            $disp_url = $my_tweet->entities->media[0]->display_url;
        }
        echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->in_reply_to_status_id_str . "'>";
        $text = htmlentities($my_tweet->text, ENT_QUOTES, 'utf-8');
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);

        $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
        echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
        echo '<i class="dogear"></i>';
        echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></a></div>";
        echo '<div class="tweet-content">';
        echo '<div class="stream-item-header">';
        echo '<b>' . $my_tweet->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->user->screen_name . '</a></span></span>';
        echo '</div>';
        echo $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
        echo '<div class="tweet-counts"></div>';
        echo '</div>';



        //Popup
        echo '<div id="myModals' . $k . '" class="reveal-modal">';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
        echo '<input type="button" name="retweet" value="Retweet" onclick="retweet(' . $k . ')" class="tweet-rt">';
        echo '<a class="close-reveal-modal">&#215;</a></div>';


        if ($my_tweet->in_reply_to_status_id_str != '') {

            $conversation = '<span  id="replied' . $k . '"><a href="javascript:void(0)" onclick="getReplies(' . $k . ')">  <span class="details-icon js-icon-container">
                                             <i class="sm-chat"></i>
                                                </span><b>
                                                  <span class="expand-stream-item js-view-details">
                                                    View conversation
                                                  </span>
                                                </b></a></span>';
        }
        $imge_id = explode('/', $my_tweet->entities->urls[0]->display_url);

        if ($my_tweet->entities->urls[0]->url != '' && $imge_id[0] != 'youtu.be' && $imge_id[0] != 'soundcloud.com' && $imge_id[0] != 'instagram.com' && $imge_id[0] != 'tmblr.co') {
            //$url_result = Twitter::expandUrlLongApi($my_tweet->entities->urls[0]->url);
            if ($url_result['response-code'] == 200) {
                // $img_name = Twitter::getImageName($url_result['long-url']);
            } else {

                //$img_name = Twitter::getImageName($my_tweet->entities->urls[0]->url);
            }

            // preg_match("/<title>(.*)<\/title>/i", $html, $match);
            // if ($img_name != "") {
            //<a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>
            $media_flag = '<a href="javascript:void(0)" id="tweet_summ' . $k . '" onclick="displaysummary(' . $k . ')"><i class="sm-embed"></i> View Summary</a><a href="javascript:void(0)" onclick="hidesummary(' . $k . ')"  id="htweet_summ' . $k . '" style="display:none;"><i class="sm-embed"></i> Hide Summary</a></a>';
            //}
            // $viewsummary = $connection->get('https://api.twitter.com/1.1/statuses/oembed.json?id=' . $my_tweet->id_str, array("omit_script" => true, "hide_thread" => true, "hide_media" => false, "related" => twitterapi, "maxwidth" => 500));
            $image_are = "<div class='tweet-medias' id='tweets-summary$k' style='display:none;'></div>";
        }



        $vid = explode('/', $my_tweet->entities->urls[0]->expanded_url);
        $ct = count($vid) - 1;
        $video_id = explode('=', $vid[$ct]);
        if ($my_tweet->entities->media[0]->id_str != '') {
            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='" . $my_tweet->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->entities->media[0]->media_url . "' ></a></div>";
        } else if ($imge_id[0] == 'twitpic.com') {
            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
        } else if ($imge_id[0] == 'yfrog.com') {
            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
        } else if ($imge_id[0] == 'instagram.com') {
            $expand_url = expandUrlLongApi($my_tweet->entities->urls[0]->url);
            if ($expand_url['response-code'] == 200) {
                $PAGE_url = $expand_url['long-url'];
            } else {
                $PAGE_url = $my_tweet->entities->urls[0]->url;
            }
            $html = file_get_contents($PAGE_url);
            $doc = new DOMDocument();
            $doc->loadHTML($html);
            foreach ($doc->getElementsByTagName('meta') as $meta) {
                if ($meta->getAttribute('property') == 'og:image') {
                    $image = $meta->getAttribute('content');
                }
            }
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "'></a></div>";
        } else if ($imge_id[0] == 'tumblr.co') {
            $expand_url = expandUrlLongApi($my_tweet->entities->urls[0]->url);
            if ($expand_url['response-code'] == 200) {
                $PAGE_url = $expand_url['long-url'];
            } else {
                $PAGE_url = $my_tweet->entities->urls[0]->url;
            }
            $html = file_get_contents($PAGE_url);
            $doc = new DOMDocument();
            $doc->loadHTML($html);
            foreach ($doc->getElementsByTagName('meta') as $meta) {
                if ($meta->getAttribute('property') == 'og:image') {
                    $image = $meta->getAttribute('content');
                }
            }
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "' width='00px' height='00px'></a></div>";
        } else if ($imge_id[0] == 'youtube.com' || $imge_id[0] == 'youtu.be') {
            $len = count($video_id) - 1;
            //$video_ids = $video_id[$len];
            // echo $video_id[$len];
//                                                    $ch = curl_init();
//                                                    curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" . $video_id[$len]);
//                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                                                    $feed = curl_exec($ch);
//                                                    curl_close($ch);
//                                                    $xml = simplexml_load_string($feed);
//                                                  //  echo $xml;
//                                                    $entry = $xml->entry[0];
//                                                    $media = $entry->children('media', true);
//                                                    $group = $media[0];
//                                                    $title = $group->title;
//                                                    $desc = $group->description;

            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><object width='100%' height='' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                    "<br><b>" . $title . "</b><br>" .
                    "<b>" . $desc . "</b><br>"
                    . "</div>";
        } else if ($imge_id[0] == 'vine.co') {
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
                    "<br><b>" . $title . "</b><br>" .
                    "<b>" . $desc . "</b><br>"
                    . "</div>";
        } else if ($imge_id[0] == 'soundcloud.com') {

            $media_flag = '<a href="javascript:void(0)" id="tweet_med' . $k . '" onclick="displmed(' . $k . ')"><i class="sm-image"></i> View Summary</a><a href="javascript:void(0)" onclick="hidemedia(' . $k . ')"  id="htweet_med' . $k . '" style="display:none;"><i class="sm-image"></i> Hide Media</a></a>';
            $image_are = '<div class="tweet-medias" id="tweets-med' . $k . '" id="yfrog' . $k . '" style="display:none;"></div>';
        }
		echo $image_are;
        echo '<div class="tweet-options"><a href="javascript:void(0);" onclick="displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
                                 <b>Reply</b></a>';
        echo '</div>';
        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
        
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
        echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";


        echo '</div>';
    } else {
        echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='" . $my_tweet->retweeted_status->id_str . "'>";
        //  echo $my_tweet->retweeted_status->current_user_retweet->id_str;
        if ($my_tweet->current_user_retweet->id_str != '') {
            $RT = 'retweeted';
            $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
        } else {
            $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
        }
        if ($my_tweet->retweeted_status->entities->urls[0]->display_url != '') {
            $disp_url = $my_tweet->retweeted_status->entities->urls[0]->display_url;
        } else if ($my_tweet->retweeted_status->entities->media[0]->display_url != '') {
            $disp_url = $my_tweet->retweeted_status->entities->media[0]->display_url;
        }
        echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->retweeted_status->in_reply_to_status_id_str . "'>";
        $text = htmlentities($my_tweet->retweeted_status->text, ENT_QUOTES, 'utf-8');
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);
        $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
        echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';

        echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet->retweeted_status->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></a></div>";

        echo '<div class="tweet-content">';
        echo '<div class="stream-item-header">';
        echo '<b>' . $my_tweet->retweeted_status->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->retweeted_status->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->retweeted_status->user->screen_name . '</span></a></span>';
        echo '</div>';
        echo $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
        echo '<div class="tweet-counts">Retweet By ' . $my_tweet->user->name;
        echo '</div>';
        echo '</div>';
        echo '<div id="myModals' . $k . '" class="reveal-modal">';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">' . $text . ' <br />-<i>' . $my_tweet->retweeted_status->created_at . '</i></div>';
        echo '<a href="javascript:void(0)" onclick="retweet(' . $k . ')"  class="tweet-rt">Retweet</a>';
        echo '<a class="close-reveal-modal">&#215;</a></div>';

        if ($my_tweet->retweeted_status->in_reply_to_status_id_str != '') {

            $conversation = '<a href="javascript:void(0)" id="replied' . $k . '" onclick="getReplies(' . $k . ')">  <span class="details-icon js-icon-container">
                                         <i class="sm-chat"></i>
                                             </span>
                                                 <b>
                                                    <span class="expand-stream-item js-view-details">
                                                        View conversation
                                                    </span>

                                                 </b></a>';
        }
        $imge_id = explode('/', $my_tweet->retweeted_status->entities->urls[0]->display_url);

        if ($my_tweet->retweeted_status->entities->urls[0]->url != '' && $imge_id[0] != 'youtu.be' && $imge_id[0] != 'soundcloud.com' && $imge_id[0] != 'instagram.com' && $imge_id[0] != 'tmblr.co') {
            //$url_result = Twitter::expandUrlLongApi($my_tweet->entities->urls[0]->url);
            if ($url_result['response-code'] == 200) {
                // $img_name = Twitter::getImageName($url_result['long-url']);
            } else {

                //$img_name = Twitter::getImageName($my_tweet->entities->urls[0]->url);
            }

            // preg_match("/<title>(.*)<\/title>/i", $html, $match);
            // if ($img_name != "") {
            //<a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>
            $media_flag = '<a href="javascript:void(0)" id="tweet_summ' . $k . '" onclick="displaysummary(' . $k . ')"><i class="sm-embed"></i> View Summary</a><a href="javascript:void(0)" onclick="hidesummary(' . $k . ')"  id="htweet_summ' . $k . '" style="display:none;"><i class="sm-embed"></i> Hide Summary</a></a>';
            //}
            // $viewsummary = $connection->get('https://api.twitter.com/1.1/statuses/oembed.json?id=' . $my_tweet->id_str, array("omit_script" => true, "hide_thread" => true, "hide_media" => false, "related" => twitterapi, "maxwidth" => 500));
            $image_are = "<div class='tweet-medias' id='tweets-summary$k' style='display:;'></div>";
        }
        $vid = explode('/', $my_tweet->retweeted_status->entities->urls[0]->expanded_url);
        $ct = count($vid) - 1;
        $video_id = explode('=', $vid[$ct]);
        if ($my_tweet->retweeted_status->entities->media[0]->id_str != '') {
            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' ></a></div>";
        } else if ($imge_id[0] == 'twitpic.com') {
            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
        } else if ($imge_id[0] == 'yfrog.com') {
            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium'' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
        } else if ($imge_id[0] == 'instagram.com') {
            $expand_url = expandUrlLongApi($my_tweet->retweeted_status->entities->urls[0]->url);
            if ($expand_url['response-code'] == 200) {
                $PAGE_url = $expand_url['long-url'];
            } else {
                $PAGE_url = $my_tweet->retweeted_status->entities->urls[0]->url;
            }
            $html = file_get_contents($PAGE_url);
            $doc = new DOMDocument();
            $doc->loadHTML($html);
            foreach ($doc->getElementsByTagName('meta') as $meta) {
                if ($meta->getAttribute('property') == 'og:image') {
                    $image = $meta->getAttribute('content');
                }
            }
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "'></a></div>";
        } else if ($imge_id[0] == 'tumblr.co') {
            $expand_url = expandUrlLongApi($my_tweet->retweeted_status->entities->urls[0]->url);
            if ($expand_url['response-code'] == 200) {
                $PAGE_url = $expand_url['long-url'];
            } else {
                $PAGE_url = $my_tweet->retweeted_status->entities->urls[0]->url;
            }
            $html = file_get_contents($PAGE_url);
            $doc = new DOMDocument();
            $doc->loadHTML($html);
            foreach ($doc->getElementsByTagName('meta') as $meta) {
                if ($meta->getAttribute('property') == 'og:image') {
                    $image = $meta->getAttribute('content');
                }
            }
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "' width='0px' height='0px'></a></div>";
        } else if ($imge_id[0] == 'youtube.com' || $imge_id[0] == 'youtu.be') {
            $len = count($video_id) - 1;
//                                                    $video_ids = $video_id[$len];
//                                                    echo $video_id[$len];
//                                                    $ch = curl_init();
//                                                    curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" . $video_id[$len]);
//                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                                                    $feed = curl_exec($ch);
//                                                    curl_close($ch);
//                                                    $xml = simplexml_load_string($feed);
//                                                    $entry = $xml->entry[0];
//                                                   // $media = $entry->children('media', true);
//                                                    $group = $media[0];
//                                                    $title = $group->title;
//                                                    $desc = $group->description;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><object width='100%' height='' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                    "<br><b>" . $title . "</b><br>" .
                    "<b>" . $desc . "</b><br>"
                    . "</div>";
        } else if ($imge_id[0] == 'vine.co') {
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:;'><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
                    "<br><b>" . $title . "</b><br>" .
                    "<b>" . $desc . "</b><br>"
                    . "</div>";
        } else if ($imge_id[0] == 'soundcloud.com') {

            $media_flag = '<a href="javascript:void(0)" id="tweet_med' . $k . '" onclick="displmed(' . $k . ')"><i class="sm-image"></i> View Summary</a><a href="javascript:void(0)" onclick="hidemedia(' . $k . ')"  id="htweet_med' . $k . '" style="display:none;"><i class="sm-image"></i> Hide Media</a></a>';
            $image_are = '<div class="tweet-medias" id="tweets-med' . $k . '" id="yfrog' . $k . '" style="display:none;"></div>';
        }
		echo $image_are;
        echo '<div class="tweet-options"><a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="favorite(' . $k . ')"><i class="sm-fav"></i><b>Favorite</b></a>&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
                                                      <b>Reply</b></a>';
        echo '</div>';
        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
        
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
        echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";
        echo '</div>';
    }
    $k++;
}
}
echo '</div>';

function expandUrlLongApi($url) {
    $format = 'json';
    $api_query = "http://api.longurl.org/v2/expand?" .
            "url={$url}&response-code=1&format={$format}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $fileContents = curl_exec($ch);
    curl_close($ch);

    $s1 = str_replace("{", " ", "$fileContents");
    $s2 = str_replace("}", " ", "$s1");
    return json_decode($fileContents, true);
}
