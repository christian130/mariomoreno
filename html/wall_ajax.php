
<?php foreach ($entries as $entry): ?>
    <!--
        <div class="one-wall-entry">
            <p><i><?php echo date('m/d/Y H:i:s', strtotime($entry['date'])) ?></i></p>
            <p><?php echo $entry['text'] ?></p>
<?php if (strlen($entry['link']) > 0): ?>
                                                    <div class="link_container">
<?php if (strlen($entry['link_photo']) > 0): ?>
                                                                                                <img src="<?php echo $entry['link_photo'] ?>" alt="" />
<?php endif ?>
                                                            <p><a href="<?php echo $entry['link'] ?>"><?php echo $entry['link_title'] ?></a></p>
                                                            <p><?php echo $entry['link_description'] ?></p>
                                                            <div class="clear"></div>
                                                        </div>
<?php endif ?>
                </div>
            -->
            <div class="crispbx"> <img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" width="50px;" height="45px;" style="border-radius:4px; "/>
                <div class="crispcont">
                    <h2><?php echo $entry['firstname'] ?> <?php echo $entry['lastname'] ?></h2>
                    <p class="status-text"><?php echo Functions::addLink($entry['text']) ?></p>
        <?php if (strlen($entry['link']) > 0): ?>
                <div class="link_container">
            <?php if (strlen($entry['link_photo']) > 0): ?>
                    <img src="<?php echo $entry['link_photo'] ?>" alt="" />
            <?php endif ?>
                    <div class="clear"></div>
                    <p><a target="_blank" href="<?php echo $entry['link'] ?>"><?php echo $entry['link_title'] ?></a></p>
                    <p><?php echo $entry['link_description'] ?></p>
                    <div class="clear"></div>
                </div>
        <?php endif ?>

        <?php if (!empty($entry['photos'])): ?>
                        <div class="crispbx">
                            <div class="crispcont">

                                <p><?php echo count($entry['photos']) ?> photos uploaded</p>
                                <div class="upimgwrap">

                                    <div class="big-photo-container">
                                        <a class="fancybox" href="resizer.php?file=<?php echo $entry['photos'][0]['file'] ?>">
                                            <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>.jpg" alt=""  class="upbigimg"/>
                                        </a>
                                    </div>
                                    <div class="upsmimg">
                        <?php foreach ($entry['photos'] as $key => $photo): if ($key == 0)
                                continue; ?>
                            <div class="small-photo-container">
                                <a class="fancybox" href="resizer.php?file=<?php echo $photo['file'] ?>">
                                    <img src="uploads/<?php echo $photo['file'] ?>" alt="" />
                                </a>
                            </div>

       <?php endforeach ?>
                        </div>
                    </div>
                </div>
<?php endif ?>  



                            <div class="likemenu">
                                <ul>
                                    <li><a href="#">Like</a></li>
                                    <li><a class="add-comment-link" rel="<?php echo $entry['id'] ?>" href="#">Comment</a></li>
                                    <li><a href="#">Share</a></li>
                                </ul>
                            </div>
                            <div class="clear"></div>
<?php foreach ($entry['comments'] as $comment): ?>
                                <div class="comment-block">
                                    <img src="images/fbim.jpg" alt="">
                                    <div class="comment-content">
                                        <h2><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></h2>
                                        <i><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></i>
                                        <p><?php echo Functions::addLink($comment['text']) ?></p>
                                    </div>
                                    <div class="clear"></div>
                                </div>
<?php endforeach ?>
                                <div class="add-comment" rel="<?php echo $entry['id'] ?>">
                                    <form rel="<?php echo $entry['id'] ?>" action="" method="post" enctype="multipart/form-data">
                                        </a><textarea placeholder="Start typing your comment here" name="comment-<?php echo $entry['id'] ?>"></textarea>
                                        Photo: <input rel="<?php echo $entry['id'] ?>" type="file" name="photo" />
                                        <input name="post_id" type="hidden" value="<?php echo $entry['id'] ?>" />
                                        <input type="submit" class="postbutton-comments" value="post">
                                    </form>
                                </div>
                            </div>
                        </div>
                    
    <?php endforeach; ?>

