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
$nextid = $_GET['nextid'];
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
$username = $_SESSION['ig_photo_section']; //'iamkb';
$insta_user = $instagram->searchUser($username, 1);

$insta_user_id = $insta_user->data[0]->id;
$insta_result = $instagram->getUserMoreMedia($insta_user_id, $limit = 0, $oauth_token, $nextid);
?>
<?php
foreach ($insta_result->data as $user_medias) {
    if ($user_medias->type == 'video') {
        $media_type = 'View Video';
    } else {
        $media_type = 'View Photo';
    }
?>
    <div class="item" data-id="<?php echo $insta_result->pagination->next_max_id; ?>"> <img width="200" height="200" src="<?php echo $user_medias->images->standard_resolution->url; ?>" alt="my image" title="my image" />
        <div class="caption" style="display: none;">
            <h2><?php echo $user_medias->comments->count; ?> Comments</h2>
            <p><?php echo $user_medias->likes->count; ?> Likes</p>
            <p><a href="instagram_ajax/view_photo.php?ig_userid=<?php echo $user_medias->id; ?>" tabindex="-1" class="ProfileCard-avatarLink fancybox fancybox.ajax"><?php echo $media_type; ?></a></p>
        </div>
    </div>
<?php } ?>
<script src="js/jquery.hoverGrid.js"></script>
<link href="css/jquery.hoverGrid.css" rel="stylesheet" type="text/css">
<style>
    #layout { width:1052px; height:auto; margin:0 auto;}
    .jquery-bar {
        margin: -14px 0 0 -5px !important;
    }
    .tweet_count_dis{
        margin-top: -46px;
        padding-bottom: 3px;
        padding-left: 223px;
        position: fixed;
        text-align: center;
        width: 579px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#layout').hoverGrid();
    });
</script>