<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'model/Twitter.php';
require_once 'classes/Session.class.php';
$session = new Session();
if ($session->getSession("userid") == "" || $session->getSession("userid") == null) {
   
    include 'html/index.php';
} else {
    header("Location:home.php");
}
?>