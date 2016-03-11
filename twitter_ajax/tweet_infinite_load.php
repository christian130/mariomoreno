<?php

session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$screenname = $_SESSION['screen_name_twitter']; //$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];
$count = $_GET['count'];
$twieet_id = $_GET['twittid'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$live_timeline = $connection->get('statuses/home_timeline', array('screen_name' => $screenname, 'count' => 100, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true, "max_id" => $twieet_id));
if (count($live_timeline) == 0) {
    $live_timeline = $connection->get('statuses/user_timeline', array('screen_name' => $screenname, 'count' => 100, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true, "max_id" => $twieet_id));
}

$k = $count + 1;
$tweet_count = count($k) - 1;
$total_tweets = count($live_timeline);
$my_tweet = $live_timeline;
for ($i = 1; $i < $total_tweets; $i++) {
    if ($my_tweet->errors[0]->message == '') {
        echo '<input type="hidden" name="tcount" id="tcount" value="' . $tweet_count . '" />';
        echo '<input type="hidden" name="oauthscreen_name" id="oauthscreen_name" value="' . $screenname . '" />';
        $media_flag = '';
        $image_are = '';
        $conversation = '';
        $RT_link = '';
        $Delete_link = '';
        $fav = '';
        $RT = '';
        $disp_url = '';
        echo "<input type='hidden' name='tweet_id$k' id='tweet_id$k' value='" . $my_tweet[$i]->id_str . "'>";
        echo "<input type='hidden' name='screen_name$k' id='screen_name$k' value='" . $my_tweet[$i]->user->screen_name . "'>";
        echo "<input type='hidden' name='uretweet_id$k' id='uretweet_id$k' value='" . $my_tweet[$i]->current_user_retweet->id_str . "'>";

        if ($my_tweet[$i]->retweeted_status->id == '') {

            echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='" . $my_tweet[$i]->id_str . "'>";
            //delete tweet
            if ($twitterid == $my_tweet[$i]->user->id_str) {
                // $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i><b>Delete</b></a>';
                $Delete_link = '<a href="javascript:void(0);" data-reveal-id="mytweet_d' . $k . '"><i class="sm-trash"></i><b>Delete</b></a>';
            }
            // echo $my_tweet->current_user_retweet->id_str;
            //undo retweet
            if ($my_tweet[$i]->current_user_retweet->id_str != '') {
                $RT = 'retweeted';
                $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
            } else {
                $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
            }
            if ($my_tweet[$i]->favorited != '') {
                $fav = 'favorited';
                $Fav_link = '<a href="javascript:void(0);" onclick="undofavorite_tweet(' . $k . ')"><i class="sm-fav"></i><b>Favorited</b></a>';
            } else {
                $Fav_link = '<a href="javascript:void(0)" onclick="favorite(' . $k . ')" ><i class="sm-fav"></i><b>Favorite</b></a>';
            }
            if ($my_tweet[$i]->entities->urls[0]->display_url != '') {
                $disp_url = $my_tweet[$i]->entities->urls[0]->display_url;
            } else if ($my_tweet[$i]->entities->media[0]->display_url != '') {
                $disp_url = $my_tweet[$i]->entities->media[0]->display_url;
            }
            echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet[$i]->in_reply_to_status_id_str . "'>";
            $text = htmlentities($my_tweet[$i]->text, ENT_QUOTES, 'utf-8');
            $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
            $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);

            $text = preg_replace('/\s#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
            echo '<div class="tweet-outer center_area" id="tweet-outer' . $k . '" data="' . $my_tweet[$i]->id_str . '" data-count="' . $k . '">';
            echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
            echo '<i class="dogear"></i>';
            echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet[$i]->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet[$i]->user->profile_image_url . "' title='" . $my_tweet[$i]->user->name . "' class='profile_pic'></a></div>";
            echo '<div class="tweet-content">';
            echo '<div class="stream-item-header">';
            echo '<b>' . $my_tweet[$i]->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet[$i]->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet[$i]->user->screen_name . '</a></span></span>';
            echo '</div>';
            echo $text . ' <br />-<span>' . $my_tweet[$i]->created_at . '</span></div>';
            //echo '<div class="tweet-counts">' . ($my_tweet[$i]->retweet_count != 0 ? $my_tweet[$i]->retweet_count . 'Retweets' : false);
            //echo '</div>';
            echo '<div class="tweet-counts"></div>';
            echo '</div>';



            //Popup
            echo '<div id="myModals' . $k . '" class="reveal-modal">';
                                                echo '<div style="border-top:1px solid #ccc;width: 440px;border-bottom:1px solid #ccc;padding: 5px 40px 34px;margin-top:30px;display: inline-block;">';
            echo "<div class='tweet-pic'><img src='" . $my_tweet[$i]->user->profile_image_url . "' title='" . $my_tweet[$i]->user->name . "' class='profile_pic'></div>";
            echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet[$i]->created_at . '</span></div></div>';
            echo '<input type="button" name="retweet" value="Retweet" onclick="retweet(' . $k . ')" class="tweet-rt" style="margin:5px;float:right;">';
            echo '<a class="close-reveal-modal">&#215;</a></div>';

            echo '<div id="mytweet_d' . $k . '" class="reveal-modal">';
   echo '<div style="border-top:1px solid #ccc;border-bottom:1px solid #ccc;width: 440px;padding: 5px 40px 34px;margin-top:30px;display: inline-block;">';
            echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
            echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div></div>';
            echo '<input type="button" name="Delete" value="Delete" onclick="delete_tweet(' . $k . ')" class="tweet-rt" style="float:right;margin:5px;">';
            echo '<a class="close-reveal-modal">&#215;</a></div>';


            if ($my_tweet[$i]->in_reply_to_status_id_str != '') {
                $conversation = '<span  id="replied' . $k . '"><a href="javascript:void(0)" onclick="getReplies(' . $k . ')"><i class="sm-chat"></i>
                                                </span><b>
                                                  <span class="expand-stream-item js-view-details">
                                                    View conversation
                                                  </span>

                                                </b></a></span>';
            }
            $imge_id = explode('/', $my_tweet[$i]->entities->urls[0]->display_url);
            //  $imge_id = explode('/', $my_tweet->entities->urls[0]->display_url);

            if ($my_tweet[$i]->entities->urls[0]->url != '' && $imge_id[0] != 'youtu.be' && $imge_id[0] != 'soundcloud.com' && $imge_id[0] != 'instagram.com' && $imge_id[0] != 'tmblr.co') {
                //$url_result = Twitter::expandUrlLongApi($my_tweet->entities->urls[0]->url);
                if ($url_result['response-code'] == 200) {
                    // $img_name = Twitter::getImageName($url_result['long-url']);
                } else {

                    //$img_name = Twitter::getImageName($my_tweet->entities->urls[0]->url);
                }

                // preg_match("/<title>(.*)<\/title>/i", $html, $match);
                // if ($img_name != "") {
                //<a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;color: #8899a6 !important;">Collapse</a>
                $media_flag = '<a href="javascript:void(0)" id="tweet_summ' . $k . '" onclick="displaysummary(' . $k . ')" style="color: #8899a6 !important;"><i class="sm-embed"></i> View Summary</a><a href="javascript:void(0)" onclick="hidesummary(' . $k . ')"  id="htweet_summ' . $k . '" style="display:none;"><i class="sm-embed"></i> Hide Summary</a></a>';
                //}
                // $viewsummary = $connection->get('https://api.twitter.com/1.1/statuses/oembed.json?id=' . $my_tweet->id_str, array("omit_script" => true, "hide_thread" => true, "hide_media" => false, "related" => twitterapi, "maxwidth" => 500));
                $image_are = "<div class='tweet-medias tweet_outer' id='tweets-summary$k' style='display:;'></div>";
            }
            $vid = explode('/', $my_tweet->entities->urls[0]->expanded_url);
            $ct = count($vid) - 1;
            $video_id = explode('=', $vid[$ct]);
            if ($my_tweet[$i]->entities->media[0]->id_str != '') {
                $w = $my_tweet[$i]->entities->media[0]->media_url->sizes->large->w;
                $h = $my_tweet[$i]->entities->media[0]->media_url->sizes->large->h;
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View photo</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $my_tweet[$i]->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet[$i]->entities->media[0]->media_url . "' ></a></div></div>";
            } else if ($imge_id[0] == 'twitpic.com') {
                $w = $my_tweet[$i]->entities->media[0]->media_url->sizes->large->w;
                $h = $my_tweet[$i]->entities->media[0]->media_url->sizes->large->h;
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View photo</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div></div>";
            } else if ($imge_id[0] == 'yfrog.com') {
                $w = $my_tweet[$i]->entities->media[0]->media_url->sizes->large->w;
                $h = $my_tweet[$i]->entities->media[0]->media_url->sizes->large->h;
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View photo</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://yfrog.com/" . $imge_id[1] . ":medium' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div></div>";
            } else if ($imge_id[0] == 'instagram.com') {
                $expand_url = expandUrlLongApi($my_tweet[$i]->entities->urls[0]->url);
                if ($expand_url['response-code'] == 200) {
                    $PAGE_url = $expand_url['long-url'];
                } else {
                    $PAGE_url = $my_tweet[$i]->entities->urls[0]->url;
                }
                $html = file_get_contents($PAGE_url);
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                foreach ($doc->getElementsByTagName('meta') as $meta) {
                    if ($meta->getAttribute('property') == 'og:image') {
                        $image = $meta->getAttribute('content');
                    }
                }
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "'></a></div></div>";
            } else if ($imge_id[0] == 'tumblr.co') {
                $expand_url = expandUrlLongApi($my_tweet[$i]->entities->urls[0]->url);
                if ($expand_url['response-code'] == 200) {
                    $PAGE_url = $expand_url['long-url'];
                } else {
                    $PAGE_url = $my_tweet[$i]->entities->urls[0]->url;
                }
                $html = file_get_contents($PAGE_url);
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                foreach ($doc->getElementsByTagName('meta') as $meta) {
                    if ($meta->getAttribute('property') == 'og:image') {
                        $image = $meta->getAttribute('content');
                    }
                }
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "' width='0px' height='0px'></a></div></div>";
            } else if ($imge_id[0] == 'youtube.com' || $imge_id[0] == 'youtube.be') {
                $len = count($video_id) - 1;
                $video_ids = $video_id[$len];
//                $ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" . $video_id[$len]);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                $feed = curl_exec($ch);
//                curl_close($ch);
//                $xml = simplexml_load_string($feed);
//                $entry = $xml->entry[0];
//                $media = $entry->children('media', true);
//                $group = $media[0];
//                $title = $group->title;
//                $desc = $group->description;

                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-youtube-play' style='color:#e02927;
margin-top:3px;margin-right:3px;'></i> Youtube</p><object width='100%' height='285' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                        "<br><b>" . $title . "</b><br>" .
                        "<b>" . $desc . "</b><br>"
                        . "</div>";
            } else if ($imge_id[0] == 'vine.co') {
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-vine' style='background-image: none !important;color:#26bd97;margin-top:3px;margin-right:3px;'></i> Vine</p><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='450px' height='506px' frameborder='0'></iframe>" .
                        "<br><b>" . $title . "</b><br>" .
                        "<b>" . $desc . "</b><br>"
                        . "</div>";
            } else if ($imge_id[0] == 'soundcloud.com') {

                $media_flag = '<a href="javascript:void(0)" id="tweet_med' . $k . '" onclick="displmed(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Summary</a><a href="javascript:void(0)" onclick="hidemedia(' . $k . ')"  id="htweet_med' . $k . '" style="display:none;color:#8899a6 !important;"><i class="sm-image"></i> Hide Media</a></a>';
                $image_are = '<div class="tweet-medias tweet_outer" id="tweets-med' . $k . '" id="yfrog' . $k . '" style="display:;"></div>';
            }
			 echo $image_are;
            echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";

            echo '<div class="tweet-options"><a href="javascript:void(0);" onclick="displayRetweeters(' . $k . ')" id="retweet_img' . $k . '" style="color:#8899a6 !important;">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;color: #8899a6 !important;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i><b>Reply</b></a>';
            echo '</div>';
           
            echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
            echo '<table><tr>';
            $mentions = '';
            for ($jk = 0; $jk < count($my_tweet[$i]->entities->user_mentions); $jk++) {
                $mentions .= '@' . $my_tweet[$i]->entities->user_mentions[$jk]->screen_name . ' ';
            }
            echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet[$i]->user->screen_name . ' ' . $mentions . '</textarea></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right"><input type="button" value="Tweet" class="tweet-rt"   onclick="reply(' . $k . ')"/></td>';
            echo '</tr></table>';
            echo '</div>';
            echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";


            echo '</div>';
        } else {
            echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='" . $my_tweet[$i]->retweeted_status->id_str . "'>";
            //  echo $my_tweet->retweeted_status->current_user_retweet->id_str;
            if ($my_tweet[$i]->current_user_retweet->id_str != '') {
                $RT = 'retweeted';
                $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
            } else {
                $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
            }
            if ($my_tweet[$i]->retweeted_status->entities->urls[0]->display_url != '') {
                $disp_url = $my_tweet[$i]->retweeted_status->entities->urls[0]->display_url;
            } else if ($my_tweet[$i]->retweeted_status->entities->media[0]->display_url != '') {
                $disp_url = $my_tweet[$i]->retweeted_status->entities->media[0]->display_url;
            }
            echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet[$i]->retweeted_status->in_reply_to_status_id_str . "'>";
            $text = htmlentities($my_tweet[$i]->retweeted_status->text, ENT_QUOTES, 'utf-8');
            $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
            $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);
            $text = preg_replace('/\s#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
            echo '<div class="tweet-outer center_area" id="tweet-outer' . $k . '" data="' . $my_tweet[$i]->id_str . '" data-count="' . $k . '">';
            echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
            echo '<i class="dogear"></i>';
            echo "<div class='tweet-pic'><img src='" . $my_tweet[$i]->retweeted_status->user->profile_image_url . "' title='" . $my_tweet[$i]->retweeted_status->user->name . "' class='profile_pic'></div>";
            echo '<div class="tweet-content">';
            echo '<div class="stream-item-header">';
            echo '<b>' . $my_tweet[$i]->retweeted_status->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet[$i]->retweeted_status->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet[$i]->retweeted_status->user->screen_name . '</a></span></span>';
            echo '</div>';
            echo $text . ' <br />-<span>' . $my_tweet[$i]->retweeted_status->created_at . '</span></div>';
            echo '<div class="tweet-counts">Retweet By ' . $my_tweet[$i]->user->name;
            echo '</div>';
            echo '</div>';



            echo '<div id="myModals' . $k . '" class="reveal-modal">';
   echo '<div style="border-top:1px solid #ccc;border-bottom:1px solid #ccc;width: 440px;padding: 5px 40px 34px;margin-top:30px;display: inline-block;">';
            echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet[$i]->retweeted_status->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet[$i]->retweeted_status->user->profile_image_url . "' title='" . $my_tweet[$i]->retweeted_status->user->name . "' class='profile_pic'></a></div>";
            echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet[$i]->retweeted_status->created_at . '</span></div></div>';
            echo '<a href="javascript:void(0)" onclick="retweet(' . $k . ')"  class="tweet-rt" style="margin:5px;float:right;">Retweet</a>';
            echo '<a class="close-reveal-modal">&#215;</a></div>';


            if ($my_tweet[$i]->retweeted_status->in_reply_to_status_id_str != '') {
                $conversation = '<a href="javascript:void(0)" id="replied' . $k . '" onclick="getReplies(' . $k . ')"> <span class="details-icon js-icon-container">
                    <i class="sm-chat"></i>
                </span>
                <b>
                  <span class="expand-stream-item js-view-details">
                      View conversation
                  </span>

                </b></a>';
            }

            $imge_id = explode('/', $my_tweet[$i]->retweeted_status->entities->urls[0]->display_url);
            //$imge_id = explode('/', $my_tweet->retweeted_status->entities->urls[0]->display_url);
//
            if ($my_tweet[$i]->retweeted_status->entities->urls[0]->url != '' && $imge_id[0] != 'youtu.be' && $imge_id[0] != 'soundcloud.com' && $imge_id[0] != 'instagram.com' && $imge_id[0] != 'tmblr.co') {
                //$url_result = Twitter::expandUrlLongApi($my_tweet->entities->urls[0]->url);
                if ($url_result['response-code'] == 200) {
                    // $img_name = Twitter::getImageName($url_result['long-url']);
                } else {

                    //$img_name = Twitter::getImageName($my_tweet->entities->urls[0]->url);
                }

                // preg_match("/<title>(.*)<\/title>/i", $html, $match);
                // if ($img_name != "") {
                //<a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;color: #8899a6 !important;">Collapse</a>
                $media_flag = '<a href="javascript:void(0)" id="tweet_summ' . $k . '" onclick="displaysummary(' . $k . ')" style="color: #8899a6 !important;"><i class="sm-embed"></i> View Summary</a><a href="javascript:void(0)" onclick="hidesummary(' . $k . ')"  id="htweet_summ' . $k . '" style="display:none;"><i class="sm-embed"></i> Hide Summary</a></a>';
                //}
                // $viewsummary = $connection->get('https://api.twitter.com/1.1/statuses/oembed.json?id=' . $my_tweet->id_str, array("omit_script" => true, "hide_thread" => true, "hide_media" => false, "related" => twitterapi, "maxwidth" => 500));
                $image_are = "<div class='tweet-medias tweet_outer' id='tweets-summary$k' style='display:;'></div>";
            }
            $vid = explode('/', $my_tweet->retweeted_status->entities->urls[0]->expanded_url);
            $ct = count($vid) - 1;
            $video_id = explode('=', $vid[$ct]);

            if ($my_tweet[$i]->retweeted_status->entities->media[0]->id_str != '') {
                $w = $my_tweet[$i]->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                $h = $my_tweet[$i]->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View photo</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $my_tweet[$i]->retweeted_status->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet[$i]->retweeted_status->entities->media[0]->media_url . "' ></a></div></div>";
            } else if ($imge_id[0] == 'twitpic.com') {
                $w = $my_tweet[$i]->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                $h = $my_tweet[$i]->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View photo</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div></div>";
            } else if ($imge_id[0] == 'yfrog.com') {
                $w = $my_tweet[$i]->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                $h = $my_tweet[$i]->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View photo</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://yfrog.com/" . $imge_id[1] . ":medium'' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div></div>";
            } else if ($imge_id[0] == 'instagram.com') {
                $expand_url = expandUrlLongApi($my_tweet[$i]->retweeted_status->entities->urls[0]->url);
                if ($expand_url['response-code'] == 200) {
                    $PAGE_url = $expand_url['long-url'];
                } else {
                    $PAGE_url = $my_tweet[$i]->retweeted_status->entities->urls[0]->url;
                }
                $html = file_get_contents($PAGE_url);
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                foreach ($doc->getElementsByTagName('meta') as $meta) {
                    if ($meta->getAttribute('property') == 'og:image') {
                        $image = $meta->getAttribute('content');
                    }
                }
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "'></a></div></div>";
            }else if ($imge_id[0] == 'tumblr.co') {
                $expand_url = expandUrlLongApi($my_tweet[$i]->retweeted_status->entities->urls[0]->url);
                if ($expand_url['response-code'] == 200) {
                    $PAGE_url = $expand_url['long-url'];
                } else {
                    $PAGE_url = $my_tweet[$i]->retweeted_status->entities->urls[0]->url;
                }
                $html = file_get_contents($PAGE_url);
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                foreach ($doc->getElementsByTagName('meta') as $meta) {
                    if ($meta->getAttribute('property') == 'og:image') {
                        $image = $meta->getAttribute('content');
                    }
                }
                $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "' width='00px' height='00px'></a></div></div>";
            }else if ($imge_id[0] == 'youtube.com' || $imge_id[0] == 'youtube.be') {
                    $len = count($video_id) - 1;
                    $video_ids = $video_id[$len];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" . $video_id[$len]);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $feed = curl_exec($ch);
                    curl_close($ch);
                    $xml = simplexml_load_string($feed);
                    $entry = $xml->entry[0];
                    $media = $entry->children('media', true);
                    $group = $media[0];
                    $title = $group->title;
                    $desc = $group->description;

                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                    $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-youtube-play' style='color:#e02927;
margin-top:3px;margin-right:3px;'></i> Youtube</p><object width='100%' height='285' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                            "<br><b>" . $title . "</b><br>" .
                            "<b>" . $desc . "</b><br>"
                            . "</div>";
                } else if ($imge_id[0] == 'vine.co') {
                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Media</a>';
                    $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-vine' style='background-image: none !important;color:#26bd97;margin-top:3px;margin-right:3px;'></i> Vine</p><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='450px' height='506px' frameborder='0'></iframe>" .
                            "<br><b>" . $title . "</b><br>" .
                            "<b>" . $desc . "</b><br>"
                            . "</div>";
                } else if ($imge_id[0] == 'soundcloud.com') {

                    $media_flag = '<a href="javascript:void(0)" id="tweet_med' . $k . '" onclick="displmed(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"></i> View Summary</a><a href="javascript:void(0)" onclick="hidemedia(' . $k . ')"  id="htweet_med' . $k . '" style="display:none;color:#8899a6 !important;"><i class="sm-image"></i> Hide Media</a></a>';
                    $image_are = '<div class="tweet-medias tweet_outer" id="tweets-med' . $k . '" id="yfrog' . $k . '" style="display:;"></div>';
                }
				 echo $image_are;
                echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";

                echo '<div class="tweet-options"><a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '" style="color:#8899a6 !important;">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;color: #8899a6 !important;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="favorite(' . $k . ')" style="color:#8899a6 !important;">Favorite</a>&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
                             <b>Reply</b></a>';
                echo '</div>';
               
                echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
                echo '<table><tr>';
                $mentions = '';
                for ($jk = 0; $jk < count($my_tweet[$i]->retweeted_status->entities->user_mentions); $jk++) {
                    $mentions .= '@' . $my_tweet[$i]->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
                }
                echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet[$i]->retweeted_status->user->screen_name . ' ' . $mentions . '</textarea></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right"><input type="button" value="Tweet" class="tweet-rt" onclick="reply(' . $k . ')"/></td>';
                echo '</tr></table>';
                echo '</div>';
                echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";

                echo '</div>';
            }
            $k++;
        } else {
            echo "0";
        }
    }
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
?>