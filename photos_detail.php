<?php

session_start();
require_once "bootstrap.php";
require_once 'model/Albums.php';
require_once 'entities/Album.php';
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';



$session = new Session();


if ($_POST['func'] == "listAlbum") {
    $params= array(
      'id_owner' => $_SESSION['userid'] 
        );
    $result = Albums::listAlbum($entityManager, $params);
    echo $result;   
}

if ($_POST['func'] == "createAlbum") {
    $params= array(
      'id_owner' => $_SESSION['userid'] 
        ,'title' => $_POST['title']
        ,'priv' => $_POST['priv']
    );
   $result = Albums::createAlbum($entityManager, $params);
   $repo = $entityManager->getRepository('Album');
//                $album = new Album();
                $album = $repo->findOneBy($params);                
                AlbumUtil::createAlbumFolder($album->getIdAlbum());
   
   echo 'Album Created!';
}

//var_dump(AlbumUtil::userHaveFolder()); 