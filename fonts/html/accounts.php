<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready( function() {
                $(".delbutton").click(function(){

                    //Save the link in a variable called element
                    var element = $(this);

                    //Find the id of the link that was clicked
                    var del_id = element.attr("id");

                    //Built a url to send
                    var info = 'account_id=' + del_id;
                    if(confirm("Sure you want to delete this account? There is NO undo!"))
                    {

                        $.ajax({
                            type: "GET",
                            url: "delete_account.php",
                            data: info,
                            success: function(){

                            }
                        });
                        $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                        .animate({ opacity: "hide" }, "slow");

                    }

                    return false;

                });
            });
        </script>
    </head>
    <body>
        <?php include 'header.php' ?>
        <div class="logleft" style="padding-left: 200px;">
            <div id="tab-container" class='tab-container'>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <?php foreach($accounts as $acc) { ?>
                    <tr class="record">
                        <td width="51">
                            <img src="images/Twitter-Bird-Logo.png" width="50" height="50"/>
                        </td>
                        <td width="376" class="tcontent">
                            <strong style="color:#006699;">@<?php echo $acc['screen_name']; ?></strong>
                        </td>
                        <TD width="28" bgcolor="#FFFFFF">
                            <a href="#" id="<?php echo $acc["token_id"]; ?>" class="delbutton"><img src="images/trash.png" style="background:#FFFFFF"/></a>
                        </TD>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>
</html>