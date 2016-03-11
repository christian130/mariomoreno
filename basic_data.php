<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Profile.php';
$text = $_GET['term'];
$data = array("text" => $text);
$cities = new Profile();
$cities_list = Profile::getCitiesForBasic($data, $entityManager);
$return_arr = array();
foreach ($cities_list as $aValues) {
   // echo $aValues['city'] . "\n";
    $data['id'] = $aValues['id'];//array("id"=>$aValues['city'],"value"=>$aValues['id']);
    $data['value'] = $aValues['city']." ".$aValues['country'];
     array_push($return_arr,$data);

}
echo json_encode($return_arr);
?>
