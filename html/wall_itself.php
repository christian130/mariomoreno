<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" href="css/wall.css" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="js/wall.js"></script>
        <script>
            $(document).ready(function() {
                $(".third").click(function() {
                    $(".frienddropwrap").slideToggle("slow");
                });

                $(".setting").click(function() {
                    $(".settings").slideToggle("slow");
                });
            });
        </script>
    </head>

    <body class="nobg">
        <div class="wallEntries">
          
        </div>
        <div class="lazyLoader"></div>
        <input type="hidden" name="limit" value="10" />
    </body>
</html>