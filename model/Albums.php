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
class Albums {

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function removeIfEmpty($entityManager, $params) {
        $session = new Session();
        if (count($session->getSession('send_photos_path')) == 0) {
            Albums::removeAlbum($entityManager, $params);
            unset($_SESSION['open_album']);
            unset($_SESSION['send_photos']);
            return false;
        } else
            return $entityManager->getRepository('Album')->find($params['id_album']);
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function listAlbum($entityManager, $params) {
       // print_r($params);

        $repo = $entityManager->getRepository('Album');
       
        $album = new Album();
        $i = 1;
//        $pos = '';
        $include = true;
        $div = '<h4 class="album_header"><i class="fa fa-picture-o"></i>&nbsp;Photos</h4> ';
        foreach ($repo->findBy($params) as $album) {
            if ($i == 1)
                $div .= '<div class="lines" style="display: inline-block;">';
            if ($include) {
               
               // $div .= '<div id="openBox2" class="album_style newalbum"  onclick="$(\'#openBox\').trigger(\'click\')">'
              //          . ' <a   title="New Album" style="margin-bottom: 4px;"><img src="images/add.png"></img> Create Album</a>                    '
               //         . '</div>';
                $include = false;
                $i++;
                
            }
 // echo "test". $album->getIdAlbum(); die();
         // echo '<pre>';
     //  echo   $album->getIdAlbum()."-----".$album->getCover()."<br>";
         if($album->getCover() != ""  ){
            $div .= '
                        <div class="album_style ">
                            <a href="album_detail.php?id=' . $album->getIdAlbum() . '">
                            <img src="' .Albums::getCover($entityManager, $album->getCover()) . '" class="imgphoto" width="200px" height="200px"></img>
                           <h3 style="margin:0px;padding:3px;font-weight:bold;color:#23abe8;"> ' . $album->getTitle() . '</h3><br/><div class="photo_num"> ' . Albums::getPhotoCount($entityManager, $album->getIdAlbum()) . ' &nbsp;Photo </div>
</a>    
                        </div>         
                    ';
         }
            if ($i == 5) {
                $div .= '</div>';
                $i = 1;
            } else
                $i++;
        }

        return $div;
    }

    public static function delTree($dir) {
        $files = glob($dir . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (substr($file, -1) == '/')
                delTree($file);
            else
                unlink($file);
        }

        if (is_dir($dir))
            rmdir($dir);
    }

    public static function getPhotoArray($entityManager, $id_album) {
        $query = $entityManager->getConnection()->executeQuery('SELECT id_photo FROM `photo_album` WHERE id_album =' . $id_album);
        $result = $query->fetchAll();
        $result2 = array();
        foreach ($result as $line) {
            $result2[] = $line['id_photo'];
        }
        return $result2;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function removeAlbum($entityManager, $params) {
        $session = new Session();
        $album = $entityManager->getRepository('Album')->find($params['id_album']);
        $photoArray = Albums::getPhotoArray($entityManager, $params['id_album']);

        /* clean all photos related to the album */
        $query = $entityManager->getConnection()->executeQuery('delete FROM `photo_album` WHERE id_album =' . $params['id_album']);

        /**
         * Clean all files related to the album
         */
        foreach ($photoArray as $photo) {
            $path = 'uploads/' . $session->getSession('userid') . '/' . $params['id_album'] . '/' . $photo . '.jpg';
            unlink($path);
        }
//


        $photocomments = '(';
        $count = count($photoArray);
        if ($count > 0) {
            $i = 0;
            foreach ($photoArray as $photo) {
                $photocomments.=$photo;
                if ($i != $count - 1) {
                    $photocomments.=',';
                    $i++;
                }
            }
            $photocomments .= ')';

            echo $photocomments;
            $query = $entityManager->getConnection()->executeQuery('delete FROM `photo_comments` WHERE id_photo IN' . $photocomments);
        }

        if ($album->getIdOwner() == $session->getSession('userid')) {
            $query = $entityManager->getConnection()->executeQuery('delete FROM `albums` WHERE id_album =' . $params['id_album']);
        }

        return false;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function removePhoto($entityManager, $params) {
        $session = new Session();
        $photo = new PhotoAlbum();
        $photo = $entityManager->getRepository('PhotoAlbum')->findOneBy($params);
        if ($photo->getIdOwner() == $session->getSession('userid')) {
            unlink($photo->getPath());
            $entityManager->remove($photo);
            $comments = $entityManager->getRepository('PhotoComment')->findBy($params);
            foreach ($comments as $comment) {
                if ($comment->getIdUser() == $_SESSION['userid'] || $photo->getIdOwner() == $_SESSION['userid']) {
                    $id_photo = $comment->getIdPhoto();
                    $entityManager->remove($comment);
                }
            }
            $entityManager->flush();
            unset($params);
            $params = array();
            $params['id_album'] = $photo->getIdAlbum();
            return $params;
        }
        return false;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner
     * @param type $id_friend
     */
    public static function createPhoto($entityManager, $params) {

        $friend = new PhotoAlbum();
        $friend->setIdAlbum($params['id_album']);
        $friend->setIdOwner($params['id_owner']);
        $friend->setTitle($params['title']);
        $params['datetime'] = $friend->getDatetime(true);
        $entityManager->persist($friend);
        $entityManager->flush();

        $photo = $entityManager->getRepository('PhotoAlbum')->findOneBy($params);
        return $photo;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager   
     */
    public static function createAlbum($entityManager, $params) {
        $id_owner = $params['id_owner'];
        $own = $id_owner > 0 ? $id_owner : 0;
	
        if ($own > 0) {
            $friend = new Album();
            $friend->setIdOwner($id_owner);
            $friend->setPrivate($params['priv']);
            $friend->setTitle($params['title']);
			
            $entityManager->persist($friend);
            $entityManager->flush();
			
            AlbumUtil::createAlbumFolder($friend->getIdAlbum());
            return $friend;
        }
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager   
     */
    public static function getPhotoCount($entityManager, $id_album) {
        $sql = 'SELECT count( id_album ) AS count
FROM `photo_album`
WHERE id_album =' . $id_album;

        $query = $entityManager->getConnection()->executeQuery($sql);
        $result = $query->fetchAll();
        $result = $result[0];
        $result = $result['count'];
        return $result;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager   
     */
    public static function getPhotoDescription($entityManager, $params) {
        $div = '';
        $photo = new PhotoAlbum();
        $photo = $params['photo'];
        $other = $params['other'];
        unset($params['other']);
        $user = $entityManager->getRepository('UserRegister')->find($photo->getIdOwner());
        $div .= '<div id="info"><img src="uploads/' . $user->getProfilePic() . '" class="imgowner"> ' . ucfirst($user->getFirstName()) . ' ' . ucfirst($user->getLastName()) . ': <p>' . $photo->getDatetime() . '</p> ';
        $div .= '<h2 id="titlePhoto" ';
        if ($other)
            $div .= 'onclick="showTitlePhotoForm()">';
        $div .= '>' . $photo->getTitle() . '<h2></div>';

        return $div;
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager   
     */
    public static function setCover($entityManager, $params) {
        $album = new Album();
        $session = new Session();
        $album = $entityManager->getRepository('Album')->find($params['id_album']);
        if($album->getIdOwner() ==$session->getSession('userid')){
            $photo = new PhotoAlbum();
            $photo = $entityManager->getRepository("PhotoAlbum")->find($params['id_photo']);
            if($photo->getIdOwner() ==$session->getSession('userid')){
                $album->setCover($params['id_photo']);
                $entityManager->persist($album);
                $entityManager->flush();
            }
        }
        
    }
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager   
     */
    public static function getCover($entityManager, $id) {
        $photo =  new PhotoAlbum();
        $photo =  $entityManager->getRepository('PhotoAlbum')->find($id);
           return $photo->getPath();
    }
    
    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager   
     */
    public static function getPhotos($entityManager, $params) {

      //  $entityManager->getRepository('Photo')->findBy($params);
       // $photo = new Photo();
        $other = $params['other'];
        unset($params['other']);
        $album = $entityManager->getRepository('Album')->find($params['id_album']);


        $pos = '';

        $i = 1;
        $photo = new PhotoAlbum();
        foreach ($entityManager->getRepository('PhotoAlbum')->findBy($params) as $photo) {
            if ($i == 1)
                $div .= '<div class="lines">';
            $div .= '       
        <div class="favicon" onclick="sendCover(\''.$photo->getIdAlbum().'\',\''.$photo->getIdPhoto().'\'); " >                            </div>        
                            <a class="group1" href="photo_detail.php?id=' . $photo->getIdPhoto() . '" title="' . $photo->getTitle() . '" style="float:left;">                            
    <img src="' . $photo->getPath() . '" >                            
        
                            </a>                            
                    ';
            if ($i == 5) {
                $div .= '</div>';
                $i = 1;
            } else
                $i++;
        }
        $div .="<script>$(document).ready(function(){ 
             $(\".group1\").colorbox({  rel:'group1',iframe:true, width:\"85%\", height:\"85%\"});
             })             
;</script>";
        return $div;
    }

}

?>