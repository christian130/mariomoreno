<!--<script src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/twitter_profile.js"></script>
<script type="text/javascript" src="js/twitterhome.js"></script>
<link rel="stylesheet" href="css/tweet_options.css">-->
<link rel="stylesheet" href="css/tweet_options.css">
<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");

$screenname = $_GET['screenname'];
$screenname_a = $_SESSION['screen_name_twitter'];//$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

$live_timeline = $connection->get('statuses/user_timeline', array('screen_name' => $screenname, "count" => 1));


$user_info = $connection->get('users/show', array("include_entities" => true, "screen_name" => $screenname));

$profile_banner = $connection->get('https://api.twitter.com/1.1/users/profile_banner.json?screen_name='.$screenname);


//  $mentions_timeline = $connection->get("http://search.twitter.com/search.json?q=@" . $screenname . "&rpp=100&include_entities=true&result_type=json");

$FF_status = $connection->get('http://api.twitter.com/1.1/friendships/exists.json', array('screen_name_a' => $screenname_a, 'screen_name_b' => $screenname));

$profile_pic = str_replace("_normal", "", $user_info->profile_image_url);
?>
<div id="outer_box">
    <div class="pop_demo-cb-tweets" style="text-align:center;"></div>
    <div id="tabs">

        <div id="dmessage" style="display:none;">
            <textarea cols="68" id="dm_text" name="dm_text" value=""></textarea><br>
            <input type="button" name="dm_cancel" id="dm_cancel" value="Cancel"/>
            <input type="button" name="dm_send" id="dm_send" value="Send" />
        </div>
        <div id="tw_reply" style="display:none;">
            <textarea cols="68" id="rp_text" name="rp_text" value=""><?php echo '@' . $screenname ?></textarea><br>
            <input type="button" name="rp_cancel" id="rp_cancel" value="Cancel"/>
            <input type="button" name="rp_send" id="rp_send" value="Send" />
        </div>

        <div id="profile_img" style="text-align: center;  background:url('<?php echo $profile_banner->sizes->web->url; ?>') no-repeat center;">
            <?php if ($FF_status == true) { ?>
                <span class="follow-status">following</span>
            <?php } if ($user_info->verified == 1) { ?>
                <span class="icon verified verified-large-border"><span class="visuallyhidden">Verified account</span></span>
            <?php } if ($user_info->protected == 1) { ?>
                <span class="icon lock-large"><span class="visuallyhidden">Protected account</span></span>
            <?php } ?>
            <img src="<?php echo $profile_pic; ?>" width="200px" height="200px">

        </div>
        <div id="update_counts" style="padding-top: 10px;">
 <a href="#modal1" id="fadein">Fadein</a>
            <table width="100%">
                <tr>
                    <td width="25%" align="center"><b><?php echo $user_info->followers_count; ?></b><br>Followers</td>
                    <td width="25%" align="center"><b><?php echo $user_info->friends_count; ?></b><br>Following</td>
                    <td width="25%" align="center"><b><?php echo $user_info->statuses_count; ?></b><br>Tweets</td>
                    <td width="25%" align="center"><b><?php echo $user_info->favourites_count; ?></b><br>Favorites</td>
                </tr>
            </table>
        </div>
        <div style="padding-top: 10px;">
            <table width="100%">
                <tr>
                    <td width="50%" align="center"><b>Location:</b></td>
                    <td width="50%" align="center"><?php echo $user_info->location; ?></td>
                </tr>
                <tr>
                    <td width="50%" align="center"><b>Bio:</b></td>
                    <td width="50%" align="center"><?php echo $user_info->description; ?></td>
                </tr>
                <tr>
                    <td width="50%" align="center"><b>Twitter:</b></td>
                    <td width="50%" align="center"><a href="<?php echo "http://twitter.com/" . $user_info->screen_name; ?>" target="_blank"><?php echo "http://twitter.com/" . $user_info->screen_name; ?></a></td>
                </tr>
                <tr>
                    <td width="50%" align="center"><b>Joined:</b></td>
                    <td width="50%" align="center"><?php echo $user_info->created_at; ?></td>
                </tr>
                <tr>
                    <td width="50%" align="center"></td>
                    <td width="50%" align="center"><a href="index.php?option=com_community&view=uprofile&screename=<?php echo $screenname; ?>">Goto <?php echo ucfirst($screenname); ?> Profile >></a></td>
                </tr>
            </table>
        </div>
        <div style="positive: relative; margin: 0px auto;width: 100px; height: 20px;">
            <div class="demo-cb-tweets" style="text-align:center;position:fixed;"></div>
        </div>
        <div class="ltimeline">
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
                            $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i><b>Delete</b></a>';
                        }

                        if ($my_tweet->current_user_retweet->id_str != '') {
                            $RT = 'retweeted';
                            $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
                        } else {
                            $RT_link = '<a href="#" class="big-link" onclick="pop_retweet(' . $k . ')"  data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
                        }
                        if ($my_tweet->favorited != '') {
                            $fav = 'favorited';
                            $Fav_link = '<a href="javascript:void(0);" onclick="undofavorite_tweet(' . $k . ')"><i class="sm-fav"></i><b>Favorited</b></a>';
                        } else {
                            $Fav_link = '<a href="javascript:void(0)" onclick="pfavorite(' . $k . ')"><i class="sm-fav"></i><b>Favorite</b></a>';
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
                        echo '<b>' . $my_tweet->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->user->screen_name . '</a></span></span>';
                        echo '</div>';
                        echo $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                        echo '<div class="tweet-counts"></div>';
                        echo '</div>';



                        //Popup
                        echo '<div id="myModals' . $k . '" class="reveal-modal">';
                        echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
                        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                        echo '<input type="button" name="retweet" value="Retweet" onclick="pop_retweet(' . $k . ')" class="tweet-rt">';
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
                        echo '<div class="tweet-options">' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pdisplayreply(' . $k . ')"><i class="sm-reply"></i>
                                 <b>Reply</b></a>';
                        echo '</div>';
                        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
                        echo $image_are;
                        echo "<div class='tweet-reply' id='ptweet-reply$k' style='display:none;'>";
                        echo '<table><tr>';
                        $mentions = '';
                        for ($jk = 0; $jk < count($my_tweet->entities->user_mentions); $jk++) {
                            $mentions .= '@' . $my_tweet->entities->user_mentions[$jk]->screen_name . ' ';
                        }
                        echo '<td><textarea name="preply_message' . $k . '" id="preply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->user->screen_name . ' ' . $mentions . '</textarea></td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td align="right"><input type="button" value="Tweet" onclick="preply(' . $k . ')"/></td>';
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
                            $RT_link = '<a href="#" class="big-link" onclick = "pop_retweet(' . $k . ');" data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
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
                        echo '<b>' . $my_tweet->retweeted_status->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->retweeted_status->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->retweeted_status->user->screen_name . '</span></a></span>';
                        echo '</div>';
                        echo $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
                        echo '<div class="tweet-counts">Retweet By ' . $my_tweet->user->name;
                        echo '</div>';
                        echo '</div>';



                        echo '<div id="myModals' . $k . '" class="reveal-modal">';
                        echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
                        echo '<div class="tweet-content">' . $text . ' <br />-<i>' . $my_tweet->retweeted_status->created_at . '</i></div>';
                        echo '<a href="javascript:void(0)" onclick="pop_retweet(' . $k . ')"  class="tweet-rt">Retweet</a>';
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
                        echo '<div class="tweet-options">' . $RT_link . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pfavorite(' . $k . ')"><i class="sm-fav"></i><b>Favorite</b></a>&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pdisplayreply(' . $k . ')"><i class="sm-reply"></i>
                             <b>Reply</b></a>';
                        echo '</div>';
                        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
                        echo $image_are;
                        echo "<div class='tweet-reply' id='ptweet-reply$k' style='display:none;'>";
                        echo '<table><tr>';
                        $mentions = '';
                        for ($jk = 0; $jk < count($my_tweet->retweeted_status->entities->user_mentions); $jk++) {
                            $mentions .= '@' . $my_tweet->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
                        }
                        echo '<td><textarea name="preply_message' . $k . '" id="preply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->retweeted_status->user->screen_name . ' ' . $mentions . '</textarea></td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td align="right"><input type="button" value="Tweet" onclick="preply(' . $k . ')"/></td>';
                        echo '</tr></table>';
                        echo '</div>';
                        echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
                        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";

                        echo '</div>';
                    }
                }
                ?>
            </div>

        </div>
    </div>
    <div class="popup_footer">
        <div class="_userInfoActions btns btns-center userInfoActions" style="padding:1px;">
            <a href="javascript:void(0);" class="_follow btn-cmt" id="twitter_ff">Follow</a>
            <a href="javascript:void(0);" class="_unfollow btn-cmt" id="twitter_uf">Unfollow</a>
            <a href="javascript:void(0);" class="_dm btn-cmt" id="twitter_dm">DM</a>
            <a href="javascript:void(0);" class="_reply btn-cmt" id="twitter_rp">Reply</a>
            <!-- <a href="#" class="_addToList btn-cmt">Add To List</a>-->
        </div>
    </div>
</div>
    <div id="modal1" style="display: none;" class="modal-example-content">
        <div class="modal-example-header">
            <button type="button" class="close" onclick="$.fn.custombox('close');">&times;</button>
            <h4>jQuery Custombox</h4>
        </div>
        <div class="modal-example-body">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
<script src="js/jquery-latest.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/twitter_profile.js"></script>
<script type="text/javascript" src="js/twitterhome.js"></script>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <script type="text/javascript" src="css/childpopup/jquery.custombox.js"></script>
    <script type="text/javascript" src="css/childpopup/demo.js"></script>
        <link rel="stylesheet" href="css/childpopup/jquery.custombox.css">

    <link rel="stylesheet" href="css/childpopup/demo.css">