<?php
require_once './classes/Avitar.class.php';
?>
<head>
    <!-- CSS Reset -->


    <title>SocialHood / Login</title>
    <script type="text/javascript">var P_TIMER_START = new Date();</script>
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/md5.js"></script>

    <link rel="stylesheet" type="text/css" href="css/pinterest.css">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/wookmark.css">
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/colorbox.css" rel="stylesheet" type="text/css" />

    <!-- add scripts -->

    <script src="js/jquery.colorbox.js"></script>

    <script>
        function viewblog(id){

            var blog_id = $("#blogid_"+id).val();
            var blog_name = $("#blogname_"+id).val();
            var url = "service.php?blog_id="+blog_id+"&blog_name="+blog_name;
            $(this).attr("href", url);

            $(".ajax").colorbox({ href: url });

        }
    </script>
</head>

<body class="nobg">

    <div class="main_content">


        <div class="hommidIG main" id="Ig_Home_feeds">
            <div class="twt-wall-tw-info-title" id="igtabs" style="margin-bottom:20px;">
                <div class="TwtLogo">
                    <a href="#"><img src="rgimages/tumblr.jpg" width="55px;" height="11px"></a>
                   <!-- <span>@<?php //echo $user_info->screen_name;                              ?></span>-->
                </div>
                <div class="HomeTwBtn"><a href='insta_feeds.php'>Home<br/>
                        <i style="color:#66AFE9 !important;font-size:14px;float:left;background-image:none;padding-left: 10px;" class="fa fa-home"></i>
                    </a>
                </div>

                <div class="FollowingQntty TweetsQntty">
                    <a href='insta_userwall.php'>User Posts
                        <br/> <span style="color:#66AFE9 !important;font-size:14px;float:left;padding-left: 15px;"> <?php echo $users_details->data->counts->media; ?> </span>
                    </a>
                </div>
                <div class="FollowerQntty TweetsQntty">
                    <a href='insta_followers.php'>Followers
                        <br/>  <span style="color:#66AFE9 !important;font-size:14px;float:left;padding-left: 22px;;"><?php echo $users_details->data->counts->followed_by; ?> </span>
                    </a>
                </div>
                <div class="Favorites TweetsQntty">
                    <a href='insta_following.php'>Following
                        <br/>  <span style="color:#66AFE9 !important;font-size:14px;float:left;padding-left: 20px;"><?php echo $users_details->data->counts->follows; ?> </span>
                    </a>
                </div>


                <!--<div class="UserTimeline TweetsQntty">&nbsp; <br/><a href='javascript:void(0)' onclick='load_connect();'>UserTimeline</a></div>-->
            </div></div>


        <div id="insta_feeds">
            <div class="tweet_count_dis" style="margin-top: -11px;"></div>
            <div class="wallEntries" id="postedComments" style="margin-top: 34px;">
                <?php
                $img = new Avitar();

                for ($i = 0; $i < count($parms[2]['photos']->response->posts); $i++) {
                    $image = $parms[2]['photos']->response->posts[$i]->photos[$k]->original_size->url;
                    echo $image;
                ?>
                    <input type="hidden" name="blogid_<?php echo $i; ?>" id="blogid_<?php echo $i; ?>" value="<?php echo $parms[2]['photos']->response->posts[$i]->id; ?>" />
                    <input type="hidden" name="blogname_<?php echo $i; ?>" id="blogname_<?php echo $i; ?>" value="<?php echo $parms[2]['photos']->response->posts[$i]->blog_name; ?>" />
                    <div class="timelineItem"  data-id="<?php echo $parms[2]['photos']->response->posts[$i]->id; ?>" data-count="<?php echo $i; ?>">

                        <div class="timelineCenter">
                            <div class="profile_description">
                                <div>
<?php
$ava_image = $img->getProfileImg($parms[2]['photos']->response->posts[$i]->blog_name);
?>
                                    <div style="float: left; display: table-cell;">
                                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $media->user->username; ?>" class="fancybox fancybox.ajax">
                                            <img src="<?php echo $ava_image[0]['avaitar']->response->avatar_url; ?>" width="40px" height="40px" />
                                        </a>
                                    </div>

                                    <div style=" display: table-cell;margin-left:10px;">
                                        <b style="font-size:12px;"><a href="instagram_ajax/insta_profile.php?screenname=<?php echo $media->user->username; ?>" class="fancybox fancybox.ajax"><?php echo ucfirst($media->user->full_name); ?></a></b><br/>
                                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $parms[2]['photos']->response->posts[$i]->blog_name; ?>" class="fancybox fancybox.ajax"><span style="color:#999;margin-left:10px;">@ <?php echo ucfirst($parms[2]['photos']->response->posts[$i]->blog_name); ?></span></a>
                                    </div>
                                    <div style=" display: table-cell;">
                                        <span data-timestamp-short="13m" class="timelineBookmarkInfoTimestamp">
                                            <span class="timelineBookmarkInfoTimestampContent"></span>
                                        </span>
                                        <div class="timelineBookmarkLocation">
                                            <!--Location-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="timelineCard">

                                <div class="mediaPhoto">
                                    <span class="i-like-big"></span>
<?php
                    if ($media->type === 'video') {
                        echo $image;
                    } else {
?>
                                    <div class="mpFrame Frame Image" src="<?php echo $image; ?>">
                                        <div style="background-image: url('<?php echo $image; ?>');" class="iImage">
                                        </div>
                                    </div>
<?php } ?>
                                </div>

                                <div class="timelineLikes">
<?php if ($media->user_has_liked == 1) {
?>
                                    <a class="timelineLikeButton timelineLiked" title="Toggle like" href="javascript:;" id="<?php echo $media->id; ?>" onclick="addMediaLike(this.id);">
                                        <span class="i-like-pop timelineLikeButtonAnimation"></span>
                                    </a>
<?php } else {
?>
                                    <a class="timelineLikeButton" title="Toggle like" href="javascript:;" id="<?php echo $media->id; ?>" onclick="addMediaLike(this.id);">
                                        <span class="timelineLikeButtonAnimation"></span>
                                    </a>
<?php } ?>
                                    <div class="mediaMoreButtonContainer">
                                        <a role="button" title="More" href="javascript:;" class="mediaMoreButton" aria-haspopup="true"> </a>
                                    </div>
                                    <div class="timelineLikeList">
<?php if ($media->likes->count > 0) {
?>
                                        <span class="LikeList">
<?php
                                    $i = 0;
                                    foreach ($media->likes->data as $likes) {
                                        if ($i <= 2) {
?>
                                            <span></span>
                                            <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $likes->username; ?>" class="llNameLink fancybox fancybox.ajax"><?php echo $likes->username; ?></a>
                                            <span>, </span>
<?php
                                            $i++;
                                        }
                                    }
?>
                                            <span> and </span>
                                            <span class="llRemainingCount"><?php echo $media->likes->count - $i; ?></span>
                                            <span> others like this.</span>
                                        </span>
<?php } ?>
                                    </div>
                                </div>

                                <div class="timelineComments">
                                    <div class="timelineComment timelineCaption">
                                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $media->user->username; ?>" class="fancybox fancybox.ajax">
                                            <div class="timelineCommentAvatar Image" src="<?php echo $media->user->profile_picture; ?>">
                                                <div style="background-image:url('<?php echo $media->user->profile_picture; ?>');" class="iImage">
                                                </div>
                                            </div>
                                        </a>
                                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $media->user->username; ?>" class="timelineCommentUsername fancybox fancybox.ajax"><?php echo $media->user->username; ?></a>
                                        <span class="timelineCommentText">
<?php echo $text; ?>
                                        </span>
                                        <a class="delete-comment"></a>
                                    </div>

                                    <div class="scrollArea scrollAreaOpen scrollAreaInitialized">
                                        <div class="scrollAreaContents" id="cmt_<?php echo $media->id; ?>">
<?php
                                        foreach ($media->comments->data as $comments) {
                                            $cmt = htmlentities($comments->text, ENT_QUOTES, 'utf-8');
                                            $cmt = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $cmt);
                                            $cmt = preg_replace('/@(\w+)/', '<a href="instagram_ajax/insta_profile.php?screenname=$1" class="fancybox fancybox.ajax" title="Profile Summary">@$1</a>', $cmt);
                                            $cmt = preg_replace('/\s#(\w+)/', ' <a href="instagram_ajax/insta_tag_search.php?q=$1" class="fancybox fancybox.ajax">#$1</a>', $cmt);
?>
                                            <div class="timelineComment">
                                                <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $comments->from->username; ?>" class="fancybox fancybox.ajax"><?php echo $comments->from->username; ?>
                                                    <div class="timelineCommentAvatar Image" src="<?php echo $comments->from->profile_picture; ?>">
                                                        <div style="background-image:url('<?php echo $comments->from->profile_picture; ?>');" class="iImage">
                                                        </div>
                                                    </div>
                                                </a>
                                                <!--<a  href="instagram_ajax/insta_profile.php?screenname=<?php //echo $comments->from->username;                      ?>" class="fancybox fancybox.ajax timelineCommentUsername"><?php //echo $comments->from->username;                      ?></a>-->
                                                <span class="timelineCommentText">
<?php echo $cmt; ?>
                                                </span>
                                                <a class="delete-comment"></a>
                                            </div>
<?php } ?>
                                        </div>
                                    </div>

                                    <div class="timelineCommentComposer">
                                        <div class="timelineCommentAvatar Image" style="width:24px;height:24px;">
                                            <div style="background-image:url(undefined);" class="iImage"></div>
                                        </div>
                                        <div class="timelineCommentText">
                                            <form class="timelineCommentForm" id="cmtfrm_<?php echo $media->id; ?>">
                                                <input type="hidden" name="post_id" id="post_id" value="<?php echo $media->id; ?>" />
                                                <input type="text" name="comments" id="comments" class="fadedTextField timelineCommentTextField" placeholder="Write a comment...">
                                                <input type="button" name="Post" class="post_comment" id="post_comment" value="Post" onclick="commentPost('<?php echo $media->id; ?>');" data-id="<?php echo $media->id; ?>"/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>
                    <div id="loadorders"></div>
                    <div id="loadMoreComments" style="display:none;" ></div>

            </div> 
        </div>
    </div>

    <script src="js/jquery-1.9.1.min.js"></script>

    <!-- Include the plug-in -->
    <script src="js/jquery.wookmark.js"></script>

    <!-- Once the page is loaded, initalize the plug-in. -->
    <script type="text/javascript">
        var handler = null;
        //
        //        // Prepare layout options.
        var options = {
            autoResize: true, // This will auto-update the layout when the browser window is resized.
            container: $('#main'), // Optional, used for some extra CSS styling
            offset: 2, // Optional, the distance between grid items
            itemWidth: 250 // Optional, the width of a grid item
        };
        //
        //
        $(document).ready(new function() {
            //
            //            //            // Capture scroll event.
            $("#container").append( "<p id='last'></p>" );
            $(window).data('ajaxready', true).scroll(function(e) {

                if ($(window).data('ajaxready') == false) return;

                var winHeight = window.innerHeight ? window.innerHeight : $(window).height(); // iphone fix
                var closeToBottom = ($(window).scrollTop() + winHeight > $(document).height() - 100);
                if(closeToBottom) {
                    $(window).data('ajaxready', false);
                    $('div#loadmoreajaxloader').show();

                    $.ajax({
                        cache: false,
                        dataType : "html" ,
                        url: "tblr_infinite_load.php?offset="+ $(".pins:last").attr('data-count'),
                        success: function(html) {
                            if(html != '0' || html== ''){
                                var items = $('#tiles li'),
                                firstTen = items.slice(0, 10);
                                $('#tiles').append(html);
                                // Create a new layout handler.
                                handler = $('#tiles li');
                                handler.wookmark(options);
                            }else{
                                $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                            }
                            $(window).data('ajaxready', true);
                        }
                    });
                }
            });
            //
            //            // Call the layout function.
            handler = $('#tiles li');
            handler.wookmark(options);
        });
    </script>

</body>
</html>
<link rel="stylesheet" href="colorbox.css" />
<script src="js/jquery.colorbox.js"></script>
