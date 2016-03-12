<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "bootstrap.php";
require_once 'model/Signup.php';

require_once 'classes/Session.class.php';
$session = new Session();
 //$data = array(
 //       "sign_uid" => $session->getSession("sign_uid")
 //   );
//$gender = Signup::getUserGender($data, $entityManager);
//echo $gender[0]['gender'];
include 'html/signup3.php';

