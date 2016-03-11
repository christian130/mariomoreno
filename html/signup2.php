<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>:WHATSDADILLY:</title>

            <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
            <link rel="stylesheet" href="css/style.css" type="text/css" />
            <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
            <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
            <script type="text/javascript" src="js/jquery-ui.js"></script>


            <link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
            <!-- Bootstrap -->
            <link href="css/bootstrap.min1.css" rel="stylesheet">
                <link href="css/bootstrap-theme.min.css" rel="stylesheet">
                    <link href="css/registration-process1.css" rel="stylesheet">
                        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                        <!--[if lt IE 9]>
                          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
                        <![endif]-->







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
                                            delay: 1,
                                            dataType: "json",
                                            autoSelect: true,
                                            autoFocus: true,
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
                                            delay: 1,
                                            autoSelect: true,
                                            autoFocus: true,
                                            type: "GET",
                                            success: function(data){
                                                response(data);
                                            }
                                        });
                                    },
                                    minLength: 1,
                                    select: function(event,ui) {
                                        var TABKEY = 9;
                                        this.value = ui.item.value;

                                        if (event.keyCode == TABKEY) {
                                            event.preventDefault();
                                            this.value = this.value + " ";
                                            $('#home_town').focus();
                                        }

                                        return false;
                                        $('#home_city_id').val(ui.item.id);
                                    }
                                });
                            });
                        </script>


                        <style>

                            #login_topblack
                            {
                                top:0px !important;
                                position:absolute;
                            }

                            body
                            {
                                background:#fff !important;
                            }
                            td
                            {
                                color:#333 !important;
                            }

                        </style>
                        </head>
                        <body>
                            <?php include 'header.php'; ?>
                            <div class="cols-xs">
                                <div class="StepProgresses">
                                    <div class="Step1Process">
                                        Step 1 <br/>
                                        <small>Personal Details</small>
                                    </div>
                                    <div class="Step2Process">
                                        Step 2 <br/>
                                        <small>Location details</small>
                                    </div>
                                    <div class="Step3Process">
                                        Step 3 <br/>
                                        <small>Profile Picture</small>
                                    </div>
                                    <div class="Step4Process">
                                        Step 4 <br/>
                                        <small>Invie Your Friends</small>
                                    </div>

                                </div>
                                <form id="AuthForm" class="Form FancyForm AuthForm" action="signup2.php" method="POST" accept-charset="utf-8">
                                    <input type="hidden" name="country_hide" id="country_hide" value="" />
                                    <input type="hidden" name="current_city_id" id="current_city_id" value="" />
                                    <input type="hidden" name="home_city_id" id="home_city_id" value="" />
                                    <div class="progress" style="margin-top:0 !important;">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                            <span class="fright" style="margin-right:20px;"><strong>50% </strong>Complete</span>
                                        </div>
                                    </div>
                                    <p class="InviteYourFrieds"><i>Select Your City</i></p>
                                    <div class="SelectCounCityDetails">
                                        <div class="SelectCountry">Current Country
                                           <select name="country" id="country" value="" class="form-control" placeholder="First Name">
                                                <option value="">Select Country</option>
                                                <?php for ($i=0;$i<count($country);$i++) {
                                                ?>
                                                    <option value="<?php echo $country[$i]['country']; ?>"><?php echo $country[$i]['country']; ?></option>
                                                <? } ?>
                                            </select>



                                        </div>
                                        <!--<div class="SelectCurrentState">Current State/ Province

                                            <select class="form-control">
                                                <option value="one">Select Your State</option>
                                                <option value="two">Two</option>
                                                <option value="three">Three</option>
                                                <option value="four">Four</option>
                                                <option value="five">Five</option>
                                            </select>


                                        </div>-->
                                        <div class="CurrentCitySelect">Current City


                                            <input type="text" name="current_city" id="current_city" value="" class="form-control" placeholder="Current City" autocomplete="off" >

                                        </div>
                                        <div class="HometownSelect">Hometown



                                            <input type="text" name="home_town" id="home_town" value="" class="form-control" placeholder="Home Town" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="SaveOrSkip">
                                        <span style="margin-left:20px; padding-top:20px;vertical-align:middle;">
                                            <a href="index.php" style="color:#cccccc;"> <img src="rgimages/back-icon.png"> Back</a>
                                        </span>
                                        <div class="fright">or <a href="signup3.php" id="login_btn">Skip This Step</a>
                                            <input type="submit" id="login_btn" value="Save & Continue" class="btn btn-default">
                                        </div>
                                    </div>
                                </form>






                            </div>
                            <div class="FooterBelowHints">By selecting your city, we can ensure that content specific to your area is communicated to you.
                                Network with people in your area to find resources easily. <br/><br/>
                                Always keep you in the loop about what's happening in the city around you since its always a good idea to be aware of current events that are close to home. </div>

                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                        </body>
                        </html>