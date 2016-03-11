<?php

require_once "bootstrap.php";

class PhotosModel {
     public function __construct() {

    }
    
     public static function addPhoto($entityManager,$params) {
        $entry = new Photos();
        $entry->setWallId($params['wall_id']);
        $entry->setFile($params['file']);
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
    
    public static function getPhotos($post_id,$entityManager)
    {
       
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT p
                FROM Wall w,Photos p
                WHERE w.id=p.wall_id and  p.wall_id =:post order by p.date desc";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'post' => $post_id
            ));
          //  echo '<pre>';
          // print_r($query->getArrayResult());
             return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }
    
}