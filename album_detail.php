<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
require_once 'entities/Album.php';
$session = new Session();
$userid = $session->getSession('userid');
$img_p = $session->getSession("profile_pic");

$album =$entityManager->getRepository('Album')->find($_GET['id']);

if(!$album->getIdOwner()== $session->getSession('userid')){        
     $other = true;       
}else $other = false;      



 $params = array('id_album' => $_GET['id']);

 $session->setSession('other', $other);
 $session->setSession('id_album',$_GET['id']);
 $session->setSession('album_title',$album->getTitle());
include 'html/album_detail.php';
?>
