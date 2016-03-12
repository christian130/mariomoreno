<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
$countryname = $_GET['country'];
$text = $_GET['term'];
$data = array("country" => $countryname, "text" => $text);
$cities = new Signup();
$cities_list = Signup::getCities($data, $entityManager);
$return_arr = array();
foreach ($cities_list as $aValues) {
   // echo $aValues['city'] . "\n";
    $data['id'] = $aValues['id'];//array("id"=>$aValues['city'],"value"=>$aValues['id']);
    $data['value'] = $aValues['city'];
     array_push($return_arr,$data);

}
echo json_encode($return_arr);
?>
