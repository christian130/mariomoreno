<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'bootstrap.php';

require_once 'entities/UserRegister.php';
require_once 'classes/Session.class.php';
require_once 'classes/Search.class.php';
$session = new Session();

$messages = new SearchUtil();

if ($_POST['func'] == "search") {

    $result = $messages->search($entityManager, $_POST['term']);
    echo $result;
}

?>
