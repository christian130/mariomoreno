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
class PhotoComments {

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner     
     */
    public static function removeComment($entityManager, $params) {
        $comment = new PhotoComment();
        $photo = new PhotoAlbum();
        $comment = $entityManager->getRepository('PhotoComment')->findOneBy($params);
                
        $photo = $entityManager->getRepository('PhotoAlbum')->find($comment->getIdPhoto());


        if ($comment->getIdUser() == $_SESSION['userid'] || $photo->getIdOwner() == $_SESSION['userid']) {
            $id_photo = $comment->getIdPhoto();
            $entityManager->remove($comment);
            $entityManager->flush();
        }
        return array('id_photo' => $id_photo);
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner     
     */
    public static function addComment($entityManager, $params) {
        $comment = new PhotoComment();
        $comment->setIdPhoto($params['id_photo']);
        $comment->setComment($params['comment']);
        $comment->setIdUser($_SESSION['userid']);
        $entityManager->persist($comment);
        $entityManager->flush();
    }

    /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner     
     */
    public static function getPhotoComments($entityManager, $params) {
        $session = new Session();
        $repo = $entityManager->getRepository('PhotoComment');
//        $photo = new PhotoAlbum();
        $photo = $entityManager->getRepository('PhotoAlbum')->findOneBy($params);
        $repoUser = $entityManager->getRepository('UserRegister');
        $user = new UserRegister();
        $photosComment = $repo->findBy($params);
        $div = '';
        $photoComment = new PhotoComment();
        if(count($photosComment ) > 0){
        foreach ($photosComment as $photoComment) {
            $user = $repoUser->find($photoComment->getIdUser());
            
            $div.='<div class="comment" id="1">
                    <div class="comment-made">
                        <a href="profile.php?profileid=' . $user->getUser_id() . '" class="link"><img src="uploads/' . $user->getProfilePic() . '" > ' . ucfirst($user->getFirstName()) . ' ' . ucfirst($user->getLastName()) . '</a> says : ';
            $div.=($photo->getIdOwner() == $session->getSession('userid') || $photoComment->getIdUser() ==$session->getSession('userid') )? '<img class="remove_icon" src="images/remove.jpg" onclick="removeComment('.$photoComment->getIdComment().');"> ' : '';
            $div.='</div>                                        
                                <div class="comment-text">                        
                                    ' . $photoComment->getComment() . '
                                </div>                                                           
                                </div>';
        }
        
    }else $div = '<div style="background-color: #ffcc66; width: 29em;color: whitesmoke; font-size: 1em; text-align: justify; position: relative;  text-wrap: avoid; padding-right: 10px; margin: 3px 2px 3px 2px; border-radius: 3px; padding: 3px; ">No Comments Yet</div>';
        echo $div;
    }
}

?>
