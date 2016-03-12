<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
<?php //theses bind the event when he click to upload to a existing album ?>
<?php //On closed its a callback function that its called when the box are close ?>        
<?php //this fucntion refreshAlbum make a ajax call to refresh the photo list ?>
        <script>$(document).ready(function(){ 
            $("#openBox").colorbox({  rel:'openBox   ',iframe:true, width:"100%", height:"85%",
                onClosed:function(){ refreshAlbum('<?php echo $_GET['id']; ?>') }
            });
        })             
        ;</script>
    </head>

    <body  class="nobg">         
        <?php include 'header.php'; ?>

        <script src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/albums_header.js"></script>
        <link rel="stylesheet" href="js/colorbox/colorbox.css" />        
        <script src="js/colorbox/jquery.colorbox.js"></script>
        <div class="midwht">
            <div class="homlft"> <img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" style="border-radius:4px; "/> </div>
            <div class="hommid">   
                <?php if ($session->getSession('other')) { ?>
                    <h3 class="createAlbum">Send a photo to your album!</h3>
                    <div class="album_form" >
                        <a class="postbutton" id="openBox"  href="album_new.php?id=<?php echo $album->getIdAlbum(); ?>" title="<?php echo $album->getTitle(); ?>" style="margin-bottom: 4px;"> Add Photos</a>
                           
                    <?php } ?>                        
                    <div class="photo_lists">                                                
                        
                            <?php
                            $params = array('id_album' => $_GET['id']);
                            echo Albums::getPhotos($entityManager, $params);
                            ?>                        
                    </div>  
                </div>
                </body>
                </html>
