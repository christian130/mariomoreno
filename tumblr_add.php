<?php

require_once('lib/tumblroauth/tumblroauth.php');
require_once('config/config.php');
require_once 'classes/Session.class.php';
require_once 'model/Signup.php';
$consumer_key = TUMBLR_CONSUMER_KEY;
$consumer_secret = TUMBLR_CONSUMER_SECRET;
$callback_url = TUMBLR_CALLBACK;
$session = new Session();
if ($_REQUEST['oauth_verifier'] == '') {
    $tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret);
    $request_token = $tum_oauth->getRequestToken($callback_url);

    $session->setSession('request_token', $request_token['oauth_token']);
    $session->setSession('request_token_secret', $request_token['oauth_token_secret']);
    if ($request_token['oauth_callback_confirmed'] == true) {
        $url = $tum_oauth->getAuthorizeURL($session->getSession('request_token'));
        $session->getSession('oauth_token');

        header('Location: ' . $url);
    } else {
        echo 'Could not connect to Tumblr. Refresh the page or try again later.';
    }
    die();
} else {
    $tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $session->getSession('request_token'), $session->getSession('request_token_secret'));
    $access_token = $tum_oauth->getAccessToken($_REQUEST['oauth_verifier']);
    $userinfo = $tum_oauth->get('user/info');

    $screenname = $userinfo->response->user->blogs[0]->uuid;
    $data = array("networkname" => "tumblr",
        "auth_token" => $access_token['oauth_token'],
        "auth_secret" => $access_token['oauth_token_secret'],
        "user_id" => $session->getSession("userid"),
        "screen_name" => $screenname,
        "screen_id" => ''
    );
    Signup::addToken($data, $entityManager);
    $session->setSession('auth_token_tumblr', $access_token['oauth_token']);
    $session->setSession('auth_secret_tumblr', $access_token['oauth_token_secret']);

    unset($_SESSION['request_token']);
    unset($_SESSION['request_token_secret']);

    // $tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

    if (200 == $tum_oauth->http_code) {
        header("Location:tumblr_userinfo.php");
    } else {
        die('Unable to get info');
    }
}
?>