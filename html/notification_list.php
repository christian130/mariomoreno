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

    </head>

    <body  class="nobg">         
        <?php include 'header.php'; ?>
        <!--<script type="text/javascript" src="js/home_header.js"></script>-->
        <script type="text/javascript" src="js/albums_header.js"></script>
        <div class="midwht">
            <div class="homlft"> <img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" style="border-radius:4px; "/> </div>
            <div class="hommid">                                  
                                <div class="notification_lists">                                    
                                    <h3 class="">Notification  List</h3>               
                                    <?php echo $notifications->getAllNotifications($entityManager) ?>
                                    </div>  
                                </div>
                                </body>
                                </html>
