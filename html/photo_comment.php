<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <script type="text/javascript" src="js/albums_header.js"></script>        
            <div class="comments">
                <div class="comment" id="1">
                    <img src="uploads/foto01.jpg" >
                    <img class="remove_icon" src="images/remove.jpg">         
                        <div class="comment-text">                        
                            Linda D+,LindaD+,Linda D+,Linda D+,Linda D+,Linda D+,LindaD+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,              Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,                Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,                                                
                        </div>                                                           
                </div>                     
                <div class="comment" id="1">
                    <img src="uploads/foto01.jpg" >
                        <div class="comment-text">
                            Linda D+,LindaD+,Linda D+,Linda D+,Linda D+,Linda D+,LindaD+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,              Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,                Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,                        
                        </div>                                   
                </div>                     
                <div class="comment" id="1">
                    <img src="uploads/foto01.jpg" >
                        <div class="comment-text">
                            Linda D+,LindaD+,Linda D+,Linda D+,Linda D+,Linda D+,LindaD+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,              Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,                Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,Linda D+,                        
                        </div>                                   
                </div>                     
                <?php PhotoComments::getPhotoComments($entityManager, $params)?>
            </div>
            <div class="comments_form" >
                <form method="post" action="friend_list.php">
                    <input type="hidden" name="id_photo" id="id_photo">
                    <input type="text" name="comment" class="comment_input" maxlength="200">
                </form>
            </div>

        </body>
    </html>
