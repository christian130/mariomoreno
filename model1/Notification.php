<?php

class NotificationModel {

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $params
     * @throws Exception
     */
    public static function addNotification($entityManager, $params) {
       
        $entry = new Notification();
        $entry->setIdFriend($params['id_user']);
        $entry->setIdUser($params['id_friend']);
        $entry->setMessage($params['message']);
        $entry->setType($params['type']);
//        $entry->setDate('CURRENT_TIMESTAMP');


        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($entry);
            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }
    public static function addFriendNotification($entityManager, $params) {

        $sql = 'select firstname,lastname from sh_users where user_id = ' . $params['id_user'];

        $query = $entityManager->getConnection()->executeQuery($sql);
        $result = $query->fetchAll();
        $result = $result[0];

        $params['message'] = ucfirst($result['firstname']) .' ' . $params['message'];

        $entry = new Notification();
        $entry->setIdFriend($params['id_user']);
        $entry->setIdUser($params['id_friend']);
        $entry->setMessage($params['message']);
        $entry->setType($params['type']);
//        $entry->setDate('CURRENT_TIMESTAMP');


        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($entry);
            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $params
     */
    public static function readNotification($entityManager, $id_notification) {
        $sql = 'UPDATE notifications SET readed= 1 WHERE id_notifications =' . $id_notification . ' ;';
//            echo $sql;
        $session = new Session();
        $query = $entityManager->getConnection()->executeQuery($sql);
//            $result = $query->fetchAll();
        return NotificationModel::getNotifications($entityManager, $session->getSession('userid'));
    }

    public static function readNotifications($entityManager, $user_id) {
        $own = $user_id > 0 ? $user_id : 0;
        $sql = 'UPDATE notifications SET readed= 1 WHERE id_user =' . $own . ' ;';
//            echo $sql;
        $query = $entityManager->getConnection()->executeQuery($sql);
//            $result = $query->fetchAll();
        return NotificationModel::getNotifications($entityManager, $user_id);
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $params
     */
    public static function getAllNotifications($entityManager) {
        $q = $entityManager->createQuery("select u from Notification u where u.id_user = ". $_SESSION['userid']."");
        $div = '';
        $repoUser = $entityManager->getRepository('UserRegister');
        $notifications = $q->getResult();
        foreach ($notifications as $notification) {        
            $user = $repoUser->find($notification->getIdFriend());
            $div.= '<div class="lines">';
            if ($notification->getRead() == 0) {
                $div .= '<img src="images/read.png" class="readed"  onclick="readNotification(\'' . $notification->getId() . '\');$(this).hide();" title="Mark as Read"> </p>';
            }
            $div.='<img src="uploads/' . $user->getProfilePic() . '"></img> <a href="profile.php?profileid=' . base64_encode($user->getUser_id()) . '  ">  ' . ucfirst($user->getFirstName()). '  ' . ucfirst($user->getLastName()). ' </a>
                                        <br>
                                        <h4>' . $notification->getType() . ' - ' . $notification->getDate() . '</h4>
                                        <p>' . $notification->getMessage() . '';

            $div .='</div>';
        }
		$div .="<script>$(document).ready(function(){ 
             $(\".group1\").colorbox({  rel:'group1',iframe:true, width:\"85%\", height:\"85%\"});
             })             
;</script>";
        return $div;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $params
     */
    public static function getNotifications($entityManager, $sh_user_receiver) {

        $receiver = $sh_user_receiver > 0 ? $sh_user_receiver : 0;
        $sql = 'SELECT `id_notifications`, `id_friend` , profile_pic, `type` , `message` , `readed` , `date`
FROM notifications, sh_users
WHERE id_user = ' . $receiver . '
AND sh_users.user_id = id_friend ORDER BY `notifications`.`readed` ASC,`notifications`.`date` ASC ';
//        echo $sql;
        $query = $entityManager->getConnection()->executeQuery($sql);
        $result = $query->fetchAll();

        $unreaded = 0;
        if (count($result) > 0) {
            $var = '';
            $i = 0;
			$bg = '';
            foreach ($result as $item) {
                $bg = $i % 2 == 0 ? " nobg" : "";
                $var .= '<div class="notificationwrap' . $bg . '" >
        <img src="uploads/' . $item['profile_pic'] . '" alt="Image Friend" class="dimg friendrequestimg" onclick="var url = \'profile.php?profileid=' . base64_encode($item['id_friend'] ). '\';$(location).attr(\'href\',url); "/>                                
                   <p onclick="var url = \'profile.php?profileid=' . base64_encode($item['id_friend']) . '\';$(location).attr(\'href\',url); ">' . $item['message'] . '      </p>
                    ';
//                <h4>' . NotificationModel::verifyType($item['type']) . '</h4>
                if ($item['readed'] == 0) {
                    $var .= '<div id="read_' . $item['id_notifications'] . '"><img src="images/read.png" style="float:right;cursor:pointer;display:block;"  onclick="readNotification(\'' . $item['id_notifications'] . '\');" title="Mark as Read">  </div>';
                    $unreaded++;
                }
                $var .= '<div class="notificationtime">' . NotificationModel::getDiffDate($item['date']) . '</div></div>';

                $i++;
               if($limit == $i) break;
            }
			if(count($result)!= $i){
            $var .= '<div class="notificationwrap " onmouseover="getMoreNotificaitons()" >            
                        <img src="images/add.png" >
                        <img src="images/ajax-loader.gif" onclick="getMoreNotificaitons()" style="margin-bottom:10px; width: 30px; height:15px;" >                        
                     </div> ';
            }
            $var.="<h5 onclick=\"var url = 'notification_list.php';$(location).attr('href',url);\">See all</h5>
            <h5 class=\"readAll\">mark as read</h5>";

            $number = $unreaded > 0 ? $unreaded : '';
 unset($_SESSION['notifications_number']);
            $_SESSION['notifications_number'] = $number;
            return $var;
        }else {
            $_SESSION['notifications_number'] = '';
            return "<h5>No notifications</h5><h5 onclick=\"var url = 'notification_list.php';$(location).attr('href',url);\">See all</h5>";
        }
    }

    private static function verifyType($type) {

        switch ($type) {
            case 1:
                return "Friendship Request";
                break;
            case 2:
                return "Friendship Accept";
                break;
            default:
                break;
        }
        return;
    }
 public static function getDiffDate($date) {

        $inicio = strtotime($date);
        $fim = strtotime('' . date('Y-m-d H:i:s', time()));

# CALCULA A DIFERENÇA ENTRE AS DATAS
        $intervalo = $fim - $inicio;

# ESPECIFICO OS FATORES DE CÁLCULO DO INTERVALO
        define('FATOR_ANO', (365 * 60 * 60 * 24));
        define('FATOR_MES', (30 * 60 * 60 * 24));
        define('FATOR_DIA', (60 * 60 * 24));
        define('FATOR_HORA', (60 * 60));
        define('FATOR_MINUTO', 60);
        $retorno = '';


        $anos = floor($intervalo / FATOR_ANO);
        if($anos>0){
            $retorno = $anos.' year ago';
            return $retorno;
        }

        $meses = floor(($intervalo / FATOR_MES));
        if ($meses > 0) {
            $retorno = $meses . ' month ago';
            return $retorno;
        }

        $dias = floor($intervalo / FATOR_DIA);
        if ($dias > 0) {

            $semanas = floor($dias / 7);

            if ($semanas >= 1) {
                $retorno = $semanas . 'week';
                if ($semanas == 1)
                    $retorno .= ' ago';
                else
                    $retorno .= 's ago';
                return $retorno;
            }
            $retorno = $dias . ' day';            
            return $retorno;
        }
        

        $horas = floor($intervalo / FATOR_HORA);
        if ($horas < 24 && $horas > 0) {
            $retorno = $horas . ' hr';
            if ($horas > 1)
                $retorno .= 's';
            
            return $retorno;
        }

        $minutos = floor($intervalo / FATOR_MINUTO);
        if ($minutos < 60 && $minutos > 0) {
            $retorno = $minutos . ' min';
            if ($minutos > 1)
                $retorno .= 's';
            
            return $retorno;
        }

        return $intervalo . ' s ago';

#EM SEGUNDOS É A PRÓPRIA VARIÁVEL
    }

    public static function getNumber() {
        $session = new Session();
        if (isset($_SESSION['notifications_number'])) {

            $number = $session->getSession('notifications_number');
            unset($_SESSION['notifications_number']);
            return $number;
        }else
            return '';
    }

}
