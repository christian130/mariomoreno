<?php
require_once "bootstrap.php";

class AnotherCommentsModel {
     public static function addComment01($entityManager,$params) {
        $entry = new Comments();
        $entry->setAuthorId($params['author_id']);
        $entry->setPostId($params['post_id']);
        $entry->setText($params['text']);
        $entry->setDate($params['date']);
	$entityManager->persist($entry);
	$entityManager->flush();
    }
    }
    ?>
	