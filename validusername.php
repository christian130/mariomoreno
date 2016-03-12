<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
$email = $_POST['email'];
$user = new UserRegister();
$user = Signup::validate($email, $entityManager);
if (count($user) != 0) {
    $success = array("success" => 1);
} else {
    $success = array("success" => 0);
}
echo json_encode($success);
?>
