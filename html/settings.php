<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="js/jquery.hashchange.min.js" type="text/javascript"></script>
        <script src="js/jquery.easytabs.min.js" type="text/javascript"></script>
        <style>
            /* Example Styles for Demo */
            .etabs { margin: 0; padding: 0; }
            .tab { display: inline-block; zoom:1; *display:inline; background: #eee; border: solid 1px #999; border-bottom: none; -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; }
            .tab a { font-size: 14px; line-height: 2em; display: block; padding: 0 10px; outline: none; }
            .tab a:hover { text-decoration: underline; }
            .tab.active { background: #fff; padding-top: 6px; position: relative; top: 1px; border-color: #666; }
            .tab a.active { font-weight: bold; }
            .tab-container .panel-container { background: #fff; border-top: solid #666 1px;  -moz-border-radius: 0 4px 4px 4px; -webkit-border-radius: 0 4px 4px 4px; }
            .panel-container { margin-bottom: 10px; }
        </style>
        <script type="text/javascript">
            $(document).ready( function() {
                $('#tab-container').easytabs();
            });
        </script>
    </head>
    <body>
        <?php include 'header.php' ?>
        <div class="logleft" style="padding-left: 200px;">
            <div id="tab-container" class='tab-container'>
                <ul class='etabs'>
                    <li class='tab'><a href="#socialnetwork">Social Networks</a></li>
                    <li class='tab'><a href="#mailnetwork">Mail Accounts</a></li>
                </ul>
                <div class='panel-container'>
                    <div id="socialnetwork">

                        <div id="sicons">
                            <ul>
                                <li><a href="twitter_add.php">Tweeter</a></li>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">LIn</a></li>
                                <li><a href="#">Gplus</a></li>
                                <li><a href="#">Facebook</a></li>

                            </ul>
                        </div>
                    </div>
                    <div id="mailnetwork">

                        <div id="sicons">
                            <ul>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Tweeter</a></li>
                                <li><a href="#">LIn</a></li>
                                <li><a href="#">Gplus</a></li>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Tweeter</a></li>
                                <li><a href="#">LIn</a></li>
                                <li class="nomargR"><a href="#">Gplus</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>