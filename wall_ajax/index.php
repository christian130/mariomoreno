<?php
require_once("../model/newComments.php");
//var_dump($_SERVER['DOCUMENT_ROOT']."betaPhase/model/newComments.php");
//var_dump(getcwd());
//die();
$params02= Array(
"author_id"=>$_POST["author_id"],
"post_id"=>$_POST["post_id"],
"text"=>$_POST["text"],
"date"=>$_POST["date"]
);
AnotherCommentsModel::addComment01($entityManager,$params02);

echo '<div class="slider_two_title">
                                <img style="width:37px;height:37px;" alt=" " src="uploads/'.$_POST["anotherData"].'">
                                <div class="slider_title_style 1single-comment">
                                    <a href="#"><span class="author_slide_top">'.$_POST["firstName01"].'  '.$_POST["lastName01"].'</span></a>
                                    <span class="comment_box_bottom_text"> '.$_POST['text'].'</span>
                                    <a href="#"><p class="like_and_reply"><span>Like</span><span class="comment_reply">Reply</span> 路 '.$_POST["date"].'</p></a>                                    
                                </div>
                            </div>';
//author_id: <?=$entry['user_id'];  post_id: <?=$entry['id'];text:jQuery("#comminput_<?=$entry['id'] ").val(),date:curDateTime01
?>