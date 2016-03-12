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
if ($session->getSession("userid") != "" || $session->getSession("userid") != null) {
$datas = array("userid" => $session->getSession("userid"));
$accounts = Signup::getTokens($datas, $entityManager);
//echo '<pre>';
//print_r($accounts);

include 'html/accounts.php';
}else {
    header("Location:index.php");
}
?>