<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'model/Twitter.php';
require_once 'model/Wall.php';
require_once 'model/PhotosModel.php';
require_once 'model/Comments.php';
include 'html/wall/functions.php';
include_once("config.php");
include_once("twitteroauth/twitteroauth.php");
require_once 'classes/Session.class.php';

$session = new Session();
if ($session->getSession("userid") != "" || $session->getSession("userid") != null) {
    $img_p = $session->getSession("profile_pic");
    $data = array("userid" => $session->getSession("userid"));
    $accounts = Signup::getTokens($data, $entityManager);
    $screen_name = Twitter::getAllTwitterAccounts($data, $entityManager);
    $messages = new Friends();
    $notifications = new NotificationModel();

    function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    if (!is_dir('uploads')) {
        mkdir('uploads');
    }

    $status_saved = false;

    $types = array('image/png', 'image/gif', 'image/jpeg');
    
    if (isset($_POST['post_id'])) {
        $comment = $_POST['comment-' . $_POST['post_id']];
        $post_id = $_POST['post_id'];


        $ext = array_pop(explode('.', $_FILES['photo']['name']));
        if ($_FILES['photo']['error'] == 0 && in_array($_FILES['photo']['type'], $types)) {
            $new_file = slugify($_FILES['photo']['name']) . '.' . $ext;
            move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $new_file);
            $comment .='<div class="comment-photo"><img src="uploads/' . $new_file . '"></div>';
        }
        $params = array();
        $params['author_id'] = $_SESSION['userid'];
        $params['post_id'] = $post_id;
        $params['text'] = $comment;
        $params['date'] = date('Y-m-d H:i:s');
        CommentsModel::addComment($entityManager, $params);
    } else {

        foreach ($_FILES as $file) {
            $ext = array_pop(explode('.', $file['name']));

            if ($file['error'] == 0 && in_array($file['type'], $types)) {
                if (!$status_saved) {
                    /* save the blank status */
                    if ($_POST['status'] == 'Whats in your head?') {
                        $_POST['status'] = '';
                    }

                    $params = array();
                    $params['author_id'] = $_SESSION['userid'];
                    $params['owner_id'] = $_SESSION['userid'];
                    $params['text'] = @$_POST['status'];
                    $params['link'] = '';
                    $params['link_description'] = '';
                    $params['link_photo'] = '';
                    $params['link_title'] = '';
                    $params['date'] = date('Y-m-d H:i:s');
                    $id_wall = WallModel::addWallEntry($entityManager, $params);

                    $status_saved = true;
                }
                $new_file = slugify($file['name']) . '.' . $ext;
                move_uploaded_file($file['tmp_name'], 'uploads/' . $new_file);
                /* save the photo for a new status */
                $params = array();
                $params['wall_id'] = $id_wall;
                $params['file'] = $new_file;
                $params['date'] = date('Y-m-d H:i:s');
                $id = PhotosModel::addPhoto($entityManager, $params);
                //  echo $id;
            }
        }
    }
    if ($status_saved) {
        /* redirect */
    }
unset($_SESSION['profileid']);
    // if (isset($_POST['ajax_get']) || isset($_POST['add_comment'])) {
    if (!isset($_POST['limit'])) {
        $limit = 10;
    } else {
        $limit = 3; //$_POST['limit'];
    }
 $last_comment = CommentsModel::getLastcommentID($session->getSession("userid"), $entityManager);
    $entries = array_slice(WallModel::getEntries($entityManager), 0, $limit);
//echo '<pre>';
//print_r($entries);
    /* get comments foreach entries */

    foreach ($entries as $key => $value) {
        $comments = CommentsModel::getComments($entries[$key]['id'], $entityManager);
        $photos = PhotosModel::getPhotos($entries[$key]['id'], $entityManager);

        $entries[$key]['comments'] = $comments;
        $entries[$key]['photos'] = $photos;
    }
    //if count(){}
//echo '<pre>';
//print_r($entries);
    //include 'html/wall_ajax.php';
    // die();
//}
    include 'html/home.php';
} else {
    header("Location:index.php");
}