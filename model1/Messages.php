<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//namespace Model;
//require 'bootstrap.php';
//use Entities\Mail;

/**
 * Description of Message
 *
 * @author Marcel
 */
class Messages {

    //put your code here
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $sh_user_receiver
     */
    public static function getMessageNum($entityManager, $sh_user_receiver) {
        $receiver = $sh_user_receiver > 0 ? $sh_user_receiver : 0;
        $query = $entityManager->getConnection()->executeQuery('SELECT count( `receiver` ) as count
FROM `messages`
WHERE `receiver` = ' . $receiver . '
AND readed =0');
        $result = $query->fetchAll();
        $result = $result[0]['count'];
        return $result;
    }

    public static function getMessages($entityManager, $sh_user_receiver) {
        $entityManager->beginTransaction();

        $receiver = $sh_user_receiver > 0 ? $sh_user_receiver : 0;
        $query = $entityManager->getConnection()->executeQuery('SELECT id, firstname, sh_users.profile_pic, messages.message
FROM sh_users, messages
WHERE sh_users.user_id = messages.sender
AND messages.receiver =43
ORDER BY data ASC
LIMIT 0 , 30');
        $result = $query->fetchAll();
        if (count($result) != 0) {
            $i = 0;
            $var = '';
            foreach ($result as $item) {
                $bg = $i % 2 == 0 ? " nobg" : "";
                $var .= "<div class=\"messageswrap" . $bg . "\">
                    <img src=\"uploads/" . $item['profile_pic'] . "\" alt=\"\" class=\"dimg sender\" />            
                    <h3>" . $item['firstname'] . " says:</h3>    
                    <h3>" . $item['message'] . "</h3>                    
                    </div>";
                ;
                $i++;
            }
            $var.='<h5>See all</h5>';
            return $var;
        } else {
            return 'No Messages!';
        }
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $sh_user_receiver
     */
    public static function sendMessage($entityManager, $sh_user_sender, $sh_user_receiver) {
//require_once "entities/Mail.php";
        $message = new mail();
//        $message->setIdUserCReciver(48);
//        $message->setIdUserSender(43);
        $message->setMessage('Uuh!!!!');
        $entityManager->beginTransaction();
        $entityManager->persist($message);
        $entityManager->flush();
    }

}

?>
