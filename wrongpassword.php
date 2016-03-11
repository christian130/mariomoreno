<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'classes/Session.class.php';
require_once 'model/Signup.php';
require_once 'model/Profile.php';
$session = new Session();
//if ($session->getSession("userid") != "" || $session->getSession("userid") != null) {
    if ($session->getSession("email") != null) {
        $data = array("login_username" => $session->getSession("email"));
        $result_user = Signup::checkusername($data, $entityManager);
    }
    include 'html/wrongpassword.php';
/*} else {
    header("Location:index.php");
}*/
?>
