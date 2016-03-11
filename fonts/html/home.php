<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" href="css/wall.css" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="js/wall.js"></script>
        <link href='css/nprogress.css' rel='stylesheet' />
        <script type="text/javascript" src='js/nprogress.js'></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script type="text/javascript">
            function submitForm() {
                console.log("submit event");
                var fd = new FormData(document.getElementById("upload_photos"));
                fd.append("label", "WEBUPLOAD");
                $.ajax({
                    url: "wdd_ajaxupload.php",
                    type: "POST",
                    data: fd,
                    enctype: 'multipart/form-data',
                    processData: false,  // tell jQuery not to process the data
                    contentType: false   // tell jQuery not to set contentType
                }).done(function( data ) {
                    $(".wallEntries").prepend(data);
                    $(".one-photo").remove();
                    // console.log("PHP Output:");
                    // $( ".one-photo" ).empty();
                    console.log( data );
                });
                return false;
            }
        </script>
         <script type="text/javascript">
//                $(document).ready(function() {
//                    $('.fancybox').fancybox();
//
//                    $(".fancybox-effects-a").fancybox({
//                        padding: 0,
//                        closeClick : true,
//
//                        helpers : {
//                            overlay : null
//                        }
//                    });
//                       $(".fancybox-skin").easydrag();
//                });
            </script>
			<style>
			.peopwrap img{
			
			width:50px;
			height:45px;
			}
			</style>
    </head>
    <?php
    $session = new Session();
    if ($session->getSession('userid') != null) {
    ?>
        <script type="text/javascript" src="js/updater.js"></script>
		 <script type="text/javascript" src="js/updater_remove.js"></script>
    <?php
    }
    ?>
    <body  class="nobg">
        <div class="main_content">
            <script type="text/javascript">
                var ajaxUrl = 'wall.php';
            </script>
            <?php include 'header.php'; ?>
            <div class="midwht">
                <div class="homlft">
                    <?php include 'profilepic.php'; ?>
                </div>
                <div class="hommid">
                    <?php include 'socialmenu.php'; ?>
                    <form action="wdd_ajaxupload.php" id="upload_photos" method="post" onsubmit="return submitForm();">
                        <textarea name="status" class="grybord">Whats in your head?</textarea>
                        <div id="link_info"></div>
                        <div class="clear"></div>
                        <div id="picture">
                            <h3>Use the form below to add photos.</h3>
                            <div class="one-photo">
                                <input class="fileUpload" type="file" name="photo_0" />
                                <div class="removePhoto">remove</div>
                                <div class="preview"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="dgry">
                            <div class="picon"><a href="#"> <img src="images/photoicon.png" alt="" /></a> </div>
                            <input type="submit" class="postbutton" value="post" />
                        </div>
                    </form>

                    <div class="bluebg">Twitter</div>
                    <div class="tabgray">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr valign="middle">
                                <td class="homtit" width="55" height="25">Home</td>
                                <td class="homtit" width="40">52587 Twitter</td>
                                <td class="homtit" width="62">1125 Following</td>
                                <td class="homtit" width="62">525 Followers</td>
                                <td class="homtit" width="52">Favorites</td>
                                <td class="homtit" width="52">Mentions</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                    <div class="postbg">6 new posts</div>
                    <div class="peoplebx">
                        <!--div class="jessicatxt">Jessica is now friends with Karla M. and 7 other people</div-->
                        <!--div class="peopwrap"> <a href="#"><img src="images/fim1.jpg" alt="" /> <img src="images/fim2.jpg" alt="" /> <img src="images/fim3.jpg" alt="" /> <img src="images/fim4.jpg" alt="" /> <img src="images/fim5.jpg" alt="" /> <img src="images/fim6.jpg" alt="" /> <img src="images/fim7.jpg" alt="" /> <img src="images/fim8.jpg" alt="" /></a> </div-->
                    </div>
                    <div id="postedComments" style="display:none;"></div>


                    <div class="wallEntries">

                        <?php
                        $postids = 0;
//echo '<pre>';
//print_r($entries);
                        foreach ($entries as $entry) {
                            //echo $entry['id'];
                            $userdetails = WallModel::getUserDetails($entityManager, $entry['user_id']);
                        ?>

                            <div class="crispbx crispbxmain" id="wall<?php echo $entry['id']; ?>" data="<?php echo $entry['id']; ?>" data-count="<?php echo $postids; ?>">
                                <img src="uploads/<?php echo $userdetails[0]['profile_pic']; ?>" alt="" width="50px;" height="45px;" style="border-radius:4px; "/>
                                <div class="crispcont">
                                    <h2><?php echo $userdetails[0]['firstname'] ?> <?php echo $userdetails[0]['lastname'] ?></h2>
                                    <p class="status-text"><?php echo Functions::addLink($entry['text']) ?></p>
                                <?php if (strlen($entry['link']) > 0) {
                                ?>
                                    <div class="link_container">
                                    <?php if (strlen($entry['link_photo']) > 0): ?>
                                        <img src="<?php echo $entry['link_photo'] ?>" alt=""/>
                                    <?php endif ?>
                                        <div class="clear"></div>
                                        <p><a target="_blank" href="<?php echo $entry['link'] ?>"><?php echo $entry['link_title'] ?></a></p>
                                        <p><?php echo $entry['link_description'] ?></p>
                                        <div class="clear"></div>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($entry['photos'])) {
 ?>
                                        <div class="crispbx">
                                            <div class="crispcont">

                                                <p><?php echo count($entry['photos']) ?> photos uploaded</p>
                                                <div class="upimgwrap">

                                                    <div class="big-photo-container">
                                                        <a class="fancybox fancybox.ajax" href="resizer.php?file=<?php echo $entry['photos'][0]['file'] ?>&id=<?php echo $entry['id']; ?>">
                                                            <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  class="upbigimg"/>
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
                                            <div class="clear"></div>
                                            <div class="comment-section" data="<?php echo $entry['id']; ?>" id="comment_<?php echo $entry['id'] ?>" style="display:none;">
                                    <?php //echo '<pre>'; print_r($entry['comments']); ?>
                                    <?php
                                            foreach ($entry['comments'] as $comment):
                                                $cuserdetails = WallModel::getUserDetails($entityManager, $comment['author_id']);
                                                //echo '<pre>'; print_r($cuserdetails);
                                    ?>
                                                <div class="comment-block">
                                                    <img src="uploads/<?php echo $cuserdetails[0]['profile_pic']; ?>" alt="<?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?>" width="50px;" height="45px;" style="border-radius:4px;">
                                                        <div class="comment-content">
                                                            <h2><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></h2>
                                                            <p><?php echo Functions::addLink($comment['text']) ?></p>
                                                            <i><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></i>

                                                        </div>
                                                        <div class="clear"></div>
                                                </div>
<?php endforeach ?>
                                            </div>
                                            <div class="add-comment" rel="<?php echo $entry['id'] ?>">
                                                <form rel="<?php echo $entry['id'] ?>" id="commform_<?php echo $entry['id'] ?>" action="" method="post" enctype="multipart/form-data">
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="10%"><img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" width="40px;" height="35px;" style="border-radius:4px; "/></td>
                                                            <td width="90%"><textarea placeholder="Start typing your comment here" class="grybord" id="wallcomment" name="comment"></textarea></td>
                                                        </tr>
                                                    </table>
                                                    Photo: <input rel="<?php echo $entry['id'] ?>" type="file" name="photo" />
                                                    <input name="post_id" type="hidden" value="<?php echo $entry['id'] ?>" />
                                                    <input type="button" class="postbutton-comments" id="<?php echo $entry['id'] ?>" value="post" />
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                        <?php
                                                $postids++;
                                            }
                        ?>

                                            <div id="loadorders"></div>
                                            <div id="loadMoreComments" style="display:none;" ></div>
                                                                                                  <!--<iframe id="wall-iframe" scrolling="no" frameborder="0" src="wall-itself.php"></iframe>-->
                                        </div>



                                    </div>
                                    <!--<div class="friendright">
                                        <h3>Friends</h3>
                                        <div class="friendwrap">
                                            <a href="#"><img src="images/frnd1.jpg" alt="" />
                                                <img src="images/frnd2.jpg" alt="" />
                                                <img src="images/frnd3.jpg" alt="" />
                                                <img src="images/frnd4.jpg" alt="" />
                                                <img src="images/frnd5.jpg" alt="" />
                                                <img src="images/frnd6.jpg" alt="" />
                                                <img src="images/frnd7.jpg" alt="" />
                                                <img src="images/frnd8.jpg" alt="" /></a>
                                        </div>
                                    </div>-->
                                    <div class="friendright">
                        <?php $result = $messages->getFriends($entityManager, $session->getSession("userid"), 8); ?>
                                        <a href="friend_list.php" ><h3 class="">Friends(<font class="totalfriends"><?php echo $messages->getNumber(true); ?></font>)</h3></a>
                                        <div class="friendwrap">
<?php echo $result; ?>
                                        </div>
                                    </div>
                                    <div class="logfoot">
                                        <div class="fmenu">
                                            <ul>
                                                <li><a href="#">About</a></li>
                                                <li><a href="#">Help</a></li>
                                                <li><a href="#">Blog</a></li>
                                                <li><a href="#">Status</a></li>
                                                <li><a href="#">Terms</a></li>
                                                <li><a href="#">Privacy</a></li>
                                                <li><a href="#">Advertisers</a></li>
                                                <li><a href="#">Businesses</a></li>
                                                <li><a href="#">Directory</a></li>
                                            </ul>
                                        </div>
                                        <span class="toimg"><img src="images/tobg.png" alt="" /></span>
                                        <p>Copyright 2013 whatsdadilly. All Rights Reserved.</p>
                                    </div>
                                    <p id="back-top">
                                        <a href="#top"><span></span>Back to Top</a>
<style>
#close_notific img{
height: 20px;
width: 20px;
position: absolute;
right: 1px;
top: 1px;
}
</style> </p>
		
								
									
                                </div>
                        </body>
                    </html>
					
					
                    <script>
<?php if ($_GET['msg'] == 'success') { ?>
                        alert("Account added successfully!!!");
                        opener.location.reload();
                        window.close();
                        $('body').show();
                        $('.version').text(NProgress.version);
                        NProgress.start();
                        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
<?php } else if ($_GET['msg'] == 'error') { ?>
                        alert("Oops Already acount availablle!!!");
                        opener.location.reload();
                        window.close();
                        $('body').show();
                        $('.version').text(NProgress.version);
                        NProgress.start();
                        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
<?php } ?>
</script>
<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

</script>
<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

</script>