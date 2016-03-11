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
class AlbumUtil{

    public static function userHaveFolder(){
        $userid = $_SESSION['userid'];
        $file = __DIR__."../uploads/".$userid.'/';
//        echo $file;
//        echo !file_exists($file);
        try{
        if(!file_exists($file)){
           $mask=umask(0);
            mkdir($output_dir,0777);
			umask($mask);
        }
        }  catch (Exception $e){
            
        }
        
//        return file_exists($file);
    }

    public static function createAlbumFolder($id){
        $userid = $_SESSION['userid'];
        AlbumUtil::userHaveFolder();
                
        $file = "uploads/".$userid.'/'.$id.'/';
        
        if(!file_exists($file)){
            $mask=umask(0);
            mkdir($output_dir,0777);
			umask($mask);
        }
        
//        return file_exists($file);
    }
 
   
     /**
     * 
     * @param Doctrine\ORM\EntityManager $entityManager
     * @param type $id_owner     
     */
    public static function getPhoto($entityManager, $params) {
        $session = new Session();
        $repo = $entityManager->getRepository('PhotoAlbum');
        $album = new PhotoAlbum();
        $album = $repo->find($params['id_photo']); 
        if($album instanceof PhotoAlbum){            
            return $album;
        }else{
            return false;
        }
    }
    
    public static function getAlbum($entityManager, $params) {
        $session = new Session();
        $repo = $entityManager->getRepository('Album');
        $album = new Album();
        $album = $repo->find($params['id_album']); 
        if($album instanceof Album){            
            return $album;
        }else{
            return false;
        }
    }
    
    public static function getFirstPhotoAlbum($id_album){
        $userid = $_SESSION['userid'];
        $path = "uploads/$userid/$id_album/";
        $photos = scandir($path);
//        var_dump($photos);
        if(count($photos) > 2){
            return $path.$photos[2];
        }else return '';
        
    }
    
    
}
?>