<?php

require_once "bootstrap.php";

class WallModel {

    public static function addWallEntry($entityManager, $params) {
        $entry = new Wall();
        $entry->setAuthorId($params['author_id']);
        $entry->setOwnerId($params['owner_id']);
        $entry->setText($params['text']);

        $entry->setLink($params['link']);
        $entry->setLinkDescription($params['link_description']);
        $entry->setLinkPhoto($params['link_photo']);
        $entry->setLinkTitle($params['link_title']);
        $entry->setDate($params['date']);

        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($entry);
            $entityManager->flush();
            $entityManager->getConnection()->commit();
            return $entry->getId();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }
    public static function getPhotoAlbum($entityManager, $wall_id){
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->getConnection()->executeQuery('select file,id from photos where wall_id='.$wall_id);
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    public static function getEntries($entityManager, $user_id=false) {
        if (!$user_id) {
            $user_id = $_SESSION['userid'];
        }
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->getConnection()->executeQuery('SELECT distinct(w.id),w.text,w.link,w.link_title,w.link_description,w.link_photo,w.date,w.author_id as user_id FROM friends f
                                                                    RIGHT JOIN wall as w on w.author_id = f.id_owner or w.author_id=f.id_friend
                                                                    WHERE f.id_friend=' . $user_id . ' OR f.id_owner=' . $user_id . ' OR w.author_id=' . $user_id . ' order by w.date desc');
            $result = $query->fetchAll();
           /* $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'owner' => $user_id
            ));
            * */
            return $result;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    
    public static function getTweetsEntries($entityManager, $user_id=false,$curTime) {
        if (!$user_id) {
            $user_id = $_SESSION['userid'];
        }
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->getConnection()->executeQuery('SELECT distinct(w.id),w.text,w.link,w.link_title,w.link_description,w.link_photo,w.date,w.author_id as user_id FROM friends f
                                                                    RIGHT JOIN wall as w on w.author_id = f.id_owner or w.author_id=f.id_friend
                                                                    WHERE (f.id_friend=' . $user_id . ' OR f.id_owner=' . $user_id . ' OR w.author_id=' . $user_id . ') and  w.date >"'.$curTime.'"');
            $result = $query->fetchAll();
           /* $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'owner' => $user_id
            ));
            * */
            return $result;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    
    public static function getUserWall($entityManager,$data){
          $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT w.id,w.text,w.link,w.link_title,w.link_description,w.link_photo,w.date,u.firstname, u.lastname,w.author_id as user_id FROM Wall w join UserRegister u WHERE u.user_id=w.author_id and u.user_id =:owner order by w.date desc";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'owner' => $data['userid']
            ));
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
        
    }
    public static function getInfiniteWall($entityManager,$limit1, $limit2) {
        if (!$user_id) {
            $user_id = $_SESSION['userid'];
        }

         if (!$user_id) {
            $user_id = $_SESSION['userid'];
        }
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->getConnection()->executeQuery('SELECT distinct(w.id),w.text,w.link,w.link_title,w.link_description,w.link_photo,w.date,w.author_id as user_id FROM friends f
                                                                    INNER JOIN wall as w on w.author_id = f.id_owner or w.author_id=f.id_friend
                                                                    WHERE f.id_friend=' . $user_id . ' OR f.id_owner=' . $user_id . ' order by w.date desc LIMIT '.$limit1.','.$limit2);
            $result = $query->fetchAll();
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'owner' => $user_id
            ));
            return $result;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    public static function getUserDetails($entityManager, $user_id){
          $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->getConnection()->executeQuery('select profile_pic,firstname,lastname from sh_users where user_id='.$user_id);
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    public static function getPrviousPost($entityManager, $post_id) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT w.id,w.text,w.link,w.link_title,w.link_description,w.link_photo,w.date,u.firstname, u.lastname FROM Wall w inner join UserRegister u WHERE  u.user_id=w.author_id and w.id =:wall order by w.date desc";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'wall' => $post_id
            ));
//            echo '<pre>';
//            print_r($query->getArrayResult()); die();
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
	public static function getLatestPost($entityManager, $post_id) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT w.id,w.text,w.link,w.link_title,w.link_description,w.link_photo,w.date,u.firstname, u.lastname FROM Wall w inner join UserRegister u WHERE  u.user_id=w.author_id and w.id >:wall order by w.date desc";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'wall' => $post_id
            ));
//            echo '<pre>';
//            print_r($query->getArrayResult()); die();
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }

}
