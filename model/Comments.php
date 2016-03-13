<?php

require_once "bootstrap.php";

class CommentsModel {
    
     public static function addComment($entityManager,$params) {
        $entry = new Comments();
        $entry->setAuthorId($params['author_id']);
        $entry->setPostId($params['post_id']);
        $entry->setText($params['text']);
        $entry->setDate($params['date']);
		//echo '<pre>';
print_r($params);
die();
        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($entry);
            $entityManager->flush();
            $last_id = $entityManager->getConnection()->commit();
            return $entry->getId();
            
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }
	
    public static function getLastComments($entityManager,$post_id)
    {

        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT c.text, c.date, c.author_id
                FROM Comments c
                WHERE c.id =:post order by c.date desc";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'post' => $post_id
            ));
             return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    public static function getComments($post_id,$entityManager)
    {
       
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT c.text, c.date, c.author_id, u.firstname, u.lastname
                FROM Wall w,Comments c,UserRegister u
                WHERE u.user_id=w.author_id and w.id=c.post_id and c.post_id =:post order by c.date asc";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'post' => $post_id
            ));
             return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
	    public static function getLastcommentID($user_id, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {

            $query = $entityManager->getConnection()->executeQuery('SELECT * FROM wall as w
                    inner JOIN comments as c on c.post_id=w.id
                    where w.author_id=' . $user_id . ' ORDER BY c.id DESC Limit 0,1');
            $result = $query->fetch();
            return $result;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    public static function checkNewComment($data,$entityManager){
        $entityManager->getConnection()->beginTransaction();
        $user_id = $_SESSION['userid'];
        $last_cmtid = $data['last_cmtid'];
     
        try {

            $query = $entityManager->getConnection()->executeQuery('SELECT * FROM wall as w
                    inner JOIN comments as c on c.post_id=w.id
                    where w.author_id=' . $user_id . ' and c.id > '.$last_cmtid.' ORDER BY c.id DESC');
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }

    }
    
}