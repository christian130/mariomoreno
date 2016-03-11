<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>

        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/profile.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<link rel="stylesheet" href="css/marcel.css" type="text/css" /> 
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />


        <link rel="stylesheet" href="js/build/coverphoto.css" />
        <script type="text/javascript" src="js/build/coverphoto.js"></script>

        <link rel="stylesheet" href="css/tweet_options.css" />
        <link href="css/bootstrap.min.css" rel="stylesheet"/>



        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript" src="js/jquery.reveal.js"></script>
        <link rel="stylesheet" href="css/reveal.css" />
        <script type="text/javascript" src="js/scrollpagination.js"></script>

        <script type="text/javascript" src="jlib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.4"></script>
        <link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.4" media="screen" />

        <script type="text/javascript" src="js/jquery.validate.js"></script>

        <script type="text/javascript" src="js/file_uploads.js"></script>
        <script type="text/javascript" src="js/vpb_script.js"></script>
        <link href='css/nprogress.css' rel='stylesheet' />
        <script src='js/nprogress.js'></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.fancybox').fancybox();
                $(".fancybox-effects-a").fancybox({
                    padding: 0,
                    closeClick : true,

                    helpers : {
                        overlay : null
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $(function(){
                $('#sidemenu a').on('click', function(e){
                    e.preventDefault();

                    if($(this).hasClass('open')) {
                        // do nothing because the link is already open
                    } else {
                        var oldcontent = $('#sidemenu a.open').attr('href');
                        var newcontent = $(this).attr('href');

                        $(oldcontent).fadeOut('fast', function(){
                            $(newcontent).fadeIn().removeClass('hidden');
                            $(oldcontent).addClass('hidden');
                        });


                        $('#sidemenu a').removeClass('open');
                        $(this).addClass('open');
                    }
                });
            });
            function basicinfos(){
                $('#basicinfo input, #basicinfo select').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).removeClass("proedits");
                    $("#"+id).addClass("textboxs");
                    $("#"+id).attr("readonly", false);
                    $("#dropdown").removeClass("dropdown");
                    $("#dropdown1").removeClass("dropdown");
                    $(".pro_button").show();
                }
            )
            }
           
            function basiccancel(){
                
                $('#basicinfo input, #basicinfo select').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).addClass("proedits");
                    $("#"+id).removeClass("textboxs");
                    $("#dropdown").addClass("dropdown");
                    $("#dropdown1").addClass("dropdown");
                    $("#"+id).attr("readonly", true);
                    $(".pro_button").hide();
                }
            )
            }
             
            function savebasicinfo(){
                var formdata = $('#basicinfo').serialize();
                var getURL = "profile_edit.php";
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       formdata,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 1)
                        {
                            alert("updated");
                            basiccancel();
                        }
                        else if(data.success == 0)
                        {
                            basiccancel();
                        }
                    }
                });
            }
            function aboutyous() {
                $('#aboutyou input, #aboutyou textarea').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).removeClass("proedits");
                    $("#"+id).addClass("p_textarea");
                    $("#"+id).attr("readonly", false);
                    //  $("#myTextArea").attr("readonly", "");
                    $(".pro_button").show();
                }
            )
            }
            function aboutyoucancel(){

                $('#aboutyou input, #aboutyou textarea').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).addClass("proedits");
                    $("#"+id).removeClass("aboutyou_p");
                    $("#"+id).attr("readonly", true);
                    $(".pro_button").hide();
                }
            )
            }
            function saveaboutyou(){
                var formdata = $('#aboutyou').serialize();
                var getURL = "profile_edit.php";
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       formdata,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 1)
                        {
                            alert("updated");
                            aboutyoucancel();
                        }
                        else if(data.success == 0)
                        {
                            aboutyoucancel();
                        }
                    }
                });
            }

            function contacts() {
                $('#contact input, #contact textarea').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).removeClass("proedits");
                    $("#"+id).addClass("textboxs");
                    $("#"+id).attr("readonly", false);
                    //  $("#myTextArea").attr("readonly", "");
                    $(".pro_button").show();
                }
            )
            }
            function contactcancel(){

                $('#contact input, #contact textarea').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).addClass("proedits");
                    $("#"+id).removeClass("textboxs");
                    $("#"+id).attr("readonly", true);
                    $(".pro_button").hide();
                }
            )
            }
            function savecontact(){
                var formdata = $('#contact').serialize();
                var getURL = "profile_edit.php";
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       formdata,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 1)
                        {
                            alert("updated");
                            contactcancel();
                        }
                        else if(data.success == 0)
                        {
                            contactcancel();
                        }
                    }
                });
            }

            function works() {
                $('#work_p input, #work_p textarea').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).removeClass("proedits");
                    $("#"+id).addClass("textboxs");
                    $("#"+id).attr("readonly", false);
                    //  $("#myTextArea").attr("readonly", "");
                    $(".pro_button").show();
                }
            )
            }
            function workcancel(){

                $('#work_p input, #work_p textarea').each(function(index){
                    var input = $(this);
                    var id = input.attr('id');
                    $("#"+id).addClass("proedits");
                    $("#"+id).removeClass("textboxs");
                    $("#"+id).attr("readonly", true);
                    $(".pro_button").hide();
                }
            )
            }
            function savework(){
                var formdata = $('#work_p').serialize();
                var getURL = "profile_edit.php";
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       formdata,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 1)
                        {
                            alert("updated");
                            workcancel();
                        }
                        else if(data.success == 0)
                        {
                            workcancel();
                        }
                    }
                });
            }
            
            $(document).ready(function()
            {
                $(".coverphoto").CoverPhoto({
                    currentImage: '<?php echo $cover_photo; ?>',
<?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) { ?>
                editable: false
<?php } else { ?>
                editable: true
<?php } ?>
        });
        $(".coverphoto").bind('coverPhotoUpdated', function(evt, dataUrl) {
            $(".coverphoto").empty();
            $("#cover_ph").val(dataUrl);
            $("<img>").attr("src", dataUrl).appendTo(".coverphoto");
            var getURL = "profile_edit.php"
            var formdata = $('#cover_phs').serialize();
            $.ajax({
                cache:      false,
                async:      false,
                type:       'post',
                data:       formdata,
                url:        getURL,
                success: function(data){
                        
                }
            });
                        
                   
        });

                
        $("#current_city").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "basic_data.php",
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
        $("#home_city").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "basic_data.php",
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
    })
           
        </script>
        <style>
            .coverphoto, .output {
                width: 988px;
                height: 280px;
                border: 0px solid black;
                margin: -1px auto;
            }
            .p_textarea{
                border: 1px solid #765942;
                border-radius: 6px;
                height: 40px;
                width: 230px;
            }
            .textboxs {
                border: 1px solid #848484;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 5px;
                outline:0;
                height:25px;
                width: 275px;
                padding-left:-3px;
                padding-right:-1px;
            }
            .proedits{
                border: 0;
                outline: none;
                outline-offset: 0;
            }
            .ba_info {
                border-collapse:separate;
                border-spacing:10px 11px;
            }
            .button {
                border:1px solid #7eb9d0;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                font-size:12px;
                font-family:arial, helvetica, sans-serif;
                padding: 6px 6px 6px 6px;
                text-decoration:none;
                display:inline-block;
                text-shadow: -1px -1px 0 rgba(0,0,0,0.3);
                font-weight:bold;
                color: #FFFFFF;
                background-color: #a7cfdf;
                background-image: -webkit-gradient(linear, left top, left bottom, from(#a7cfdf), to(#23538a));
                background-image: -webkit-linear-gradient(top, #a7cfdf, #23538a);
                background-image: -moz-linear-gradient(top, #a7cfdf, #23538a);
                background-image: -ms-linear-gradient(top, #a7cfdf, #23538a);
                background-image: -o-linear-gradient(top, #a7cfdf, #23538a);
                background-image: linear-gradient(to bottom, #a7cfdf, #23538a);
                filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#a7cfdf, endColorstr=#23538a);
            }
            .button:hover {
                border-top-color: #28597a;
                background: #28597a;
                color: #ccc;
            }
            .dropdown {
                -webkit-appearance: none;
                -moz-appearance: none;
                padding: 2px 30px 2px 2px;
                border: none;
                -moz-appearance: none;
                text-indent: 0.01px;
                text-overflow: '';


            }
        </style>
    </head>
    <!--<div class="wrapper">
        <input type="text" />
        <button>GO</button>
    </div>-->
    <body  class="nobg">
        <?php include 'header.php'; ?>
        <div class="midwht">
            <div id="banner"><div class="coverphoto"></div></div>


            <div class="banner_band">
                <div style="border:0px solid;fload:right;"><h2 style="margin:0;"><?php echo ucfirst($user_det[0]['firstname']); ?> <?php echo ucfirst($user_det[0]['lastname']); ?></h2></div>
                
            </div>
<span class="account_verify" style="position:relative;"><img src="images/wdd_verified_account.png" width="20px" height="20px" style="float:right;" alt="Verified"/></span>
            <div class="homlft" style="margin: -134px 12px 0 0 !important;">
                <?php
                if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                ?>
                    <div class='profile_pic'>

                        <img src="uploads/<?php echo $user_det[0]['profile_pic']; ?>" alt="" style="border-radius:4px;border:2px solid white;" id="profile_img" width="200px" height="200px"/>

                    </div>
                <?
                } else {

                    include 'profilepic.php';
                }
                ?>
                
                <div class="profilelinks">
                    <ul class="mailcontent">
                        <li><a href="">Friend Request</a></li>
                        <li><a href="">Send Message</a></li>
                        <li><a href="">Photos</a></li>
                        <li><a href="">block User</a></li>
                    </ul>
                </div>
                <img src="images/leftban.jpg" alt="" width="200"/> </div>
            <div class="hommid" style="margin-top:1px;">
                <div id="w" class="clearfix">
                    <ul id="sidemenu">
                        <li>
                            <a href="#home-content" class="open"><i class="icon-home icon-large"></i><strong>Basic Info</strong></a>
                        </li>

                        <li>
                            <a href="#about-content"><i class="icon-info-sign icon-large"></i><strong>About You</strong></a>
                        </li>
                        <li>
                            <a href="#contact-content"><i class="icon-envelope icon-large"></i><strong>Work and Education</strong></a>
                        </li>

                        <li>
                            <a href="#ideas-content"><i class="icon-lightbulb icon-large"></i><strong>Contact Info</strong></a>
                        </li>


                    </ul>
                    <form name="cover_phs" id="cover_phs" class="cover_phs" action="" method="post">
                        <input type="hidden" name="segment" id="segment" value="cover" />
                        <input type="hidden" name="cover_ph" id="cover_ph" value="" />
                    </form>
                    <div id="content">
                        <div id="home-content" class="contentblock">
                            <div class="prfdet">
                                <div style="float:left;"><b>Basic Info</b></div>
                                <div style="float:right;">
                                    <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                    ?>
                                    <?php } else {
                                    ?>
                                        <a href="javascript:void(0)" onclick="basicinfos();">Edit</a>
                                    <?php } ?>
                                </div>
                                <form name="basicinfo" id="basicinfo" class="basicinfo" action="" method="post">
                                    <input type="hidden" name="segment" id="segment" value="basicinfo" />
                                    <div style="padding-top:20px;">
                                        <table class="ba_info">
                                            <tr>
                                                <td>
                                                    Firstname
                                                </td>
                                                <td>
                                                    <input type="text" name="firstname" id="firstname" value="<?php echo ucfirst($user_det[0]['firstname']); ?>" class="proedits" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Lastname
                                                </td>
                                                <td>
                                                    <input type="text" name="lastname" id="lastname" value="<?php echo ucfirst($user_det[0]['lastname']); ?>" class="proedits" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Gender
                                                </td>
                                                <td>
                                                    <?php echo ucfirst($user_det[0]['gender']); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Lives in
                                                </td>
                                                <td>
                                                    <input type="text" name="current_city" id="current_city" value="<?php echo ucfirst($current_city[0]['city']); ?> <?php echo ucfirst($current_city[0]['country']); ?>" class="proedits" readonly/>
                                                    <input type="hidden" name="current_city_id" id="current_city_id" value="<?php echo $user_det[0]['current_city']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Home
                                                </td>
                                                <td>
                                                    <input type="text" name="home_city" id="home_city" value="<?php echo ucfirst($home_city[0]['city']); ?> <?php echo ucfirst($home_city[0]['country']); ?>" class="proedits" readonly/>
                                                    <input type="hidden" name="home_city_id" id="home_city_id" value="<?php echo $user_det[0]['home_city']; ?>" />
                                                </td>
                                            </tr>
                                            <tr><?php $inter = $user_det[0]['interested']; ?>
                                                <td>
                                                    Interested In
                                                </td>
                                                <td> 
                                                    <select name="interested" id="dropdown" class="dropdown" readonly>
                                                        <option>Select</option>
                                                        <option value="Male" <?php echo $inter == 'Male' ? 'selected' : ''; ?>>Male</option>
                                                        <option value="Female" <?php echo $inter == 'Female' ? 'selected' : ''; ?>>Female</option>
                                                        <option value="Both" <?php echo $inter == 'Both' ? 'selected' : ''; ?>>Both</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Relationship
                                                </td>
                                                <td><?php $rel = $user_det[0]['relationship']; ?>
                                                    <select name="relationship" id="dropdown1" class="dropdown" readonly>
                                                        <option>Select</option>
                                                        <option value="Single" <?php echo $rel == 'Single' ? 'selected' : ''; ?>>Single</option>
                                                        <option value="Divorced" <?php echo $rel == 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                                                        <option value="Separated" <?php echo $rel == 'Separated' ? 'selected' : ''; ?>>Separated</option>
                                                        <option value="Married" <?php echo $rel == 'Married' ? 'selected' : ''; ?>>Married</option>
                                                        <option value="Open" <?php echo $rel == 'Open' ? 'selected' : ''; ?>>Open</option>
                                                        <option value="Widowed" <?php echo $rel == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                                                        <option value="Common Law" <?php echo $rel == 'Common Law' ? 'selected' : ''; ?>>Common Law</option>
                                                        <option value="Dating" <?php echo $rel == 'Dating' ? 'selected' : ''; ?>>Dating</option>
                                                        <option value="Seeing Someone" <?php echo $rel == 'Seeing Someone' ? 'selected' : ''; ?>>Seeing Someone</option>
                                                        <option value="Engaged" <?php echo $rel == 'Engaged' ? 'selected' : ''; ?>>Engaged</option>

                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Political Views
                                                </td>
                                                <td>
                                                    <input type="text" name="politicalview" id="politicalview" value="<?php echo ucfirst($user_det[0]['politicalview']); ?>" class="proedits" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Religion
                                                </td>
                                                <td>
                                                    <input type="text" name="religion" id="religion" value="<?php echo ucfirst($user_det[0]['religion']); ?>" class="proedits" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Language
                                                </td>
                                                <td>
                                                    <input type="text" name="language" id="language" value="<?php echo ucfirst($user_det[0]['language']); ?>" class="proedits" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Last login
                                                </td>
                                                <td>
                                                    <?php echo ucfirst($user_det[0]['last_login']); ?>
                                                </td>
                                            </tr>
                                            <tr style="display: none;" class="pro_button">

                                                <td colspan="2">
                                                    <input type="button" name="Save" value="Save" class="button" onclick="savebasicinfo()"/>&nbsp;&nbsp;
                                                    <input type="button" name="Cancel" value="Cancel" class="button" onclick="basiccancel()"/>
                                                </td>
                                            </tr>
                                           <!-- <tr>
                                                <td>
                                                    <input type="text" name="dob" id="dob" value="<?php echo ucfirst(Date($user_det[0]['dob']->date)); ?>" class="proedits" readonly/>
                                                </td>
                                            </tr>-->
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div><!-- @end #home-content -->
                        <div id="about-content" class="contentblock hidden">

                            <div class="prfdet">
                                <?php
                                                    if ($user_det[0]['aboutyou'] != '') {
                                                        $link = 'Edit';
                                                    } else {
                                                        $link = 'Add';
                                                    }
                                ?>
                                                    <div style="float:left;"><b>About You</b></div>
                                                    <div style="float:right;">
                                    <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                    ?>
                                    <?php } else {
                                    ?>
                                                        <a href="javascript:void(0)" onclick="aboutyous();"><?php echo $link; ?></a>
                                    <?php } ?>
                                                </div>
                                                <form name="aboutyou" id="aboutyou" class="aboutyou" action="" method="post">
                                                    <input type="hidden" name="segment" id="segment" value="aboutyou" />
                                                    <div style="padding-top:20px;">
                                                        <table class="ba_info">
                                                            <tr>
                                                                <td>
                                                                    List of Interest
                                                                </td>
                                                                <td>
                                                                    <textarea name="list_interest" id="list_interest" class="proedits" readonly/><?php echo $user_det[0]['listinterest']; ?></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Details
                                                                </td>
                                                                <td>
                                                                    <textarea name="aboutyou_p" id="aboutyou_p" class="proedits" readonly/><?php echo $user_det[0]['aboutyou']; ?></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr style="display: none;" class="pro_button">
                                                                <td colspan="2">
                                                                    <input type="button" name="Save" value="Save" class="button" onclick="saveaboutyou()"/>&nbsp;&nbsp;
                                                                    <input type="button" name="Cancel" value="Cancel" class="button" onclick="aboutyoucancel()"/>
                                                                </td>
                                                            </tr>
                                                           <!-- <tr>
                                                                <td>
                                                                    <input type="text" name="dob" id="dob" value="<?php echo ucfirst(Date($user_det[0]['dob']->date)); ?>" class="proedits" readonly/>
                                                                </td>
                                                            </tr>-->
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- @end #ideas-content -->

                                        <div id="ideas-content" class="contentblock hidden">
                                            <div class="prfdet">
                                <?php
                                                    if ($user_det[0]['phonenumber'] != '') {
                                                        $link = 'Edit';
                                                    } else {
                                                        $link = 'Add';
                                                    }
                                ?>
                                                    <div style="float:left;"><b>Work & Education</b></div>
                                                    <div style="float:right;">
                                    <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                    ?>
                                    <?php } else {
                                    ?>
                                                        <a href="javascript:void(0)" onclick="contacts();"><?php echo $link; ?></a>
                                    <?php } ?>
                                                </div>
                                                <form name="contact" id="contact" class="contact" action="" method="post">
                                                    <input type="hidden" name="segment" id="segment" value="contact" />
                                                    <div style="padding-top:20px;">
                                                        <table class="ba_info">
                                                            <tr>
                                                                <td>
                                                                    Phone
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="phonenumber" id="phonenumber" value="<?php echo $user_det[0]['phonenumber']; ?>" class="proedits" readonly/>
                                                                </td>
                                                            </tr>
