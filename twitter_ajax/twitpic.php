<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/twitter_profile.js"></script>
<script type="text/javascript" src="js/twitterhome.js"></script>
<link rel="stylesheet" href="css/tweet_options.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


<script>
$(document).ready(function() {
    $('#referNav td').on('click', changeClass);
});
function changeClass() {
   $('#referNav td').removeClass('active');
    $(this).addClass('active');
}

</script>

<style>
.active {

border-bottom:4px solid #0084B4 !important;

}

.fontt
{
color: #66757f;
font-size: 12px !important;
font-weight: normal !important;


text-transform: uppercase;

}
</style>
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
if($profile_banner->sizes->web->url == null || $profile_banner->sizes->web->url == ''){
    $prof_image = 'images/grey_header_web.jpg';
} else {
    $prof_image = $profile_banner->sizes->web->url;
}
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div id="outer_box" >
    <div class="pop_demo-cb-tweets" style="text-align:center;"></div>
    <div id="tabs">
        <div id="profile_img" style="text-align: left; border-top:1px solid #ccc;border-bottom:1px solid #ccc;background-size:cover !important;height:250px;margin-bottom:20px; background:url('<?php echo $prof_image; ?>') no-repeat center;"> <img src="<?php echo $profile_pic; ?>" width="200px" height="200px" style="margin-top:150px;">
        </div>
        <div class="profile_description">
            <table width="100%" style="margin-left:20px;">
                <tr> 
                   
                    <td width="60%" align=""><br>

<b style="font-size:18px;"><?php echo ucfirst($screenname); ?>&nbsp; <span>
 <?php if ($user_info->verified == 1) {
                            ?>
                                <span class="icon verified verified-large-border"><span class="visuallyhidden">Verified account</span></span>
                            <?php } if ($user_info->protected == 1) {
                            ?>
                                <span class="icon lock-large"><span class="visuallyhidden">Protected account</span></span>
                            <?php } ?>
</span>



 </b>&nbsp;<b>
                            <?php if ($FFs_status[1]->connections[1] == 'followed_by') {
                            ?>
                                follows you
                            <?php } ?>
                           
                        </b>
<br />
<span style="color:#999;">@ <?php echo ucfirst($screenname); ?></span><br/>
<?php echo $user_info->location; ?></td>
                    
                     
<td width="10%" align="center">
                        
                    </td>
 <td width="10%" align="center">&nbsp;</td>

                </tr>
                <tr>
                    <td width="60%" align=""><?php echo $user_info->description; ?></td>

                    <td width="10%" align="center">&nbsp;</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <?php
                            $following = '';
                            $followings = '';
                            $verified = '';
                            $ret = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=' . $screenname_b . '&target_screen_name=' . $screenname);

                            if ($ret->relationship->source->following == 1) {
                                $following = '<span class="button-text following-text" id="spn' . $screenname . '"><i class="follow"></i> Following</span>';
                                $followings = 'followings-text';
                                echo '<input type="hidden" name="f_condition' . $screenname . '" id="f_condition' . $screenname . '" value="1" />';
                            } else {
                                $following = '<span class="button-text follow-text" id="spn' . $screenname . '"><i class="follow"></i> Follow</span>';
                                $followings = 'follows';
                                echo '<input type="hidden" name="f_condition' . $screenname . '" id="f_condition' . $screenname . '" value="2" />';
                            }
        ?>
                            <div id="update_counts" style="padding-top: 0px;">
                                <table width="100%" style="border-bottom: 1px solid #ccc;border-top:1px solid #ccc;margin-top:3px;" id="referNav">
                                    <tr>
                                        <td width="12%" align="center" id="1" onClick="changeClass();" class="active"><a href="javascript:void(0);"  onclick="show_home();"><span class="fontt">Tweets</span><br><span class="count"><?php echo $user_info->statuses_count; ?></span></a></td>


                                        <td width="12%" align="center"  id="1" valign="top" onClick="changeClass();" class=""><a href="javascript:void(0);" onclick="show_mentions();"><span class="fontt">Mentions</span><br></a></td>
                                        <td width="12%" align="center"  id="1" onClick="changeClass();" class=""><a href="javascript:void(0);" onclick="show_followers();"><span class="fontt">Followers</span><br><span class="count"><?php echo $user_info->followers_count; ?></span></a></td>
                                        <td width="12%" align="center"  id="1" onClick="changeClass();" class=""><a href="javascript:void(0);" onclick="show_following();"><span class="fontt">Following</span><br><span class="count"><?php echo $user_info->friends_count; ?></span></a></td>
                                        <td width="12%" align="center"  id="1" onClick="changeClass();" class=""><a href="javascript:void(0);" onclick="show_favorites();"><span class="fontt">Favorites</span><br><span class="count"><?php echo $user_info->favourites_count; ?></span></a></td>
                    <?php if ($FFs_status[1]->connections[1] == 'followed_by') {
                    ?>
                                <td width="5%" align="center"> <a href="#twitter_dm" class="fadein _dm btn-cmt" id="fadein"><img src="images/Twt-message-icon.png" height="25" width="30"/></a></td>
                    <?php } ?>
<td width="15%" align="center" class="btn_follow">
                                <!--<a href="javascript:void(0);" class="_follow btn-cmt" id="twitter_ff" style="color:#fff;">Follow</a></td>-->
                        <?php
                            echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '" id="' . $screenname . '" data="' . $screenname . '" onclick="do_follow(this.id)">';
                            echo $following;
                            echo '</button>';
                        ?>
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
                                        $Fav_link = '<a href="javascript:void(0);" onclick="undofavorite_tweet(' . $k . ')"><i class="sm-fav" style="color:#fff000 !important;"></i>Favorited</a>';
                                    } else {
                                        $Fav_link = '<a href="javascript:void(0)" onclick="pfavorite(' . $k . ')"><i class="sm-fav" style="color:#fff000 !important;"></i>Favorite</a>';
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
                                    echo '<div class="stream-item-header" style="font-weight:bold;">';
                                    echo '' . $my_tweet->user->name . '&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->user->screen_name . '</a></span></span>';
                                    echo '</div>';
                                    echo $text . ' <br /><br />-<span>' . $my_tweet->created_at . '</span></div>';
                                    echo '<div class="tweet-counts"></div>';
                                    echo '</div>';



                                    //Popup
                                    echo '<div id="retweet_pop' . $k . '" style="display: none;" class="modal-example-content">';
                ?> <div class="modal-example-header">
                                        <button type="button" class="close" onclick="$.fn.custombox('close');">&times;</button>
                                        <h4>Retweet</h4>
                                    </div>
                                    <div class="modal-example-body">
<div style="border-bottom:1px solid #e1e8ed;padding:10px 10px 0px 10px;height:90px;">
                    <?php
                                    echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
                                    echo '<div class="tweet-content"><b>'.$my_tweet->user->name.'</b>&nbsp@'.$my_tweet->user->screen_name.'<br>' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div></div>';
                                     

                                    echo '<input type="button" name="retweet" value="Cancel" onclick="" class="tweet-rt-cancel">'; 
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
                                         <h4>Reply to @<?php echo $my_tweet->user->screen_name; ?></h4>
                                        </div>
                                        <div class="modal-example-body" style="padding-bottom:0px !important;">
<div style="border-bottom:1px solid #e1e8ed;padding:10px 10px 0px 10px;height:90px;"> 
<?php
echo '<div id="retweet_pop" style="display: block;" class="modal-example-content">';
                                    echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
                                    echo '<div class="tweet-content"><b>'.$my_tweet->user->name.'</b>&nbsp@'.$my_tweet->user->screen_name.'<br>' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                                    //echo '<a href="javascript:void(0)" onclick="childpop_retweet(' . $k . ')"  class="tweet-rt">Retweet</a>';
                                    echo '</div>';
									?>
</div>
                                <div style="background:#f5f5f5;height:160px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
                            <?php
                                    $mentions = '';
                                    for ($jk = 0; $jk < count($my_tweet->entities->user_mentions); $jk++) {
                                        $mentions .= '@' . $my_tweet->entities->user_mentions[$jk]->screen_name . ' ';
                                    }
                            ?>

                                    <textarea cols="65" rows="5" id="preply_message<?php echo $k; ?>" name="preply_message<?php echo $k; ?>" value="">@<?php echo $my_tweet->user->screen_name . ' ' . $mentions; ?></textarea><br>
    <div class=".modal-example-footer" style="float:left;">
                                
 <a href="#" style="float:left;margin:10px;"><i class="fa fa-camera fa-1" ></i>&nbsp;Add Photo</a></div>
<div class=".modal-example-footer" style="float:right;">
                                     
                                        <input type="button" name="dm_reply" value="Reply" id="dm_send" onclick="childpreply(<?php echo $k; ?>)" class="tweet-rt"/></div>
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
                                        $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt" ></i>Retweeted</a>';
                                    } else {
                                        $RT_link = '<a href="#retweet_pop' . $k . '" id="fadein" class="fadein big-link" data-animation="none"><i class="sm-rt" ></i>Retweet</a>';
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
                                    echo '<div class="stream-item-header" style="font-weight:bold;">';
                                    echo '' . $my_tweet->retweeted_status->user->name . '&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->retweeted_status->user->screen_name . '" class="fancybox fancybox.ajax"><span >@' . $my_tweet->retweeted_status->user->screen_name . '</span></a></span>';
                                    echo '</div>';
                                    echo $text . ' <br /><br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
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
                                    echo '<div class="tweet-content"><b>'.$my_tweet->retweeted_status->user->name.'</b>&nbsp@'.$my_tweet->retweeted_status->user->screen_name.'<br>' . $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
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
                                    echo '<div class="tweet-options">' . $RT_link . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pfavorite(' . $k . ')"><i class="sm-fav" ></i>Favorite</a>&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="#repetweet_pop' . $k . '" id="fadein" class="fadein"><i class="sm-reply"></i>
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
                                         <h4>Reply to @<?php echo $my_tweet->user->screen_name; ?></h4>
                                        </div>
                                        <div class="modal-example-body" style="padding-bottom:0px !important;">
<div style="border-bottom:1px solid #e1e8ed;padding:10px 10px 0px 10px;height:90px;"> 
<?php
echo '<div id="retweet_pop" style="display: block;" class="modal-example-content">';
                                    echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
                                    echo '<div class="tweet-content"><b>'.$my_tweet->user->name.'</b>&nbsp@'.$my_tweet->user->screen_name.'<br>' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                                    //echo '<a href="javascript:void(0)" onclick="childpop_retweet(' . $k . ')"  class="tweet-rt">Retweet</a>';
                                    echo '</div>';
									?>
</div>

                                <div style="background:#f5f5f5;height:160px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;">

                                <?php
                                    $mentions = '';
                                    for ($jk = 0; $jk < count($my_tweet->retweeted_status->entities->user_mentions); $jk++) {
                                        $mentions .= '@' . $my_tweet->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
                                    }
                                ?>
                                    <textarea cols="65" rows="5" id="preply_message<?php echo $k; ?>" name="preply_message<?php echo $k; ?>" value="">@<?php echo $my_tweet->retweeted_status->user->screen_name . ' ' . $mentions; ?> </textarea><br>
<div class=".modal-example-footer" style="float:left;">
                                
 <a href="#" style="float:left;margin:10px;"><i class="fa fa-camera fa-1" ></i>&nbsp;Add Photo</a></div>
                                    <div class=".modal-example-footer" style="float:right;">
                                        <input type="button" name="dm_reply" value="Reply" id="dm_send" onclick="childpreply(<?php echo $k; ?>)"/></div>
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

            </div>
            <div class="ltimeline" id="tw_following" style="display:none;">

            </div>
            <div class="ltimeline" id="tw_followers" style="display:none;">


            </div>
            <div class="ltimeline" id="tw_favorites" style="display:none;">

            </div>

            <!--<div class="popup_footer">
                <div class="_userInfoActions btns btns-center userInfoActions" style="padding:1px;">
                    <a href="javascript:void(0);" class="_follow btn-cmt" id="twitter_ff">Follow</a>
                    <a href="javascript:void(0);" class="_unfollow btn-cmt" id="twitter_uf">Unfollow</a>
                <?php if ($FFs_status[1]->connections[1] == 'followed_by') {
 ?>
                                <a href="#twitter_dm" class="fadein _dm btn-cmt" id="fadein">DM</a>
<?php } ?>
                            <a href="javascript:void(0);" class="_reply btn-cmt" id="twitter_rp">Reply</a>
                            <!-- <a href="#" class="_addToList btn-cmt">Add To List</a>
                         </div> -->
                        <div class="popup_goprofile" style="height:40px;background:#fff !important;"><a style="font-size:16px;text-align:left;float:left;margin-left:20px;margin-top:8px;" href="index.php?option=com_community&view=uprofile&screename=<?php echo $screenname; ?>">Goto <?php echo ucfirst($screenname); ?> Profile </a></div>
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
    </div>

</div>
<script type="text/javascript">
</script>
<script type="text/javascript" src="js/jquery.easydrag.js"></script>
<link rel="stylesheet" href="css/1bootstrap.min.css">
<script type="text/javascript" src="css/childpopup/jquery.custombox.js"></script>
<script type="text/javascript" src="css/childpopup/demo.js"></script>
<link rel="stylesheet" href="css/childpopup/1jquery.custombox.css">
<link rel="stylesheet" href="css/childpopup/1demo1.css">