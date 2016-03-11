<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'bootstrap.php';

require_once 'entities/PhotoComment.php';
require_once 'model/PhotoComments.php';
require_once 'classes/Session.class.php';
$session = new Session();

if ($_POST['func'] == "get_comments") {
    $params = array();
    $params['id_photo'] = $_POST['id_photo'];
    echo PhotoComments::getPhotoComments($entityManager, $params);
}

if ($_POST['func'] == "send_comment") {
    $params = array();
    $params['id_photo'] = $_POST['id_photo'];
    $params['comment'] = $_POST['comment'];
    PhotoComments::addComment($entityManager, $params);
    unset($params['comment']);
    echo PhotoComments::getPhotoComments($entityManager, $params);

    $photo = $entityManager->getRepository('PhotoAlbum')->find($_POST['id_photo']);

    if ($photo->getIdOwner() != $session->getSession('userid')) {

        $params = array(
            'id_friend' => '' . $session->getSession('userid'),
            'id_user' => '' . $photo->getIdOwner(),
            'message' => 'sayd on you photo - '.$_POST['comment'],
            'type' => '4',
        );
        NotificationModel::addNotification($entityManager, $params);
    
        
        $text = 'sayd on you photo - '.$_POST['comment'];
        $params = array(
                'owner_id' => '' .  $photo->getIdOwner(),
                'author_id' => '' . $session->getSession('userid'),
                'text' => $text,
                'link' => './album_detail.php?id='.$photo->getIdAlbum(),
                'link_photo' => $photo->getPath(),
                'date' => date('Y-m-d H:i:s')
            );

            WallModel::addWallEntry($entityManager, $params);
        
    }
}

if ($_POST['func'] == "delete_comment") {

    $params = array();
    $params['id_comment'] = $_POST['id_comment'];
    $params = PhotoComments::removeComment($entityManager, $params);
    unset($params['comment']);
    echo PhotoComments::getPhotoComments($entityManager, $params);
}
?>
