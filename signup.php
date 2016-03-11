<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//include("html/signup.php");
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
        $session = new Session();
if (isset($_POST['firstname']) && $_POST['firstname'] != "") {
    $data = array("firstname" => $_POST['firstname'],
        "lastname" => $_POST['lastname'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "month" => $_POST['dmonth'],
        "day" => $_POST['dday'],
        "year" => $_POST['dyear'],
        "gender" => $_POST['gender']
    );
    $session->setSession("sign_gender", $_POST['gender']);
    $result = Signup::save($data,$entityManager);
    if($result != '') {

        $session->setSession("sign_uid", $result);
        header("Location: signup2.php");
    }
}
?>