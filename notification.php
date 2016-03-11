<?php session_start();
require_once "bootstrap.php";
require_once 'model/Notification.php';
require_once 'classes/Session.class.php';

$session = new Session();
//if (isset($_POST['ajax_add'])) {

if ($_POST['func'] == "raiseLimit") {
    
    if(!isset($_SESSION['limit_notifications'])){
        $session->setSession('limit_notifications', 16);
    }else{
        $session->setSession('limit_notifications', 8+$session->getSession('limit_notifications'));        
    }	
echo $session->getSession('limit_notifications'); 
}

if ($_POST['func'] == "getAll") {
    
        if(isset($_SESSION['limit_notifications'])){
            echo 'case1';
        $result = NotificationModel::getNotifications($entityManager, $session->getSession('userid'),$session->getSession('limit_notifications'));
    }else{
        echo 'case2';
        $result = NotificationModel::getNotifications($entityManager, $session->getSession('userid'));
    }
    
    
    echo $result;
//    unset($_SESSION['notifications_number']);
}

if ($_POST['func'] == "ClearAll") {
    echo '';
    $result = NotificationModel::readNotifications($entityManager, $session->getSession('userid'));
    unset($_SESSION['notifications_number']);
}


if ($_POST['func'] == "readNotification") {
    NotificationModel::readNotification($entityManager, $_POST['qtd']);
}

if ($_POST['func'] == "getNumber") {
    echo NotificationModel::getNumber();
}

?>