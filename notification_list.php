<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
require_once 'model/Friends.php';
require_once 'model/Notification.php';
require_once 'entities/Notification.php';
$session = new Session();
$userid= $session->getSession("userid");
$img_p = $session->getSession("profile_pic");
$messages = new Friends();
$notifications = new NotificationModel();
include 'html/notification_list.php';
