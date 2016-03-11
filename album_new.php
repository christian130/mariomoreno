<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set("memory_limit",'128M');
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
require_once 'entities/Album.php';
$session = new Session();
$userid = $session->getSession('userid');
$img_p = $session->getSession("profile_pic");

//$album = new Album();
//AlbumUtil::userHaveFolder();
//here i check if you are uploading to new album or 
//if you are uploading to a existing album

if (isset($_GET['id'])) {
    $params = array(
        'id_owner' => $userid,
        'id_album' => $_GET['id']
    );
    $album = AlbumUtil::getAlbum($entityManager, $params);
    //put it one to mark that a album that already have photos included
    $session->setSession('send_photos',1);
    if ($album == false) {
        $other = true;
        //identify if its you album or from other
        $session->setSession('other', false);
    } else {
        if ($album->getIdOwner() == $session->getSession('userid'))
            $session->setSession('other', true);
        else
            $session->setSession('other', false);
        $session->setSession('id_album', $album->getIdAlbum());
    }
}else {
    //here if a new he create 
    $params = array(
        'id_owner' => $_SESSION['userid']
        , 'title' => 'No title'
        , 'priv' => '1'
    );
	
    $result = Albums::createAlbum($entityManager, $params);
    $repo = $entityManager->getRepository('Album');
    $params['datetime'] = $result->getDatetime();
    $album = $repo->findOneBy($params);
    //save the id to identify the new album when upload a photo
    $_SESSION['open_album'] = $album->getIdAlbum();
    unset($_SESSION['id_album']);
    unset($_SESSION['send_photos']);
     //identify how many photos he send
    $session->setSession('send_photos',0);
}
 $session->setSession('other',true); 

  
$_SESSION['id_album'] = $album->getIdAlbum();
include 'html/album_new.php';
?>
