<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
         <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>:WHATSDADILLY:</title>
            <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
            <link rel="stylesheet" href="css/style.css" type="text/css" />
            <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
            <script type="text/javascript" src="js/jquery.validate.js"></script>
            <script type="text/javascript" src="js/jquery.form.js"></script>      \
            <link type="text/css" href="js/scroll/jquery.jscrollpane.css" rel="stylesheet" media="all" />
            <link type="text/css" href="css/marcel.css" rel="stylesheet" media="all" />
            <script type="text/javascript" src="js/scroll/jquery.mousewheel.js"></script>
            <!-- the jScrollPane script -->
            <script type="text/javascript" src="js/scroll/mwheelIntent.js"></script>            
            <script type="text/javascript" src="js/scroll/jquery.jscrollpane.min.js"></script>            

            <script type="text/javascript" src="js/albums_header.js"></script>        
        </head>

        <body  class="nobg .scroll-pane">                
            <script>
                $(document).ready(function(){
                    $('body').jScrollPane(); 
                });
            </script>




            <div class="photo_main">
                <div class="photo_detail">
                    <?php if ($other) { ?>
                        <div class="remove_icon" onclick="removePhoto(<?php echo $photo->getIdPhoto(); ?>)">Remove Photo</div>
                    <?php } ?>
                        
                    <img src="<?php echo $photo->getPath(); ?>" >                    
                    </img>

                </div>                                       
            </div>
            <div class="owner">
                <?php
                $params['photo'] = $photo;
                $params['other'] = $other;
                echo Albums::getPhotoDescription($entityManager, $params)
                ?>
                <?php if ($other) { ?>
                    <div id="formTitle">Title: <input name="title" class="inputTitlePhoto" ></div>
                <?php } ?>
                    
            </div>
            <div class="comments-section">
                <div class="comments">
                    <?php                    
                    $params = array();
                    $params['id_photo'] = $_GET['id'];                    //                  
                    echo PhotoComments::getPhotoComments($entityManager, $params);
                    ?>                                                    
                </div>
                <div class="comments_form" >
                    <div id="message"></div>

                    <input type="hidden" name="id_photo" id="id_photo" value="<?php echo $photo->getIdPhoto(); ?>">
                        <input type="text" name="comment" class="comment_input" maxlength="200" autocomplete="off">
                            </div>
                            </div>

                            </body>
                            </html>
