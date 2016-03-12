<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'model/Signup.php';
require_once 'model/Twitter.php';
require_once 'model/Wall.php';
require_once 'model/PhotosModel.php';
require_once 'model/Comments.php';
require_once 'classes/Session.class.php';
include 'html/wall/functions.php';
session_start();
$last_cmtid = $_GET['commentid'];
$params = array();
$params['user_id'] = $_SESSION['userid'];
$parms['last_cmtid'] = $last_cmtid;
$commentslist = CommentsModel::checkNewComment($parms, $entityManager);
if(count($commentslist) > 0) {
    $cmdata = array();
    foreach($commentslist as $cmtdata){
        $row['dev_id'] = $cmtdata['post_id'];
        $row['cmt_id'] = $cmtdata['id'];

        $cuserdetails = WallModel::getUserDetails($entityManager, $cmtdata['author_id']);
        $row['comment_block'] = '<div class="comment-block"><table border="0"><tr><td style="width:5%" valign="top">';
        $row['comment_block'] .= '<img src="uploads/'.$cuserdetails[0]['profile_pic'].'" alt="'.$cuserdetails[0]['firstname'] ." ".$cuserdetails[0]['lastname'] .'" width="32px;" height="32px;" style="border-radius:px;"></td>';
        $row['comment_block'] .= '<td valign="top"><div class="comment-content" style="color:#999;margin-left:0px !important;">';
        $row['comment_block'] .= '<p style="color:#fff;"><b style="color:#ffa96e;">'.$cuserdetails[0]['firstname'].' '.$cuserdetails[0]['lastname'].'</b>&nbsp';
        $row['comment_block'] .= Functions::addLink($cmtdata['text']) .'</br>';
        $row['comment_block'] .= '<span style="color:#ccc !important;">'.date('m/d/Y H:i:s', strtotime($cmtdata['date'])).'</span></p>';
        $row['comment_block'] .= '</div></td> </tr></table><div class="clear"></div></div>';

        array_push($cmdata,$row);
    }
    echo json_encode($cmdata);
}
?>
