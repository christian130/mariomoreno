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
//$dateTime = '2016-03-03 14:28:31';
$dateTime = $_REQUEST['curTime'];
$differSecTime = $_REQUEST['differSec'];

$dateinsec=strtotime($dateTime);
$newdate=$dateinsec+$differSecTime;
$finalTime =  date('Y-m-d H:i:s',$newdate);

 
$entries = WallModel::getTweetsEntries($entityManager,$session->getSession("userid"),$finalTime);

foreach ($entries as $key => $value) {
        $comments = CommentsModel::getComments($entries[$key]['id'], $entityManager);
        $photos = PhotosModel::getPhotos($entries[$key]['id'], $entityManager);

        $entries[$key]['comments'] = $comments;
        $entries[$key]['photos'] = $photos;
    }
$dataMain = array('total'=>4);
//echo json_encode($dataMain);

                                        $postids = 0;

                                        foreach ($entries as $entry) {
                                            //echo $entry['id'];
                                          //  print('<pre>');
                                         //   print_r($entry);
                                            $userdetails = WallModel::getUserDetails($entityManager, $entry['user_id']);
?>




          
          
         						<div class="middle_area_four crispbx  notshow crispbxmain" style="margin-bottom:5px;" id="wall<?php echo $entry['id']; ?>" data="<?php echo $entry['id']; ?>" data-count="<?php echo $postids; ?>">
						<div class="slider_two_title">

							<img class="image_border_style" src="uploads/<?php echo $userdetails[0]['profile_pic']; ?>"  alt="" style="width:49px;height:49px;">

<div class="slider_title_style2">

<span class="author_slide_top author_upload_name"><?php echo $userdetails[0]['firstname'] ?> <?php echo $userdetails[0]['lastname'] ?> </span><span></span><p class="update_profile_date">
</p></div>														
						</div>
<div style="padding:10px;width:100%;">
<p><?php echo Functions::addLink($entry['text']) ?></p></div>

<?php if (strlen($entry['link']) > 0) { ?>
						<div class="display_profile_pic">
<?php if (strlen($entry['link_photo']) > 0): ?>
                                                            <img src="<?php echo $entry['link_photo'] ?>" alt=""/>
<?php endif ?>
						<div style="padding:10px;">
 <p><a target="_blank" href="<?php echo $entry['link'] ?>" style="color: #000;font-size: 18pt;line-height: 1.2em;"><?php echo $entry['link_title'] ?></a></p>
                                                            <p style="font-size:12pt;"><?php echo $entry['link_description'] ?></p></div>





	
						</div>
 <?php } ?>














<div style="padding:10px;">
 <?php if (!empty($entry['photos'])) {
                                        ?>
                                                <div class="crispbx">
                                                    <div class="crispcont1">
                                                        <p><?php echo count($entry['photos']) ?> photos uploaded</p>
                                                <?php if (count($entry['photos']) > 1) {
                                                ?>
                                                    <div class="upimgwrap ">

                                                        <div class="big-photo-container ">
                                                            <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $entry['photos'][0]['id']; ?>&postion=0">
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
                                                                <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $photo['id']; ?>&postion=<?php echo $postion; ?>">
                                                                    <img src="uploads/<?php echo $photo['file'] ?>" alt="" />
                                                                </a>
                                                            </div>
                                                        <?php $postion++;
                                                        } ?>
                                                    </div>
                                                </div>
                                                <?php } else {
                                                ?>
                                                        <div class="upimgwrap1">

                                                            <div class="big-photo-container1">
                                                                <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $entry['photos'][0]['id']; ?>&postion=0">
                                                                    <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  class="upbigimg"/>
                                                                </a>
                                                            </div>
                                                        </div>
                                                <?php } ?>
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


							<img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" style="width:37px;height:37px;" >
							<span><input class="comment_box_inline" placeholder="Write your comment here" type="text"></span>
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
                                                            }
                                                            ?>
