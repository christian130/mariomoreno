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
    if (isset($_POST['log_username']) && $_POST['log_username'] != "") {
        $data = array("email" => $_POST['log_username']);
        Signup::sendForgotPasswordLink($data,$entityManager);
    }
include 'html/forgotpassword.php';
} else {
    header("Location:home.php");
}
?>