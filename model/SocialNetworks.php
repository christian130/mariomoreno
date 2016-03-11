<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SocialNetworks
 *
 * @author admin
 */
require_once "bootstrap.php";

class SocialNetworks {

    public function __construct() {
        
    }

     static public function getSocialAccount($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT a FROM AddToken a WHERE a.user_id = ?1 and a.networkname = ?2";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data['userid']);
            $query->setParameter(2, $data['networkname']);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }
    
}
?>
