<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'bootstrap.php';

require_once 'model/Messages.php';
require_once 'classes/Session.class.php';
$session = new Session();

$messages = new Messages();


if($_POST['func']=="messages"){
    $result = $messages->getMessages($entityManager, $session->getSession('userid'));
    echo $result;
}

if($_POST['func']=="message_num"){
    $result = $messages->getMessageNum($entityManager, $session->getSession('userid'));
    echo $result;
}





?>
