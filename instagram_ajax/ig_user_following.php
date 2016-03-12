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
$insta_user_id = $_GET['userid'];
$user_follwers = $instagram->getUserFollows($insta_user_id);
//echo '<pre>';
//print_r($user_follwers);
foreach ($user_follwers->data as $k => $details) {
    echo '<div data-cursor="' . $user_follwers->pagination->next_cursor_str . '" class="stream-container" style="border-radius: 5px 5px 0 0;">';
    echo '<ol class="stream-items">';
    $following = '';
    $followings = '';
    $user_relationship = $instagram->getUserRelationship($details->id);
    //$ret = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=' . $screenname_b . '&target_screen_name=' . $details->screen_name);

    if ($user_relationship->data->outgoing_status == "follows") {
        $following = '<span class="button-text following-text" id="spn' . $details->screen_name . '"><i class="follow"></i> Following</span>';
        $followings = 'followings-text';
        echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="1" />';
    } else {
        $following = '<span class="button-text follow-text" data="' . $details->screen_name . '" id="spn' . $details->screen_name . '"><i class="follow"></i> Follow</span>';
        $followings = 'follows';
        echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="2" />';
    }

    echo '<li class="js-stream-item stream-item stream-item">';
    echo '<div data-user-id="' . $details->id . '" data-screen-name="' . $details->username . '" class="account  js-actionable-user js-profile-popup-actionable ">';
    echo '<div data-protected="false" data-name="' . $details->username . '" data-screen-name="' . $details->username . '" data-user-id="' . $details->id . '" class="user-actions btn-group following can-dm including  ">';
    // echo "<div class='tweet-pic'><img src='" . $details->profile_image_url . "' title='" . $details->name . "' class='profile_pic'></div>";
    echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '" id="' . $details->username . '" data="' . $details->username . '" onclick="do_follow(this.id)">';
    echo $following;
    echo '</button>';
    echo '</div>';
    echo '<div class="content">
                 <div class="stream-item-header">
                      <div class="ProfileCard js-actionable-user">
                 <a class="ProfileCard-bg" href="#" style="background-color: #0084B4;background-image: url(images/banner.jpg);">
  </a>
  <div class="ProfileCard-content">
    <a href="instagram_ajax/insta_profile.php?screenname=' . $details->username . '" tabindex="-1" class="ProfileCard-avatarLink fancybox fancybox.ajax"><img data-user-id="' . $details->id . '" alt="' . $details->full_name . '" src="' . $details->profile_picture . '" class="ProfileCard-avatarImage avatar js-action-profile-avatar "></a>
  </div></div>    <strong class="fullname js-action-profile-name">' . $details->full_name . '</strong>
                         <span>&rlm;</span>
                         <span class="username js-action-profile-name">@' . $details->username . '</span>
                      </a>
                    <p class="bio" style="margin:0">' . $details->bio . ' </p>
                </div>
             </div>';
    echo '</div>';
    echo '</li>';
    echo '</ol>';
    echo '</div>';
    $k++;
}
?>