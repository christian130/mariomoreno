<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>


        <link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            $(document).ready(function()
            {
                $( "#country" ).change(function() {
                    $("#country_hide").val(($(this).val()));
                });
                $("#current_city").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "data.php?country="+$("#country_hide").val(),
                            data: request,
                            dataType: "json",
                            type: "GET",
                            success: function(data){
                                response(data);
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event,ui) {

                        $('#current_city_id').val(ui.item.id);
                    }
                });
                $("#home_town").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "data.php?country="+$("#country_hide").val(),
                            data: request,
                            dataType: "json",
                            type: "GET",
                            success: function(data){
                                response(data);
                            }
                        });
                    },
                    minLength: 1,
                    select: function(event,ui) {

                        $('#home_city_id').val(ui.item.id);
                    }
                });
            });
        </script>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div id="logincontainer">
            <div class="signup2">
                <form id="AuthForm" class="Form FancyForm AuthForm" action="signup2.php" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="country_hide" id="country_hide" value="" />
                    <input type="hidden" name="current_city_id" id="current_city_id" value="" />
                    <input type="hidden" name="home_city_id" id="home_city_id" value="" />
                    <table width="80%">
                        <tr>
                            <td colspan="2"> <h3>- Sign up Step2</h3></td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-left: 150px;">Current Country</td>
                            <td>
                                <select name="country" id="country" value="" class="locinputsel" placeholder="First Name">
                                    <option value="">Select Country</option>
                                    <?php foreach ($country as $cty) {
                                    ?>
                                        <option value="<?php echo $cty['country']; ?>"><?php echo $cty['country'];
                                    ?></option>
                                    <? } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-left: 150px;">Current City</td>
                            <td><input type="text" name="current_city" id="current_city" value="" class="locinput2" placeholder="Current City" autocomplete="off" ></td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-left: 150px;">Hometown</td>
                            <td><input type="text" name="home_town" id="home_town" value="" class="locinput2" placeholder="Home Town"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                                <br><input type="submit" value="Next" id="login_btn">&nbsp;&nbsp;<input type="button" value="Skip" id="login_btn">
                                            </td>
                                            </tr>
                                            </table>
                                            </form>
                                            </div>
                                            </div>
                                            </body>
                                            </html>