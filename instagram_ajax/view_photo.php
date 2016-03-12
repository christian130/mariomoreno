<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL & ~E_NOTICE);
include_once("../config.php");
require_once '../instagramoauth/instagram.class.php';
require_once '../classes/Session.class.php';
$session = new Session();
$oauth_token = $session->getSession("auth_token_instagram");
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
//$username = 'iamkb';
$ig_userid = $_GET['ig_userid']; //'iamkb''907344117375119272_1557743018'; //;

$insta_result = $instagram->getMedia($ig_userid,$oauth_token);
//echo '<pre>';
//print_r($insta_result);
$screenname = $insta_result->data->user->username;
$text = htmlentities($insta_result->data->caption->text, ENT_QUOTES, 'utf-8');
$text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
$text = preg_replace('/@(\w+)/', '<a href="instagram_ajax/insta_profile.php?screenname=$1" class="fancybox fancybox.ajax" title="Profile Summary">@$1</a>', $text);
$text = preg_replace('/\s#(\w+)/', ' <a href="instagram_ajax/insta_tag_search.php?q=$1" class="fancybox fancybox.ajax">#$1</a>', $text);

//echo $screenname;
//$media_comments = $instagram->getMediaLikes('897510739620239894_5762661');
//echo '<pre>';
//print_r($media_comments);
?>
<link rel="stylesheet" href="css/tweet_options.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="css/jquery.hoverGrid.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/jquery.hoverGrid.js"></script>
<script src="js/IGprofile.js"></script>
<style>
    #layout { width:700px; height:auto; margin:0 auto;}

</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#layout').hoverGrid();
    });
</script>
<input type="hidden" name="ig_user_id" id="ig_user_id" value="<?php echo $insta_user_id; ?>" />
<div id="outer_box" >
    <div class="pop_demo-cb-tweets" style="text-align:center;"></div>
    <div id="tabs">

        <div class="profile_description">
            <div>

                <div style="float: left"><img src="<?php echo $insta_result->data->user->profile_picture; ?>" width="40px" height="40px" /></div>

                <div style="display: inline;margin-left:10px;">
                    <b style="font-size:18px;"><?php echo ucfirst($insta_result->data->user->full_name); ?></b><br/>
                    <span style="color:#999;margin-left:10px;">@ <?php echo ucfirst($screenname); ?></span>
                </div>
            </div>
        </div>


        <div id="jp-container" class="jp-container">
            <?php
            if ($insta_result->data->type === 'video') {
                // video
                $poster = $insta_result->data->images->standard_resolution->url;
                $source = $insta_result->data->videos->standard_resolution->url;
              $content .= "<video width='100%' controls> <source src='$source' type='video/mp4'> <source src='mov_bbb.mp4' type='video/ogg'></video>";
            } else {
                $image = $insta_result->data->images->standard_resolution->url;
                $content .= "<img style='border-radius:5px;border:0px solid;' width='100%' height='100%' data-id=\"{$insta_result->data->id}\" class=\"media\" src=\"{$image}\" data-src=\"{$image}\" />";
            }
            echo $content;
            ?>
            <div class="timelineLikes">
                <?php if ($insta_result->user_has_liked == 1) {
                ?>
                    <a class="timelineLikeButton timelineLiked" title="Toggle like" href="javascript:;">
                        <span class="i-like-pop timelineLikeButtonAnimation"></span>
                    </a>
                <?php } else {
                ?>
                    <a class="timelineLikeButton" title="Toggle like" href="javascript:;">
                        <span class="timelineLikeButtonAnimation"></span>
                    </a>
                <?php } ?>
                <div class="mediaMoreButtonContainer">
                    <a role="button" title="More" href="javascript:;" class="mediaMoreButton" aria-haspopup="true"> </a>
                </div>
                <div class="timelineLikeList">
                    <?php if ($insta_result->data->likes->count > 0) {
 ?>
                        <span class="LikeList">
                        <?php
                        $i = 0;
                        foreach ($insta_result->data->likes->data as $likes) {
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
                        <span class="llRemainingCount"><?php echo $insta_result->data->likes->count - $i; ?></span>
                        <span> others like this.</span>
                    </span>
<?php } ?>
                </div>
            </div>

            <div class="timelineComments">
                <div class="timelineComment timelineCaption">
                    <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $insta_result->data->user->username; ?>" class="fancybox fancybox.ajax">
                        <div class="timelineCommentAvatar Image" src="<?php echo $insta_result->data->user->profile_picture; ?>">
                            <div style="background-image:url('<?php echo $insta_result->data->user->profile_picture; ?>');" class="iImage">
                            </div>
                        </div>
                    </a>
                    <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $insta_result->data->user->username; ?>" class="timelineCommentUsername fancybox fancybox.ajax"><?php echo $insta_result->data->user->username; ?></a>
                    <span class="timelineCommentText">
<?php echo $text; ?>
                    </span>
                    <a class="delete-comment"></a>
                </div>

                <div class="scrollArea scrollAreaOpen scrollAreaInitialized">
                    <div class="scrollAreaContents">
                        <?php
                        foreach ($insta_result->data->comments->data as $comments) {
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
                                <!--<a  href="instagram_ajax/insta_profile.php?screenname=<?php //echo $comments->from->username;    ?>" class="fancybox fancybox.ajax timelineCommentUsername"><?php //echo $comments->from->username;    ?></a>-->
                                <span class="timelineCommentText">
<?php echo $cmt; ?>
                            </span>
                            <a class="delete-comment"></a>
                        </div>
<?php } ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>