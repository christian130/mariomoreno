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
       // $action = base64_encode("activation");
        $to = $mail;
        $subject = "Registeration";

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">';
        $message .= '<tr><td style="background:#000;padding:10px;"><a href="www.whatsdadilly.com"><img src="http://whatsdadilly.com/beta/images/logo.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 5px; font-size: 14px;font-weight: bold;color: #FF780D;">Dear <b>' . $fname . ' ' . $lname . '</b></td>                     
                     </tr>
                    <tr><td style="padding:0px 25px 5px; font-size: 14px;font-weight: bold;color:#333;">Welcome to <b>Whatsdadilly</td></tr>';
        $message .= '<tr><td style="padding:0 25px 0;line-height:20px; text-align:justify;text-decoration:none;">';
        $message .= "<a href='http://whatsdadilly.com/betaPhase/activation.php?activation=".$activation."&action=".base64_encode('activation')."'>Conform your registration</a> </td></tr>";
        $message .= '<tr><td style="padding:30px 25px 30px; color:#999; font-size:12px;color:#999; line-height:22px;"><b>Regards</b> <br />Whatsdadilly</td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2014 Whatsdadilly. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        $headers .= 'From: <webmaster@whatsdadilly.com>' . "\r\n";
       // echo $message; die();
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
        $message .= '<tr><td style="background:#000;padding:10px;"><a href="www.whatsdadilly.com"><img src="http://whatsdadilly.com/beta/images/logo.png" alt="whatsdadilly" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; font-size: 14px;font-weight: bold;color: #FF780D;">
Dear ' . ucfirst($Friend->getFirstName()) . ' ' . ucfirst($Friend->getLastName()) . ' </td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"><img src="./uploads/'.$Owner->getProfilePic().'" 
alt="' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . '" style="width:120px;height:120px;float:left;"/><span style="float:left;margin-left:10px;"><b>
' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . '</b> comment - "'.$params['comment'].'" on your <a href="www.whatsdadilly.com/photo_detail.php?
        id='.$params['id'].'">photo</a>. </span></td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px;color:#ccc; font-size:12px; line-height:22px;"><b>Regards</b> <br />Whatsdadilly</td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2014 Whatsdadilly. All Rights Reserved.</td></tr>';
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

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">';
        $message .= '<tr><td style="background: #000;padding: 10px;"><a href="www.whatsdadilly.com"><img src="http://whatsdadilly.com/beta/images/logo.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; font-size: 14px;font-weight: bold;color: #FF780D;">Dear <b>' . ucfirst($Owner->getFirstName()) . ' ' . ucfirst($Owner->getLastName()) . '</b></td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"><img src="./uploads/'.$Friend->getProfilePic().'" alt="' . ucfirst($Friend->getFirstName()) . ' ' . ucfirst($Friend->getLastName()) . '" style="width:120px;height:120px;float:left;"/><span style="float:left;margin-left:10px;"><b>' . ucfirst($Friend->getFirstName()) . ' ' . ucfirst($Friend->getLastName()) . '</b> accepted your friend request.</span> <br/> </td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#ccc; font-size:12px; line-height:22px;"><b>Regards</b> <br />Whatsdadilly <a href="#" class="viewprofile" class="viewfrnd" style="float: right;width: 100px;text-align: center;text-decoration: none;background: #ff780d;color:#fff;border: 1px solid #da6305;">View Profile</a></td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2014 Whatsdadilly. All Rights Reserved.</td></tr>';
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

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">';
        $message .= '<tr><td style="background: #000;padding: 10px;"><a href=""><img src="http://whatsdadilly.com/beta/images/logo.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 15px; font-size: 14px;font-weight: bold;color: #FF780D;">Dear ' . ucfirst($id_friend['name']) . ' </td></tr>';
        $message .= '<tr><td style="padding:0 25px 0; color:#101010; line-height:20px; text-align:justify;"><img src="./uploads/'.$User->getProfilePic().'" alt="' . ucfirst($User->getFirstName()) . ' ' . ucfirst($User->getLastName()) . '" style="width:120px;height:120px;float:left;" /><span  style="float:left;margin-left:10px;"><b>' . ucfirst($User->getFirstName()) . ' ' . ucfirst($User->getLastName()) . '</b> are inviting you to join <a href="www.whatsdadilly.com">Whats Dadilly?</a> .</span></td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#101010; font-size:12px;color:#ccc; line-height:22px;">Regards <br />Whatsdadilly</td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2014 Whatsdadilly. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        $headers .= 'From: <norespond@whatsdadilly.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
    static public function sendForgotPasswordMail($mail, $token) {
        $to = $mail;
        $subject = "Forgot Password Link";

        $message = '<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">';
        $message .= '<tr><td style="background:#000;padding:10px;"><a href="www.whatsdadilly.com"><img src="http://whatsdadilly.com/beta/images/logo.png" alt="whatdadily" /></a></td></tr>';
        $message .='<tr><td style="padding:30px 25px 5px; font-size: 14px;font-weight: bold;color: #FF780D;">Click the link <b><a href="http://whatsdadilly.com/beta/updatepassword.php?token='. $token . '">Update Password</a></b></td>
                     </tr>';
       // $message .='<tr><td style="padding:0px 25px 5px; font-size: 14px;font-weight: bold;color:#333;">Welcome to <b>Whatsdadilly</td></tr>';
        //$message .= '<tr><td style="padding:0 25px 0;line-height:20px; text-align:justify;text-decoration:none;"><a href="http://whatsdadilly.com/beta/home.php">Conform your registration</a> </td></tr>';
        $message .= '<tr><td style="padding:30px 25px 30px; color:#999; font-size:12px;color:#999; line-height:22px;"><b>Regards</b> <br />Whatsdadilly</td></tr>';
        $message .= '<tr bgcolor="#000"><td style="color:#fff; padding:20px 25px; line-height:18px;">Copyright © 2014 Whatsdadilly. All Rights Reserved.</td></tr>';
        $message .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        $headers .= 'From: <webmaster@whatsdadilly.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

}
?>