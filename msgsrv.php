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
    $id_wall = $_GET['post_id'];
    //if($id_wall !=""){
    $previous_post = WallModel::getLatestPost($entityManager, $id_wall);
    $comments = CommentsModel::getComments($previous_post[0]['id'], $entityManager);
    $photos = PhotosModel::getPhotos($previous_post[0]['id'], $entityManager);

    $previous_post[0]['comments'] = $comments;
    $previous_post[0]['photos'] = $photos;
    $postids = 0;
    foreach ($previous_post as $entry) {
?>

        <div class="crispbx crispbxmain" id="wall<?php echo $entry['id']; ?>" data="<?php echo $entry['id']; ?>" data-count="<?php echo $postids; ?>"> <img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" width="40px;" height="40px;" style="border-radius:px;padding:5px; "/>
            <div class="crispcont">
                <h2><?php echo $entry['firstname'] ?> <?php echo $entry['lastname'] ?></h2>
                <p class="status-text"><?php echo Functions::addLink($entry['text']) ?></p>
<?php if (strlen($entry['link']) > 0) { ?>
                    <div class="link_container">
<?php if (strlen($entry['link_photo']) > 0): ?>
                            <img src="<?php echo $entry['link_photo'] ?>" alt="" />
        <?php endif ?>
                    <div class="clear"></div>
                    <p><a target="_blank" href="<?php echo $entry['link'] ?>"><?php echo $entry['link_title'] ?></a></p>
                <p><?php echo $entry['link_description'] ?></p>
                <div class="clear"></div>
            </div>
<?php } ?>

<?php if (!empty($entry['photos'])) { ?>
            <div class="crispbx">
                <div class="crispcont1">

                    <p><?php echo count($entry['photos']) ?> photos uploaded</p>
					<?php if(count($entry['photos']) > 1) { ?>
                        <div class="upimgwrap">

                            <div class="big-photo-container"><div class="bigimgg">
                                <a class="fancybox" href="resizer.php?file=<?php echo $entry['photos'][0]['file'] ?>">
                                    <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  />
</div>
                                </a>
                            </div>
                            <div class="upsmimg">
<?php
                foreach ($entry['photos'] as $key => $photo) {
                    if ($key == 0)
                        continue;
?>
                        <div class="small-photo-container">
                            <a class="fancybox" href="resizer.php?file=<?php echo $photo['file'] ?>">
                                <img src="uploads/<?php echo $photo['file'] ?>" alt="" />
                            </a>
                        </div>
<?php } ?>
                    </div>
                </div>
				<?php } else { ?>
                                                  <div class="upimgwrap1">

                                                    <div class="big-photo-container1">
                                                        <a class="wall_popup" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $entry['photos'][0]['id']; ?>&postion=0">
                                                            <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  />
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php } ?>
            </div>
        </div>
<?php } ?>

        <div class="likemenu">
            <ul>
                <li><a href="#">Like</a></li>
                <li><a class="add-comment-link" rel="<?php echo $entry['id'] ?>" href="#">Comment</a></li>
                        <li><a href="#">Share</a></li>
                    </ul>
                </div>
</div>




                 <div class="clear"></div>
                <div class="commentmain" >

                   <div class="comment-section" data="<?php echo $entry['id']; ?>" id="comment_<?php echo $entry['id'] ?>" style="display:none;">
            <?php //echo '<pre>'; print_r($entry['comments']); ?>
            <?php
                    foreach ($entry['comments'] as $comment):
                        $cuserdetails = WallModel::getUserDetails($entityManager, $comment['author_id']);
                        //echo '<pre>'; print_r($cuserdetails);
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

                                  <p style="color:#fff;"><b style="color:#ffa96e;"><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></b>&nbsp;
                                                          <?php echo Functions::addLink($comment['text']) ?></br>
                                                            <span style="color:#ccc !important;"><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></span></p>
                                                        </div></td> </tr></table>
                                                        <div class="clear"></div>
                                                </div>
<?php endforeach ?>
                                            </div>






                    <div class="add-comment" rel="<?php echo $entry['id'] ?>">
                        <form rel="<?php echo $entry['id'] ?>" id="commform_<?php echo $entry['id'] ?>" action="" method="post" enctype="multipart/form-data">
                            <table width="100%">
                                <tr>
                                    <td width="10%"><img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" width="32px;" height="32px;" style="border-radius:px;margin-left:5px;/></td>
                                    <td width="90%"><textarea placeholder="Start typing your comment here" class="grybord" id="wallcomment" name="comment" style="width:88% !important;"></textarea></td>
                                </tr>
                            </table>
                           <div style="float: right;
margin-top: -22px;
position: relative;
margin-right: 15px;">
                                                     <i class="fa fa-camera fa-lg" style="float: right;color:#999999;
cursor: pointer;"></i>
                                                    <input for="file-input" rel="<?php echo $entry['id'] ?>" type="file" name="photo" style="opacity: 0;
float: right;   filter: alpha(opacity=0);margin-right: -18px;margin-top: -5px;width: 23px;"/> </div>
                                                    <input name="post_id" type="hidden" value="<?php echo $entry['id'] ?>" />
                                                  <!--  <input type="button" class="postbutton-comments" id="<?php echo $entry['id'] ?>" value="post" />-->
                        </form>
                    </div>

            </div>
        </div>

<?php
                $postids++;
            } ?>
<?php
            die();

        } else {
            header("Location:index.php");
        }
?>
