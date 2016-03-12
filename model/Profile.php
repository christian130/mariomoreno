<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";

class Profile {

    protected $res;

    //put yor code here
    public function __construct() {
        
    }

    static public function getCitiesForBasic($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT l FROM Location l WHERE l.city LIKE :search";
            $query = $entityManager->createQuery($dql);
            $query->setMaxResults(10);
            $query->setParameter('search', $data['text'] . '%');
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }
    static public function setUserActivity($data, $entityManager){
        $lastLogin = new LastLogin();
        $lastLogin->setIPAddress($data['ipaddress']);
        $lastLogin->setLoginDate($data['login_date']);
        $lastLogin->setUserId($data['user_id']);
        $lastLogin->setDevice($data['device']);
        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($lastLogin);
            $entityManager->flush();
            $entityManager->getConnection()->commit();
            return $lastLogin->getLoginId();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

}
?>