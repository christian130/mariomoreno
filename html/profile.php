


<!DOCTYPE html>
<html class="no-js" lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>








        <link rel="stylesheet" href="css/1reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/1style.css" type="text/css" />        
        <link rel="stylesheet" href="css/1marcel.css" type="text/css" />        
        <script type="text/javascript" src="js/1jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/profile.js"></script>       
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/1wall.css" type="text/css" />
    <link type="text/css" rel="stylesheet" href="css/tab/1style.css" />
 <link type="text/css" rel="stylesheet" href="css/tab/1responsive-tabs.css" /> 





        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />


       <!-- <link rel="stylesheet" href="js/build/coverphoto.css" />
        <script type="text/javascript" src="js/build/coverphoto.js"></script>-->

        <link rel="stylesheet" href="css/1tweet_options.css" />
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
        <link href='css/nprogress.css' rel='stylesheet' />
        <script src='js/nprogress.js'></script>

        <script type="text/javascript" src="js/jquery.colorbox.js"></script>
         <link rel="stylesheet" href="css/colorbox.css" type="text/css" />




       


       
<!-- Java Scripts & Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>





            <link rel="stylesheet" href="css/1tweet_options.css" />

 <script type="text/javascript" src="js/jquery.validate.js"></script>

            <script type="text/javascript" src="js/file_uploads.js"></script>
            <script type="text/javascript" src="js/vpb_script.js"></script>
            <link href='css/1nprogress.css' rel='stylesheet' />
            <script src='js/nprogress.js'></script>

          <script type="text/javascript" src="js/1jquery.colorbox.js"></script>
            <link rel="stylesheet" href="css/1colorbox.css" type="text/css" />
<link href="css/Tweetstyle.css" rel="stylesheet" type="text/css" />


    <link href="img/favicon.ico" type="image/x-icon" rel="shortcut icon">	
	        <script type="text/javascript" src="js/profile.js"></script>       

	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">	
	
	<link rel="stylesheet" href="css/1normalize.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">	
	
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
	
		
	<link rel="stylesheet" href="css/profilestyle.css">
	
	<link rel="stylesheet" href="css/responsive.css">
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>





 <link href='css/1nprogress.css' rel='stylesheet' />
            <script src='js/nprogress.js'></script>

            <script type="text/javascript" src="js/1jquery.colorbox.js"></script>
            <link rel="stylesheet" href="css/1colorbox.css" type="text/css" />


            <script type="text/javascript">
                $(document).ready(function() {
                    $(".wall_popup").colorbox({
                        rel:'wall_popup'});  });

            </script>

            <?php
            $session = new Session();
            if ($session->getSession('userid') != null) {
            ?>
                <script type="text/javascript" src="js/updater_remove.js"></script>
                <script type="text/javascript" src="js/updater.js"></script>
                <script type="text/javascript" src="js/home_header.js"></script>
            <?php
            }
            ?>

            <script type="text/javascript">
                $(document).ready(function() {
         
                    $(".orginal_profilepic").colorbox({
                        fixed:true,
                        scrolling:false,
                        rel:'orginal_profilepic'});
                    $(document).bind('cbox_open', function() {
                        $('html').css({ overflow: 'hidden' });
                    }).bind('cbox_closed', function() {
                        $('html').css({ overflow: '' });
                    });
                    $(".blockUser").click(function(){
                        $result = getFriends('friend_block',<?php echo base64_decode($_GET['profileid']); ?>,'');
                        $('.sendFriendRequest').text($result);
                    });
<?php // if(Friends::WhoSendRequest($entityManager, $_GET['profileid'],$_SESSION['userid'])=='0'){  ?>
            $(".sendFriendRequest").click(function(){   window.alert = function() {};
                $( this ).replaceWith( "<div style='color:#fff;'>" + "Friend Request Sent" + "</div>" );
                $result = sendFriendRequest('friend_request_send',<?php echo base64_decode($_GET['profileid']); ?>);
            });
<?php // }  ?>
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
                    alert('press ok to start');
                    var formdata = $('#contact').serialize();
                    var getURL = "profile_edit.php";
                    $.ajax({
                        cache:      false,
                        async:      false,
                        type:       'post',
                        data:       formdata,
                        url:        getURL,
                        success:    function(msg){
                            alert(msg);
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



<style>
.space
{
margin-top:10px;
margin-bottom:10px;
}
            </style>

<script type="text/javascript">
 $(document).ready(function () {
                $('.tweet-outer').click(function(){

$(this).addClass("space");

});

}
</script>

            <style>





.twt-wall-tw-info-title {
    background: #fff;
    border-radius: 0px;
height:80px;
border:1px solid #ccc;
}

.TwtLogo {
background: #23BBF4;
    padding: 5px;
}

.FollowingQntty  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}
.TweetsQntty1
 {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}

.FollowerQntty  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}

.Favorites  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}


.Mentions  {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}

.HomeTwBtn {
    width: 16.6%;
    float: left;
    height: 30px;
    color: #333;
    padding: 5px;
}
.twt-wall-tw-info-title a {
    color: #333;
    font-weight: bold;
}

                .coverphoto, .output {
                    width: 1010px;
                    height: 280px;
                    border: 0px solid black;
                    margin: -1px auto;
                }
                .p_textarea{
                    border: 1px solid red;
                    border-radius:2px;
                    height: 40px;
                    width: 230px;

                }
                .textboxs {

                    -webkit-border-radius: 10px;
                    -moz-border-radius: 10px;
                    border-radius: 0px;
                    outline:0;
                    height:19px;
                   // width:100%;
                    padding-left:-3px;
                    padding-right:-1px;

                    border: 1px solid red;


                }
                .proedits{
                    border: 0;
                    outline: none;
                    //width: 100%;
                    word-break: break-word;

                }
                .ba_info {
                    //border-collapse:separate;
                    border-spacing:16px 11px;
                    width: 430px;
                    margin:5px;
                }
.reveal-modal {
    visibility: hidden;
    top: 100px;
    left: 50%;
    margin-left: -300px;
    width: 520px;
    background: #fff;
    position: absolute;
    z-index: 101;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 0 10px rgba(0,0,0,.4);
    -webkit-box-shadow: 0 0 10px rgba(0,0,0,.4);
    -box-shadow: 0 0 10px rgba(0,0,0,.4);
}
                .button {
                    /*border:1px solid #7eb9d0;
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
                    filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#a7cfdf, endColorstr=#23538a);*/
                    -webkit-font-smoothing: antialiased;
                    display: inline-block;
                    vertical-align: middle;
                    zoom: 1;
                    padding: 6px;
                    font-weight: 400;
                    font-size: 14px;
                    color: #fff !important;
                    text-shadow: rgba(0, 0, 0, 0.2) 0 -1px 0;
                    border: 0px;
                    border-radius: 5px;
                    box-shadow: rgba(0, 0, 0, 0.3) 0 1px 2px, inset rgba(255, 255, 255, 0.88) 0px 1px 3px -1px;
                    background-color: #4589E3;
                    background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #5da4ff), color-stop(100%, #417bff));
                    background: -webkit-linear-gradient(#5da4ff, #417bff);
                    background: -moz-linear-gradient(#5da4ff, #417bff);
                    background: -o-linear-gradient(#5da4ff, #417bff);
                    background: linear-gradient(#5da4ff, #417bff);
                    -webkit-transition: all 0.2s linear;
                    -moz-transition: all 0.2s linear;
                    -ms-transition: all 0.2s linear;
                    -o-transition: all 0.2s linear;
                    transition: all 0.2s linear;
                    float:right;
                    margin-right: 5px;


                }
                .button:hover {
                    border-top-color: #28597a;
                    background: #28597a;
                    color: #ccc;
                }
                .dropdown {
                    // -webkit-appearance: none;
                    // -moz-appearance: none;
                    padding: 2px 30px 2px 2px;
                    border: 1px solid #d3d6db !important;
                    -moz-appearance: none;
                    text-indent: 0.01px;
                    text-overflow: '';
                   //width:100%;


                }

                .peopwrap img{

                    width:50px;
                    height:45px;
                }



                .plusign
                {
                    //border-top-right-radius: -10px !important;
                    //border-top-left-radius: -25px !important;
                    padding: 3px;
                    background:none !important;
                    color:#333 !important;
                    border-radius: 20% !important;
                    box-shadow:none !important;
                    margin-left: 10px !important;
                    margin-top: 10px !important;
                }
                .plusign:hover
                {
                    background: #00c7df;
                    color:#fff;

                }

            </style>
<script>
$(document).ready(function(){
    $(".center_area").click(function(){
$(".center_area").css( { marginTop : "0px", marginBottom : "0px" } );
        $(this).css( { marginTop : "5px", marginBottom : "5px" } );
    });
});
</script>

    </head>
    <!--<div class="wrapper">
        <input type="text" />
        <button>GO</button>
    </div>-->
    <body  class="nobg" style="background-position: initial !important;background-size:auto !important;">
        <?php include 'headerHome.php'; ?>
 <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="display:table;">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
    </div>

            <div class="midwht">
               
<!-- =========================
        profile picture section
============================== -->	

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="profile_bg">
						<img src="<?php echo $cover_photo; ?>" alt="" />
					</div>
					<div class="author_name_bottom">
						<div class="left_position">
							<p class="p_inline"><?php echo ucfirst($user_det[0]['firstname']); ?> <?php echo ucfirst($user_det[0]['lastname']); ?></p>
							
							<span class="p_inline s_hide"><img src="img/Twtverf.png" style="    width: 32px;
    margin-top: -10px;"></span>
						</div>
					</div>
				</div>
				
				
				<div class="profile_pic_bg_top">
					<div class="add_cover_photo_new">
						<p><i class="fa fa-camera"></i><span>Add cover photo</span></p>
					</div>
					<div class="message_profile_area_new">
						<span class="add_friend_new"><i class="fa fa-user-plus"></i>Add Friend</span>
						<span class="add_Message_new"><i class="fa fa-envelope"></i>Message</span>
					</div>
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
<!-- 				<div class="add_cover_add_friend_message">
					<div class="add_cover_photo">
						<p><i class="fa fa-camera"></i><span>Add cover photo</span></p>
					</div>
					<div class="message_profile_area">
						<span class="add_friend"><i class="fa fa-user-plus"></i>Add Friend</span>
						<span class="add_Message"><i class="fa fa-envelope"></i>Message</span>
					</div>
				</div> -->
			</div>
		</div>
	</section>


<!-- =========================
        main section
============================== -->	
	<section>
		<div class="container">
			<div class="row">
				<!-- left sidebar -->
				<div class="col-sm-3 width_three homlft">
 <?php
                    if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                    ?>
                            <div class="main_profile_pic profile_pic">
<a class="orginal_profilepic group1" href="viewProfilepic.php?profileid=<?php echo base64_decode($_GET['profileid']); ?>"><img src="uploads/<?php echo $user_det[0]['profile_pic']; ?>" alt=""  id="profile_img" /></a></div>
					

						  <?php
                    } else {

                        include 'profilepic1.php';
                    }
                    ?>





<div class="sidebar_add_element profilelinks">
 <?php if (!$mine) {
                            ?>
						<div class="left_sidebar_add">
							<p><i class="fa fa-user-times"></i><span><a class="sendFriendRequest" style="color:#fff;"><?php echo Friends::isFriendText($entityManager, $session->getSession('userid'), base64_decode($_GET['profileid'])) ?> </a>


<img src="images/arrow.png" id="confirmLink" style="cursor: pointer;width:16px;height:16px;float:right;margin-top: 2px;"></img>
                               <?php // if (Friends::WhoSendRequest($entityManager, $_GET['profileid'], $session->getSession('userid') == "1")) { ?>   
<!--                                    <div class="menuConfirm" id="itemMenuConfirm">
                                        <ul id="itemMenuConfirm">
                                            <li id="itemMenuConfirm" onclick="friendsAction('friend_confirm',<?php // echo '\'' + $_GET['profileid'] + '\''; ?>  , '');">Confirm </li>
                                            <li id="itemMenuConfirm" onclick="friendsAction('friend_ignore',<?php // echo '\'' + $_GET['profileid'] + '\''; ?>  , '');">Ignore Request </li>
                                        </ul>
                                    </div>-->
                                <?php // } ?>


</span></p>
						</div>
						<div class="left_sidebar_add">
							<p><i class="fa fa-envelope"></i><span>Send Message</span></p>
						</div>
						<div class="left_sidebar_add">
							<p><i class="fa fa-camera"></i><span>Block User</span></p>
						</div>
 <?php } ?>

 <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                            ?>

						<div class="left_sidebar_add">
							<p><i class="fa fa-user-times"></i><span><a href="album.php?profileid=<?php echo $_GET['profileid']; ?>" style="color:#fff !important;">Photos</a></span></p>

						</div>
  <?php } else {
 ?>
<div class="left_sidebar_add">
							<p><i class="fa fa-user-times"></i><span><a href="album.php" style="color:#fff !important;">Photos</a></span></p>

						</div>
<?php } ?>

					</div>
					
					
															
						<!-- widget two -->				
					<div class="widget-box">
						<div class="left_sidebar_photos">
							<p><i class="fa fa-camera"></i><span>Photos</span></p>
						</div>
						<!-- WIDGET CONTENT -->
						<ul class="instagram-photo-list">
							<li>
								<a href="#" target="_blank"><img src="img/instagram1.jpg" alt="Instagram" /></a>
							</li>
							<li>
								<a href="#" target="_blank"><img src="img/instagram2.jpg" alt="Instagram" /></a>
							</li>
							<li>
								<a href="#" target="_blank"><img src="img/instagram3.jpg" alt="Instagram" /></a>
							</li>
							<li>
								<a href="#" target="_blank"><img src="img/instagram4.jpg" alt="Instagram" /></a>
							</li>
							<li>
								<a href="#" target="_blank"><img src="img/instagram5.jpg" alt="Instagram" /></a>
							</li>
							<li>
								<a href="#" target="_blank"><img src="img/instagram6.jpg" alt="Instagram" /></a>
							</li>
						</ul>
					</div>
					<!--// end widget two -->
					<!--widget three -->
					<div class="widget-box">
						<div class="left_sidebar_photos">
							<p><i class="fa fa-youtube-play"></i><span>Videos</span></p>
						</div>
						<div class="left_sidebar_video">
							<div class="video_style embed-responsive embed-responsive-16by9">
								<iframe class="comment_video" width="100%" height="250px" src="https://www.youtube.com/embed/s8zwRAVfHec" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="video_style embed-responsive embed-responsive-16by9">
								<iframe class="comment_video" width="100%" height="250px" src="https://www.youtube.com/embed/s5xu-lWbnn4" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="last_video_style embed-responsive embed-responsive-16by9">
								<iframe class="comment_video" width="100%" height="250px" src="https://www.youtube.com/embed/s8zwRAVfHec" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					</div>
					<!--// end widget two -->
				</div>

				<!-- //end left sidebar -->
				
				
				
				
				

				
				
				
				
				
				
				
				
				
				<!-- middle area -->
				<div class="col-sm-6 width_six">
					<div class="middle_area">
						<!-- basic information -->
						<div class="basic_information">
							
							<div class="row">
								<div class="col-sm-3 left_side_padding_right">
									<div class="left_side">
										<ul>
											<li><p class="basic_first_p">Basic information</p></li>
											<li><p>About you</p></li>
											<li><p>Work and <br />Education</p></li>
											<li><p>Contact info</p></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-9 left_side_padding_left">
									<?php include('table_ba_info.php'); ?>  
								</div>
							</div>
						</div>
						<!-- social icon dropdown -->
					</div>
					<div class="middle_area_two">
						<div class="social_dropwon">
							<ul>
								<li><img src="img/icons/what.png" alt="" /></li>
								<li><img src="img/icons/facebook.png" alt="" /></li>
								<li><img src="img/icons/twitter.png" alt="" /></li>
								<li class="hover_show">
									<img src="img/icons/girl.png" alt="" /><span class="girl_span_text">@lunphuddi</span>
									
								<!-- 	<ul class="dropdown_girl">
										<li><img src="img/icons/boy.png" alt="" /><span>@lunphuddi</span></li>
										<li><img src="img/icons/girl.png" alt="" /><span>@lunphuddi</span></li>
									</ul> -->
								</li>
								<li><img src="img/icons/t.png" alt="" /></li>
								<li><img src="img/icons/gray.png" alt="" /></li>
							</ul>
						</div>
						<div class="social_d">
							 <?php
                                        if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                            include 'psocialmenu.php';
                                        } else {
                                    ?>
                                    <?php include 'socialmenu.php'; ?>
<?php } ?>
						</div>
<div id="post_box">
<input type="hidden" name="current_url" id="current_url" value="<?php echo $cur_url; ?>" />
                                            <input type="hidden" name="page_url" id="page_url" value="<?php echo $url; ?>" />
                                            <input type="hidden" name="pcurrent_url" id="pcurrent_url" value="<?php echo $pcur_url; ?>" />
                                            <input type="hidden" name="current_tscreen" id="current_tscreen" value="<?php echo $screenname; ?>" />
                                            <input type="hidden" name="current_tid" id="current_tid" value="<?php echo $twitterid; ?>" />
                                            <form id="vasPLUS_Programming_Blog_Form" method="post" enctype="multipart/form-data" action="tweet_image.php">
                                                <div class="TwtrPostWall">
                                                    <textarea  class=" none-radiusP social_bottom_p" name="updateme" id="updateme" rows="1" style="    width: 100%;
   
    border-top: none;
    border-left: none;
    border-right: none;
    margin-top: 10px;margin-bottom:5px;">What you want to share...</textarea>

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

textarea  class=" none-radiusP social_bottom_p" name="status" rows="1" style="    width: 100%;
   
    border-top: none;
    border-left: none;
    border-right: none;
    margin-top: 10px;margin-bottom:5px;">What you want to share...</textarea>
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
                                            <div class="bluebg">Whiteboard</div>

                                        </div>








												
						
						<div class="slider_one_bottom">
							<a href="#"><span class="slider_bottom_photo"><i class="fa fa-camera"></i>Photos</span></a>
							<a href="#"><span class="slider_bottom_video"><i class="fa fa-youtube-play"></i>Videos</span></a>
							<a href="#"><span class="slider_bottom_post">Post</span></a>
						</div>				
					</div>	
					

					<div class="1add_friend_slider">
					<div class-"tab-1">
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
                                    ?><?php if ($screen_length != 0) { ?>
                                            <div class="twt-wall-tw-info-title">
                                                <div class="TwtLogo">
                                                    <a href="#"><img src="images/twitter-logo.png"></a>
                                                   <!-- <span>@<?php //echo $user_info->screen_name;                      ?></span>-->
                                                </div>
                                        <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                        ?>

                                        <?php } else {
                                        ?>
                                                <div class="HomeTwBtn"><a href='javascript:void(0)' onclick='load_index();'>Home</a></div>
                                        <?php } ?>
                                            <div class="TweetsQntty TweetsQntty1 ">
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
                                                <div style="positive: relative; margin: 0px auto;width: 100px; height: 2px;">
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
                                                document.body.style.background="#f3f3f3 url(<?php echo $user_info->profile_background_image_url; ?>) fixed";
                                                document.body.style.backgroundRepeat="repeat";
                                                document.body.style.height = "100%";
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
                                                        $text = preg_replace('/@(\w+)/', '<a href="twitter_ajax/twitpic.php?screenname=$1" data-toggle="modal" data-target="#myModal" class="fancybox fancybox.ajax">@$1</a>', $text);

                                                        $text = preg_replace('/\s#(\w+)/', ' <a href="twitter_ajax/twitter_search.php?q=%23$1" class="fancybox fancybox.ajax">#$1</a>', $text);
                                                        echo '<div class="tweet-outer center_area" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

                                                        echo '<div class="tweet-txt  ' . $fav . ' ' . $RT . '" id="tweet-txt' . $k . '">';
                                                        echo '<i class="dogear"></i>';
                                                        echo "<div class='tweet-pic'><a href='twitter_ajax/twitpic.php?screenname=" . $my_tweet->user->screen_name . "' class='fancybox fancybox.ajax'><img src='" . $my_tweet->user->profile_image_url . "' title='" . $my_tweet->user->name . "' class='profile_pic'></a></div>";
                                                        echo '<div class="tweet-content">';
                                                        echo '<div class="stream-item-header">';
                                                        echo '<b>' . $my_tweet->user->name . '</b>&nbsp;<span class="username js-action-profile-name"><a href="twitter_ajax/twitpic.php?screenname=' . $my_tweet->user->screen_name . '" data-toggle="modal" data-target="#myModal" class="fancybox fancybox.ajax"><span>@' . $my_tweet->user->screen_name . '</a></span></span>';
                                                        echo '</div>';
                                                        echo $text . ' <br />-<span>' . $my_tweet->created_at . '</span></div>';
                                                        echo '<div class="tweet-counts"></div>';
                                                        echo ' </div>';



                                                        //Popup
                                                        echo '<div id="myModals' . $k . '" class=" reveal-modal">';
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
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:;'><a href='" . $my_tweet->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->entities->media[0]->media_url . "' ></a></div>";
                                                        } else if ($imge_id[0] == 'twitpic.com') {
                                                            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                                            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
                                                        } else if ($imge_id[0] == 'yfrog.com') {
                                                            $w = $my_tweet->entities->media[0]->media_url->sizes->large->w;
                                                            $h = $my_tweet->entities->media[0]->media_url->sizes->large->h;
                                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
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
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:none;'><object width='425' height='349' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                                                                    "<br><b>" . $title . "</b><br>" .
                                                                    "<b>" . $desc . "</b><br>"
                                                                    . "</div>";
                                                        } else if ($imge_id[0] == 'vine.co') {
                                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:none;'><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
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
                                                        echo '<div class="tweet-outer center_area" id="tweet-outer' . $k . '" data="' . $my_tweet->id_str . '" data-count="' . $k . '">';

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



                                                        echo '<div id="myModals' . $k . '" class=" reveal-modal">';
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
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:;'><a href='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' class='fancybox-effects-a' title = 'Photo'><img src='" . $my_tweet->retweeted_status->entities->media[0]->media_url . "' ></a></div>";
                                                        } else if ($imge_id[0] == 'twitpic.com') {
                                                            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                                            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:;'><a href='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg' class='fancybox-effects-a' title = 'Photo'><img src='http://twitpic.com/show/full/" . $imge_id[1] . ".jpg'></a></div>";
                                                        } else if ($imge_id[0] == 'yfrog.com') {
                                                            $w = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->w;
                                                            $h = $my_tweet->retweeted_status->entities->media[0]->media_url->sizes->large->h;
                                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:;'><a href='http://yfrog.com/" . $imge_id[1] . ":medium'' class='fancybox-effects-a' title = 'Photo'><img src='http://yfrog.com/" . $imge_id[1] . ":medium'></a></div>";
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
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:none;'><object width='425' height='349' type='application/x-shockwave-flash' data='http://www.youtube.com/v/" . $video_id[$len] . "'><param name='movie' value='http://www.youtube.com/v/" . $video_id[$len] . "' /></object>" .
                                                                    "<br><b>" . $title . "</b><br>" .
                                                                    "<b>" . $desc . "</b><br>"
                                                                    . "</div>";
                                                        } else if ($imge_id[0] == 'vine.co') {
                                                            $media_flag = '<a href="javascript:void(0)" onclick="displaymedia(' . $k . ')"><i class="sm-image"></i> View Media</a>';
                                                            $image_are = "<div class='tweet_outer tweet-medias' id='yfrog$k' style='display:none;'><iframe src='https://vine.co/v/" . $imge_id[2] . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>" .
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

                            <div id="tab-2">



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
                                                    <img src="uploads/<?php echo $userdetails[0]['profile_pic']; ?>" alt="" width="40px;" height="40px;" style="border-radius:0px;padding:5px; "/>
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
                                                            <div class="crispcont1">

                                                                <p><?php echo count($entry['photos']) ?> photos uploaded</p>
                                                                <div class="upimgwrap">

                                                                    <div class="big-photo-container1">
                                                                        <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $entry['photos'][0]['id']; ?>&postion=0">
                                                                            <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  class="upbigimg"/>
                                                                        </a>
                                                                    </div>
                                                                    <div class="upsmimg">
                                                            <?php
                                                            $postion = 1;
                                                            foreach ($entry['photos'] as $key => $photo) {
                                                                if ($key == 0)
                                                                    continue;
                                                            ?>
                                                                <div class="small-photo-container">
                                                                    <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $photo['id']; ?>&postion=<?php echo $postion; ?>">                                                                            <img src="uploads/<?php echo $photo['file'] ?>" alt="" />
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
                                                        </div></div>
                                                    <div class="clear"></div>

                                                    <div class="commentmain" >




                                                        <div class="comment-section" id="comment_<?php echo $entry['id'] ?>" style="display:none;">
                                                <?php //echo '<pre>'; print_r($entry['comments']); ?>
                                                <?php
                                                        foreach ($entry['comments'] as $comment):
                                                            $cuserdetails = WallModel::getUserDetails($entityManager, $comment['author_id']);
                                                            //echo '<pre>'; print_r($cuserdetails);
                                                ?>
                                                            <div class="comment-block">


                                                                <table border="0">
                                                                    <tr>
                                                                        <td style="width:5%" valign="top">

                                                                            <img src="uploads/<?php echo $cuserdetails[0]['profile_pic']; ?>" alt="<?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?>" width="32px;" height="32px;" style="border-radius:px;"></td>
                                                                        <td valign="top"><div class="comment-content" style="color:#999;margin-left:0px !important;">
                                                                          <!--  <h2 ><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></h2>
                                                                            <p style="color:#fff;"><?php echo Functions::addLink($comment['text']) ?></p></br></br>
                                                                            <p style="margin-top:-15px;color:#ccc;"><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></p> -->

                                                                                <p style="color:#fff;"><b style="color:#ffa96e;"><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></b>&nbsp;
                                                                        <?php echo Functions::addLink($comment['text']) ?></br>
                                                                        <span style="color:#ccc !important;"><?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></span></p>
                                                                </div></td> </tr></table>





                                                    <div class="clear"></div>
                                                </div>
                                                <?php endforeach ?>
                                                                    </div>
                                                                    <div class="add-comment" rel="<?php echo $entry['id'] ?>">
                                                                        <form rel="<?php echo $entry['id'] ?>" id="commform_<?php echo $entry['id'] ?>" action="" method="post" enctype="multipart/form-data">                                                    <table width="100%">
                                                                                <tr>
                                                                                    <td width="10%"><img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" width="32px;" height="32px;" style="border-radius:px;margin-left: 5px; "/></td>
                                                                                    <td width="90%"><textarea placeholder="Start typing your comment here" class="grybord" id="wallcomment" name="comment"></textarea></td>
                                                                                </tr>
                                                                            </table>
                                                                            <div style="float: right;
                                                                                 margin-top: -22px;
                                                                                 position: relative;
                                                                                 margin-right: 15px;">
                                                                                <i class="fa fa-camera fa-lg" style="float: right;color:#999999;
                                                                                   cursor: pointer;"></i>
                                                                                <input for="file-input" rel="<?php echo $entry['id'] ?>" type="file" name="photo" style="opacity: 0;
                                                                                       float: right;   filter: alpha(opacity=0);margin-right: -18px;margin-top: -5px;width: 23px;"/> </div>
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
					
					
					
				</div>  <!--  end col sm 7 -->
				<!--// end middle area -->
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<!-- right sidebar -->
				<div class="col-sm-3 width_three">
					<div class="right_sidebar">
					
						<!-- right widget one -->
						<div class="widget-box">
 <?php
                                                                    /* echo "<script type='text/javascript'>alert('$session->getSession("friends")');</script>"; */


                                                                    //echo base64_decode($session->getSession("profileid"));
                                                                    //echo base64_decode($_GET['profileid']);
                                                                    //echo $session->getSession("userid");
                                                                    //echo $mine;
                                                                    /*  if($_SESSION['userid']=="")
                                                                      {
                                                                      ?>
                                                                      <a href="friend_list.php?profileid=<?php echo $_GET['profileid'];?>" ><h3 class="">Friends(<font class="totalfriends"><?php echo Friends::getNumber(); ?></font>)</h3></a>

                                                                      <div class="friendwrap">
                                                                      <?php echo $result; ?>
                                                                      </div>

                                                                      <?php


                                                                      }
                                                                      if($_SESSION['userid'] == base64_decode($_GET['profileid']) ){

                                                                      $result = Friends::getFriends($entityManager, $session->getSession("userid"), 8);
                                                                      ?>
                                                                      <a href="friend_list.php?id=<?php echo $_GET['profileid'];?>" ><h3 class="" >Friends(<font class="totalfriends" ><?php echo Friends::getNumber(); ?></font>)</h3></a>

                                                                      <div class="friendwrap">
                                                                      <?php echo $result; ?>
                                                                      </div>

                                                                      <?php


                                                                      } */
                                                                    if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                                                        $result = Friends::getFriends($entityManager, base64_decode($_GET['profileid']), 8);
                            ?>
							<div class="right_sidebar_photos">
								<p><a href="friend_list.php?id=<?php echo $_GET['profileid']; ?>" ><i class="fa fa-user"></i><span>Friends(<font class="totalfriends"><?php echo Friends::getNumber(); ?></font>)</span></a></p>
							</div>
							<!-- WIDGET CONTENT -->
							<ul class="instagram-photo-list">
								<?php echo $result; ?>

							</ul>
<?php
                                                                    } else {
                                                                        $result = Friends::getFriends($entityManager, $session->getSession("userid"), 8);
?>
<div class="right_sidebar_photos">
<p><a href="friend_list.php?id=<?php echo $_GET['profileid']; ?>" ><i class="fa fa-user"></i><span>Friends (<font class="totalfriends"><?php echo Friends::getNumber(); ?></font>)</span></a></p></div>

<ul class="instagram-photo-list">
								<?php echo $result; ?>

							</ul>

<?php } ?>
						</div>	
						
						<!-- right widget one -->
						<div class="find_people">
							<div class="find_people_you_know">
								<p><i class="fa fa-user"></i><span>Find people you know</span></p>
							</div>
						</div>
						<!-- right widget two friends requireds -->
						<div class="widget-box widget_padding_bootom">
							<div class="friend_request_confirm">
								<p><i class="fa fa-user"></i><span>Friends Requests</span><span class="see_all">See All</span></p>
							</div>
							<div class="confirm_friend_area">
								<div class="confirm_friend">
									<img src="img/confirm_friend1.jpg" alt="" />
									<div class="confirm_friend_details">
										<p class="confirm_friend_name" >Jonathan Ofelia <span class="closs_icon_right"><i class="fa fa-times"></i></span></p>
										<p class="confirm_mutual_friends">2 mutual friends</p>
										<div class="confirm_friend_button">
											<span class="confirm_friend_icon_and_text"><i class="fa fa-user-plus"></i>Confirm Friend</span>									
										</div>
									</div>
								</div>
								<div class="confirm_friend">
									<img src="img/confirm_friend2.jpg" alt="" />
									<div class="confirm_friend_details">
										<p class="confirm_friend_name" >Jonathan Ofelia <span class="closs_icon_right"><i class="fa fa-times"></i></span></p>
										<p class="confirm_mutual_friends">2 mutual friends</p>
										<div class="confirm_friend_button">
											<span class="confirm_friend_icon_and_text"><i class="fa fa-user-plus"></i>Confirm Friend</span>									
										</div>
									</div>
								</div>
								<div class="confirm_friend">
									<img src="img/confirm_friend1.jpg" alt="" />
									<div class="confirm_friend_details">
										<p class="confirm_friend_name" >Jonathan Ofelia <span class="closs_icon_right"><i class="fa fa-times"></i></span></p>
										<p class="confirm_mutual_friends">2 mutual friends</p>
										<div class="confirm_friend_button">
											<span class="confirm_friend_icon_and_text"><i class="fa fa-user-plus"></i>Confirm Friend</span>									
										</div>
									</div>
								</div>
								<div class="confirm_friend">
									<img src="img/confirm_friend2.jpg" alt="" />
									<div class="confirm_friend_details">
										<p class="confirm_friend_name" >Jonathan Ofelia <span class="closs_icon_right"><i class="fa fa-times"></i></span></p>
										<p class="confirm_mutual_friends">2 mutual friends</p>
										<div class="confirm_friend_button">
											<span class="confirm_friend_icon_and_text"><i class="fa fa-user-plus"></i>Confirm Friend</span>									
										</div>
									</div>
								</div>
							</div>
						</div>						
						<!--end right widget two friends requireds -->
						
						<!-- right widget three sponsor -->
						<div class="widget-box">
							<div class="sponsor_widget_area">
								<div class="sponsor_first">
									<p><span class="sponsor_title">SPONSORED</span><span class="Create_ad">Create Ad</span></p>
									<img src="img/sponsor.jpg" alt="sponsor" />
									<h3>Thicken Denum Cost</h3>
									<h4>www.gearbest.com</h4>
									<p>Men cost up to 60% off, Free shipping, shop now</p>
								</div>
							</div>
							<div class="sponsor_widget_area">								
								<img src="img/sponsor2.jpg" alt="sponsor" />
								<h3>Thicken Denum Cost</h3>
								<h4>www.gearbest.com</h4>
								<p>Men cost up to 60% off, Free shipping, shop now</p>
							</div>
						</div>
						
						<!--// end right widget three sponsor -->


						
						
						
					</div>


				</div>
				<!-- //end right sidebar -->
			</div>
			</div>
	</section>
	
	
	



        </div>
    </body>
</html>
<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

</script>






<!-- jQuery with fallback to the 1.* for old IE -->
<!--[if lt IE 9]>
    <script src="js/tab1/jquery-1.11.0.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="js/tab1/jquery-2.1.0.min.js"></script>
<!--<![endif]-->

<!-- Responsive Tabs JS -->
<script src="js/tab/jquery.responsiveTabs.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').responsiveTabs({
            rotate: false,
            startCollapsed: 'accordion',
            collapsible: 'accordion',
            setHash: true,
            disabled: [],
            activate: function(e, tab) {
                $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
            },
            activateState: function(e, state) {
                //console.log(state);
                $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
            }
        });

        $('#start-rotation').on('click', function() {
            $('#horizontalTab').responsiveTabs('active');
        });
        $('#stop-rotation').on('click', function() {
            $('#horizontalTab').responsiveTabs('stopRotation');
        });
        $('#start-rotation').on('click', function() {
            $('#horizontalTab').responsiveTabs('active');
        });
        $('.select-tab').on('click', function() {
            $('#horizontalTab').responsiveTabs('activate', $(this).val());
        });

    });

</script>