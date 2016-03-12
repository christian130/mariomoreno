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
            }
        }
    }
    $previous_post = WallModel::getPrviousPost($entityManager, $id_wall);
    $comments = CommentsModel::getComments($previous_post[0]['id'], $entityManager);
    $photos = PhotosModel::getPhotos($previous_post[0]['id'], $entityManager);

    $previous_post[0]['comments'] = $comments;
    $previous_post[0]['photos'] = $photos;
    $postids = 0;

    foreach ($previous_post as $entry) {
?>

        <div class="middle_area_four crispbx crispbxmain" id="wall<?php echo $entry['id']; ?>" style="margin-bottom:5px;" data="<?php echo $entry['id']; ?>" data-count="<?php echo $postids; ?>"> 

<div class="slider_two_title">


<img class="image_border_style" src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" style="width:49px;height:49px;"/>

            <div class="slider_title_style2">

<span class="author_slide_top author_upload_name"><?php echo $entry['firstname'] ?> <?php echo $entry['lastname'] ?></span><span></span><p class="update_profile_date">
</p></div>

</div>
<div style="padding:10px;width:100%;">
<p>									
               <?php echo Functions::addLink($entry['text']) ?></p></div>

<?php if (strlen($entry['link']) > 0) { ?>
<div class="display_profile_pic">
<?php if (strlen($entry['link_photo']) > 0): ?>
                            <img src="<?php echo $entry['link_photo'] ?>" alt="" />
        <?php endif ?>
						<div style="padding:10px;">

                    <p><a target="_blank" href="<?php echo $entry['link'] ?>" style="color: #000;font-size: 18pt;line-height: 1.2em;"><?php echo $entry['link_title'] ?></a></p>
               <p style="font-size:12pt;"><?php echo $entry['link_description'] ?></p></div>
                <div class="clear"></div>
            </div>
<?php } ?>

<div style="padding:10px;">

<?php if (!empty($entry['photos'])) { ?>
             <div class="crispbx">
                <div class="crispcont">

                    <p><?php echo count($entry['photos']) ?> photos uploaded</p>
                        <div class="upimgwrap">

                            <div class="big-photo-container">
                                <a class="wall_popup" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $entry['photos'][0]['id']; ?>&postion=0">
                                    <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  class="upbigimg"/>
                                </a>
                            </div>
                            <div class="upsmimg photo-grid-container">
<?php
$postion = 1;
                foreach ($entry['photos'] as $key => $photo) {
                    if ($key == 0)
                        continue;
?>
                        <div class="small-photo-container photo-grid-item">
                            <a class="wall_popup" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $photo['id']; ?>&postion=<?php echo $postion; ?>">
                                <img src="uploads/<?php echo $photo['file'] ?>" alt="" />
                            </a>
                        </div>
<?php $postion++; } ?>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>


</div>

        <div class="like_comment_share">


<a href="#"><span><i class="fa fa-thumbs-up"></i>Like</span></a>

							<a href="#"><span><i class="fa fa-heart"></i>Love it</span></a>
                                                       <a href="#" class="add-comment-link" rel="<?php echo $entry['id'] ?>" ><span><i class="fa fa-commenting"></i>Comment</span></a>
							<a href="#"><span><i class="fa fa-share-square-o"></i>Share</span></a>

            
                </div>
<div class="comment_box" rel="<?php echo $entry['id'] ?>">



   <form rel="<?php echo $entry['id'] ?>" id="commform_<?php echo $entry['id'] ?>" action="" method="post" enctype="multipart/form-data">


							<img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" style="width:37px;height:37px;">
							<span><input class="comment_box_inline grybord" placeholder="Write your comment here" id="wallcomment" name="comment" type="text"></span>
							<div class="comment_box_icon comment_box_inline"><a href="#"><span><i class="comment_box_left fa fa-camera"></i></span></a>
							<a href="#"><span><i class="comment_box_left2 fa fa-smile-o"></i></span></a></div>
							<h5 class="press_enter_post">Press enter to post</h5>
						</div>


<div data="<?php echo $entry['id']; ?>" id="comment_<?php echo $entry['id'] ?>"> 
<?php //echo '<pre>'; print_r($entry['comments']); ?>
                                            <?php
                                                foreach ($entry['comments'] as $comment):
                                                    $cuserdetails = WallModel::getUserDetails($entityManager, $comment['author_id']);
                                                    //echo '<pre>'; print_r($cuserdetails);
                                            ?>
					
<div class="slider_two_title">
								<img src="uploads/<?php echo $cuserdetails[0]['profile_pic']; ?>" alt="<?php echo $comment['1firstname'] ?> <?php echo $comment['1lastname'] ?>" style="width:37px;height:37px;">
								<div class="slider_title_style 1single-comment">
									<a href="#"><span class="author_slide_top"><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></span></a>
									<span class="comment_box_bottom_text"><?php echo Functions::addLink($comment['text']) ?></span>
									<a href="#"><p class="like_and_reply"><span>Like</span><span class="comment_reply">Reply</span> 路 <?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></p></a>									
								</div>
							</div><div class="line"></div>
<?php endforeach ?>
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