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

if ($_GET['token'] != '' && isset($_GET['token'])) {
    if (isset($_GET['ow'])) {
        if (isset($_GET['fd'])) {
            $id_owner = base64_decode($_GET['ow']);
            $id_friend = base64_decode($_GET['fd']);
            $repo = new \Doctrine\ORM\EntityRepository;
            $repo = $entityManager->getRepository('UserRegister');
            $params = array(
                'user_id' => $id_owner,
                'activation' => $_GET['token']
            );
            $user = $repo->findOneBy($params);
            if ($user instanceof UserRegister) {
                $_POST['id_friend'] = $id_friend;


                $result = $messages->setFriendAccept($entityManager, $_POST['id_friend'], $user->getUser_id());

                $user = new UserRegister();
                $friend = new UserRegister();

                $params = array(
                    'id_friend' => '' . $_POST['id_friend'],
                    'id_user' => '' . $user->getUser_id(),
                    'message' => 'accepted your friend request',
                    'type' => '2',
                );

                NotificationModel::addFriendNotification($entityManager, $params);
//    
                SendMail::sendFriendshipAccept($entityManager, $params['id_user'], $params['id_friend']);


                $params = array(
                    'owner_id' => '' . $session->getSession('userid'),
                    'author_id' => '' . $session->getSession('userid'),
                    'text' => $text,
                    'date' => date('Y-m-d H:i:s'),
                );

                WallModel::addWallEntry($entityManager, $params);

                echo $result;
            }
        }
    }
}

require_once 'classes/Session.class.php';
$session = new Session();

$messages = new Friends();

if ($_POST['func'] == "friends_request") {

    $result = $messages->getFriendsRequest($entityManager, $session->getSession('userid'));
    echo $result;
}

if ($_POST['func'] == "tumbnail_text") {
    if (isset($_SESSION['tumbnail_text'])) {
        echo $session->getSession('tumbnail_text');
        unset($_SESSION['tumbnail_text']);
    }else
        echo '';
}

if ($_POST['func'] == "friends_tumbnail") {
    $result = $messages->getFriendsTumbnail($entityManager, $session->getSession('userid'), 10);
    echo $result;
}

if ($_POST['func'] == "friendsAll") {
    $result = $messages->getFriends($entityManager, $session->getSession('userid'), 10);
    echo $result;
}

if ($_POST['func'] == "friends") {
    $result = $messages->getFriends($entityManager, $session->getSession('userid'), 10);
    echo $result;
}

if ($_POST['func'] == "friend_block") {
    $result = $messages->setFriendBlock($entityManager, $_POST['id_friend'], $session->getSession('userid'));
}

if ($_POST['func'] == "friend_ignore") {
    $result = $messages->setFriendReject($entityManager, $_POST['id_friend'], $session->getSession('userid'));
}

if ($_POST['func'] == "friend_confirm") {

    $result = $messages->setFriendAccept($entityManager, $_POST['id_friend'], $session->getSession('userid'));

    $user = new UserRegister();
    $friend = new UserRegister();

    $params = array(
        'id_friend' => '' . $_POST['id_friend'],
        'id_user' => '' . $session->getSession('userid'),
        'message' => 'accepted your friend request',
        'type' => '2',
    );

    NotificationModel::addFriendNotification($entityManager, $params);
//    
    SendMail::sendFriendshipAccept($entityManager, $params['id_user'], $params['id_friend']);

    unset($params);

    $tumb = $messages->getFriendsTumbnail($entityManager, $session->getSession('userid'), 10);
    $text = '  <div class="jessicatxt">' . $session->getSession('tumbnail_text') . '</div>
                  	 <div class="peopwrap"><div class="slider_two"><div id="slider_two" class="owl-carousel owl-theme">' . $tumb . '</div></div></div>';

    $params = array(
        'owner_id' => '' . $session->getSession('userid'),
        'author_id' => '' . $session->getSession('userid'),
        'text' => $text,
        'date' => date('Y-m-d H:i:s'),
    );

    WallModel::addWallEntry($entityManager, $params);

    echo $result;
}

if ($_POST['func'] == "friend_request_number") {

    echo $messages->getNumberRequest();
}

if ($_POST['func'] == "search") {
    echo $messages->search($entityManager, $_POST['id_friend']);
}

if ($_POST['func'] == "friends_number") {

    echo $messages->getNumber();
}

 if ($_POST['func'] == "friend_request_send") {
    $result = $messages->sendFriendRequest($entityManager, $session->getSession('userid'), $_POST['id_friend']);


    $params = array(
        'id_friend' => '' . $_POST['id_friend'],
        'id_user' => '' . $session->getSession('userid'),
        'message' => 'wants to add you as friend',
        'type' => '1',
    ); 


    NotificationModel::addFriendNotification($entityManager, $params);

    SendMail::sendFriendshipRequest($entityManager, $params['id_user'], $params['id_friend']);
    echo $result;
} 
?>
