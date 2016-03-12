<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/twitter_profile.js"></script>
<script type="text/javascript" src="js/twitterhome.js"></script>
<link rel="stylesheet" href="css/tweet_options.css">
<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");

$screenname = $_GET['screenname'];
$screenname_b = $_SESSION['screen_name_twitter']; //$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$live_timeline = $connection->get('statuses/user_timeline', array('screen_name' => $screenname, "count" => 10));
$user_info = $connection->get('users/show', array("include_entities" => true, "screen_name" => $screenname));
$profile_banner = $connection->get('https://api.twitter.com/1.1/users/profile_banner.json?screen_name=' . $screenname);
$FFs_status = $connection->get('https://api.twitter.com/1.1/friendships/lookup.json?screen_name=' . $screenname_b . ',' . $screenname);
$profile_pic = str_replace("_normal", "", $user_info->profile_image_url);
?>
<div id="outer_box" >
    <div class="pop_demo-cb-tweets" style="text-align:center;"></div>
    <div id="tabs">
        <div id="profile_img" style="text-align: left;  background:url('<?php echo $profile_banner->sizes->web->url; ?>') no-repeat center;"> <img src="<?php echo $profile_pic; ?>" width="200px" height="200px" style="margin-top: 59px;">
        </div>
        <div class="profile_description">
            <table width="100%">
                <tr> 
                    <td width="55%" align="center">&nbsp;</td>
                    <td width="45%" align=""><b>
                            <?php if ($FFs_status[1]->connections[1] == 'followed_by') {
                            ?>
                                follows you
                            <?php } ?>
                            <?php if ($user_info->verified == 1) {
                            ?>
                                <span class="icon verified verified-large-border"><span class="visuallyhidden">Verified account</span></span>
                            <?php } if ($user_info->protected == 1) {
                            ?>
                                <span class="icon lock-large"><span class="visuallyhidden">Protected account</span></span>
                            <?php } ?>
                        </b><br><b><?php echo ucfirst($screenname); ?></b><br /><?php echo $user_info->location; ?></td>
                </tr>
                <tr>
                    <td width="55%" align="center">&nbsp;</td>
                    <td width="45%" align=""><?php echo $user_info->description; ?></td>
                </tr>
            </table>
        </div>
        <div id="update_counts" style="padding-top: 0px;">
            <table width="100%" style="border-bottom: 1px solid #ccc;">
                <tr>
                    <td width="15%" align="center"><a href="javascript:void(0);"  onclick="show_home();"><span class="count"><?php echo $user_info->statuses_count; ?></span><br>Tweets</a></td>
                    <td width="15%" align="center"><a href="javascript:void(0);" onclick="show_mentions();">Mentions</a></td>
                    <td width="15%" align="center"><a href="javascript:void(0);" onclick="show_followers();"><span class="count"><?php echo $user_info->followers_count; ?></span><br>Followers</a></td>
                    <td width="15%" align="center"><a href="javascript:void(0);" onclick="show_following();"><span class="count"><?php echo $user_info->friends_count; ?></span><br>Following</a></td>
                    <td width="15%" align="center"><a href="javascript:void(0);" onclick="show_favorites();"><span class="count"><?php echo $user_info->favourites_count; ?></span><br>Favorites</a></td>
                   
                <?php if ($FFs_status[1]->connections[1] == 'followed_by') {
 ?>
                               <td width="15%" align="center"> <a href="#twitter_dm" class="fadein _dm btn-cmt" id="fadein"><img src="images/Twt-message-icon.png" height="25" width="30"/></a></td>
<?php } ?><td width="15%" align="center" class="btn_follow"> 
<a href="javascript:void(0);" class="_follow btn-cmt" id="twitter_ff" style="color:#fff;">Follow</a></td>
                </tr>
            </table>
        </div>
        <div id="tw_reply" style="display:none;background:#ccc;">
            <table>
                <tr>&nbsp;</tr>
                <tr><th ><?php echo '@' . $screenname ?></th></tr>
                <tr><td >
                        <textarea cols="50" id="rp_text" name="rp_text" value=""><?php echo '@' . $screenname ?></textarea></td></tr>
                <tr><td ><input type="button" name="rp_cancel" id="rp_cancel" value="Cancel" style="float: right;margin-left:10px"/>&nbsp;&nbsp;&nbsp;<input type="button" name="rp_send" id="rp_send" value="Tweet" style="float: right;"/></td></tr> <tr style="margin-bottom:10px;float:left;">&nbsp;</tr> </table>
        </div>
        <div style="positive: relative; margin: 0px auto;width: 100px; height: 20px;">
            <div class="demo-cb-tweets" style="text-align:center;position:fixed;"></div>
        </div>
        <input type="hidden" name="dm_screenname" id="dm_screenname" value="<?php echo $screenname; ?>" />
        <div id="popup_tweets">
        <div class="ltimeline" id="ltimeline">
            <div id="jp-container" class="jp-container">
                <?php
                            foreach ($live_timeline as $k => $my_tweet) {
                                $media_flag = '';
                                $image_are = '';
                                $conversation = '';
                                $RT_link = '';
                                $Delete_link = '';
                                $fav = '';
                                $RT = '';
                                echo "<input type='hidden' name='tweet_ids$k' id='tweet_ids$k' value='$my_tweet->id_str'>";
                                echo "<input type='hidden' name='screen_name$k' id='pscreen_name$k' value='" . $my_tweet->user->screen_name . "'>";
                                echo "<input type='hidden' name='uretweet_id$k' id='uretweet_id$k' value='" . $my_tweet->current_user_retweet->id_str . "'>";

                                if ($my_tweet->retweeted_status->id == '') {
                                    echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='$my_tweet->id_str'>";
                                    if ($twitterid == $my_tweet->user->id_str) {
                                        $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i>Delete</a>';
                                    }

                                    if ($my_tweet->current_user_retweet->id_str != '') {
                                        $RT = 'retweeted';
                                        $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i>Retweeted</a>';
                                    } else {
                                        $RT_link = '<a href="#retweet_pop' . $k . '" id="fadein" class="fadein big-link" data-animation="none"><i class="sm-rt"></i>Retweet</a>';
                                    }
                                    if ($my_tweet->favorited != '') {
                                        $fav = 'favorited';
                                        $Fav_link = '<a href="javascript:void(0);" onclick="undofavorite_tweet(' . $k . ')"><i class="sm-fav"></i>Favorited</a>';
                                    } else {
                                        $Fav_link = '<a href="javascript:void(0)" onclick="pfavorite(' . $k . ')"><i class="sm-fav"></i>Favorite</a>';
                                    }

                                    echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->in_reply_to_status_id_str . "'>";
                                    $text = htmlentities($my_tweet->text, ENT_QUOTES, 'utf-8');
                                    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
                                    $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);

                                    $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
                                    echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

                                    echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
                                    echo '<i class="dogear"></i>';
                                    echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></a></div>";
                                    echo '<div class="tweet-content">';
                                    echo '<div class="stream-item-header">';
                                    echo '' . $my_tweet->user->name . '&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->user->screen_name . '</a></span></span>';
                                    echo '</div>';
                                    echo $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                                    echo '<div class="tweet-counts"></div>';
                                    echo '</div>';



                                    //Popup
                                    echo '<div id="retweet_pop' . $k . '" style="display: none;" class="modal-example-content">';
                ?> <div class="modal-example-header">
                                        <button type="button" class="close" onclick="$.fn.custombox('close');">&times;</button>
                                        <h4>Retweet</h4>
                                    </div>
                                    <div class="modal-example-body">
                    <?php
                                    echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
                                    echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                                    echo '<input type="button" name="retweet" value="Retweet" onclick="childpop_retweet(' . $k . ')" class="tweet-rt">';
                                    echo '</div></div>';


                                    if ($my_tweet->in_reply_to_status_id_str != '') {

                                        $conversation = '<span  id="replied' . $k . '"><a href="javascript:void(0)" onclick="getReplies(' . $k . ')">  <span class="details-icon js-icon-container">
                                             <i class="sm-chat"></i>
                                                </span>
                                                  <span class="expand-stream-item js-view-details">
                                                    View conversation
                                                  </span>
                                                </a></span>';
                                    }
                                    $imge_id = explode('/', $my_tweet->entities->urls[0]->display_url);
                                    if ($my_tweet->entities->media[0]->id_str != '') {
                                        $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                        $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                        $media_flag = '<a href="javascript:void(0)" onclick="displayphoto(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                        $image_are = "<div class='tweet-medias' id='yfrogs$k' style='display:none;'><a href='" . $my_tweet->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->entities->media[0]->media_url . "' width='" . $my_tweet->entities->media[0]->sizes->small->w . "px' height='" . $my_tweet->entities->media[0]->sizes->small->h . "px'></a></div>";
                                    } else if ($imge_id[0] == 'twitpic.com') {
                                        $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                        $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                        $media_flag = '<a href="javascript:void(0)" onclick="displayphoto(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                        $image_are = "<div class='tweet-medias' id='yfrogs$k' style='display:none;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
                                    } else if ($imge_id[0] == 'yfrog.com') {
                                        $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                        $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                        $media_flag = '<a href="javascript:void(0)" onclick="displayphoto(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                        $image_are = "<div class='tweet-medias' id='yfrogs$k' style='display:none;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
                                    }
                                    echo '<div class="tweet-options">' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="#repetweet_pop' . $k . '" class="fadein" id="fadein"><i class="sm-reply"></i>
                                 Reply</a>';
                                    echo '</div>';
                                    echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
                                    echo $image_are;


//                                    echo "<div class='tweet-reply popup_tweet-reply' id='ptweet-reply$k' style='display:none;'>";
//                                    echo '<table><tr>';
//                                    $mentions = '';
//                                    for ($jk = 0; $jk < count($my_tweet->entities->user_mentions); $jk++) {
//                                        $mentions .= '@' . $my_tweet->entities->user_mentions[$jk]->screen_name . ' ';
//                                    }
//                                    echo '<td><textarea name="preply_message' . $k . '" id="preply_message' . $k . '" cols="50" rows="4">@' . $my_tweet->user->screen_name . ' ' . $mentions . '</textarea></td>';
//                                    echo '</tr>';
//                                    echo '<tr>';
//                                    echo '<td align="right"><input type="button" value="Tweet" onclick="preply(' . $k . ')"/></td>';
//                                    echo '</tr></table>';
//                                    echo '</div>';
                    ?>
                                    <div id="repetweet_pop<?php echo $k; ?>" style="display: none;" class="modal-example-content">
                                        <div class="modal-example-header">
                                            <button type="button" class="close" onclick="$.fn.custombox('close');">&times;</button>
                                            <h4>Reply</h4>
                                        </div>
                                        <div class="modal-example-body">
                            <?php
                                    $mentions = '';
                                    for ($jk = 0; $jk < count($my_tweet->entities->user_mentions); $jk++) {
                                        $mentions .= '@' . $my_tweet->entities->user_mentions[$jk]->screen_name . ' ';
                                    }
                            ?>
                                    <textarea cols="65" rows="5" id="preply_message<?php echo $k; ?>" name="preply_message<?php echo $k; ?>" value="">@<?php echo $my_tweet->user->screen_name . ' ' . $mentions; ?></textarea><br>
                                    <div class=".modal-example-footer" style="float:right;background-color: #FFFFFF;">
                                        <input type="button" name="dm_reply" value="Reply" id="dm_send" onclick="childpreply(<?php echo $k; ?>)"/>
                                    </div>
                                </div>
                            </div>
                    <?php
                                    echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
                                    echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";


                                    echo '</div>';
                                } else {
                                    echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='" . $my_tweet->retweeted_status->id_str . "'>";
                                    //  echo $my_tweet->retweeted_status->current_user_retweet->id_str;
                                    if ($my_tweet->current_user_retweet->id_str != '') {
                                        $RT = 'retweeted';
                                        $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i>Retweeted</a>';
                                    } else {
                                        $RT_link = '<a href="#retweet_pop' . $k . '" id="fadein" class="fadein big-link" data-animation="none"><i class="sm-rt"></i>Retweet</a>';
                                    }

                                    echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->retweeted_status->in_reply_to_status_id_str . "'>";
                                    $text = htmlentities($my_tweet->retweeted_status->text, ENT_QUOTES, 'utf-8');
                                    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
                                    $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);
                                    $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
                                    echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

                                    echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';

                                    echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet->retweeted_status->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></a></div>";

                                    echo '<div class="tweet-content">';
                                    echo '<div class="stream-item-header">';
                                    echo '' . $my_tweet->retweeted_status->user->name . '&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->retweeted_status->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->retweeted_status->user->screen_name . '</span></a></span>';
                                    echo '</div>';
                                    echo $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
                                    echo '<div class="tweet-counts">Retweet By ' . $my_tweet->user->name;
                                    echo '</div>';
                                    echo '</div>';



                                    echo '<div id="retweet_pop' . $k . '" style="display: none;" class="modal-example-content">';
                    ?> <div class="modal-example-header">
                                        <button type="button" class="close" onclick="$.fn.custombox('close');">&times;</button>
                                        <h4>Retweet</h4>
                                    </div>
                                    <div class="modal-example-body">
                        <?php
                                    echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
                                    echo '<div class="tweet-content">' . $text . ' <br />-<i>' . $my_tweet->retweeted_status->created_at . '</i></div>';
                                    echo '<a href="javascript:void(0)" onclick="childpop_retweet(' . $k . ')"  class="tweet-rt">Retweet</a>';
                                    echo '</div></div>';

                                    if ($my_tweet->retweeted_status->in_reply_to_status_id_str != '') {

                                        $conversation = '<a href="javascript:void(0)" id="replied' . $k . '" onclick="getReplies(' . $k . ')">  <span class="details-icon js-icon-container">
                                         <i class="sm-chat"></i>
                                             </span>
                                                 
                                                    <span class="expand-stream-item js-view-details">
                                                        View conversation
                                                    </span>

                                                 </a>';
                                    }

                                    $imge_id = explode('/', $my_tweet->retweeted_status->entities->urls[0]->display_url);
                                    if ($my_tweet->retweeted_status->entities->media[0]->id_str != '') {
                                        $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                        $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                        $media_flag = '<a href="javascript:void(0)" onclick="displayphoto(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                        $image_are = "<div class='tweet-medias' id='yfrogs$k' style='display:none;'><a href='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' width='" . $my_tweet->retweeted_status->entities->media[0]->sizes->small->w . "px' height='" . $my_tweet->retweeted_status->entities->media[0]->sizes->small->h . "px'></a></div>";
                                    } else if ($imge_id[0] == 'twitpic.com') {
                                        $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                        $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                        $media_flag = '<a href="javascript:void(0)" onclick="displayphoto(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                        $image_are = "<div class='tweet-medias' id='yfrogs$k' style='display:none;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
                                    } else if ($imge_id[0] == 'yfrog.com') {
                                        $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                        $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                        $media_flag = '<a href="javascript:void(0)" onclick="displayphoto(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                        $image_are = "<div class='tweet-medias' id='yfrogs$k' style='display:none;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium'' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
                                    }
                                    echo '<div class="tweet-options">' . $RT_link . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pfavorite(' . $k . ')"><i class="sm-fav"></i>Favorite</a>&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="#repetweet_pop' . $k . '" id="fadein" class="fadein"><i class="sm-reply"></i>
                             Reply</a>';
                                    echo '</div>';
                                    echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
                                    echo $image_are;


//                                    echo "<div class='tweet-reply' id='ptweet-reply$k' style='display:none;'>";
//                                    echo '<table><tr>';
//                                    $mentions = '';
//                                    for ($jk = 0; $jk < count($my_tweet->retweeted_status->entities->user_mentions); $jk++) {
//                                        $mentions .= '@' . $my_tweet->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
//                                    }
//                                    echo '<td><textarea name="preply_message' . $k . '" id="preply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->retweeted_status->user->screen_name . ' ' . $mentions . '</textarea></td>';
//                                    echo '</tr>';
//                                    echo '<tr>';
//                                    echo '<td align="right"><input type="button" value="Tweet" onclick="preply(' . $k . ')"/></td>';
//                                    echo '</tr></table>';
//                                    echo '</div>';
                        ?>
                                    <div id="repetweet_pop<?php echo $k; ?>" style="display: none;" class="modal-example-content">
                                        <div class="modal-example-header">
                                            <button type="button" class="close" onclick="$.fn.custombox('close');">&times;</button>
                                            <h4>Reply</h4>
                                        </div>
                                        <div class="modal-example-body">
                                <?php
                                    $mentions = '';
                                    for ($jk = 0; $jk < count($my_tweet->retweeted_status->entities->user_mentions); $jk++) {
                                        $mentions .= '@' . $my_tweet->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
                                    }
                                ?>
                                    <textarea cols="65" rows="5" id="preply_message<?php echo $k; ?>" name="preply_message<?php echo $k; ?>" value="">@<?php echo $my_tweet->retweeted_status->user->screen_name . ' ' . $mentions; ?> </textarea><br>
                                    <div class=".modal-example-footer" style="float:right;background-color: #FFFFFF;">
                                        <input type="button" name="dm_reply" value="Reply" id="dm_send" onclick="childpreply(<?php echo $k; ?>)"/>
                                    </div>
                                </div>
                            </div>
                        <?php
                                    echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
                                    echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";
                                    echo '</div>';
                                }
                            }
                        ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="ltimeline" id="mentions" style="display:none;">
            <?php
                            $mentions_timeline = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=@" . $screenname . "&result_type=json&count=20");

                            foreach ($mentions_timeline->statuses as $k => $my_tweet) {

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
                                echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='$my_tweet->id_str'>";
                                //delete tweet
                                if ($twitterid == $my_tweet->user->id_str) {
                                    $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i><b>Delete</b></a>';
                                }
                                // echo $my_tweet->current_user_retweet->id_str;
                                //undo retweet
                                if ($my_tweet->retweeted != '') {
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
                                echo '<div class="tweet-counts">' . ($my_tweet->retweet_count != 0 ? $my_tweet->retweet_count . 'Retweets' : false);
                                echo '</div>';
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
                                } else if ($imge_id[0] == 'youtube.com') {
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

                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><object width='425' height='349' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                                            "<br><b>" . $title . "</b><br>" .
                                            "<b>" . $desc . "</b><br>"
                                            . "</div>";
                                } else if ($imge_id[0] == 'vine.co') {
                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
                                            "<br><b>" . $title . "</b><br>" .
                                            "<b>" . $desc . "</b><br>"
                                            . "</div>";
                                }
                                echo '<div class="tweet-options"><a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
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
                            }
            ?>
                        </div>
                        <div class="ltimeline" id="tw_following" style="display:none;">
            <?php
                            $followers = $connection->get("https://api.twitter.com/1.1/friends/list.json?cursor=-1&screen_name=" . $screenname . "&skip_status=true&include_user_entities=false&count=3");
//echo '<pre>';
//print_r($followers);
                            if (isset($followers->errors)) {
                                echo '<center><h3><b>Time limit exceed please try after some times.</b></h3></center>';
                            } else {
                                foreach ($followers->users as $k => $details) {
                                    echo '<div data-cursor="' . $followers->next_cursor_str . '" class="stream-container" style="border-radius: 5px 5px 0 0;">';
                                    echo '<ol class="stream-items">';
                                    $following = '';
                                    $followings = '';
                                    $verified = '';
                                    $ret = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=' . $screenname_b . '&target_screen_name=' . $details->screen_name);

                                    if ($ret->relationship->source->following == 1) {
                                        $following = '<span class="button-text following-text" id="spn' . $details->screen_name . '"><i class="follow"></i> Following</span>';
                                        $followings = 'followings-text';
                                        echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="1" />';
                                    } else {
                                        $following = '<span class="button-text follow-text" id="spn' . $details->screen_name . '"><i class="follow"></i> Follow</span>';
                                        $followings = 'follows';
                                        echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="2" />';
                                    }
                                    if ($details->verified == 1) {
                                        $verified = '<span class="icon verified"><span class="visuallyhidden"></span></span>';
                                    }
                                    echo '<li class="js-stream-item stream-item stream-item">';
                                    echo '<div data-user-id="' . $details->id . '" data-screen-name="' . $details->screen_name . '"  class="account  js-actionable-user js-profile-popup-actionable ">';
                                    echo '<div data-protected="false" data-name="' . $details->screen_name . '" data-screen-name="' . $details->screen_name . '" data-user-id="' . $details->id . '" class="user-actions btn-group following can-dm including  ">';
                                    // echo "<div class='tweet-pic'><img src='" . $details->profile_image_url . "' title='" . $details->name . "' class='profile_pic'></div>";
                                    //echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '">';
                                    echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '" id="' . $details->screen_name . '" data="' . $details->screen_name . '" onclick="do_follow(this.id)">';
                                    echo $following;
                                    echo '</button>';
                                    echo '</div>';
                                    echo '<div class="content">
                 <div class="stream-item-header">
                     <a href="twitter_ajax/twitpic.php?screenname=' . $details->screen_name . '" class="fancybox fancybox.ajax account-group js-user-profile-link addButton">
                         <a href="twitter_ajax/twitpic.php?screenname=' . $details->screen_name . '" class="fancybox fancybox.ajax"><img data-user-id="' . $details->id . '" alt="' . $details->name . '" src="' . $details->profile_image_url . '" class="avatar js-action-profile-avatar "></a>
                         <strong class="fullname js-action-profile-name">' . $details->name . '</strong>
                         <span>&rlm;</span>
                         ' . $verified . '
                         <span class="username js-action-profile-name">@' . $details->screen_name . '</span>
                      </a>
                    <p class="bio" style="margin:0">' . $details->description . ' </p>
                </div>
             </div>';
                                    echo '</div>';
                                    echo '</li>';
                                    echo '</ol>';
                                    echo '</div>';
                                }
                            }
            ?>
                        </div>
                        <div class="ltimeline" id="tw_followers" style="display:none;">

            <?php
                            $followers = $connection->get("https://api.twitter.com/1.1/followers/list.json?cursor=-1&screen_name=" . $screenname . "&skip_status=true&include_user_entities=false&count=10");

                            foreach ($followers->users as $k => $details) {
                                echo '<div data-cursor="' . $followers->next_cursor_str . '" class="stream-container" style="border-radius: 5px 5px 0 0;">';
                                echo '<ol class="stream-items">';
                                $following = '';
                                $followings = '';
                                $ret = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=' . $screenname_b . '&target_screen_name=' . $details->screen_name);

                                if ($ret->relationship->source->following == 1) {
                                    $following = '<span class="button-text following-text" id="spn' . $details->screen_name . '"><i class="follow"></i> Following</span>';
                                    $followings = 'followings-text';
                                    echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="1" />';
                                } else {
                                    $following = '<span class="button-text follow-text" data="' . $details->screen_name . '" id="spn' . $details->screen_name . '"><i class="follow"></i> Follow</span>';
                                    $followings = 'follows';
                                    echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="2" />';
                                }

                                echo '<li class="js-stream-item stream-item stream-item">';
                                echo '<div data-user-id="' . $details->id . '" data-screen-name="' . $details->screen_name . '" class="account  js-actionable-user js-profile-popup-actionable ">';
                                echo '<div data-protected="false" data-name="' . $details->screen_name . '" data-screen-name="' . $details->screen_name . '" data-user-id="' . $details->id . '" class="user-actions btn-group following can-dm including  ">';
                                // echo "<div class='tweet-pic'><img src='" . $details->profile_image_url . "' title='" . $details->name . "' class='profile_pic'></div>";
                                echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '" id="' . $details->screen_name . '" data="' . $details->screen_name . '" onclick="do_follow(this.id)">';
                                echo $following;
                                echo '</button>';
                                echo '</div>';
                                echo '<div class="content">
                 <div class="stream-item-header">
                     <a href="twitter_ajax/twitpic.php?screenname=' . $details->screen_name . '" class="fancybox fancybox.ajax account-group js-user-profile-link addButton">
                         <a href="twitter_ajax/twitpic.php?screenname=' . $details->screen_name . '" class="fancybox fancybox.ajax"><img data-user-id="' . $details->id . '" alt="' . $details->name . '" src="' . $details->profile_image_url . '" class="avatar js-action-profile-avatar "></a>
                         <strong class="fullname js-action-profile-name">' . $details->name . '</strong>
                         <span>&rlm;</span>
                         <span class="username js-action-profile-name">@' . $details->screen_name . '</span>
                      </a>
                    <p class="bio" style="margin:0">' . $details->description . ' </p>
                </div>
             </div>';
                                echo '</div>';
                                echo '</li>';
                                echo '</ol>';
                                echo '</div>';
                                $k++;
                            }
            ?>
                        </div>
                        <div class="ltimeline" id="tw_favorites" style="display:none;">
            <?php
                            $favorites_list = $connection->get("https://api.twitter.com/1.1/favorites/list.json?count=3&screen_name=" . $screenname);
//echo '<pre>';
//print_r($favorites_list);
//$connection->post('direct_messages/new', array('text' => 'dm text here', 'screen_name' => 'sathishauit'));

                            foreach ($favorites_list as $k => $my_tweet) {

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
                                echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='$my_tweet->id_str'>";
                                //delete tweet
                                if ($twitterid == $my_tweet->user->id_str) {
                                    $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i><b>Delete</b></a>';
                                }
                                // echo $my_tweet->current_user_retweet->id_str;
                                //undo retweet
                                if ($my_tweet->retweeted != '') {
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
                                echo '<div class="tweet-counts">' . ($my_tweet->retweet_count != 0 ? $my_tweet->retweet_count . 'Retweets' : false);
                                echo '</div>';
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
                                }
                                echo '<div class="tweet-options"><a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
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
                            }
            ?>
                        </div>
                        <div class="popup_footer">
                          <!--  <div class="_userInfoActions btns btns-center userInfoActions" style="padding:1px;">
                                <a href="javascript:void(0);" class="_follow btn-cmt" id="twitter_ff">Follow</a>
                                <a href="javascript:void(0);" class="_unfollow btn-cmt" id="twitter_uf">Unfollow</a>
                <?php if ($FFs_status[1]->connections[1] == 'followed_by') {
 ?>
                                <a href="#twitter_dm" class="fadein _dm btn-cmt" id="fadein">DM</a>
<?php } ?>
                            <a href="javascript:void(0);" class="_reply btn-cmt" id="twitter_rp">Reply</a>
                          
                        </div>-->
                        <div class="popup_goprofile"><a href="index.php?option=com_community&view=uprofile&screename=<?php echo $screenname; ?>">Goto <?php echo ucfirst($screenname); ?> Profile </a></div>
        </div>
        </div>
    </div>
</div>
<div id="twitter_dm" style="display: none;" class="modal-example-content">
    <div class="modal-example-header">
        <button type="button" class="close" onclick="$.fn.custombox('close');">&times;</button>
        <h4>Direct Message</h4>
    </div>
    <div class="modal-example-body">
        <textarea cols="65" rows="5" id="dm_text" name="dm_text" value=""></textarea><br>
        <div class=".modal-example-footer" style="float:right;background-color: #FFFFFF;">
            <input type="button" name="dm_send" value="Send" id="dm_send" onclick="sendDM()"/>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.easydrag.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="css/childpopup/jquery.custombox.js"></script>

<script type="text/javascript" src="css/childpopup/demo.js"></script>
<link rel="stylesheet" href="css/childpopup/jquery.custombox.css">
<link rel="stylesheet" href="css/childpopup/demo.css">

