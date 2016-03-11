<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>

        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />        
        <link rel="stylesheet" href="css/marcel.css" type="text/css" />        
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/profile.js"></script>       
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />


        <link rel="stylesheet" href="js/build/coverphoto.css" />
        <script type="text/javascript" src="js/build/coverphoto.js"></script>

        <link rel="stylesheet" href="css/tweet_options.css" />
        <link href="css/bootstrap.min.css" rel="stylesheet"/>



        <script type="text/javascript" src="js/messages.js"></script>
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
        <script type="text/javascript" src="js/jquery.easydrag.js"></script>
        <link href='css/nprogress.css' rel='stylesheet' />

        <script src='js/nprogress.js' type="text/javascript"></script>
        <script type="text/javascript" src="js/wall.js"></script>
        <link rel="stylesheet" href="css/wall.css" type="text/css" />
        <script type="text/javascript" src="js/twitterhome.js"></script>

        <?php
        $session = new Session();
        if ($session->getSession('userid') != null) {
        ?>
            <script type="text/javascript" src="js/updater.js"></script>
            <script type="text/javascript" src="js/home_header.js"></script>
        <?php
        }
        ?>

        <script type="text/javascript">
            $(document).ready(function() {
                
                
                $(".blockUser").click(function(){
<?php if ($_GET['profileid'] != '') { ?>
                $result = getFriends('friend_block',<?php echo $_GET['profileid']; ?>,'');
<?php } ?>
            $('.sendFriendRequest').text($result);
        });
<?php if ($_GET['profileid'] != '') { ?>
            $(".sendFriendRequest").click(function(){
                $result = sendFriendRequest('friend_request_send',<?php echo $_GET['profileid']; ?>);
            });
<?php } ?>
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
<?php if (isset($_GET['profileid']) != '' && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) { ?>
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
    });
           
        </script>
                    <script type="text/javascript">
            function submitForm() {
                console.log("submit event");
                var fd = new FormData(document.getElementById("upload_photos"));
                fd.append("label", "WEBUPLOAD");
                $.ajax({
                    url: "wdd_ajaxupload.php",
                    type: "POST",
                    data: fd,
                    enctype: 'multipart/form-data',
                    processData: false,  // tell jQuery not to process the data
                    contentType: false   // tell jQuery not to set contentType
                }).done(function( data ) {
                    $(".wallEntries").prepend(data);
                    $(".one-photo").remove();
                    // console.log("PHP Output:");
                    // $( ".one-photo" ).empty();
                    console.log( data );
                });
                return false;
            }
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
                <h2 style="margin:0;"><?php echo ucfirst($user_det[0]['firstname']); ?> <?php echo ucfirst($user_det[0]['lastname']); ?></h2>

            </div>

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
                <div class="friendrightProfile">
                    <?php
                    // echo $mine;
                    if ($mine) {
                        $result = Friends::getFriends($entityManager, $session->getSession("userid"), 8);
                    } else {
                        $result = Friends::getFriends($entityManager, $session->getSession("profileid"), 8);
                    }
                    ?>

                    <a href="friend_list.php" ><h3 class="">Friends(<font class="totalfriends"><?php echo Friends::getNumber(); ?></font>)</h3></a>
                    <div class="friendwrap">
                        <?php echo $result; ?>
                    </div>
                </div>
                <div class="profilelinks">
                    <ul class="mailcontent">
                        <?php if (!$mine) {
                        ?>
                            <li ><a class="sendFriendRequest"><?php echo Friends::isFriendText($entityManager, $session->getSession('userid'), base64_decode($_GET['profileid'])) ?> </a><img src="images/drop.png" id="confirmLink" style="cursor: pointer;"></img>
                            <?php // if (Friends::WhoSendRequest($entityManager, $_GET['profileid'], $session->getSession('userid') == "1")) {  ?>
                            <!--                                    <div class="menuConfirm" id="itemMenuConfirm">
                                                                    <ul id="itemMenuConfirm">
                                                                        <li id="itemMenuConfirm" onclick="friendsAction('friend_confirm',<?php // echo '\'' + $_GET['profileid'] + '\'';     ?>  , '');">Confirm </li>
                                                                        <li id="itemMenuConfirm" onclick="friendsAction('friend_ignore',<?php // echo '\'' + $_GET['profileid'] + '\'';     ?>  , '');">Ignore Request </li>
                                                                    </ul>
                                                                </div>-->
                            <?php // }  ?>
                        </li>
                        <li class="blockUser"><a >block User</a></li>
                        <li><a href="">Send Message</a></li>
                        <?php } ?>
                        <li><a href="album.php">Photos</a></li>

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
                                                            <tr style="display: none;" class="pro_button">
                                                                <td>
                                                                    <input type="button" name="Save" value="Save" class="button" onclick="savecontact()"/>&nbsp;&nbsp;
                                                                    <input type="button" name="Cancel" value="Cancel" class="button" onclick="contactcancel()"/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- @end #about-content -->



                                        <div id="contact-content" class="contentblock hidden">
                                            <div class="prfdet">
                                <?php
                                                    if ($user_det[0]['work'] != '') {
                                                        $link = 'Edit';
                                                    } else {
                                                        $link = 'Add';
                                                    }
                                ?>
                                                    <div style="float:left;"><b>Contact Info</b></div>
                                                    <div style="float:right;">
                                    <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                    ?>
                                    <?php } else { ?>
                                                        <a href="javascript:void(0)" onclick="works();"><?php echo $link; ?></a>
                                    <?php } ?>
                                                </div>
                                                <form name="work_p" id="work_p" class="work_p" action="" method="post">
                                                    <input type="hidden" name="segment" id="segment" value="work" />
                                                    <div style="padding-top:20px;">
                                                        <table class="ba_info">
                                                            <tr>
                                                                <td>
                                                                    Education
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="work" id="work" value="<?php echo $user_det[0]['work']; ?>" class="proedits" readonly/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Work
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="education" id="education" value="<?php echo $user_det[0]['education']; ?>" class="proedits" readonly/>
                                                                </td>
                                                            </tr>
                                                            <tr style="display: none;" class="pro_button">
                                                                <td colspan="2">
                                                                    <input type="button" name="Save" value="Save" class="button" onclick="savework()"/>&nbsp;&nbsp;
                                                                    <input type="button" name="Cancel" value="Cancel" class="button" onclick="workcancel()"/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- @end #contact-content -->

                                    </div><!-- @end #content -->
                                </div>


                                <div class="profilecontent">
                                    <div class="hommid">

                        <?php
                                                    if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                                        include 'psocialmenu.php';
                                                    } else {
                        ?>
                        <?php include 'socialmenu.php'; ?>
                        <?php } ?>

                                                    <div id="post_box">
                                                        <input type="hidden" name="current_url" id="current_url" value="<?php echo $cur_url; ?>" />
                                                        <input type="hidden" name="page_url" id="page_url" value="<?php echo $url; ?>" />
                                                        <input type="hidden" name="pcurrent_url" id="pcurrent_url" value="<?php echo $pcur_url; ?>" />
                                                        <input type="hidden" name="current_tscreen" id="current_tscreen" value="<?php echo $screenname; ?>" />
                                                        <input type="hidden" name="current_tid" id="current_tid" value="<?php echo $twitterid; ?>" />
                                                        <form id="vasPLUS_Programming_Blog_Form" method="post" enctype="multipart/form-data" action="tweet_image.php">
                                                            <div class="TwtrPostWall">
                                                                <textarea  class="form-control none-radiusP" name="updateme" id="updateme" rows="2">Whats in your head?</textarea>

                                                            </div>
                                                            <div class="UploadIMage-n-post">
                                                                <div class="vasplusfile_adds"><input type="file" name="vasPhoto_uploads" id="vasPhoto_uploads" style="opacity:0;-moz-opacity:0;z-index:9999;width:90px;padding:5px;cursor:default;" /></div>

                                                                <button type="button" class="btn-primaryX" onclick="posttweet()">POST</button>
                                                                <div id='vasPhoto_uploads_Status'></div>
                                                                <!-- <div class="dgry">
                                                                     <div class="picon"><input type="file" name="photoimg" id="photoimg" value="" /></div>
                                                                     <input type="button" class="btn-primaryX" value="post" onclick="posttweet()"/>
                                                                 </div>-->
                                                            </div>

                                                        </form>
                                                        <div id='preview'></div>
                                                    </div>
                                                    <div id="wall_post_box" style="display:none;">
                                                        <form action="wdd_ajaxupload.php" id="upload_photos" method="post" onsubmit="return submitForm();">
                                                            <textarea name="status" class="grybord">Whats in your head?</textarea>
                                                            <div id="link_info"></div>
                                                            <div class="clear"></div>
                                                            <div id="picture">
                                                                <h3>Use the form below to add photos.</h3>
                                                                <div class="one-photo">
                                                                    <input class="fileUpload" type="file" name="photo_0" />
                                                                    <div class="removePhoto">remove</div>
                                                                    <div class="preview"></div>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <div class="dgry">
                                                                <div class="picon"><a href="#"> <img src="images/photoicon.png" alt="" /></a> </div>
                                                                <input type="submit" class="postbutton" value="post" />
                                                            </div>
                                                        </form>
                                                    </div>
                        <?php
                                                    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

                                                    $user_info = $connection->get('https://api.twitter.com/1.1/account/verify_credentials.json', array("include_entities" => true, "include_rts" => true, "contributor_details" => true));
                                                    if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                                        $live_timeline = $connection->get('statuses/user_timeline', array('screen_name' => $screenname, "count" => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));
                                                    } else {
                                                        $live_timeline = $connection->get('https://api.twitter.com/1.1/statuses/home_timeline.json', array('screen_name' => $screenname, 'count' => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));
                                                    }
                                                    //echo '<pre>';
                                                    //print_r($user_info);
                        ?><?php if ($screen_length != 0) {
                        ?>
                                                        <div class="twt-wall-tw-info-title">
                                                            <div class="TwtLogo">
                                                                <a href="#"><img src="images/twitter-logo.png"></a>
                                                               <!-- <span>@<?php //echo $user_info->screen_name;                     ?></span>-->
                                                            </div>
                            <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                            ?>

                            <?php } else {
                            ?>
                                                            <div class="HomeTwBtn"><a href='javascript:void(0)' onclick='load_index();'>Home</a></div>
                            <?php } ?>
                                                        <div class="TweetsQntty">
                                                            <a href='javascript:void(0)' onclick='load_connect();'>
                                    <?php echo $user_info->statuses_count; ?> <br/>
                                                        Tweets</a>
                                                </div>
                                                <div class="FollowingQntty TweetsQntty">
                                                    <a href='javascript:void(0)' onclick='<?php echo $function_following; ?>'><?php echo $user_info->friends_count; ?> <br/>
                                                        Following</a></div>
                                                <div class="FollowerQntty TweetsQntty">
                                                    <a href='javascript:void(0)' onclick='<?php echo $function_followers; ?>'><?php echo $user_info->followers_count; ?> <br/>
                                                        Follwers </a></div>
                                                <div class="Favorites TweetsQntty">
                                                    <a href='javascript:void(0)' onclick="<?php echo $function_fav; ?>"><?php echo $user_info->favourites_count; ?> <br/>
                                                        Favorites</a></div>
                                                <div class="Mentions TweetsQntty">&nbsp; <br/><a href='javascript:void(0)' onclick='<?php echo $function_mention; ?>'>Mentions</a></div>
                                                <!--<div class="UserTimeline TweetsQntty">&nbsp; <br/><a href='javascript:void(0)' onclick='load_connect();'>UserTimeline</a></div>-->
                                            </div>
                        <?php } ?>
                                                    <div class="wrapper" id="postedComments" style="display:block;">
                                                        <div style="positive: relative; margin: 0px auto;width: 100px; height: 20px;">
                                                            <div class="demo-cb-tweets" style="text-align:center;position:fixed;"></div>
                                                        </div>
                            <?php
                                                    //echo '<div class="welcome_txt">Welcome <strong>' . $screenname . '</strong> (Twitter ID : ' . $twitterid . '). <a href="index.php?reset=1">Logout</a>!</div>';
//echo '<pre>';
//print_r($live_timeline);
                                                    // echo '<div class="tweet_box">';
                                                    // echo '<form id="imageform" method="post" enctype="multipart/form-data" action="tweet_image.php">';
                                                    // echo '<table><tr>';
                                                    // echo '<td colspan="2"><textarea name="updateme" id="updateme" cols="60" rows="4"></textarea></td>';
                                                    // echo '</tr>';
                                                    // echo '<tr><td>';
                                                    // echo '<input type="file" name="photoimg" id="photoimg" value="" />';
                                                    //  echo '</td>';
                                                    //  echo '<td><input type="button" value="Tweet" onclick="posttweet()"/></td>';
                                                    //  echo '</tr></table>';
                                                    //  echo '</form>';
                                                    //  echo "<div id='preview'></div>";
                                                    // echo '</div>';
                                                    if ($screen_length != 0) {
                                                        if ($live_timeline->errors[0]->message == '') {
                                                            echo '<input type="hidden" name="twitter_condition" id="twitter_condition" value="' . $twitt_val . '" />';
                                                        } else {
                                                            echo '<center><h3><b>Time limit exceed please try after some times.</b></h3></center>';
                                                        }
                                                    }
                                                    //echo "<div id='menu' style='padding: 15px 7px 15px 22px;'>";
                                                    //echo "<ul>";
                                                    //echo "<li><a href='javascript:void(0)' onclick='load_index();'>HOME</a></li>";
                                                    //echo "<li><a href='javascript:void(0)' onclick='load_connect();'>USER TIMELINE</a></li>";
                                                    //echo "<li><a href='javascript:void(0)' onclick='load_mentions();'>MENTIONS</a></li>";
                                                    //  echo "<li><a href='javascript:void(0)' onclick='load_followers();'>FOLLOWERS</a></li>";
                                                    // echo "<li><a href='javascript:void(0)' onclick='load_following();'>FOLLOWING</a></li>";
                                                    // echo '<li><button title="Direct messages" type="button" class="btn dm-button" style="padding: 1px 28px; !important;width:25px;" onclick="load_dm();">  <i class="dm-envelope"><span class="dm-new"></span></i></button></li>';
                                                    //  echo "</ul>";
                                                    // echo "</div>";
                                                    // $live_timeline = $connection->get('statuses/home_timeline', array('screen_name' => $screen_name, 'count' => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true,"since_id" => "309224665145028608"));
                                                    echo '<div class="tweet_count_dis"></div>';

                                                    $user_info = $connection->get('account/verify_credentials', array("include_entities" => true, "include_rts" => true, "contributor_details" => true));
                            ?>
                                                    <script>
                                                        //document.body.style.background="#f3f3f3 url('<?php //echo $user_info->profile_background_image_url;                    ?>') no-repeat fixed 100% 100%";
                                                        //document.body.style.height = "100%";
                                                    </script>
                            <?php
                                                    echo '<div class="tweet_list" id="tweet_list">';
                                                    echo '<div class="home_timeline">';
                                                    $tweet_count = count($live_timeline) - 1;
                                                    echo '<input type="hidden" name="tcount" id="tcount" value="' . $tweet_count . '" />';
                                                    echo '<input type="hidden" name="oauthscreen_name" id="oauthscreen_name" value="' . $screenname . '" />';
                                                    if ($screen_length != 0) {
                                                        foreach ($live_timeline as $k => $my_tweet) {

                                                            $media_flag = '';
                                                            $image_are = '';
                                                            $conversation = '';
                                                            $RT_link = '';
                                                            $Delete_link = '';
                                                            $fav = '';
                                                            $RT = '';
                                                            $disp_url = '';
                                                            echo "<input type='hidden' name='tweet_id$k' id='tweet_id$k' value='$my_tweet->id_str'>";
                                                            echo "<input type='hidden' name='screen_name$k' id='screen_name$k' value='" . $my_tweet->user->screen_name . "'>";
                                                            echo "<input type='hidden' name='uretweet_id$k' id='uretweet_id$k' value='" . $my_tweet->current_user_retweet->id_str . "'>";

                                                            if ($my_tweet->retweeted_status->id == '') {

                                                                echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='$my_tweet->id_str'>";

                                                                if ($twitterid == $my_tweet->user->id_str && $_GET['profileid'] == '') {
                                                                    $Delete_link = '<a href="javascript:void(0);" onclick="delete_tweet(' . $k . ')"><i class="sm-trash"></i><b>Delete</b></a>';
                                                                }

                                                                if ($my_tweet->current_user_retweet->id_str != '') {
                                                                    $RT = 'retweeted';
                                                                    $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
                                                                } else {
                                                                    $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
                                                                }
                                                                if ($my_tweet->favorited != '') {
                                                                    $fav = 'favorited';
                                                                    $Fav_link = '<a href="javascript:void(0);" onclick="undofavorite_tweet(' . $k . ')"><i class="sm-fav"></i><b>Favorited</b></a>';
                                                                } else {
                                                                    $Fav_link = '<a href="javascript:void(0)" onclick="favorite(' . $k . ')"><i class="sm-fav"></i><b>Favorite</b></a>';
                                                                }
                                                                if ($my_tweet->entities->urls[0]->display_url != '') {
                                                                    $disp_url = $my_tweet->entities->urls[0]->display_url;
                                                                } else if ($my_tweet->entities->media[0]->display_url != '') {
                                                                    $disp_url = $my_tweet->entities->media[0]->display_url;
                                                                }
                                                                echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->in_reply_to_status_id_str . "'>";
                                                                $text = htmlentities($my_tweet->text, ENT_QUOTES, 'utf-8');
                                                                $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
                                                                $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);

                                                                $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
                                                                echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

                                                                echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
                                                                echo '<i class="dogear"></i>';
                                                                echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></a></div>";
                                                                echo '<div class="tweet-content">';
                                                                echo '<div class="stream-item-header">';
                                                                echo '<b>' . $my_tweet->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->user->screen_name . '</a></span></span>';
                                                                echo '</div>';
                                                                echo $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                                                                echo '<div class="tweet-counts"></div>';
                                                                echo '</div>';



                                                                //Popup
                                                                echo '<div id="myModals' . $k . '" class="reveal-modal">';
                                                                echo "<div class='tweet-pic'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></div>";
                                                                echo '<div class="tweet-content">' . $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                                                                echo '<input type="button" name="retweet" value="Retweet" onclick="retweet(' . $k . ')" class="tweet-rt">';
                                                                echo '<a class="close-reveal-modal">&#215;</a></div>';


                                                                if ($my_tweet->in_reply_to_status_id_str != '') {

                                                                    $conversation = '<span  id="replied' . $k . '"><a href="javascript:void(0)" onclick="getReplies(' . $k . ')">  <span class="details-icon js-icon-container">
                                             <i class="sm-chat"></i>
                                                </span><b>
                                                  <span class="expand-stream-item js-view-details">
                                                    View conversation
                                                  </span>
                                                </b></a></span>';
                                                                }
                                                                $imge_id = explode('/', $my_tweet->entities->urls[0]->display_url);
                                                                $vid = explode('/', $my_tweet->entities->urls[0]->expanded_url);
                                                                $ct = count($vid) - 1;
                                                                $video_id = explode('=', $vid[$ct]);
                                                                if ($my_tweet->entities->media[0]->id_str != '') {
                                                                    $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                                                    $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='" . $my_tweet->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->entities->media[0]->media_url . "' width='" . $my_tweet->entities->media[0]->sizes->small->w . "px' height='" . $my_tweet->entities->media[0]->sizes->small->h . "px'></a></div>";
                                                                } else if ($imge_id[0] == 'twitpic.com') {
                                                                    $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                                                    $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
                                                                } else if ($imge_id[0] == 'yfrog.com') {
                                                                    $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                                                    $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
                                                                } else if ($imge_id[0] == 'youtube.com') {
                                                                    $len = count($video_id) - 1;
                                                                    $video_ids = $video_id[$len];
                                                                    $ch = curl_init();
                                                                    curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" . $video_id[$len]);
                                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                    $feed = curl_exec($ch);
                                                                    curl_close($ch);
                                                                    $xml = simplexml_load_string($feed);
                                                                    $entry = $xml->entry[0];
                                                                    $media = $entry->children('media', true);
                                                                    $group = $media[0];
                                                                    $title = $group->title;
                                                                    $desc = $group->description;

                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><object width='425' height='349' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                                                                            "<br><b>" . $title . "</b><br>" .
                                                                            "<b>" . $desc . "</b><br>"
                                                                            . "</div>";
                                                                } else if ($imge_id[0] == 'vine.co') {
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
                                                                            "<br><b>" . $title . "</b><br>" .
                                                                            "<b>" . $desc . "</b><br>"
                                                                            . "</div>";
                                                                }
                                                                echo '<div class="tweet-options"><a href="javascript:void(0);" onclick="displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $Delete_link . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;' . $Fav_link . '&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
                                 <b>Reply</b></a>';
                                                                echo '</div>';
                                                                echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
                                                                echo $image_are;
                                                                echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
                                                                echo '<table><tr>';
                                                                $mentions = '';
                                                                for ($jk = 0; $jk < count($my_tweet->entities->user_mentions); $jk++) {
                                                                    $mentions .= '@' . $my_tweet->entities->user_mentions[$jk]->screen_name . ' ';
                                                                }
                                                                echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->user->screen_name . ' ' . $mentions . '</textarea></td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td align="right"><input type="button" value="Tweet" onclick="reply(' . $k . ')"/></td>';
                                                                echo '</tr></table>';
                                                                echo '</div>';
                                                                echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
                                                                echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";


                                                                echo '</div>';
                                                            } else {
                                                                echo "<input type='hidden' name='rtweet_id$k' id='rtweet_id$k' value='" . $my_tweet->retweeted_status->id_str . "'>";
                                                                //  echo $my_tweet->retweeted_status->current_user_retweet->id_str;
                                                                if ($my_tweet->current_user_retweet->id_str != '') {
                                                                    $RT = 'retweeted';
                                                                    $RT_link = '<a href="javascript:void(0);" onclick="destory_tweet(' . $k . ')"><i class="sm-rt"></i><b>Retweeted</b></a>';
                                                                } else {
                                                                    $RT_link = '<a href="#" class="big-link" data-reveal-id="myModals' . $k . '" data-animation="none"><i class="sm-rt"></i><b>Retweet</b></a>';
                                                                }
                                                                if ($my_tweet->retweeted_status->entities->urls[0]->display_url != '') {
                                                                    $disp_url = $my_tweet->retweeted_status->entities->urls[0]->display_url;
                                                                } else if ($my_tweet->retweeted_status->entities->media[0]->display_url != '') {
                                                                    $disp_url = $my_tweet->retweeted_status->entities->media[0]->display_url;
                                                                }
                                                                echo "<input type='hidden' name='reply_to_status_id$k' id='reply_to_status_id$k' value='" . $my_tweet->retweeted_status->in_reply_to_status_id_str . "'>";
                                                                $text = htmlentities($my_tweet->retweeted_status->text, ENT_QUOTES, 'utf-8');
                                                                $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
                                                                $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" class="fancybox fancybox.ajax">@$1</a>', $text);
                                                                $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
                                                                echo '<div class="tweet-outer" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

                                                                echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';

                                                                echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet->retweeted_status->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></a></div>";

                                                                echo '<div class="tweet-content">';
                                                                echo '<div class="stream-item-header">';
                                                                echo '<b>' . $my_tweet->retweeted_status->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->retweeted_status->user->screen_name . '" class="fancybox fancybox.ajax"><span>@' . $my_tweet->retweeted_status->user->screen_name . '</span></a></span>';
                                                                echo '</div>';
                                                                echo $text . ' <br />-<span>' . $my_tweet->retweeted_status->created_at . '</span></div>';
                                                                echo '<div class="tweet-counts">Retweet By ' . $my_tweet->user->name;
                                                                echo '</div>';
                                                                echo '</div>';



                                                                echo '<div id="myModals' . $k . '" class="reveal-modal">';
                                                                echo "<div class='tweet-pic'><img src='" . $my_tweet->retweeted_status->user->profile_image_url . "' title='" . $my_tweet->retweeted_status->user->name . "' class='profile_pic'></div>";
                                                                echo '<div class="tweet-content">' . $text . ' <br />-<i>' . $my_tweet->retweeted_status->created_at . '</i></div>';
                                                                echo '<a href="javascript:void(0)" onclick="retweet(' . $k . ')"  class="tweet-rt">Retweet</a>';
                                                                echo '<a class="close-reveal-modal">&#215;</a></div>';

                                                                if ($my_tweet->retweeted_status->in_reply_to_status_id_str != '') {

                                                                    $conversation = '<a href="javascript:void(0)" id="replied' . $k . '" onclick="getReplies(' . $k . ')">  <span class="details-icon js-icon-container">
                                         <i class="sm-chat"></i>
                                             </span>
                                                 <b>
                                                    <span class="expand-stream-item js-view-details">
                                                        View conversation
                                                    </span>

                                                 </b></a>';
                                                                }

                                                                $imge_id = explode('/', $my_tweet->retweeted_status->entities->urls[0]->display_url);
                                                                $vid = explode('/', $my_tweet->retweeted_status->entities->urls[0]->expanded_url);
                                                                $ct = count($vid) - 1;
                                                                $video_id = explode('=', $vid[$ct]);

                                                                if ($my_tweet->retweeted_status->entities->media[0]->id_str != '') {
                                                                    $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                                                    $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' width='" . $my_tweet->retweeted_status->entities->media[0]->sizes->small->w . "px' height='" . $my_tweet->retweeted_status->entities->media[0]->sizes->small->h . "px'></a></div>";
                                                                } else if ($imge_id[0] == 'twitpic.com') {
                                                                    $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                                                    $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
                                                                } else if ($imge_id[0] == 'yfrog.com') {
                                                                    $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                                                    $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium'' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
                                                                } else if ($imge_id[0] == 'youtube.com') {
                                                                    $len = count($video_id) - 1;
                                                                    $video_ids = $video_id[$len];
                                                                    $ch = curl_init();
                                                                    curl_setopt($ch, CURLOPT_URL, "http://gdata.youtube.com/feeds/api/videos?q=" . $video_id[$len]);
                                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                    $feed = curl_exec($ch);
                                                                    curl_close($ch);
                                                                    $xml = simplexml_load_string($feed);
                                                                    $entry = $xml->entry[0];
                                                                    $media = $entry->children('media', true);
                                                                    $group = $media[0];
                                                                    $title = $group->title;
                                                                    $desc = $group->description;

                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><object width='425' height='349' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                                                                            "<br><b>" . $title . "</b><br>" .
                                                                            "<b>" . $desc . "</b><br>"
                                                                            . "</div>";
                                                                } else if ($imge_id[0] == 'vine.co') {
                                                                    $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                                    $image_are = "<div class='tweet-medias' id='yfrog$k' style='display:none;'><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
                                                                            "<br><b>" . $title . "</b><br>" .
                                                                            "<b>" . $desc . "</b><br>"
                                                                            . "</div>";
                                                                }
                                                                echo '<div class="tweet-options"><a href="javascript:void(0);" onclick = "displayRetweeters(' . $k . ')" id="retweet_img' . $k . '">Expand</a><a href="javascript:void(0)" onclick="hideRetweeters(' . $k . ')"  id="hretweet_img' . $k . '" style="display:none;">Collapse</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayConversation(' . $k . ')"  id="hreplied' . $k . '" style="display:none;">Hide Conversation</a>' . $conversation . '&nbsp;&nbsp;&nbsp;' . $RT_link . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="favorite(' . $k . ')"><i class="sm-fav"></i><b>Favorite</b></a>&nbsp;&nbsp;&nbsp;' . $media_flag . '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="displayreply(' . $k . ')"><i class="sm-reply"></i>
                             <b>Reply</b></a>';
                                                                echo '</div>';
                                                                echo "<div class='tweet-retweeters' id='tweet-retweeters$k' style='display:none;'></div>";
                                                                echo $image_are;
                                                                echo "<div class='tweet-reply' id='tweet-reply$k' style='display:none;'>";
                                                                echo '<table><tr>';
                                                                $mentions = '';
                                                                for ($jk = 0; $jk < count($my_tweet->retweeted_status->entities->user_mentions); $jk++) {
                                                                    $mentions .= '@' . $my_tweet->retweeted_status->entities->user_mentions[$jk]->screen_name . ' ';
                                                                }
                                                                echo '<td><textarea name="reply_message' . $k . '" id="reply_message' . $k . '" cols="60" rows="4">@' . $my_tweet->retweeted_status->user->screen_name . ' ' . $mentions . '</textarea></td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td align="right"><input type="button" value="Tweet" onclick="reply(' . $k . ')"/></td>';
                                                                echo '</tr></table>';
                                                                echo '</div>';
                                                                echo "<div class='rtweet-replies' id='rtweet-replies$k' style='display:none;'></div>";
                                                                echo "<div class='tweet-replied' id='tweet-replied$k' style='display:none;'></div>";

                                                                echo '</div>';
                                                            }
                                                        }
                                                    }
                                                    echo ' <div id="loadorders"></div>';
                                                    echo '<div id="loadMoreComments" style="display:none;" ></div>';
                                                    echo '</div></div></div>';
                            ?>

                                                    <div id="loadmoreajaxloader" style="display:none;"><center><img src="images/ajax-loader.gif" /></center></div>
                                                </div>


                                                <div id="userwall" class="userwall" style="display:none;">
                                                    <div class="wallEntries">

                                <?php
                                                    $postids = 0;
//echo '<pre>';
//print_r($entries);
                                                    foreach ($entries as $entry) {
                                                        //echo $entry['id'];
                                                        $userdetails = WallModel::getUserDetails($entityManager, $entry['user_id']);
                                ?>

                                                        <div class="crispbx crispbxmain" id="wall<?php echo $entry['id']; ?>" data="<?php echo $entry['id']; ?>" data-count="<?php echo $postids; ?>">
                                                            <img src="uploads/<?php echo $userdetails[0]['profile_pic']; ?>" alt="" width="50px;" height="45px;" style="border-radius:4px; "/>
                                                            <div class="crispcont">
                                                                <h2><?php echo $userdetails[0]['firstname'] ?> <?php echo $userdetails[0]['lastname'] ?></h2>
                                                                <p class="status-text"><?php echo Functions::addLink($entry['text']) ?></p>
                                        <?php if (strlen($entry['link']) > 0) {
                                        ?>
                                                            <div class="link_container">
                                            <?php if (strlen($entry['link_photo']) > 0): ?>
                                                                <img src="<?php echo $entry['link_photo'] ?>" alt="" />
                                            <?php endif ?>
                                                                <div class="clear"></div>
                                                                <p><a target="_blank" href="<?php echo $entry['link'] ?>"><?php echo $entry['link_title'] ?></a></p>
                                                                <p><?php echo $entry['link_description'] ?></p>
                                                                <div class="clear"></div>
                                                            </div>
                                        <?php } ?>

                                        <?php if (!empty($entry['photos'])) {
                                        ?>
                                                                <div class="crispbx">
                                                                    <div class="crispcont">

                                                                        <p><?php echo count($entry['photos']) ?> photos uploaded</p>
                                                                        <div class="upimgwrap">

                                                                            <div class="big-photo-container">
                                                                                <a class="fancybox" href="resizer.php?file=<?php echo $entry['photos'][0]['file'] ?>">
                                                                                    <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  class="upbigimg"/>
                                                                                </a>
                                                                            </div>
                                                                            <div class="upsmimg">
                                                        <?php
                                                                foreach ($entry['photos'] as $key => $photo) {
                                                                    if ($key == 0)
                                                                        continue;
                                                        ?>
                                                                    <div class="small-photo-container">
                                                                        <a class="fancybox" href="resizer.php?file=<?php echo $photo['file'] ?>">
                                                                            <img src="uploads/<?php echo $photo['file'] ?>" alt="" />
                                                                        </a>
                                                                    </div>
                                                        <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php } ?>

                                                            <div class="likemenu">
                                                                <ul>
                                                                    <li><a href="#">Like</a></li>
                                                                    <li><a class="add-comment-link" rel="<?php echo $entry['id'] ?>" href="#">Comment</a></li>
                                                                    <li><a href="#">Share</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="clear"></div>
                                                            <div class="comment-section" id="comment_<?php echo $entry['id'] ?>" style="display:none;">
                                            <?php //echo '<pre>'; print_r($entry['comments']); ?>
                                            <?php
                                                            foreach ($entry['comments'] as $comment):
                                                                $cuserdetails = WallModel::getUserDetails($entityManager, $comment['author_id']);
                                                                //echo '<pre>'; print_r($cuserdetails);
                                            ?>
                                                                <div class="comment-block">
                                                                    <img src="uploads/<?php echo $cuserdetails[0]['profile_pic']; ?>" alt="<?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?>" width="50px;" height="45px;" style="border-radius:4px;">
                                                                        <div class="comment-content">
                                                                            <h2><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></h2>
                                                                            <p><?php echo Functions::addLink($comment['text']) ?></p>
                                                                            <i><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></i>

                                                                        </div>
                                                                        <div class="clear"></div>
                                                                </div>
                                            <?php endforeach ?>
                                                            </div>
                                                            <div class="add-comment" rel="<?php echo $entry['id'] ?>">
                                                                <form rel="<?php echo $entry['id'] ?>" id="commform_<?php echo $entry['id'] ?>" action="" method="post" enctype="multipart/form-data">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td width="10%"><img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" width="40px;" height="35px;" style="border-radius:4px; "/></td>
                                                                            <td width="90%"><textarea placeholder="Start typing your comment here" class="grybord" id="wallcomment" name="comment"></textarea></td>
                                                                        </tr>
                                                                    </table>
                                                                    Photo: <input rel="<?php echo $entry['id'] ?>" type="file" name="photo" />
                                                                    <input name="post_id" type="hidden" value="<?php echo $entry['id'] ?>" />
                                                                    <input type="button" class="postbutton-comments" id="<?php echo $entry['id'] ?>" value="post" />
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>

                                <?php
                                                                $postids++;
                                                            }
                                ?>

                                <div id="loadorders"></div>
                                <div id="loadMoreComments" style="display:none;" ></div>
                                                                                      <!--<iframe id="wall-iframe" scrolling="no" frameborder="0" src="wall-itself.php"></iframe>-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>      
    </body>
</html>
<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

</script>