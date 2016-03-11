<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'model/Twitter.php';
include_once("config.php");
include_once("twitteroauth/twitteroauth.php");
require_once 'classes/Session.class.php';
$session = new Session();
$img_p = $session->getSession("profile_pic");
$data = array("userid"=>$session->getSession("userid"));
$screen_name = Twitter::getAllTwitterAccounts($data,$entityManager);
$messages = new Friends();
$notifications = new NotificationModel();
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

include 'html/home.php';
