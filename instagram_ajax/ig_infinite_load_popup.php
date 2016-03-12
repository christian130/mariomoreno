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
$nextid = $_POST['nextid'];
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
$username = $_POST['insta_username']; //'iamkb';
$insta_user = $instagram->searchUser($username, 1);

$insta_user_id = $_POST['insta_userid']; //$insta_user->data[0]->id;
$insta_result = $instagram->getUserMoreMedia($insta_user_id, $limit = 18, $oauth_token, $nextid);
//$insta_result = $instagram->getUserMedia($insta_user_id, 30);
//echo '<pre>';
//print_r($insta_result);
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
<div id="ig_<?php echo $insta_result->pagination->next_max_id; ?>">
    <center><a href="javascript:void(0)" onclick="loadNextList()">Load More</a></center>
</div>
<script src="js/jquery.hoverGrid.js"></script>
<link href="css/jquery.hoverGrid.css" rel="stylesheet" type="text/css">
<style>
    #layout { width:600px; height:auto; margin:0 auto 0 18px;background-color: #fff none repeat scroll 0 0 !important;}
    .fancybox-outer,.fancybox-skin,.fancybox-inner{width:610px !important;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#layout').hoverGrid();
    });
</script>