<?php
require_once "../model/newComments.php";
$params02= Array(
"author_id"=>$_POST["author_id"],
"post_id"=>$_POST["post_id"],
"text"=>$_POST["text"],
"date"=>$_POST["date"]
);
AnotherCommentsModel::addComment01($entityManager);
//author_id: <?=$entry['user_id'];  post_id: <?=$entry['id'];text:jQuery("#comminput_<?=$entry['id'] ").val(),date:curDateTime01
?>