<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>

    </head>

    <body  class="nobg">         
        <?php include 'header.php'; ?>
        <link rel="stylesheet" href="js/colorbox/colorbox.css" />        
        <script src="js/colorbox/jquery.colorbox.js"></script>
        <div class="midwht">

            <div class="hommid">  
                <?php
                if (!$other) {
                    //theses bind to open a box to upload a new album 
                    ?>
                    <?php //the callback function its a ajax request that call func=remove_open on the photos.php  ?>

                    <div class="album_form" >
                        <a class="newbutton" id="openBox" rel="openBox" href="album_new.php" title="New Album" style="margin-bottom: 4px;"><img src="images/add.png"></img> Create Album</a>                    
                        <h2><img src="images/camera-image-uplaod.png" style="margin-bottom: 10px;"></img> Photos</h2>

                    </div>
                <?php } ?>
                <div class="album_lists">
                    <?php
                    echo Albums::listAlbum($entityManager, $params);
                    ?>
                </div>  
            </div>
            <div class="friendright" >

            </div>
        </div>
        <script>


            $(document).ready(function() {                
                $("#openBox").colorbox({rel: 'openBox', iframe: true, width: "100%", height: "85%",
                    onClosed: function() {
                        clearAlbum();
                    }
                });

            });
        </script>
    </body>
</html>
