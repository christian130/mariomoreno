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
require_once "Signup.php";
require_once "SendMail.php";
class Friends {

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     */
    public static function getFriendsTumbnail($entityManager, $id_owner, $qtd) {
        $userid = $_SESSION['userid'];
        $query = $entityManager->getConnection()->executeQuery('select user_id,firstname, lastname from sh_users where user_id = ' . $userid);
        $result = $query->fetchAll();
        $result = $result[0];
        $name = ucfirst($result['firstname']);

        $own = $id_owner > 0 ? $id_owner : 0;
        $query = $entityManager->getConnection()->executeQuery('SELECT user_id, firstname,lastname, profile_pic
FROM friends, sh_users
WHERE (
friends.id_friend = user_id
AND id_owner =' . $own . '
AND STATUS =1
)
OR (
friends.id_owner = user_id
AND id_friend =' . $own . '
AND STATUS =1
) order by id DESC  LIMIT ' . $qtd);
        $result = $query->fetchAll();
        if (count($result) != 0) {
            $var = '';
            $first = true;
            $firstName = '';
            $i = 0;
            foreach ($result as $item) {
                if ($first) {
                    $firstName = ucfirst($item['firstname']) . ' ' . ucfirst($item['lastname']);
                    $first = !$first;
                } else {
                    $qtd--;
                    $i++;
                    if ($qtd == 0)
                        break;
                }
                $var .= "<div class=\"item slider_two_item\"> <div class=\"slider_add_friends\"> <a href=\"profile.php?profileid=" . base64_encode($item['user_id']) . "\">
<img class=\"\" src=\"uploads/" . $item['profile_pic'] . "\"  title=\"" . $item['firstname'] . "\" style=\"width:157px;height:157px;\"/></a>
<span><i class=\"slider_two_times fa fa-times\"></i></span><h3>Michal Flowers</h3>
										<p><span><i class=\"fa fa-suitcase\"></i></span>Works at KFC</p>
<div class=\"add_friend_slider_div\">
											<a href=\"\"><span class=\"slider_two_add_friend\"><i class=\"fa fa-user-plus\"></i>Add friend</span></a>
										</div>

										</div></div>";
            }

            $_SESSION['tumbnail_text'] = $name . ' is now friend with ' . $firstName . ' and ' . $i . ' other friends';
            return $var;
        } else {
            $_SESSION['tumbnail_text'] = 'No activity recently!';
            return '';
        }
    }

    public static function getTumbnail($entityManager, $id_owner) {
        $userid = $id_owner;
        $query = $entityManager->getConnection()->executeQuery('SELECT * FROM `sh_users` WHERE `user_id` = '.$userid);
        $result = $query->fetchAll();
		if (count($result) > 0) {
		 foreach ($result as $item) {$result=$item['profile_pic'];}
		}
		return $result;
	}	

    public static function getFriendsList($entityManager, $id_owner, $qtd) {
        $own = $id_owner > 0 ? $id_owner : 0;
        $query = $entityManager->getConnection()->executeQuery('SELECT user_id, firstname,lastname, id_friend,profile_pic
FROM friends, sh_users
WHERE (
friends.id_friend = user_id
AND id_owner =' . $own . '
AND STATUS =1
)
OR (
friends.id_owner = user_id
AND id_friend =' . $own . '
AND STATUS =1
) LIMIT ' . $qtd);
        $result = $query->fetchAll();
        return $result;
    }

    public static function getFriendsAll($entityManager, $id_owner, $qtd) {

        $result = Friends::getFriendsList($entityManager, $id_owner, $qtd);
        if (count($result) > 0) {
            $div = '<div class="friend_container">';
            foreach ($result as $item) {

                $div.= '<div style="border:1px solid #ccc;width:480px;height:100px;float:left;margin-right:10px;margin-bottom:10px;"><a class="uni25Link" href="profile.php?profileid=' . base64_encode($item['user_id']) . '" style="float: left;
width: 100px;
height: 100px;
border-right:1px solid #ccc;
background-size: cover;background-image:url(\'uploads/'.$item['profile_pic'].'\')">	
            	
            	
            </a> <b style="
color: #333;
font-size: 14px;margin-top: 30px;display: block;float:left;">&nbsp;&nbsp;' . ucfirst($item['firstname'] . ' ' . $item['lastname']) . '</br> <span style="font-weight:normal !important;font-size:11px;">&nbsp;&nbsp;&nbsp;friends</span></b>

<a href="#" class="friendd"><i class="fa fa-check"></i>&nbsp; Friends</a>

</div>';
            }
			$div.='</div>';
            return $div;
        }else
            return '<div class="lines">
                                    <a href="home.php">  No friend!                                        
                                        </a>
                                    </div>';
    }
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function WhoSendRequest($entityManager, $id_owner, $id_friend) {
        $criteria = array(
            'id_owner' => $id_owner,
            'id_friend' => $id_friend,
            'status' => 0
        );
                
        $friend= $entityManager->getRepository('Friend')->findOneBy($criteria);
        
        if($friend instanceof Friend){
            return '1';
        }
           return '0';
    }
    
    public static function getFriends($entityManager, $id_owner, $qtd) {


        $result = Friends::getFriendsList($entityManager, $id_owner, $qtd);
        $_SESSION['friends'] = count($result);
        if (count($result) != 0) {
            $var = '';

            foreach ($result as $item) {
                $var .= '<li><a class="friend_pic1" href="profile.php?profileid=' . base64_encode($item['user_id']) . '" >

<img src="uploads/'.$item['profile_pic'].'" alt="Instagram" style="width:122px;height:122px;"/></a>	
            	<p class="friend_name">' . ucfirst($item['firstname'] . ' ' . $item['lastname']) . '</p>
            	
            </a></li>';
                $qtd--;
                if ($qtd == 0)
                    break;
            }
            return $var;
        } else {
            return 'No Friends!';
        }
    }

    public static function getFriendsRequest($entityManager, $id_owner) {
        $entityManager->beginTransaction();


        $own = $id_owner > 0 ? $id_owner : 0;
        $query = $entityManager->getConnection()->executeQuery('SELECT user_id,firstname, lastname, profile_pic,id_friend
FROM friends, sh_users
WHERE friends.id_owner = user_id
AND STATUS =0 and id_friend=' . $own);
        $result = $query->fetchAll();
        if (count($result) != 0) {
            $i = 0;
            $var = ''; 
            foreach ($result as $item) {
                $bg = $i % 2 == 0 ? " nobg" : "";
                $var .= " <div class=\"mfrienwrap notification_content information_content_confirm" . $bg . " \"  id=\"friend_requ\">
                                
<img src=\"uploads/" . $item['profile_pic'] . "\" alt=\"\" class=\" friendrequestimg\"  id=\"friend_requ\"  style=\"width:50px;height:50px;float:left;\">            
                                <div class=\"namtitwrap \" id=\"request_" . $item['user_id'] . "\" id=\"friend_requ\"   >
                                    <div class=\"friednamewrap\" id=\"friend_requ\" style=\"cursor:pointer;\"/ onclick=\"var url = 'profile.php?profileid=" . base64_encode($item['user_id'] ). "';$(location).attr('href',url);\" >
                                    <p id=\"friend_requ\" ><strong>" . $item['firstname'] . " " . $item['lastname'] . " </strong></p>
                                    <p id=\"friend_requ\" >Wants to add you as a friend</p>                                
                                    </div> 
<div class=\"m320\"><div class=\"accept_friend_request_confirm\">
 <input type=\"submit\" class=\"confirmbutton ConformBtn\" value=\"Confirm\" onclick=\"getFriends('friend_confirm'," . $item['user_id'] . ",'" . $item['firstname'] . "');showFrnds('" . $item['user_id'] . "')\"/> 
                                  </div>
<div class=\"add_friend_slider_div\">
 <input type=\"submit\" class=\"ignorebutton IgnoreBtn \" value=\"Ignore\"  onclick=\"getFriends('friend_ignore_first'," . $item['user_id'] . ",'');\"/ > 
                                </div></div>

                               </div>                                                              
                               
                            </div>";
                $i++;
                if ($i == 8)
                    break;
            }
            $var.='<div class="messagefooter"><h4 style="margin:5px;text-align:center;font-weight:bold;font-size:12px !important;" class="friendAll" ></h4></div>';

            $number = count($result) > 8 ? '+8' : $i;

            $_SESSION['friends_number'] = $number;

            return $var;
        } else {
            return '<h5>No Friends request!</h5>';
        }
    }

    public static function setFriendReject($entityManager, $id_owner, $id_friend) {
        $own = $id_owner > 0 ? $id_owner : 0;
        $sql = 'DELETE from `friends`  WHERE (id_owner =' . $own . '
                and id_friend = ' . $id_friend . ') or (id_owner =' . $id_friend . '
                and id_friend = ' . $id_owner . ') and status = 0';
        echo $sql;
        $query = $entityManager->getConnection()->executeQuery($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public static function setFriendBlock($entityManager, $id_owner, $id_friend) {
        $own = $id_owner > 0 ? $id_owner : 0;


        //in this case he are block that he already send the invite
        if (Friends::isFriend($entityManager, $id_owner, $id_friend, -1) == 1 || Friends::isFriend($entityManager, $id_owner, $id_friend, 0) == 1) {
            $query = $entityManager->getConnection()->executeQuery('UPDATE `friends` SET status=-1 WHERE (id_owner =' . $own . '
                and id_friend = ' . $id_friend . ') or id_owner =' . $id_friend . '
                and id_friend = ' . $own . ';');
                    $result = $query->fetchAll();        
        } else {
            $friend = new Friend();
            $friend->setIdFriend($id_friend);
            $friend->setIdOwner($id_owner);
            $friend->setStatus(-1);
            $entityManager->persist($friend);
            $entityManager->flush();        
        }


        return $result;
    }

    public static function setFriendAccept($entityManager, $id_owner, $id_friend) {
        $own = $id_owner > 0 ? $id_owner : 0;
        $query = $entityManager->getConnection()->executeQuery('UPDATE `friends` SET status=1 WHERE (id_owner =' . $own . '
                and id_friend = ' . $id_friend . ') or id_owner =' . $id_friend . '
                and id_friend = ' . $own . ';
');
//        $result = $query->fetchAll();
//        return $result;
    }

    /**
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     * */
    public static function isFriendText($entityManager, $id_owner, $id_friend) {
        $own = $id_owner > 0 ? $id_owner : 0;
        if (Friends::isFriend($entityManager, $id_owner, $id_friend) ==1) {
            return 'Remove Friend';
        } else {
            if (Friends::isFriend($entityManager, $id_owner, $id_friend, 0) == 1) {
                return 'Friend Request Sent';
            }else if (Friends::isFriend($entityManager, $id_owner, $id_friend, -1) >= 1) {
                    return 'Unfriend';
            }else
                return 'Add Friend';
        }
    }

    public static function isFriend($entityManager, $id_owner, $id_friend, $status = 1) {
        $own = $id_owner > 0 ? $id_owner : 0;
        $sql = 'select count(id) as count from `friends` where (id_owner =' . $own . '
                and id_friend = ' . $id_friend . ' and status=' . $status . ') OR (id_owner =' . $id_friend . '
                and id_friend = ' . $own . ' and status=' . $status . ') ';
//        echo $sql;
        $query = $entityManager->getConnection()->executeQuery($sql);

        $result = $query->fetchAll();
        $result = $result[0];
        $result = $result['count'];
        return $result;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function sendFriendRequest($entityManager, $id_owner, $id_friend) {

        if ($id_friend == $id_owner) {
            return '';
        }
        $result = Friends::isFriend($entityManager, $id_owner, $id_friend);
        if ($result == 1) {
            $own = $id_owner > 0 ? $id_owner : 0;
            $sql = 'DELETE from `friends`  WHERE (id_owner =' . $own . '
                and id_friend = ' . $id_friend . ') or (id_owner =' . $id_friend . '
                and id_friend = ' . $own . ') and status = 1';
//            echo $sql;
            $query = $entityManager->getConnection()->executeQuery($sql);
            return 'Friend Removed';
        } else {
            if (Friends::isFriend($entityManager, $id_owner, $id_friend, -1) == 1) {
                return 'Friend Request Send';
            }
            if (Friends::isFriend($entityManager, $id_owner, $id_friend, 0) == 0) {
                $data = array("user_id" => $id_friend);
                $userdetails = Signup::firstlogin($data, $entityManager);
                $user_data = array(
                                    "name" => $userdetails['firstname'].$userdetails['lastname'],
                                    "email" => $userdetails['email'],
                                    "profile_pic" => $userdetails['profile_pic']
                                  );
                $sendmail = SendMail::sendInvite($entityManager,$id_owner,$user_data);
                $friend = new Friend();
                $friend->setIdFriend($id_friend);
                $friend->setIdOwner($id_owner);
                $friend->setStatus(0);
                $entityManager->persist($friend);
                $entityManager->flush();
				$entityManager->getConnection()->commit();
            }
            return Friends::isFriendText($entityManager, $id_owner, $id_friend);
        }
    }
    public static function getNumberRequest() {
        $session = new Session();
        if (isset($_SESSION['friends_number'])) {
            $number = $session->getSession('friends_number');
            unset($_SESSION['friends_number']);

            return $number;
        }return '';
    }
    public static function getNumber($returno = false) {
        $session = new Session();
        if (isset($_SESSION['friends'])) {
            if ($returno)
                return $session->getSession('friends') . '';
            echo '' . $session->getSession('friends') . '';
			$frndno=$session->getSession('friends');
			/* echo "<script type='text/javascript'>alert('$frndno');</script>"; */
        }else
        if ($returno)
            return '0';        
    }
	
	  public static function updateNotifications($entityManager, $id_owner) {
        $own = $id_owner > 0 ? $id_owner : 0;
        $query = $entityManager->getConnection()->executeQuery('UPDATE notifications set `readed`=1 where `readed`=0 and `id_user`= ' . $own);
      
    }
   

}

?>