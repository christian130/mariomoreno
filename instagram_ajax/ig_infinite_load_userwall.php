<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL & ~E_NOTICE);
include_once("../config.php");
require_once '../instagramoauth/instagram.class.php';
require_once '../classes/Session.class.php';
require_once '../classes/Util.class.php';
$session = new Session();
$oauth_token = $session->getSession("auth_token_instagram");
$userid = $session->getSession("screen_id_instagram");
$nextid = $_GET['nextid'];
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
$insta_result = $instagram->getUserMoreMedia($userid, $limit = 0, $oauth_token, $nextid);
foreach ($insta_result->data as $media) {
    $text = htmlentities($media->caption->text, ENT_QUOTES, 'utf-8');
    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
    $text = preg_replace('/@(\w+)/', '<a href="instagram_ajax/insta_profile.php?screenname=$1" class="fancybox fancybox.ajax" title="Profile Summary">@$1</a>', $text);
    $text = preg_replace('/\s#(\w+)/', ' <a href="instagram_ajax/insta_tag_search.php?q=$1" class="fancybox fancybox.ajax">#$1</a>', $text);

    //   $content .= $text;
    if ($media->type === 'video') {
        // video
        $poster = $media->images->standard_resolution->url;
        $source = $media->videos->standard_resolution->url;
        // echo $source;
//        $image = "<video class=\"media video-js vjs-default-skin\" width=\"640px\" height=\"640px\" poster=\"{$poster}\"
//                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
//                             <source src=\"{$source}\" type=\"video/mp4\" />
//                           </video>";
        $image = "<video width='100%' controls> <source src='$source' type='video/mp4'> <source src='mov_bbb.mp4' type='video/ogg'></video>";
    } else {
        $image = $media->images->standard_resolution->url;
        $content = "<img style='border-radius:5px;border:1px solid;' data-id=\"{$media->id}\" class=\"media\" src=\"{$image}\" data-src=\"{$image}\" />";
    }
?>
    <div class="timelineItem" data-id="<?php echo $insta_result->pagination->next_max_id; ?>">

        <div class="timelineCenter">
            <div class="profile_description">
                <div>

                    <div style="float: left; display: table-cell;">
                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $media->user->username; ?>" class="fancybox fancybox.ajax">
                            <img src="<?php echo $media->user->profile_picture; ?>" width="40px" height="40px" />
                        </a>
                    </div>

                    <div style=" display: table-cell;margin-left:10px;">
                        <b style="font-size:12px;"><a href="instagram_ajax/insta_profile.php?screenname=<?php echo $media->user->username; ?>" class="fancybox fancybox.ajax"><?php echo ucfirst($media->user->full_name); ?></a></b><br/>
                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $media->user->username; ?>" class="fancybox fancybox.ajax"><span style="color:#999;margin-left:10px;">@ <?php echo ucfirst($media->user->username); ?></span></a>
                    </div>
                    <div style=" display: table-cell;">
                        <span data-timestamp-short="13m" class="timelineBookmarkInfoTimestamp">
                            <span class="timelineBookmarkInfoTimestampContent"><?php echo Util::IGTimeCalculation($media->created_time); ?></span>
                        </span>
                        <div class="timelineBookmarkLocation">
                            <a href="instagram_ajax/ig_location_search.php?locationid=<?php echo $media->location->id; ?>" class="fancybox fancybox.ajax" title="<?php echo $media->location->name; ?>">
                            <?php echo $media->location->name; ?>
                        </a>
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
                        <div class="scrollAreaContents">
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
                                    <!--<a  href="instagram_ajax/insta_profile.php?screenname=<?php //echo $comments->from->username;      ?>" class="fancybox fancybox.ajax timelineCommentUsername"><?php //echo $comments->from->username;      ?></a>-->
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
                            <form class="timelineCommentForm">
                                <input type="text" class="fadedTextField timelineCommentTextField" placeholder="Write a comment..."></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<link href="css/video-js.css" rel="stylesheet">
<script src="js/video.js"></script>