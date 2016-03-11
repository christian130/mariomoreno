<?php
require_once('lib/tumblroauth/tumblroauth.php');
require_once('config/config.php');
require_once 'classes/Session.class.php';
$consumer_key = TUMBLR_CONSUMER_KEY;
$consumer_secret = TUMBLR_CONSUMER_SECRET;
$callback_url = TUMBLR_CALLBACK;
$session = new Session();

$tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $session->getSession('auth_token_tumblr'), $session->getSession('auth_secret_tumblr'));

$userinfo = $tum_oauth->get('user/info');

$parms = array();
array_push($parms,array("userinfo" => $userinfo));
$avaitar = $tum_oauth->get("http://api.tumblr.com/v2/blog/dailyactress.tumblr.com/avatar/128");

$session->setSession('tumblr_username', $userinfo->response->user->name.".tumblr.com");
$session->setSession('tumblr_pro', $avaitar->response->avatar_url);

//$likes = $tum_oauth->get("user/likes");
//echo '<pre>';
//print_r($likes);
array_push($parms,array("avaitar" => $avaitar));
$photos = $tum_oauth->get("user/dashboard",array("limit"=>20));
//echo '<pre>';
//print_r($photos);
//die();
array_push($parms, array("photos" => $photos));
//$reblog = $tum_oauth->post("api.tumblr.com/v2/blog/sieteestrellas.tumblr.com/post/reblog",array("id"=>"54176106781","reblog_key"=>"ZvyLlgXi","comment"=>"test reblog"));

include 'html/tumblr_index.php';
//$view = new View("tumblr_index.php", $data);