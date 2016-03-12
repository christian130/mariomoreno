<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
$session = new Session();
$activation_code = $_GET['activation'];
$action = base64_decode($_GET['action']);
$url = base64_decode($_GET['url']);
if ($action == "activation") {
    $activated = Signup::getActivated($activation_code, $entityManager);
    if($activated == 1){
        header("Location: thankyou.php");
    }
} else if ($action == "resendmail") {
    $data = array(
        "sign_uid" => $session->getSession("userid")
    );
    $activation = Signup::getActivationLink($data, $entityManager);
    $mailsent = SendMail::sendRegisterationMail($activation[0]['email'], $activation[0]['activation'], $activation[0]['firstname'], $activation[0]['lastname']);
    header("Location: " . $url);
}
?>