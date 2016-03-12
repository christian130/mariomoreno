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
//$username = 'brettsoulman';
$tag_name = $_GET['q']; //'iamkb';
$tag_details = $instagram->getTagMedia($tag_name, 60);
?>
<link rel="stylesheet" href="css/tweet_options.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="css/jquery.hoverGrid.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/jquery.hoverGrid.js"></script>
<style>
    #layout { width:700px; height:auto; margin:0 auto;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#layout').hoverGrid();
    });
</script>
<div id="outer_box" >
    <div class="pop_demo-cb-tweets" style="text-align:center;"></div>
    <div id="tabs">
        <div id="layout">
<?php foreach ($tag_details->data as $user_medias) { ?>
                <div class="item"> <img width="200" height="200" src="<?php echo $user_medias->images->standard_resolution->url; ?>" alt="my image" title="my image" />
                <div class="caption" style="display: none;">
                    <h2><?php echo $user_medias->comments->count; ?> Comments</h2>
                    <p><?php echo $user_medias->likes->count; ?> Likes</p>
                    <p><a href="instagram_ajax/view_photo.php?ig_userid=<?php echo $user_medias->id; ?>" tabindex="-1" class="ProfileCard-avatarLink fancybox fancybox.ajax">View Photo</a></p>
                </div>
            </div>
<?php } ?>

        </div>

    </div>
</div>