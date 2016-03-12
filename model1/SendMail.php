<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendMail
 *
 * @author admin
 */
class SendMail {

    //put your code here

    public function __construct() {

    }

    static public function sendRegisterationMail($mail, $activation, $fname, $lname) {
        $to = $mail;
        $subject = "Registeration";

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">';
        $message .= '<tr><td><a href="www.whatsdadilly.com"><img src="./images/emailhead.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; color:#101010; font-size:16px;">Dear ' . $fname . ' ' . $lname . '</td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"></td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#101010; font-size:14px; line-height:22px;"><em>Regards</em> <br />whatdadily </td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2013 whatdadily. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        $headers .= 'From: <webmaster@whatsdadilly.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_user
     * @param type $id_friend
     */
    static public function sendPhotoComment($entityManager,$id_user,$id_friend,$params) {
        $Owner = new UserRegister();
        $Owner = $entityManager->getRepository('UserRegister')->find($id_user);
        $Friend = $entityManager->getRepository('UserRegister')->find($id_friend);
        
        
        $to = $Friend->getEmail();
        $subject = "Comment on you photo";

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">';
        $message .= '<tr><td><a href="www.whatsdadilly.com"><img src="./images/emailhead.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; color:#101010; font-size:16px;">Dear ' . ucfirst($Friend->getFirstName()) . ' ' . ucfirst($Friend->getLastName()) . '</td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"><img src="./uploads/'.$Owner->getProfilePic().'" alt="' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . '" style="width:60px;height:60px;"/>' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . ' comment - "'.$params['comment'].'" on your <a href="www.whatsdadilly.com/photo_detail.php?id='.$params['id'].'">photo</a>.</td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#101010; font-size:14px; line-height:22px;"><em>Regards</em> <br />whatdadily </td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2013 whatdadily. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

//        echo $message;
        $headers .= 'From: <webmaster@whatsdadilly.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
    
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_user
     * @param type $id_friend
     */
    static public function sendFriendshipAccept($entityManager,$id_user,$id_friend) {
        $Owner = new UserRegister();
        $Owner = $entityManager->getRepository('UserRegister')->find($id_user);
        $Friend = $entityManager->getRepository('UserRegister')->find($id_friend);
        
        
        $to = $Owner->getEmail();
        $subject = "Friendship Accepted";

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">';
        $message .= '<tr><td><a href="www.whatsdadilly.com"><img src="./images/emailhead.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; color:#101010; font-size:16px;">Dear ' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . '</td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"><img src="./uploads/'.$Friend->getProfilePic().'" alt="' . ucfirst($Friend->getFirstName()) . ' ' . ucfirst($Friend->getLastName()) . '" style="width:60px;height:60px;"/>' . ucfirst($Friend->getFirstName()) . ' ' . ucfirst($Friend->getLastName()) . ' accepted to be you friend.</td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#101010; font-size:14px; line-height:22px;"><em>Regards</em> <br />whatdadily </td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2013 whatdadily. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

//        echo $message;
        $headers .= 'From: <webmaster@whatsdadilly.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
    
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_user
     * @param type $id_friend
     */
    static public function sendFriendshipRequest($entityManager,$id_user,$id_friend) {
        $Owner = new UserRegister();
        $Owner = $entityManager->getRepository('UserRegister')->find($id_user);
        $Friend = $entityManager->getRepository('UserRegister')->find($id_friend);
        
        
        $to = $Friend->getEmail();
        $subject = "Friendship Request";

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">';
        $message .= '<tr><td><a href="www.whatsdadilly.com"><img src="./images/emailhead.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; color:#101010; font-size:16px;">Dear ' . ucfirst($Friend->getFirstName()) . ' ' . ucfirst($Friend->getLastName()) . '</td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"><img src="./uploads/'.$Owner->getProfilePic().'" alt="' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . '" style="width:60px;height:60px;"/>' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . ' wants to be you friend.</td></tr>';
//        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;">Click on the link to confirm your request <a href="'. $_SERVER["SERVER_NAME"].'/friends.php?token'.$User->getActivation().'&fd='.  base64_encode($id_friend).'&ow='.  base64_encode($id_user).'">Confirm friendship</a></td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#101010; font-size:14px; line-height:22px;"><em>Regards</em> <br />whatdadily </td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2013 whatdadily. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        echo $message;
        $headers .= 'From: <webmaster@whatsdadilly.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
    
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_user
     * @param type $id_friend
     */
    static public function sendInvite($entityManager,$id_user,$id_friend) {
        $User = new UserRegister();
        $User = $entityManager->getRepository('UserRegister')->find($id_user);
        
        
        
        $to = $id_friend['email'];
        $subject = ucfirst($User->getFirstName()) . ' ' . ucfirst($User->getLastName()) . ' are inviting you';

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">';
        $message .= '<tr><td><a href=""><img src="./images/emailhead.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; color:#101010; font-size:16px;">Dear ' . ucfirst($id_friend['name']) . ' </td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"><img src="./uploads/'.$User->getProfilePic().'" alt="' . ucfirst($User->getFirstName()) . ' ' . ucfirst($User->getLastName()) . '" style="width:60px;height:60px;" />' . ucfirst($User->getFirstName()) . ' ' . ucfirst($User->getLastName()) . ' are inviting you to join <a href="www.whatsdadilly.com">Whats Dadilly?</a> .</td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#101010; font-size:14px; line-height:22px;"><em>Regards</em> <br />whatdadily </td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2013 whatdadily. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

//        echo $message;
        $headers .= 'From: <norespond@whatsdadilly.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

}
?>
