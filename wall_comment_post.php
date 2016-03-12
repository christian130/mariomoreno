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
require_once 'classes/Session.class.php';
include 'html/wall/functions.php';
session_start();
$params = array();
$params['author_id'] = $_SESSION['userid'];
$params['post_id'] = $_POST['post_id'];
$params['text'] = $_POST['comment'];
$params['date'] = date('Y-m-d H:i:s');

$last = CommentsModel::addComment($entityManager, $params);
$comments = CommentsModel::getLastComments($entityManager, $last);

$cuserdetails = WallModel::getUserDetails($entityManager, $comments[0]['author_id']);

$text = $comments[0]['text'];
?>


<div class="comment-block">
<table border="0">
<tr>   
<td style="width:5%" valign="top">

                                                    <img src="uploads/<?php echo $cuserdetails[0]['profile_pic']; ?>" alt="<?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?>" width="32px;" height="32px;" style="border-radius:px;"></td>
                                                        <td valign="top"><div class="comment-content" style="color:#999;margin-left:0px !important;">
                                                          <!--  <h2 ><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></h2>
                                                            <p style="color:#fff;"><?php echo Functions::addLink($comment['text']) ?></p></br></br>
                                                            <p style="margin-top:-15px;color:#ccc;"><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></p> -->
   
                                  <p style="color:#fff;"><b style="color:#ffa96e;"><?php echo $cuserdetails[0]['firstname'] ?> <?php echo $cuserdetails[0]['lastname'] ?></b>&nbsp;
                                                          <?php echo Functions::addLink($text); ?></br>
                                                            <span style="color:#ccc !important;"><?php echo date('m/d/Y H:i:s', strtotime($comments[0]['date'])) ?></span></p>
                                                        </div></td> </tr></table>
                                                        <div class="clear"></div>
                                                </div>



