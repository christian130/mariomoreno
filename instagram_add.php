<?php

/**
 * Instagram PHP API
 *
 * @link https://github.com/cosenary/Instagram-PHP-API
 * @author Christian Metz
 * @since 01.10.2013
 */
include_once("config.php");
require_once 'instagramoauth/instagram.class.php';
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'model/Twitter.php';
require_once 'classes/Session.class.php';
// initialize class
$instagram = new Instagram(array(
            'apiKey' => IG_CONSUMER_KEY,
            'apiSecret' => IG_CONSUMER_SECRET,
            'apiCallback' => IG_OAUTH_CALLBACK 
        ));

// receive OAuth code parameter
$code = $_GET['code'];

// check whether the user has granted access
if (isset($code)) {
    $session = new Session();
    // receive OAuth token object
    $data = $instagram->getOAuthToken($code);
    $username = $data->user->username;
    $oauth_token = $data->access_token;
    $oauth_token_secret = $code;
    $screenname = $data->user->username;
    $insta_id = $data->user->id;

    $session->setSession("screen_name_instagram", $screenname);
    $session->setSession("screen_id_instagram", $insta_id);
    $session->setSession("auth_token_instagram", $oauth_token);
    $session->setSession("auth_secret_instagram", $oauth_token_secret);

    // store user access token
    $instagram->setAccessToken($data);
    $data = array("networkname" => "instagram",
        "auth_token" => $oauth_token,
        "auth_secret" => $oauth_token_secret,
        "user_id" => $session->getSession("userid"),
        "screen_name" => $screenname,
        "screen_id" => $insta_id
    );
    $twit_val = Twitter::getTwitterValidation($data, $entityManager);
    if (count($twit_val) == 0) {
        Signup::addToken($data, $entityManager);
        $redirect = "insta_feeds.php?msg=success";
    } else {
        $redirect = "insta_feeds.php?msg=error";
    }
    header('Location:' . $redirect);
} else {

    if (isset($_GET['error'])) {
        echo 'An error occurred: ' . $_GET['error_description'];
    }
}
?>