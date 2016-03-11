<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("config.php");
include_once("inc/twitteroauth.php");
session_start();

$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$DMs = $connection->get("direct_messages",array('count'=>200));
//echo "<pre>";
//print_r($DMs);
$DM = $connection->get("direct_messages/sent",array('count'=>200));
//echo "<pre>";
//print_r($DM);

//echo ' <div id="loadorders"></div>';
//echo '<div id="loadMoreComments" style="display:none;" ></div>';
?>