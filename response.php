
<?php

require_once "bootstrap.php";
require_once 'model/Notification.php';
require_once 'classes/Session.class.php';
require_once 'entities/Friend.php';
require_once 'entities/Notification.php';
require_once 'model/Friends.php';
require_once 'model/Notification.php';
require_once 'model/SendMail.php';
require_once 'classes/Session.class.php';
$session = new Session();

$response = array();

$messages = new Friends();


$response['friends_tumbnail'] = $messages->getFriendsTumbnail($entityManager, $session->getSession('userid'), 10); 
if (isset($_SESSION['tumbnail_text'])) {
    $txt = $session->getSession('tumbnail_text');
    unset($_SESSION['tumbnail_text']);
}else
    $txt = '';
$response['tumbnail_text'] = $txt;

$response['getAll'] = NotificationModel::getNotifications($entityManager, $session->getSession('userid'));

$response['getFirst'] = NotificationModel::getNotifications2($entityManager, $session->getSession('userid'));
$response['friend_request_number'] = $messages->getNumberRequest();
$response['friends_request'] = $messages->getFriendsRequest($entityManager, $session->getSession('userid'));
$response['friends_number'] = $messages->getNumber(true);
$response['getAllNumber'] = NotificationModel::getNumber();
 $response['getNumber2'] = NotificationModel::getNumber2();
 
echo json_encode($response);
?>
