<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//namespace Model;
require 'classes/Session.class.php';
//use Entities\Mail;

/**
 * Description of Message
 *
 * @author Marcel
 */
class Invites {

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function checkIfHave($entityManager, $params) {
//        $user = new UserRegister();
        $invite = new Invite();
        $session = new Session();
        $import = $session->getSession('email_import');
        $params2 = array('email' => $params['email']);
        $user = $entityManager->getRepository('UserRegister')->findOneBy($params2);
        if($user instanceof UserRegister){
            $import[$params['email']] = $user->getUser_id();
            $invite->setUserId($session->getSession('userid'));
            $invite->setEmail($params['email']);
            $entityManager->persist($invite);
            $entityManager->flush();
            return '<input class="btn btn-primary"  type="button" value="Send a Friendship Request?" onclick="sendFriendRequest(\'friend_request_send\', '.$user->getUser_id().', \'\')" >';
        }else {
         $import[$params['email']] = $params['email'];   
            return '<input class="btn btn-danger"  type="button" value="Send a Invite ?"  onclick="sendInvite(\'invirw\' ,\''.$params['email'].'\', \''.$params['name'].'\')">';
        }
        $session->setSession('email_import', $import);
        
        
        }


}

?>
