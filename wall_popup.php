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
$photo_id = $_GET['photoid'];
$wall_id = $_GET['wall_id'];
$postion = $_GET['postion'];
$photo_name = WallModel::getPhotoAlbum($entityManager, $wall_id);
//echo count($photo_name);
$comments = CommentsModel::getComments($wall_id, $entityManager);
//  echo '<pre>';
//print_r($comments);
?>
<style>
    .chrome.blue {
        background: -moz-linear-gradient(center top , #6AA5CF 0px, #5791BB 100%) repeat scroll 0 0 transparent;
        border-color: #4A7C9F;
    }
    .chrome {
        -moz-user-select: -moz-none;
        background: -moz-linear-gradient(center top , #ACB3BB 0px, #898F98 100%) repeat scroll 0 0 transparent;
        border-color: #656B73;
        border-radius: 3px 3px 3px 3px;
        border-style: solid;
        border-width: 1px;
        box-shadow: 0 1px 0 0 rgba(255, 255, 255, 0.6) inset;
        color: #FFFFFF;
        cursor: pointer;
        font-family: "Helvetica Neue",Arial,Helvetica,sans-serif;
        font-size: 14px;
        font-weight: bold;
        height: 30px;
        line-height: 14px;
        padding: 4px 7px 5px;
        text-decoration: none;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.32);
    }
    .reblog_comments{
        border: 1px solid #B8BDC1; width: 100%;border-color: #B8BDC1;
        border-style: solid;
        border-width: thin;
        border-radius: 5px;
        padding: 3px;

    }
</style>
<script type="text/javascript" src="js/wall.js"></script>
<div style="">
    <table width="100%">
        <tr>
            <td width="70%" valign="middle">
                <div class="slider-wrapper">
                    <div id="slider">
                        <?php for($i=0;$i<count($photo_name);$i++) { ?>
                        <div class="slide<?php echo $i; ?>" style="

text-align: center;
">
                            <img  alt="" src="uploads/<?php echo $photo_name[$i]['file']; ?>" style="display: inline-block !important;
height: auto;
image-rendering: optimizeQuality;
max-height: 600px;
max-width: 100%;
vertical-align: middle;
width: auto !important;">
                        </div>
                        <?php } ?>
                    </div>
                    <div id="slider-direction-nav"></div>
                    <div id="slider-control-nav"></div>
                </div>
            </td>
         <td width="30%" valign="top">
                <table width="100%">
                    <tr>
                        <td width="10%"><img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" width="30px;" height="35px;" style="border-radius:4px; "/></td>
                        <td width="90%"><textarea placeholder="Start typing your comment here" class="grybord" id="wallcomment" name="comment" style="width:374px !important;"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><input type="button" class="postbutton-comments" id="<?php echo $_GET['wall_id']; ?>" value="post" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="comment-section" data="<?php echo $wall_id; ?>" id="comment_<?php echo $wall_id; ?>" style="display:block;">
                                <?php //echo '<pre>'; print_r($entry['comments']); ?>
                                <?php
                                foreach ($comments as $comment):
                                    //echo '<pre>';
                                    // print_r($comment);
                                    $cuserdetails = WallModel::getUserDetails($entityManager, $comment['author_id']);
                                ?>
                                    <div class="comment-block">
                                        <div class="comment-img"><img src="uploads/<?php echo $cuserdetails[0]['profile_pic']; ?>" alt="<?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?>" width="50px;" height="45px;" style="border-radius:4px;"></div>
                                        <div class="comment-content">
                                            <b><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></b>
                                            <p><?php echo Functions::addLink($comment['text']) ?></p>
                                            <i><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></i>

                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td> 
        </tr>
        <tr>

        </tr>
    </table>

</div>
<link rel="stylesheet" href="css/sample-styles.css" type="text/css" />
<link rel="stylesheet" href="css/lean-slider.css" type="text/css" />
<script src="js/jquery.min.js"></script>
<script src="js/lean-slider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var slider = $('#slider').leanSlider({
            directionNav: '#slider-direction-nav',
            controlNav: '#slider-control-nav',
            startSlide: <?php echo $postion; ?>,
            pauseTime: 40000
        });
    });
</script>