<?php

//this file its used to upload a photo to a open album
//upload.php

require 'bootstrap.php';
require_once 'entities/Album.php';
require_once 'model/Albums.php';
require_once 'model/Wall.php';
require_once 'classes/Albums.class.php';
require_once 'classes/Session.class.php';

//ini_set('display_errors', 1);
//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
//error_reporting(E_ALL);
//error_reporting(E_ALL);

$output_dir =  __DIR__."/uploads";
$session = new Session();
$userid = $session->getSession('userid');
$params = array();
$params['userid'] = $userid;
$params['id_album'] = $session->getSession('id_album');
$photo = AlbumUtil::getAlbum($entityManager, $params);
if ($photo == false) {
    die('trying to acess an album that isnt yours');
}
AlbumUtil::userHaveFolder();

$output_dir.="/" . $userid . "/";
 if(!file_exists($output_dir)){
 $mask=umask(0);
            mkdir($output_dir,0777);
			umask($mask);
   }


$output_dir.=$params['id_album'] . "/";
//$output_dir2 = $output_dir;
if(!file_exists($output_dir)){
 $mask=umask(0);
            mkdir($output_dir,0777);
			umask($mask);
   }

//echo $output_dir; die();
//mkdir($output_dir, 755, true);

$resp = array();
	
if (isset($_FILES["files"])) {

//    $num_files = count($_FILES['files']['tmp_name']);
    $index = 0;
//    for ($index = 0; $index < $num_files; $index++) {
////
    //here he check the file type
    //accept only images
    $type = $_FILES["files"]["type"][$index];

    if (strstr($type, 'image/') == false) {
        $item = array();
        $item['name'] = $original;
        $item['error'] = "Filetype not allowed";

        echo json_encode($item);
        return;
    }

//check if file exists
    if (file_exists($_FILES["files"]["tmp_name"][$index])) {

        $params = array(
            'id_owner' => $userid,
            'id_album' => $params['id_album'],
            'title' => 'No title'
        );
		//echo 'test2'; die();
        $photo = Albums::createPhoto($entityManager, $params);

        //create the photo entry an move the upload photo to the album folder
        if ($photo instanceof PhotoAlbum) {
            $session->setSession('send_photos', 1 + $session->getSession('send_photos'));

            $paths = $session->getSession('send_photos_path');

            if (is_array($paths)) {
                $paths[] = array('id' => $photo->getIdPhoto(),
                    'path' => $photo->getPath());
//                echo 'case1';
            } else {
//                echo 'case2';
                $paths = array(array('id' => $photo->getIdPhoto(),
                        'path' => $photo->getPath()));
            }
//            var_dump($paths);
            $session->setSession('send_photos_path', $paths);

            //add the notifications and the wall entry
            //Filter the file types , if you want.

            $_FILES["files"]["name"][$index] = $photo->getIdPhoto() . '.jpg';
            //move the uploaded file to uploads folder;
            if (!file_exists($output_dir . $_FILES["files"]["name"][$index])) {
			//echo $output_dir . $_FILES["files"]["name"][$index]; die();
                move_uploaded_file($_FILES["files"]["tmp_name"][$index], $output_dir . $_FILES["files"]["name"][$index]);
            } else {
                $_FILES["files"]["name"][$index] = ($photo->getIdPhoto() + 1) . '.jpg';
				
                move_uploaded_file($_FILES["files"]["tmp_name"][$index], $output_dir . $_FILES["files"]["name"][$index]);
            }
            $resp[] = array(
                'name' => 'No Title',
                "size" => filesize($output_dir . $_FILES["files"]["name"][$index]),
                "url" => str_replace('\\', '\/', $output_dir . $_FILES["files"]["name"][$index]),
                "thumbnailUrl" => str_replace('\\', '\/', "http://whatsdadilly.com/beta/uploads/". $userid . "/".$params['id_album'] ."/". $_FILES["files"]["name"][$index]),
                "deleteUrl" => str_replace('\\', '\/', $output_dir . $_FILES["files"]["name"][$index]),
                "deleteType" => "DELETE"
            );
        }
    }
}

echo json_encode(array(files=>$resp));
?>