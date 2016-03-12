<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'classes/Session.class.php';
require_once 'model/Signup.php';
require_once 'model/Profile.php';
if (isset($_POST['login_username']) && $_POST['login_username'] != "") {
    $data = array(
        "login_username" => $_POST['login_username'],
        "login_password" => md5($_POST['login_password'])
    );
    //  echo md5($_POST['login_password']);
    $result = Signup::login($data, $entityManager);
    if (count($result) != 0) {
        $datas = array("userid" => $result[0]['user_id']);
        $credientials = Signup::getTokens($datas, $entityManager);
        $lst = Signup::lastLogin($result[0]['user_id'], $entityManager);
        $session = new Session();
        $usrData = array(
            "user_id" => $result[0]['user_id'],
            "ipaddress" => $_SERVER['REMOTE_ADDR'],
            "login_date" => date("l, F j, Y, g:i:s A"),
            "device" => $_SERVER['HTTP_USER_AGENT']
        );
        Profile::setUserActivity($usrData, $entityManager);

        foreach ($credientials as $tokens) {
            $session->setSession($tokens['networkname'], 1);
            $session->setSession("screen_name_" . $tokens['networkname'], $tokens['screen_name']);
            $session->setSession("screen_id_" . $tokens['networkname'], $tokens['screen_id']);
            $session->setSession("auth_token_" . $tokens['networkname'], $tokens['auth_token']);
            $session->setSession("auth_secret_" . $tokens['networkname'], $tokens['auth_secret']);
        }
        $session->setSession("userid", $result[0]['user_id']);
        $session->setSession("email", $result[0]['email']);
        $session->setSession("firstname", $result[0]['firstname']);
        $session->setSession("lastname", $result[0]['lastname']);
        $session->setSession("gender", $result[0]['gender']);
        $session->setSession("dob", $result[0]['dob']);
        $session->setSession("current_city", $result[0]['current_city']);
        $session->setSession("home_city", $result[0]['home_city']);
        if ($result[0]['profile_pic'] != "") {
            $session->setSession("profile_pic", $result[0]['profile_pic']);
        }
        header("Location:home.php");
    } else {
        $session = new Session();
        $data1 = array(
            "login_username" => $_POST['login_username']
        );
        $result_user = Signup::checkusername($data1, $entityManager);
        if (count($result_user) != 0) {
            $session->setSession("email", $result_user[0]['email']);
            $session->setSession("profile_pic", $result_user[0]['profile_pic']);
            header("Location: wrongpassword.php");
            //$success = array("success" => 'wrongpwd');
        } else {
            $success = array("success" => 'faild');
        }
    }
}
?>