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
        <script type="text/javascript" src="js/home_header.js"></script>
           <link rel="stylesheet" href="js/build/coverphoto.css" />
        <script type="text/javascript" src="js/build/coverphoto.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">




 <script src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/albums_header.js"></script>
        <link rel="stylesheet" href="js/colorbox/colorbox.css" />        
        <script src="js/colorbox/jquery.colorbox.js"></script>


        <link rel="stylesheet" href="css/marcel1.css" type="text/css" /> 

        <?php //theses bind the event when he click to upload to a existing album ?>
        <?php //On closed its a callback function that its called when the box are close ?>        
        <?php //this fucntion refreshAlbum make a ajax call to refresh the photo list ?>
        
<script>$(document).ready(function() {
                $("#openBox").colorbox({rel: 'openBox   ', iframe: true, width: "100%", height: "85%",
                    onClosed: function() {
                        refreshAlbum('<?php echo $_GET['id']; ?>')
                    }
                });
            })
                    ;</script>


 <style>
            .coverphoto, .output {
                width: 988px;
                height: 280px;
                border: 0px solid black;
                margin: -1px auto;
            }
        </style>
        <script>
            $(document).ready(function() {
                $("#openBox").colorbox({rel: 'openBox', iframe: true, width: "100%", height: "85%",
                    onClosed: function() {
                        clearAlbum();
                    }
                });
              
                    $(".coverphoto").CoverPhoto({
                        currentImage: '<?php echo $cover_photo; ?>',

                    editable: false

            });
           

        });
        </script>


    </head>

    <body  class="nobg">         
        <?php include 'header.php'; ?>

       
           <div class="midwht">
            <div id="banner"><div class="coverphoto"></div></div>
        <div class="hommid">   
            <?php if ($album->getIdOwner() == $session->getSession('userid')) { ?>
               
                
                    

                <?php } ?>                        
                <div class="photo_lists">                                                
                    <h4 class='album_header'> <i class="fa fa-picture-o"></i>&nbsp;<?php echo $album->getTitle(); ?>

 <a style="margin-top:-4px;margin-right:30px;" class="newbutton cboxElement" id="openBox"  href="album_new.php?id=<?php echo $album->getIdAlbum(); ?>" title="<?php echo $album->getTitle(); ?>" style="margin-bottom: 4px;"><i class="fa fa-plus-circle" style="vertical-align: middle;font-size:18px;"></i>&nbsp; Add Photos</a>
                        
                      <? if ($album->getIdOwner() == $session->getSession('userid')) { ?>
                            <div style="margin-right: -185px;" class="remove_icon" onclick="removeAlbum('<?php echo $album->getIdAlbum(); ?>')"><i class="fa fa-trash-o"></i></div>
                            <div class="favicon_list" onclick="favIcon()"></div>
                        <? } ?>     

                    </h4> 
                    <div id="photo_lists_container">
                    <?php
                    
                    echo Albums::getPhotos($entityManager, $params);
                    ?>                       
                        </div>
                </div>  
    </body>
</html>