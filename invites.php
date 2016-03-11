<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'bootstrap.php';

require_once 'entities/Friend.php';
require_once 'entities/Notification.php';
require_once 'model/Friends.php';
require_once 'model/Wall.php';
require_once 'model/Notification.php';
require_once 'model/SendMail.php';
require_once 'classes/Session.class.php';
$session = new Session();

if ($_POST['func'] == "invite") {
    
    SendMail::sendInvite($entityManager, $_POST['id_friend'], $_POST['name']);
    echo $result;
}

if ($_POST['func'] == "inviteAll") {
    $import = $session->getSession('email_import');
    foreach ($import as $item){
        if(strpos($item, '@')!=FALSE){
            $result = $messages->sendFriendRequest($entityManager, $session->getSession('userid'), $item);


    $params = array(
        'id_friend' => '' . $item,
        'id_user' => '' . $session->getSession('userid'),
        'message' => 'thanks for adding me',
        'type' => '1',
    );


    NotificationModel::addFriendNotification($entityManager, $params);

    SendMail::sendFriendshipRequest($entityManager, $params['id_user'], $params['id_friend']);
        }else{
            $params = array();
            $params['email'] = $item;
            SendMail::sendInvite($entityManager, $session->getSession('userid'), $params);
        }
    }
    
    echo 'Ok';
}




?>
