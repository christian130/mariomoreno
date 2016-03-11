<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("config.php");
include_once("twitteroauth/twitteroauth.php");
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'model/Twitter.php';
require_once 'classes/Session.class.php';
if (isset($_GET['lsession'])) {
    session_id($_GET['lsession']);
    session_start();
}

//$jsession =& JFactory::getSession();
// session_start();
if (isset($_REQUEST['oauth_token']) && $_SESSION['token'] !== $_REQUEST['oauth_token']) {

    // if token is old, distroy any session and redirect user to index.php
    session_destroy();
    // header('Location: index.php?option=com_community&view=fprofile');
} elseif (isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

    $session = new Session();
    // everything looks good, request access token
    //successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
    $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

    if ($connection->http_code == '200') {
        //redirect user to twitter
        $_SESSION['status'] = 'verified';
        $_SESSION['request_vars'] = $access_token;
        $_SESSION['twitter'] = 1;
        $screenname = $_SESSION['request_vars']['screen_name'];
        $twitterid = $_SESSION['request_vars']['user_id'];
        $oauth_token = $_SESSION['request_vars']['oauth_token'];
        $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
        $session->setSession("twitter", 1);
        $session->setSession("screen_name_twitter", $_SESSION['request_vars']['screen_name']);
        $session->setSession("screen_id_twitter", $_SESSION['request_vars']['user_id']);
        $session->setSession("auth_token_twitter", $_SESSION['request_vars']['oauth_token']);
        $session->setSession("auth_secret_twitter", $_SESSION['request_vars']['oauth_token_secret']);

        $data = array("networkname" => "twitter",
            "auth_token" => $oauth_token,
            "auth_secret" => $oauth_token_secret,
            "user_id" => $session->getSession("userid"),
            "screen_name" => $screenname,
            "screen_id" => $twitterid
        );
        $twit_val = Twitter::getTwitterValidation($data, $entityManager);
        if (count($twit_val) == 0) {
            Signup::addToken($data, $entityManager);
            $redirect = "home.php?msg=success";
        } else {
            $redirect = "home.php?msg=error";
        }
        unset($_SESSION['token']);
        unset($_SESSION['token_secret']);
        header('Location:'.$redirect);
    } else {
        die("error, try again later!");
    }
} else {

    if (isset($_GET["denied"])) {
        header('Location: index.php?option=com_community&view=fprofile');
        die();
    }
    session_start();
    //fresh authentication
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
    $request_token = $connection->getRequestToken("http://whatsdadilly.com/betaPhase/twitter_add.php?lsession=" . session_id());

    //received token info from twitter
    $_SESSION['token'] = $request_token['oauth_token'];
    $_SESSION['token_secret'] = $request_token['oauth_token_secret'];
    //$res = $connection->post("https://api.twitter.com/1.1/account/end_session.json"); print_r($res); exit;
    // any value other than 200 is failure, so continue only if http code is 200
    if ($connection->http_code == '200') {

        //redirect user to twitter
        $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
        header('Location: ' . $twitter_url);
    } else {
        die("error connecting to twitter! try again later!");
    }
}
?>
