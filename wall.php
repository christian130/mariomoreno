<?php

session_start();
require_once "bootstrap.php";
require_once 'model/Wall.php';
require_once 'model/Comments.php';
require_once 'model/PhotosModel.php';
include 'html/wall/functions.php';

if(isset($_POST['add_comment']))
{
    $params = array();
    $params['author_id'] = $_SESSION['userid'];
    $params['post_id'] = $_POST['id'];
    $params['text'] = $_POST['text'];
    $params['date'] = date('Y-m-d H:i:s');
    CommentsModel::addComment($entityManager, $params);
    
}

if (isset($_POST['ajax_get']) || isset($_POST['add_comment'])) {
    if(!isset($_POST['limit']))
    {
        $limit = 10;
    }
    else
    {
        $limit=$_POST['limit'];
    }
      
    $entries = array_slice(WallModel::getEntries($entityManager),0,$limit);
    
    /*get comments foreach entries*/
    
    foreach($entries as $key=>$value)
    {
        $comments = CommentsModel::getComments($entries[$key]['id'],$entityManager);
        $photos = PhotosModel::getPhotos($entries[$key]['id'],$entityManager);
        $entries[$key]['comments']=$comments;
        $entries[$key]['photos']=$photos;
        
    }
    
    include 'html/wall_ajax.php';
    die();
}

if (isset($_POST['ajax_add'])) {


    $params = array();
    $params['author_id'] = $_SESSION['userid'];
    $params['owner_id'] = $_SESSION['userid'];
    $params['text'] = $_POST['text'];
    $params['link'] = $_POST['link'];
    $params['link_description'] = $_POST['link_description'];
    $params['link_photo'] = $_POST['link_photo'];
    $params['link_title'] = $_POST['link_title'];
    $params['date'] = date('Y-m-d H:i:s');
    WallModel::addWallEntry($entityManager, $params);
    die();
}

if (!isset($_GET['page'])) {

    $page = 'main-wall';
} else {

    $page = 'user-wall';
}



if (isset($_POST['action']) && $_POST['action'] == 'getUrlData') {

    Functions::getUrlData();
    die();
} else if ($page == 'main-wall') {
    $wall = Functions::getMainPageWall();
    $view = 'main-wall';
} else {
    $wall = Functions::getUserWall();
    $view = 'user-wall';
}



include 'html/wall.php';
