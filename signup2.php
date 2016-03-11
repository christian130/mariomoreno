<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
$country = Signup::allCountry($entityManager);
//echo '<pre>';
//print_r($country);
//die();
$session = new Session();
if ((isset($_POST['current_city_id']) && $_POST['current_city_id'] != "") && (isset($_POST['home_city_id']) && $_POST['home_city_id'] != "")) {
    $data = array("current_city_id" => $_POST['current_city_id'],
        "home_city_id" => $_POST['home_city_id'],
        "sign_uid" => $session->getSession("sign_uid")
    );
    $result = Signup::signup2($data, $entityManager);
    if ($result == true) {

        header("Location: signup3.php");
    }
} else if ((isset($_POST['current_city_id']) && $_POST['current_city_id'] != "")) {
    $data = array("city" => $_POST['home_town'],
        "country" => $_POST['country']
    );
    $home_city_id = Signup::addCities($data, $entityManager);
    $datas = array("current_city_id" => $_POST['current_city_id'],
        "home_city_id" => $home_city_id,
        "sign_uid" => $session->getSession("sign_uid")
    );
    $result = Signup::signup2($datas, $entityManager);
    if ($result == true) {

        header("Location: signup3.php");
    }
} else if ((isset($_POST['home_city_id']) && $_POST['home_city_id'] != "")) {
    $data = array("city" => $_POST['current_city'],
        "country" => $_POST['country']
    );
    $current_city_id = Signup::addCities($data, $entityManager);
    $datas = array("current_city_id" => $current_city_id,
        "home_city_id" => $_POST['home_city_id'],
        "sign_uid" => $session->getSession("sign_uid")
    );
    $result = Signup::signup2($datas, $entityManager);
    if ($result == true) {

        header("Location: signup3.php");
    }
} else if ((isset($_POST['home_city_id']) && $_POST['home_city_id'] == "") && (isset($_POST['current_city_id']) && $_POST['current_city_id'] == "")) {
    $data = array("city" => $_POST['current_city'],
        "country" => $_POST['country']
    );
    $current_city_id = Signup::addCities($data, $entityManager);
    $data = array("city" => $_POST['home_town'],
        "country" => $_POST['country']
    );
    $home_city_id = Signup::addCities($data, $entityManager);
    $datas = array("current_city_id" => $current_city_id,
        "home_city_id" => $home_city_id,
        "sign_uid" => $session->getSession("sign_uid")
    );
    $result = Signup::signup2($datas, $entityManager);
    if ($result == true) {

        header("Location: signup3.php");
    }
}
include 'html/signup2.php';
?>