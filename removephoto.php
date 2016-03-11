<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
 $session = new Session();
        $data = array(
            "sign_uid" => $session->getSession("userid")
        );
$result = Signup::removeProfilePic($data, $entityManager);
if($result == 1)
{
    if ($session->getSession("gender") == 'Male') {
        unset($_SESSION['profile_pic']);
        echo "uploads/default/Maledefault.png";
    } else {
        unset($_SESSION['profile_pic']);
        echo "uploads/default/female.jpg";
    }
}
?>
