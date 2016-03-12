<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Session.class.php';
/**
 * Description of Session
 *
 * @author sathish
 */
class SearchUtil{

    
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $term
     */
    public static function search($entityManager,$term){
        
        $q = $entityManager->getConnection()->executeQuery("select user_id,firstname,lastname,profile_pic from sh_users u where u.firstname like '%".$term."%' or u.lastname like '%".$term."%' limit 10");        
        $results = $q->fetchAll();
        
//        $item = new UserRegister();
        $div = '';        
        if(count($results)>0){
        foreach ($results as $item){
            $div .= '<li><a href="profile.php?profileid='.base64_encode($item['user_id']).'"><img src="uploads/'.$item['profile_pic'].'" title="'.ucfirst($item['firstname']).' '. ucfirst($item['lastname']).'">'.ucfirst($item['firstname']).' '. ucfirst($item['lastname']).'</a></li>';
        }
        $div .=          ' <li><a>See All results</a></li>';
        }else $div .=          ' <li><a>No results</a></li>';
            
        return $div;    
    }

    
    
}
?>