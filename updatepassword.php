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
    if (isset($_POST['log_password']) && $_POST['log_password'] != "") {
        $data = array("log_password" => $_POST['log_password'],
            "token" => $_POST['token']
        );
        Signup::UpdatePassword($data, $entityManager);
    }
    include 'html/updatepassword.php';
} else {
    header("Location:home.php");
}
?>