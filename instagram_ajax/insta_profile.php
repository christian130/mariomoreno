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
//$username = 'sathishhunger';
//$username = 'iamkb';
$username = $_GET['screenname']; //'iamkb';
$insta_user = $instagram->searchUser($username, 1);

//echo '<pre>';
//print_r($insta_user);

$insta_user_id = $insta_user->data[0]->id;
$insta_user_details = $instagram->getUser($insta_user_id);


$profile_pic = $insta_user->data[0]->profile_picture;
$screenname = $insta_user->data[0]->username;
$user_relationship = $instagram->getUserRelationship($insta_user_id);
//echo '<pre>';
//print_r($user_relationship);

$user_media = $instagram->getUserMedia($insta_user_id, 30);
//echo '<pre>';
//print_r($user_media);
//echo $user_media->data[0]->images->standard_resolution->url;
//$user_follwers = $instagram->getUserFollower($insta_user_id);
//echo '<pre>';
//print_r($user_follwers);
//$media_details = $instagram->getMedia('897510739620239894_5762661');
//echo '<pre>';
//print_r($media_details);
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
    #layout { width:600px; height:auto; margin:0 auto 0 18px;background-color: #fff none repeat scroll 0 0 !important;}
    .fancybox-outer,.fancybox-skin,.fancybox-inner{width:610px !important;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#layout').hoverGrid();
       
    });
    function loadNextList(){
        var lastid = $(".item:last").attr("data-id");
        var insta_userid = $("#ig_user_id").val();
        var insta_username = $("#ig_user_name").val();
        //$("#ig_"+lastid).hide();
        $.ajax({
            cache: false,
            dataType : "html" ,
            type: 'POST',
            data: {
                nextid:lastid,
                insta_userid:insta_userid,
                insta_username:insta_username
            },
            url: "./instagram_ajax/ig_infinite_load_popup.php",
            success: function(html) {
                if(html != '0' || html== ''){
                    $( ".ltimeline" ).append( html );
                    $("#last").remove();
                    $("#layout").append( "<p id='last'></p>" );
                    $("#ig_"+lastid).hide();
                }
            }
        });
    }
</script>
<input type="hidden" name="ig_user_id" id="ig_user_id" value="<?php echo $insta_user_id; ?>" />
<input type="hidden" name="ig_user_name" id="ig_user_name" value="<?php echo $username; ?>" />
<div id="outer_box" >
    <div class="pop_demo-cb-tweets" style="text-align:center;"></div>
    <div id="tabs">
        <div id="profile_img" style="text-align: left; border-top:1px solid #ccc;border-bottom:1px solid #ccc;background-size:cover !important;height:250px;margin-bottom:20px; background:url('images/banner.jpg') no-repeat center;"> <img src="<?php echo $profile_pic; ?>" width="200px" height="200px" style="margin-top:150px;">
        </div>
        <div class="profile_description">
            <table width="100%" style="margin-left:20px;">
                <tr>
                    <td width="60%" align=""><br>

                        <b style="font-size:18px;"><?php echo ucfirst($insta_user->data[0]->full_name); ?>&nbsp; <span>
                                <?php if ($user_info->verified == 1) {
                                ?>
                                    <span class="icon verified verified-large-border"><span class="visuallyhidden">Verified account</span></span>
                                <?php } if ($user_info->protected == 1) {
                                ?>
                                    <span class="icon lock-large"><span class="visuallyhidden">Protected account</span></span>
                                <?php } ?>
                            </span>



                        </b>&nbsp;<b>
                            <?php if ($user_relationship->data->incoming_status == 'followed_by') {
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
                         <?php if ($user_relationship->data->target_user_is_private != 1) {
            ?>
                        <tr>
                            <td width="60%" align="">
                        <?php echo $insta_user_details->data->bio; ?>
                                <a href=" <?php echo $insta_user_details->data->website; ?>" target="_blank"> <?php echo $insta_user_details->data->website; ?></a>
                            </td>
                            <td width="10%" align="center">&nbsp;</td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
        <?php
                                $following = '';
                                $followings = '';
                                $verified = '';


                                if ($user_relationship->data->outgoing_status == "follows") {
                                    $following = '<span class="button-text following-text" id="spn' . $screenname . '"><i class="follow"></i> Following</span>';
                                    $followings = 'followings-text';
                                    echo '<input type="hidden" name="f_condition' . $screenname . '" id="f_condition' . $screenname . '" value="1" />';
                                } else if ($user_relationship->data->outgoing_status == "requested") {
                                    $following = '<span class="button-text following-text" id="spn' . $screenname . '"><i class="follow"></i> Requested</span>';
                                    $followings = 'followings-text';
                                    echo '<input type="hidden" name="f_condition' . $screenname . '" id="f_condition' . $screenname . '" value="2" />';
                                } else {
                                    $following = '<span class="button-text follow-text" id="spn' . $screenname . '"><i class="follow"></i> Follow</span>';
                                    $followings = 'follows';
                                    echo '<input type="hidden" name="f_condition' . $screenname . '" id="f_condition' . $screenname . '" value="2" />';
                                }
        ?>
                                <div id="update_counts" style="padding-top: 0px;">
                                    <table width="100%" style="border-bottom: 1px solid #ccc;border-top:1px solid #ccc;margin-top:3px;" id="referNav">
                                        <tr>
                                            <td width="20%" align="center" id="1" onClick="changeClass();" class="active"><a href="javascript:void(0);"  onclick="show_home();"><span class="fontt">POST</span><br><span class="count"><?php echo $insta_user_details->data->counts->media; ?></span></a></td>
                                            <td width="20%" align="center"  id="1" onClick="changeClass();" class=""><a href="javascript:void(0);" onclick="show_followers();"><span class="fontt">Followers</span><br><span class="count"><?php echo $insta_user_details->data->counts->followed_by; ?></span></a></td>
                                            <td width="20%" align="center"  id="1" onClick="changeClass();" class=""><a href="javascript:void(0);" onclick="show_following();"><span class="fontt">Following</span><br><span class="count"><?php echo $insta_user_details->data->counts->follows; ?></span></a></td>

                    <?php if ($user_relationship->data->incoming_status == 'followed_by') {
                    ?>
                                    <td width="5%" align="center"> <a href="#twitter_dm" class="fadein _dm btn-cmt" id="fadein"><img src="images/Twt-message-icon.png" height="25" width="30"/></a></td>
                    <?php } ?>
                                <td width="15%" align="center" class="btn_follow">

                        <?php
                                echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '" id="' . $insta_user_id . '" data="' . $screenname . '" onclick="makeRelationship(this.id)">';
                                echo $following;
                                echo '</button>';
                        ?>
                        </tr>
                    </table>
                </div>
                <div id="jp-container" class="jp-container">
            <?php if ($user_relationship->data->target_user_is_private != 1 || $user_relationship->data->outgoing_status == 'follows') {
            ?>
                                    <div class="ltimeline" id="layout">
                <?php
                                    foreach ($user_media->data as $user_medias) {
                                        if ($user_medias->type == 'video') {
                                            $media_type = 'View Video';
                                        } else {
                                            $media_type = 'View Photo';
                                        }
                ?>
                                        <div class="item" data-id="<?php echo $user_media->pagination->next_max_id; ?>"> <img width="200" height="200" src="<?php echo $user_medias->images->standard_resolution->url; ?>" alt="my image" title="my image" />
                                            <div class="caption" style="display: none;">
                                                <h2><?php echo $user_medias->comments->count; ?> Comments</h2>
                                                <p><?php echo $user_medias->likes->count; ?> Likes</p>
                                                <p><a href="instagram_ajax/view_photo.php?ig_userid=<?php echo $user_medias->id; ?>" tabindex="-1" class="ProfileCard-avatarLink fancybox fancybox.ajax"><?php echo $media_type; ?></a></p>
                                            </div>
                                        </div>
                <?php } if ($user_media->pagination->next_max_id != '') {
 ?>

                                        <div id="ig_<?php echo $user_media->pagination->next_max_id; ?>">
                                            <center><a href="javascript:void(0)" onclick="loadNextList()">Load More</a></center>
                                        </div>
<?php } else { ?>
                                        <div id="ig_<?php echo $user_media->pagination->next_max_id; ?>">
                                            <center><b>No More Post</b></center>
                                        </div>
<?php } ?>
                                </div>
                                <div class="ltimeline" id="ig_followers" style="display:none;">


                                </div>
                                <div class="ltimeline" id="ig_following" style="display:none;">
                                </div>
<?php } elseif ($user_relationship->data->target_user_is_private == 1 && $user_relationship->data->outgoing_status == 'none') { ?>
                    <div class="ltimeline" id="layout">
                        <center><h2>This user is private</h2></center>
                    </div>
<?php } ?>
        </div>
    </div>
</div>