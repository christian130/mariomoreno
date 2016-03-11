<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$screenname = $_GET['screen'];//$_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_GET['tid'];//$_SESSION['screen_id_twitter'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

//$live_timeline = $connection->get('statuses/user_timeline', array('screen_name' => $screenname, 'count' => 190, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));
$live_timeline = $connection->get('statuses/user_timeline', array('screen_name' => $screenname, "count" => 90 ,  "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));

//echo '<pre>';
//print_r($live_timeline); b16ef4ce8c1b0fb4c9c7a17b433da488:ndtjiYPhwxuVQwQOKochh5K2y1FNBoRH
                 
$tweet_count = count($live_timeline) - 1;
echo '<input type="hidden" name="tcount" id="tcount" value="' . $tweet_count . '" />';
echo '<input type="hidden" name="oauthscreen_name" id="oauthscreen_name" value="' . $screenname . '" />';
foreach ($live_timeline as $k => $my_tweet) {

    $media_flag = '';
    $image_are = '';
    $conversation = '';
    $RT_link = '';
    $Delete_link = '';
    $fav = '';
    $RT = '';
    echo "<input type='hidden' name='tweet_id$k' id='tweet_id$k' value='$my_tweet->id_str'>";
    echo "<input type='hidden' name='screen_name$k' id='screen_name$k' value='" . $my_tweet->user->screen_name . "'>";
    echo "<input type='hidden' name='uretweet_id$k' id='uretweet_id$k' value='" . $my_tweet->current_user_retweet->id_str . "'>";

    if ($my_tweet->retweeted_status->id == '') {
          echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='$my_tweet->id_str'>";
        //delete tweet
        if ($twitterid == $my_tweet->user->id_str) {
            $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i><b>Delete</b></a>';
        }
        // echo $my_tweet->current_user_retweet->id_str;
        //undo retweet
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

        echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->in_reply_to_status_id_str . "'>";
        $text = htmlentities($my_tweet->text, ENT_QUOTES, 'utf-8');
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);

        $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
        echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';
        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
        echo '<i class="dogear"></i>';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">';
        echo '<div class="stream-item-header">';
        echo '<b>' . $my_tweet->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->user->screen_name . '</a></span></span>';
        echo '</div>';
        echo $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
       // echo '<div class="tweet-counts">' . ($my_tweet->retweet_count != 0 ? $my_tweet->retweet_count . 'Retweets' : false);
        //echo '</div>';
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
        $vid = explode('/', $my_tweet->entities->urls[0]->expanded_url);
            $ct = count($vid) - 1;
            $video_id = explode('=', $vid[$ct]);
        if ($my_tweet->entities->media[0]->id_str != '') {
            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='" . $my_tweet->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->entities->media[0]->media_url . "' width='" . $my_tweet->entities->media[0]->sizes->small->w . "px' height='" . $my_tweet->entities->media[0]->sizes->small->h . "px'></a></div>";
        } else if ($imge_id[0] == 'twitpic.com') {
            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
        } else if ($imge_id[0] == 'yfrog.com') {
            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
        }else if ($imge_id[0] == 'youtube.com') {
            $len = count($video_id) - 1;  
                            $video_ids = $video_id[$len];
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" .$video_id[$len]);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $feed = curl_exec($ch);
                            curl_close($ch);
                            $xml = simplexml_load_string($feed);
                            $entry = $xml->entry[0];
                            $media = $entry->children('media', true);
                            $group = $media[0];
                            $title = $group->title;
                            $desc = $group->description;
                            
                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><object width='425' height='349' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>".
                                    "<br><b>".$title."</b><br>".
                                    "<b>".$desc."</b><br>"
                                    ."</div>";
                            
                                    }else if ($imge_id[0] == 'vine.co') {
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><iframe src='https://vine.co/v/".$imge_id[2]."/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
                                                    "<br><b>" . $title . "</b><br>" .
                                                    "<b>" . $desc . "</b><br>"
                                                    . "</div>";
                                        }
        echo '<div class="tweet-options"><a href="javascript:void(0);" onclick="displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
              <b>Reply</b></a>';
        echo '</div>';
        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
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

        echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->retweeted_status->in_reply_to_status_id_str . "'>";
        $text = htmlentities($my_tweet->retweeted_status->text, ENT_QUOTES, 'utf-8');
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);
        $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
        echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';
        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
        echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
        echo '<div class="tweet-content">';
        echo '<div class="stream-item-header">';
        echo '<b>' . $my_tweet->retweeted_status->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->retweeted_status->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->retweeted_status->user->screen_name . '</a></span></span>';
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
        $vid = explode('/', $my_tweet->retweeted_status->entities->urls[0]->expanded_url);
        $ct = count($vid) - 1;
        $video_id = explode('=', $vid[$ct]);
        
        if ($my_tweet->retweeted_status->entities->media[0]->id_str != '') {
            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' width='" . $my_tweet->retweeted_status->entities->media[0]->sizes->small->w . "px' height='" . $my_tweet->retweeted_status->entities->media[0]->sizes->small->h . "px'></a></div>";
        } else if ($imge_id[0] == 'twitpic.com') {
            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
        } else if ($imge_id[0] == 'yfrog.com') {
            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium'' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
        }else if ($imge_id[0] == 'youtube.com') {
            $len = count($video_id) - 1;  
                            $video_ids = $video_id[$len];
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" .$video_id[$len]);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $feed = curl_exec($ch);
                            curl_close($ch);
                            $xml = simplexml_load_string($feed);
                            $entry = $xml->entry[0];
                            $media = $entry->children('media', true);
                            $group = $media[0];
                            $title = $group->title;
                            $desc = $group->description;
                            
                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><object width='425' height='349' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>".
                                    "<br><b>".$title."</b><br>".
                                    "<b>".$desc."</b><br>"
                                    ."</div>";
        }else if ($imge_id[0] == 'vine.co') {
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><iframe src='https://vine.co/v/".$imge_id[2]."/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
                                                    "<br><b>" . $title . "</b><br>" .
                                                    "<b>" . $desc . "</b><br>"
                                                    . "</div>";
                                        }
        echo '<div class="tweet-options"><a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="favorite(' . $k . ')"><i class="sm-fav"></i><b>Favorite</b></a>&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
                             <b>Reply</b></a>';
        echo '</div>';
        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
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
        echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";

        echo '</div>';
    }
}
echo ' <div id="loadorders"></div>';
echo '<div id="loadMoreComments" style="display:none;" ></div>';
?>