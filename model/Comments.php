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
//print_r($params);
//die();
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
       
        //$entityManager->getConnection()->beginTransaction();
        try {
            /*$statement = $conn->prepare('SELECT * FROM user');
$statement->execute();*/

            $q = $entityManager
            ->getConnection() 


            ->prepare("select wall.id AS id,comments.text AS text,comments.date AS date,comments.author_id AS author_id,sh_users.firstname AS firstname,sh_users.lastname AS lastname from comments 
left join sh_users on sh_users.user_id=comments.author_id
left join wall on wall.id=comments.post_id where comments.post_id=".$post_id." order by comments.date asc");
            $q->execute();
            //$users = $statement->fetchAll();
            $results = $q->fetchAll();

            /*$dql = "SELECT c.text, c.date, c.author_id, u.firstname, u.lastname
                FROM Wall w,Comments c,UserRegister u
                WHERE u.user_id=w.author_id and w.id=c.post_id and c.post_id =:post order by c.date asc"; */               
            /*$query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'post' => $post_id
            ));*/
             return $results;
        } catch (Exception $e) {
            $q->getConnection()->rollback();
            $q->close();
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
