<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <input type="hidden" name="pcurrent_url" id="pcurrent_url" value="<?php echo $pcur_url; ?>" />
        <script type="text/javascript" src="js/jquery-latest.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/file_uploads.js"></script>
        <script type="text/javascript" src="js/vpb_script.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript" src="js/jquery.reveal.js"></script>
        <link rel="stylesheet" href="css/1reveal.css" />
        <script type="text/javascript" src="js/scrollpagination.js"></script>

        <link rel="stylesheet" href="css/1tweet_options.css" />

        <link href="css/1bootstrap.min.css" rel="stylesheet" />
        <script type="text/javascript" src="jlib/1jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="jlib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.4"></script>
        <link rel="stylesheet" type="text/css" href="source/1jquery.fancybox.css?v=2.1.4" media="screen" />
	<link rel="stylesheet" href="css/profilestyle.css">
<link href="css/Tweetstyle.css" rel="stylesheet" type="text/css" />


        <script type="text/javascript" src="js/twitterhome.js"></script>
        <link rel="stylesheet" type="text/css" href="js/notes/1styles.css" />
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.easydrag.js"></script>
        <style>
.twt-wall-tw-info-title a {
    color: #333;
    font-weight: bold;
}
.reveal-modal {
    visibility: hidden;
    top: 100px;
    left: 50%;
    margin-left: -300px;
    width: 520px;
    background: #fff;
    position: absolute;
    z-index: 101;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 0 10px rgba(0,0,0,.4);
    -webkit-box-shadow: 0 0 10px rgba(0,0,0,.4);
    -box-shadow: 0 0 10px rgba(0,0,0,.4);
}
            .friendrightProfile {
                position: relative;
                width: 222px;
                margin-top: 38px;
                margin-right:40px;
                float:right;
            }

            .friendrightProfile h3 {
                clear: both;
                color: #000;
                font-size: 17px;
                font-weight: 700;
            }


.twt-wall-tw-info-title {
    background: #fff;
    border-radius: 0px;
height:80px;
border:1px solid #ccc;
}

.TwtLogo {
background: #23BBF4;
    padding: 5px;
}

.FollowingQntty  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}
.TweetsQntty1
 {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}

.FollowerQntty  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}

.Favorites  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}


.Mentions  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}

.HomeTwBtn {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}


        </style>
        <?php
        $session = new Session();
        if ($session->getSession('userid') != null) {
        ?>
            <script type="text/javascript" src="js/updater_remove.js"></script>
            <script type="text/javascript" src="js/updater.js"></script>
            <script type="text/javascript" src="js/home_header.js"></script>
        <?php
        }
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox({

                    closeClick: true,
                    openEffect: 'elastic',
                    closeEffect: 'elastic'
                });
                 
                $(".fancybox-effects-a").fancybox({
                    padding: 0,
                    closeClick : true,

                    helpers : {
                        overlay : null
                    }
                });
                $(".fancybox-skin").easydrag();
            });
        </script>
<script>
$(document).ready(function(){
    $(".center_area1").click(function(){
$(".center_area").css( { marginTop : "0px", marginBottom : "0px" } );
        $(this).css( { marginTop : "5px", marginBottom : "5px" } );
    });
});
</script>


    </head>
    <body  class="nobg" style="background-color: #EDEDED !important;background-position: initial !important;background-size:auto !important; ">
        <div id="ful_content">
           
            <div id="TwrapperArea">
                <div id="TcontentColmn">  
                    <div class="midwht" style="margin-top:-35px;">
                       




     







                        <div class="hommid">
<?php include 'socialmenu.php'; ?>
                            <input type="hidden" name="current_url" id="current_url" value="<?php echo $cur_url; ?>" />
                            <input type="hidden" name="current_tscreen" id="current_tscreen" value="<?php echo $screenname; ?>" />
                            <input type="hidden" name="current_tid" id="current_tid" value="<?php echo $twitterid; ?>" />
                            <form id="vasPLUS_Programming_Blog_Form" method="post" enctype="multipart/form-data" action="tweet_image.php">
                                <div class="TwtrPostWall">
                                    <textarea  class="form-control none-radiusP" name="updateme" id="updateme" rows="2">Whats in your head?</textarea>

                                </div>
                                <div class="UploadIMage-n-post">
                                    <div class="vasplusfile_adds"><input type="file" name="vasPhoto_uploads" id="vasPhoto_uploads" style="opacity:0;-moz-opacity:0;filter:alpha(opacity:0);z-index:9999;width:90px;padding:5px;cursor:default;" /></div>

                                    <button type="button" class="btn-primaryX" onclick="posttweet()">POST</button>
                                    <div id='vasPhoto_uploads_Status'></div>
                                    <!-- <div class="dgry">
                                         <div class="picon"><input type="file" name="photoimg" id="photoimg" value="" /></div>
                                         <input type="button" class="btn-primaryX" value="post" onclick="posttweet()"/>
                                     </div>-->
                                </div>

                            </form>
                            <div id='preview'></div>
<?php
                            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
                            $live_timeline = $connection->get('https://api.twitter.com/1.1/statuses/home_timeline.json', array('screen_name' => $screenname, 'count' => 10, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));
                            $user_info = $connection->get('https://api.twitter.com/1.1/account/verify_credentials.json', array("include_entities" => true, "include_rts" => true, "contributor_details" => true));
                            //  echo '<pre>';
                            //  print_r($live_timeline);
?>
                            <div class="twt-wall-tw-info-title" style="margin-bottom:20px;">
                                <div class="TwtLogo">
                                    <a href="#"><img src="images/twitter-logo.png"></a>
                                   <!-- <span>@<?php //echo $user_info->screen_name;                    ?></span>-->
                                </div>
                                <div class="HomeTwBtn"><a href='javascript:void(0)' onclick='load_index();'>Home<br/>
                                        <i style="color:#66AFE9 !important;font-size:14px;float:left;background-image:none;" class="fa fa-home"></i>
                                    </a></div>
                                <div class="TweetsQntty TweetsQntty1 ">
                                    <a href='javascript:void(0)' onclick='load_connect();'>Tweets<br/>
                                        <span style="color:#66AFE9 !important;font-size:14px;float:left;"> <?php echo $user_info->statuses_count; ?></span>
                                    </a>
                                </div>
                                <div class="FollowingQntty TweetsQntty">
                                    <a href='javascript:void(0)' onclick='load_following();'>Following
                                        <br/> <span style="color:#66AFE9 !important;font-size:14px;float:left"> <?php echo $user_info->friends_count; ?> </span>
                                    </a></div>
                                <div class="FollowerQntty TweetsQntty">
                                    <a href='javascript:void(0)' onclick='load_followers();'>Followers<br/>  <span style="color:#66AFE9 !important;font-size:14px;float:left"><?php echo $user_info->followers_count; ?> </span>
                                    </a></div>
                                <div class="Favorites TweetsQntty">
                                    <a href='javascript:void(0)' onclick="load_userfav();">Favorites<br/>  <span style="color:#66AFE9 !important;font-size:14px;float:left"><?php echo $user_info->favourites_count; ?> </span>
                                    </a></div>
                                <div class="Mentions TweetsQntty"><a href='javascript:void(0)' onclick='load_mentions();'>Mentions</a></div>
                                <!--<div class="UserTimeline TweetsQntty">&nbsp; <br/><a href='javascript:void(0)' onclick='load_connect();'>UserTimeline</a></div>-->
                            </div>

                            <div class="wrapper" id="postedComments">
                                <div style="positive: relative; margin: 0px auto;width: 100px; height: 20px;">
                                    <div class="demo-cb-tweets" style="text-align:center;position:fixed;"></div>
                                </div>
<?php
                            //echo '<div class="welcome_txt">Welcome <strong>' . $screenname . '</strong> (Twitter ID : ' . $twitterid . '). <a href="index.php?reset=1">Logout</a>!</div>';
                            // echo '<div class="tweet_box">';
                            // echo '<form id="imageform" method="post" enctype="multipart/form-data" action="tweet_image.php">';
                            // echo '<table><tr>';
                            // echo '<td colspan="2"><textarea name="updateme" id="updateme" cols="60" rows="4"></textarea></td>';
                            // echo '</tr>';
                            // echo '<tr><td>';
                            // echo '<input type="file" name="photoimg" id="photoimg" value="" />';
                            //  echo '</td>';
                            //  echo '<td><input type="button" class="tweet-rt" value="Tweet" onclick="posttweet()"/></td>';
                            //  echo '</tr></table>';
                            //  echo '</form>';
                            //  echo "<div id='preview'></div>";
                            // echo '</div>';
                            if ($live_timeline->errors[0]->message == '') {
                                echo '<input type="hidden" name="twitter_condition" id="twitter_condition" value="1" />';
                            } else {
                                echo '<center><h3><b>Time limit exceed please try after some times.</b></h3></center>';
                                die();
                            }

                            //echo "<div id='menu' style='padding: 15px 7px 15px 22px;'>";
                            //echo "<ul>";
                            //echo "<li><a href='javascript:void(0)' onclick='load_index();'>HOME</a></li>";
                            //echo "<li><a href='javascript:void(0)' onclick='load_connect();'>USER TIMELINE</a></li>";
                            //echo "<li><a href='javascript:void(0)' onclick='load_mentions();'>MENTIONS</a></li>";
                            //  echo "<li><a href='javascript:void(0)' onclick='load_followers();'>FOLLOWERS</a></li>";
                            // echo "<li><a href='javascript:void(0)' onclick='load_following();'>FOLLOWING</a></li>";
                            // echo '<li><button title="Direct messages" type="button" class="btn dm-button" style="padding: 1px 28px; !important;width:25px;" onclick="load_dm();">  <i class="dm-envelope"><span class="dm-new"></span></i></button></li>';
                            //  echo "</ul>";
                            // echo "</div>";
                            // $live_timeline = $connection->get('statuses/home_timeline', array('screen_name' => $screen_name, 'count' => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true,"since_id" => "309224665145028608"));
                            echo '<div class="tweet_count_dis"></div>';

                            $user_info = $connection->get('account/verify_credentials', array("include_entities" => true, "include_rts" => true, "contributor_details" => true));
?>
                                <script>
                                    document.body.style.background="#f3f3f3 url(<?php echo $user_info->profile_background_image_url; ?>) fixed";
                                    document.body.style.backgroundRepeat="repeat";
                                    document.body.style.height = "100%";
                                </script>
<?php
                                echo '<div class="tweet_list" id="tweet_list">';
                                echo '<div class="home_timeline">';
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
                                            $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><img src="images/arrow_2.png" alt=""></a>';
                                        }
                                        if ($my_tweet->favorited != '') {
                                            $fav = 'favorited';
                                            $Fav_link = '<a href="javascript:void(0);" onclick="undofavorite_tweet(' . $k . ')"><i class="sm-fav"></i><b>Favorited</b></a>';
                                        } else {
                                            $Fav_link = '<a href="javascript:void(0)" onclick="favorite(' . $k . ')"><img src="images/love_icon.png" alt=""></a>';
                                        }
                                        if ($my_tweet->entities->urls[0]->display_url != '') {
                                            $disp_url = $my_tweet->entities->urls[0]->display_url;
                                        } else if ($my_tweet->entities->media[0]->display_url != '') {
                                            $disp_url = $my_tweet->entities->media[0]->display_url;
                                        }
                                        echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->in_reply_to_status_id_str . "'>";
                                        $text = htmlentities($my_tweet->text, ENT_QUOTES, 'utf-8');
                                        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
                                        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax" title="Profile Summary">@$1</a>', $text);

                                        $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
                                        echo '<div class="tweet-outer center_area" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

                                        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . ' " id="tweet-txt' . $k . '">';
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
                                        echo '<div style="border-top:1px solid #ccc;width: 440px;border-bottom:1px solid #ccc;padding: 5px 40px 34px;margin-top:30px;display: inline-block;">';
                                        echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
                                        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div></div><br/>';
                                        echo '<input type="button" name="retweet" value="Retweet" onclick="retweet(' . $k . ')" class="tweet-rt" style="margin:5px;float:right;">';
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
                                        // echo $imge_id[0];
                                        if ($my_tweet->entities->urls[0]->url != '' && $imge_id[0] != 'facebook.com' && $imge_id[0] != 'youtu.be' && $imge_id[0] != 'soundcloud.com' && $imge_id[0] != 'instagram.com' && $imge_id[0] != 'tmblr.co') {
                                            $expand_url = expandUrlLongApi($my_tweet->entities->urls[0]->url);
//                                                    if ($expand_url['response-code'] == 200) {
//                                                        $PAGE_url = $expand_url['long-url'];
//                                                    } else {
//                                                        $PAGE_url = $my_tweet->entities->urls[0]->url;
//                                                    }
//                                                    $html = file_get_contents($PAGE_url);
//                                                    $doc = new DOMDocument();
//                                                    $doc->loadHTML($html);
//                                                    print_r($doc->getElementsByTagName('meta'));
//                                                    foreach ($doc->getElementsByTagName('meta') as $meta) {
////                                                        if ($meta->getAttribute('property') == 'og:description') {
////                                                            $description = $meta->getAttribute('content');
////                                                        }
//                                                        if ($meta->getAttribute('property') == 'og:title') {
//                                                            $title = $meta->getAttribute('content');
//                                                        }
//                                                    }
                                            // preg_match("/<title>(.*)<\/title>/i", $html, $match);
                                            // if ($img_name != "") {
                                            //<a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k .'">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>
                                            //if($title!=null){
                                            $media_flag = '<a href="javascript:void(0)" id="tweet_summ' . $k . '" onclick="displaysummary(' . $k . ')" class="txt"><i class="sm-embed"></i> View Summary</a><a href="javascript:void(0)" onclick="hidesummary(' . $k . ')"  id="htweet_summ' . $k . '" style="display:none;color:#8899a6 !important;"><i class="sm-embed"></i> Hide Summary</a></a>';
                                            // }                                                    //}
                                            // $viewsummary = $connection->get('https://api.twitter.com/1.1/statuses/oembed.json?id=' . $my_tweet->id_str, array("omit_script" => true, "hide_thread" => true, "hide_media" => false, "related" => twitterapi, "maxwidth" => 500));
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='tweets-summary$k' style='display:;'></div>";
                                        }



                                        $vid = explode('/', $my_tweet->entities->urls[0]->expanded_url);
                                        $ct = count($vid) - 1;
                                        $video_id = explode('=', $vid[$ct]);
                                        if ($my_tweet->entities->media[0]->id_str != '') {
                                            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" class="txt" ><i class="sm-image"></i> View media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $my_tweet->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->entities->media[0]->media_url . "' ></a></div></div>";
                                        } else if ($imge_id[0] == 'twitpic.com') {
                                            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div></div>";
                                        } else if ($imge_id[0] == 'yfrog.com') {
                                            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-image"  class="txt"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://yfrog.com/" . $imge_id[1] . ":medium' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div></div>";
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
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "'></a></div></div>";
                                        } else if ($imge_id[0] == 'tmblr.co') {
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
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "' width='0px' height='0px'></a></div></div>";
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

                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" class="txt"><i class="sm-image"  style="color: #8899a6 !important;"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-youtube-play' style='color:#e02927;margin-top:3px;margin-right:3px;'></i> Youtube</p><object width='100%' height='285' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                                                    "<br><b>" . $title . "</b><br>" .
                                                    "<b>" . $desc . "</b><br>"
                                                    . "</div>";
                                        } else if ($imge_id[0] == 'vine.co') {
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-vine' style='color:#26bd97;margin-top:3px;margin-right:3px;background-image: none !important;'></i> Vine</p><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='450px' height='506px' frameborder='0'></iframe>" .
                                                    "<br><b>" . $title . "</b><br>" .
                                                    "<b>" . $desc . "</b><br>"
                                                    . "</div>";
                                        } else if ($imge_id[0] == 'soundcloud.com') {

                                            $media_flag = '<a href="javascript:void(0)" id="tweet_med' . $k . '" onclick="displmed(' . $k . ')" class="txt"><i class="sm-image"></i> View Summary</a><a href="javascript:void(0)" onclick="hidemedia(' . $k . ')"  id="htweet_med' . $k . '" class="txt"><i class="sm-image"></i> Hide Media</a></a>';
                                            $image_are = '<div class="tweet-medias tweet_outer " id="tweets-med' . $k . '" id="yfrog' . $k . '" style="display:;"></div>';
                                        }
                                        echo $image_are;
                                        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";

                                        echo '<div class="tweet-options detail_area">
    <h1>' . $my_tweet->created_at . '</h1>
    <ul>  
      <li><a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><img src="images/arrow_icon.png" alt=""></a></li>
   <li>' . $RT_link . '</li><li>' . $Fav_link . '</li><li>' . $conversation . '' . $Delete_link . '</li>
<li><a style="color: #8899a6 !important;" href="javascript:void(0);" onclick="displayRetweeters(' . $k . ')" id="retweet_img' . $k . '" style="color: #8899a6 !important;"><img src="images/dot_icon.png" alt=""></a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;color: #8899a6 !important;"><img src="images/dot_icon.png" alt=""></a>
   <a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a></li> </ul>
   <a href="#" class="txt">' . $media_flag . '</a>';
    echo '</div>';
                                        echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
                                        echo '<table><tr>';
                                        $mentions = '';
                                        for ($jk = 0; $jk < count($my_tweet->entities->user_mentions); $jk++) {
                                            $mentions .= '@' . $my_tweet->entities->user_mentions[$jk]->screen_name . ' ';
                                        }
                                        echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->user->screen_name . ' ' . $mentions . '</textarea></td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td align="right"><input type="button" class="tweet-rt" value="Tweet" onclick="reply(' . $k . ')"/></td>';
                                        echo '</tr></table>';
                                        echo '</div>';
                                        echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
                                        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";


                                        echo '<div class="comment_outer">
    <img src="img/qu_icon.png">
    <input type="text" class="form-control in_ne" placeholder="Text here..">
   </div></div>';
                                    } else {
                                        echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='" . $my_tweet->retweeted_status->id_str . "'>";
                                        //  echo $my_tweet->retweeted_status->current_user_retweet->id_str;
                                        if ($my_tweet->current_user_retweet->id_str != '') {
                                            $RT = 'retweeted';
                                            $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
                                        } else {
                                            $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><img src="images/arrow_2.png" alt=""></a>';
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
                                        echo '<div class="tweet-outer center_area" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

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
                                        echo '<div style="border-top:1px solid #ccc;width: 440px;padding: 10px 40px 34px;margin-top:30px;border-bottom:1px solid #ccc;display: inline-block;">';
                                        echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
                                        echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div></div><br/>';
                                        echo '<a href="javascript:void(0)" onclick="retweet(' . $k . ')"  class="tweet-rt" style="margin:5px;float:right;">Retweet</a>';
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

                                        if ($my_tweet->retweeted_status->entities->urls[0]->url != '' && $imge_id[0] != 'youtu.be') {
                                            //$url_result = Twitter::expandUrlLongApi($my_tweet->entities->urls[0]->url);
                                            if ($url_result['response-code'] == 200) {
                                                // $img_name = Twitter::getImageName($url_result['long-url']);
                                            } else {

                                                //$img_name = Twitter::getImageName($my_tweet->entities->urls[0]->url);
                                            }

                                            // preg_match("/<title>(.*)<\/title>/i", $html, $match);
                                            // if ($img_name != "") {
                                            //<a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>
                                            $media_flag = '<a href="javascript:void(0)" id="tweet_summ' . $k . '" onclick="displaysummary(' . $k . ')" style="color:#8899a6 !important;"><i class="sm-embed"></i> View Summary</a><a href="javascript:void(0)" onclick="hidesummary(' . $k . ')"  id="htweet_summ' . $k . '" style="display:none;color:#8899a6 !important;"><i class="sm-embed"></i> Hide Summary</a></a>';
                                            //}
                                            // $viewsummary = $connection->get('https://api.twitter.com/1.1/statuses/oembed.json?id=' . $my_tweet->id_str, array("omit_script" => true, "hide_thread" => true, "hide_media" => false, "related" => twitterapi, "maxwidth" => 500));
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='tweets-summary$k' style='display:none;'></div>";
                                        }
                                        $vid = explode('/', $my_tweet->retweeted_status->entities->urls[0]->expanded_url);
                                        $ct = count($vid) - 1;
                                        $video_id = explode('=', $vid[$ct]);
                                        if ($my_tweet->retweeted_status->entities->media[0]->id_str != '') {
                                            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' ></a></div></div>";
                                        } else if ($imge_id[0] == 'twitpic.com') {
                                            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div></div>";
                                        } else if ($imge_id[0] == 'yfrog.com') {
                                            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')" class="txt"><i class="sm-image"  style="color: #8899a6 !important;"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='http://yfrog.com/" . $imge_id[1] . ":medium'' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div></div>";
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
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "'></a></div></div>";
                                        } else if ($imge_id[0] == 'tmblr.co') {
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
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:;'><div class='twtimage'><a href='" . $image . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $image . "' width='00px' height='00px'></a></div></div>";
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
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-youtube-play' style='color:#e02927;margin-top:3px;margin-right:3px;'></i> Youtube</p><object width='100%' height='285' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                                                    "<br><b>" . $title . "</b><br>" .
                                                    "<b>" . $desc . "</b><br>"
                                                    . "</div>";
                                        } else if ($imge_id[0] == 'vine.co') {
                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"  class="txt"><i class="sm-image"></i> View Media</a>';
                                            $image_are = "<div class='tweet-medias tweet_outer ' id='yfrog$k' style='display:none;'><p style='text-align:left;'><i class='fa fa-vine' style='color:#26bd97;margin-top:3px;margin-right:3px;background-image: none !important;'></i> Vine</p><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='450px' height='506px' frameborder='0'></iframe>" .
                                                    "<br><b>" . $title . "</b><br>" .
                                                    "<b>" . $desc . "</b><br>"
                                                    . "</div>";
                                        } else if ($imge_id[0] == 'soundcloud.com') {

                                            $media_flag = '<a href="javascript:void(0)" id="tweet_med' . $k . '" onclick="displmed(' . $k . ')" class="txt"><i class="sm-image"></i> View Summary</a><a href="javascript:void(0)" onclick="hidemedia(' . $k . ')"  id="htweet_med' . $k . '" class="txt"><i class="sm-image"></i> Hide Media</a></a>';
                                            $image_are = '<div class="tweet-medias tweet_outer " id="tweets-med' . $k . '" id="yfrog' . $k . '" style="display:none;"></div>';
                                        }
                                        echo $image_are;
                                        echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";

                                         echo '<div class="tweet-options detail_area">
    <h1>' . $my_tweet->created_at . '</h1>
    <ul> 
      <li><a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><img src="images/arrow_icon.png" alt=""></a></li>
   <li>' . $RT_link . '</li><li>' . $Fav_link . '</li><li>' . $conversation . '' . $Delete_link . '</li>
<li><a style="color: #8899a6 !important;" href="javascript:void(0);" onclick="displayRetweeters(' . $k . ')" id="retweet_img' . $k . '" style="color: #8899a6 !important;"><img src="images/dot_icon.png" alt=""></a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;color: #8899a6 !important;"><img src="images/dot_icon.png" alt=""></a>
   <a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a></li>  </ul>
   <a href="#" class="txt">' . $media_flag . '</a>';
    echo '</div>';


                                        echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
                                        echo '<table><tr>';
                                        $mentions = '';
                                        for ($jk = 0; $jk < count($my_tweet->retweeted_status->entities->user_mentions); $jk++) {
                                            $mentions .= '@' . $my_tweet->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
                                        }
                                        echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->retweeted_status->user->screen_name . ' ' . $mentions . '</textarea></td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td align="right"><input type="button" class="tweet-rt" value="Tweet" onclick="reply(' . $k . ')"/></td>';
                                        echo '</tr></table>';
                                        echo '</div>';
                                        echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
                                        echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";
                                        echo '<div class="comment_outer">
    <img src="img/qu_icon.png">
    <input type="text" class="form-control in_ne" placeholder="Text here..">
   </div></div>';
                                    }
                                }
                                echo ' <div id="loadorders"></div>';
                                echo '<div id="loadMoreComments" style="display:none;" ></div>';
                                echo '</div></div></div>';
?>

                                <div id="loadmoreajaxloader" style="display:none;"><center><img src="images/ajax-loader.gif" /></center></div>
                            </div></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php

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