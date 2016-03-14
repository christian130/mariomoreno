<!DOCTYPE html>
<html class="no-js" lang="en-US">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <title>::WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/1reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/1style.css" type="text/css" />
        <link rel="stylesheet" href="css/1wall.css" type="text/css" />
        <link rel="stylesheet" href="css/1jquery.fancybox.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
        <link href='css/nprogress.css' rel='stylesheet' />
        <script type="text/javascript" src='js/nprogress.js'></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
            <link type="text/css" rel="stylesheet" href="css/tab/11responsive-tabs.css" />
            <link type="text/css" rel="stylesheet" href="css/tab/11style.css" />
            <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
            <script type="text/javascript" src="js/jquery.min.js"></script>

            <script type="text/javascript" src="js/jquery.colorbox.js"></script>
            <link rel="stylesheet" href="css/colorbox.css" type="text/css" />
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/1jquery-ui.css">




    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    
        
    <link rel="stylesheet" href="css/profilestyle.css">
    <link rel="stylesheet" href="css/profile.css">
    
    <link rel="stylesheet" href="css/profileresponsive.css">
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>


    
        <script src="js/owl.carousel.js"></script>


<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">











                <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                <link href="css/registration-process.css" rel="stylesheet">

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
                <!--<script type="text/javascript">
                        $(document).ready(function() {
                            $(".wall_popup").colorbox({
                                fixed:true,
                                rel:'wall_popup',

                                scrolling:false,

                                onComplete: function() {
                                                  var window_height = $(window).height();
                                    var colorbox_height = $('#colorbox').height();
                                    var top_position = 0;

                                    if(window_height > colorbox_height) {
                                        top_position = (window_height - colorbox_height) / 2;
                                    }

                                       $('#colorbox').css({'top':top_position, 'position':'fixed'});
                                }
                            });
                            $(document).bind('cbox_open', function() {
                                $('html').css({ overflow: 'hidden' });
                            }).bind('cbox_closed', function() {
                                $('html').css({ overflow: '' });
                            });
                        });
                    </script> -->
                    <?php
                    require 'instagramoauth/instagram.class.php';

// initialize class
                    $instagram = new Instagram(array(
                                'apiKey' => '5b610f1450884e93b4511629141a74af',
                                'apiSecret' => 'c86de353c84248f7a80d5e4bc8038aaf',
                                'apiCallback' => 'http://localhost/projects/whatsdadilly/instagram_add.php' // must point to success.php
                            ));

// create login URL
                    $loginUrl = $instagram->getLoginUrl();
                    ?>
                    <script type="text/javascript">



                        $(document).ready(function() {
                            $( "#dialog" ).dialog(
                            {
                                title: "Add Social Networks",
                                width: "40%",
                                modal: true
                            });


                            //                        $.ajax({
                            //                            url: 'test.ini',
                            //                            dataType: 'json',
                            //                            data: "",
                            //                            success: function(doc) {
                            //                                //$( "#dialog").html(doc);
                            //                                $( "#dialog" ).dialog(
                            //                                {
                            //                                    title: "My Dialog Title",
                            //                                    modal: true
                            //                                });
                            //                            }
                            //                        });

                            
                        
                            $(".wall_popup").colorbox({
                                fixed:true,
                                scrolling:false,
                                rel:'wall_popup'});
                            $(document).bind('cbox_open', function() {
                                $('html').css({ overflow: '' });
                            }).bind('cbox_closed', function() {
                                $('html').css({ overflow: '' });
                            });
      
                        });

                        /*function waitForMsg(){
                                 /* This requests the url "msgsrv.php"
                     When it complete (or errors)*/
                        //var firstid =  $('.crispbxmain').attr("data");
                        //  $.ajax({
                        //   type: "POST",
                        //    url: "msgsrv.php?post_id="+firstid,
                        //   async: true, /* If set to non-async, browser shows page as "Loading.."*/
                        //   cache: false,
                        //   timeout:50000, /* Timeout in ms */

                        //  success: function(data){ /* called when request to barge.php completes */
                        //     $(".wallEntries").prepend(data); /* Add response to a .msg div (with the "new" class)*/
                        //     setTimeout(
                        //     waitForMsg, /* Request next message */
                        //     1000 /* ..after 1 seconds */
                        //  );
                        //  },
                        //  error: function(XMLHttpRequest, textStatus, errorThrown){
                          
                        //     setTimeout(
                        //     waitForMsg, /* Try again after.. */
                        //  15000); /* milliseconds (15seconds) */
                        //  }
                        // });
                        // };*/
                    </script>






                    <style>
                        /*                    .ui-widget-overlay.custom-overlay
                                            {
                                                background-color: black !important;
                                                background-image: none;
                                                opacity: 0.9;
                                                z-index: 1040;
                                            }*/
.preview img
{

width: 130px !important;
    height: 130px;
}

.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.fa-plus
{
margin-top:35px !important;
}

.one-photo
{
width: 130px;
    height: 130px;
    text-align: center;
    margin-top: 10px;
    border: 2px dashed #ccc;
    color: #ccc;
    font-size: 13pt;
float:left;
margin-right:5px;
margin-bottom:5px;
}

.removePhoto
{
z-index: 100;
    position: relative;
    text-align: right;
    margin-right: 5px;
}

.fileUpload
{

z-index: 10;
    margin-top: 0px;
    opacity: 0;
    height: 100px;
    position: absolute;
}

.preview
{
position: relative;
    float: left;
    margin-top: -80px;
    width: 130px;
    margin-left: -2px;
    height: 130px;
}



#picture {
    display: none;
    padding: 10px;
//    background: #d8d8d8;
//max-height: 510px;
//    overflow-y: auto;
}


#picture::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

#picture::-webkit-scrollbar
{
    width: 6px;
    background-color: #F5F5F5;
}

#picture::-webkit-scrollbar-thumb
{
    background-color: #000000;
}
.info_linkbox
{

border: 1px solid #ccc;margin: 7px 5px;    box-shadow: 0px 0px 1px #ccc;
}
                        .peopwrap img{

                            width:50px;
                            height:45px;
                        }

                        #topblack
                        {
                            top:0px;
                        }

                        body
                        {
                            background:#F1F3F2 !important;
                            padding-top: 0px !important;
                        }
                        td
                        {
                            color:#333 !important;
                        }

                        .wrapper-dropdown-3
                        {
                            width:100px !important;
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
                        .notshow{
                            display:none;
                        }
                        .notActshow{
                            display:none;
                        }
                        .tweetsAct{
                            cursor:pointer;
                            background:white;
                            color:blue;
                            text-align:center;
                            height: 40px;
                            color: #00BDFF;
                            margin-bottom: 15px;        
                            
                        }
                        .tweetsAct P{
                            padding:10px;
                            font-weight:bold;
                        }
                        .tweetsAct:hover{
                            cursor:pointer;
                            background:#00BDFF;
                            color:blue;
                            text-align:center;
                            height: 40px;
                            color: white;
                            margin-bottom: 15px;
                                
                        }
                    </style>
                    <script type="text/javascript">
                        function loadComments(){
                            var lastcommentid = $("#lastcommentID").val();

                            $.getJSON('commentlist.php?commentid='+lastcommentid, function(data) {
                                if(data != null){
                                    // alert(data.length);
                                    // alert("Data0Title: " + );
                                    $("#lastcommentID").val(data[0].cmt_id);
                                    $(".wallEntries").find("#comment_"+data[0].dev_id).prepend(data[0].comment_block);
                                    $.av.pop({
                                        title: 'Comment',
                                        expire: 2000,
                                        message: data[0].comment_block
                                    });
                                }
                            });
                        }
                        //var comments = setInterval(loadComments, 10000);
                    </script>
                    </head>
<?php
                    $session = new Session();
                    if ($session->getSession('userid') != null) {
?>
                                                                                                                                    <!--<script type="text/javascript" src="js/updater.js"></script>
                                                                                                                                             <script type="text/javascript" src="js/updater_remove.js"></script>-->
<?php
                    }
?>
                    <body  class="nobg">
                        <div id="dialog" title="Basic dialog" style="display:none;">
                            <table width="100%" border="0" class="">
                                <tr>
                                    <td> <img src="rgimages/facebook.png"></td>
                                    <td>Connect your Facebook account</td>
                                </tr>
                                <tr>
                                    <td> <img src="rgimages/twtr.png"></td>
                                    <td>
                                        Connect your Twitter account
<?php
                    foreach ($accounts as $acc) {
                        if ($acc['networkname'] == 'twitter') {
?>
                                        <a href="#" id="<?php echo $acc["token_id"]; ?>"  class="delbutton" style="color:#555;float:right;">@<?php echo $acc['screen_name']; ?> &nbsp;<i class="fa fa-times"></i></a>
<?php }
                                } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="rgimages/pinterest.png"></td>
                                    <td>Connect your Pinterest account</td>
                                </tr>
                                <tr style="border-bottom:none;">
                                    <td> <img src="rgimages/instagram-icon.png"></td>
                                    <td>
                                        <a class="login" href="<?php echo $loginUrl ?>"><img src="rgimages/insta_preview.png"></a>
                                        <?php
                    foreach ($accounts as $acc) {
                        if ($acc['networkname'] == 'instagram') {
?>
                                        <a href="#" id="<?php echo $acc["token_id"]; ?>"  class="delbutton" style="color:#555;float:right;">@<?php echo $acc['screen_name']; ?> &nbsp;<i class="fa fa-times"></i></a>
<?php }
                                } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </div>
                        <div class="main_content">
                            <script type="text/javascript">
                                var ajaxUrl = 'wall.php';
                            </script>
<?php include 'headerHome.php'; ?>
                           


  <section>
    <div class="container">
      <div class="row">
        <!-- left sidebar -->
        <div class="col-sm-3 width_three profile_page">
        <?php include 'profilepic.php'; ?>
          

        </div>

        
        
        
        
        

        
        
        
        
        
        
        
        
                                                    <input type="hidden" name="social_menu" id="social_menu" value="wdd" />

        <div class="col-sm-6 width_six profile_page_middle">
          <div class="middle_area_two">
            <div class="social_dropwon">
              <ul role="tablist">
                <li role="presentation" class="active"><a href="#wddSwitch"  aria-controls="wddSwitch" role="tab" data-toggle="tab"><img src="img/icons/what.png" alt="" /></a></li>
                <li role="presentation"><img src="img/icons/facebook.png" alt="" /></li>
                <li role="presentation"><a href="#twtt" aria-controls="twtt" role="tab" data-toggle="tab"><img src="img/icons/twitter.png" alt="" /></a></li>
                <li class="hover_show">
                  <img src="img/icons/girl.png" alt="" /><span class="girl_span_text">@lunphuddi</span>
                  
               
                </li>
                <li role="presentation"><img src="img/icons/t.png" alt="" /></li>
                <li role="presentation"><a href="#Instaa" aria-controls="Instaa" role="tab" data-toggle="tab"><img src="img/icons/gray.png" alt="" /></a></li>
              </ul>
            </div>
            <div class="social_d">
              <?php include 'socialmenu.php'; ?>
            </div>
            <div id="tabs-container">
             <script type="text/javascript" src="js/wall.js"></script>
                                                <form action="wdd_ajaxupload.php" id="upload_photos" method="post" onsubmit="return submitForm();">
              <textarea name="status" style="width:100%;float:left;border:none;margin-top:9px;margin-bottom:8px;    border-bottom: 1px solid #ccc;"  class="grybord" placeholder="What you want to share..."></textarea>
                                                    <div id="link_info" ></div>                                                                      <div class="clear"></div>
            <div id="picture"  > 
<div style="display:table;">
            <div class="one-photo"  >
<input class="fileUpload upload" type="file" name="photo_0" multiple/>
<div class="removePhoto" >x</div>
<i class="fa fa-plus" style="    margin-top: 25px;"></i>


            <div class="preview" ></div>


            
            
            </div></div>
            <div class="clear"></div>
            </div>  
         <!--div class="dgry">
                                                        <div class="picon"><a href="#"> <img src="images/photoicon.png" alt="" /></a> </div>
                                                        <input type="submit" class="postbutton" value="post" />
                                                    </div--> 


             
                                               

              
            </div>
            <div class="slider_one_bottom dgry">
              <a href="#" class="picon"><span class="slider_bottom_photo"><i class="fa fa-camera"></i>Photos </span></a>



              <a href="#"><span class="slider_bottom_video"><i class="fa fa-youtube-play"></i>Videos</span></a>
              <input type="submit" class="slider_bottom_post postbutton" value="post" />
            </div>  </form>
            
      </div>

         
        
        
        <div class="tab-content">
<div role="tabpanel" id="wddSwitch" class="tab-pane active">

 <div class="middle_area_three"> 
    <div class="white_board">
      <p>Whiteboard</p>
    </div>
    <div class=" tweetsAct notActshow">
      <p>There are 0 post.Please Click here to view.</p>
    </div>
    </div>
  <div style="clear:both;"></div>

<div class="wallEntries" id="getting_wdd_wall">
                                                    <input type="hidden" name="lastcommentID" id="lastcommentID" value="<?php echo $last_comment['id']; ?>" />
<?php
                                        $postids = 0;
//echo '<pre>';
//print_r($entries);
                                        foreach ($entries as $entry) {
                                            //echo $entry['id'];
                                   //         print('<pre>');
                                    //        print_r($entry);
                                            $userdetails = WallModel::getUserDetails($entityManager, $entry['user_id']);
?>




          
          
                                <div class="middle_area_four crispbx crispbxmain" style="margin-bottom:5px;" id="wall<?php echo $entry['id']; ?>" data="<?php echo $entry['id']; ?>" data-count="<?php echo $postids; ?>">
                        <div class="slider_two_title">

                            <img class="image_border_style" src="uploads/<?php echo $userdetails[0]['profile_pic']; ?>"  alt="" style="width:49px;height:49px;">

<div class="slider_title_style2">

<span class="author_slide_top author_upload_name"><?php echo $userdetails[0]['firstname'] ?> <?php echo $userdetails[0]['lastname'] ?> </span><span></span><p class="update_profile_date">
</p></div>                                                      
                        </div>
<div style="padding:10px;width:100%;">
<p><?php echo Functions::addLink($entry['text']) ?></p></div>

<?php if (strlen($entry['link']) > 0) { ?>
                        <div class="display_profile_pic">
<?php if (strlen($entry['link_photo']) > 0): ?>
                                                            <img src="<?php echo $entry['link_photo'] ?>" alt=""/>
<?php endif ?>
                        <div style="padding:10px;">
 <p><a target="_blank" href="<?php echo $entry['link'] ?>" style="color: #000;font-size: 18pt;line-height: 1.2em;"><?php echo $entry['link_title'] ?></a></p>
                                                            <p style="font-size:12pt;"><?php echo $entry['link_description'] ?></p></div>





    
                        </div>
 <?php } ?>














<div style="padding:10px;">
 <?php if (!empty($entry['photos'])) {
                                        ?>
                                                <div class="crispbx">
                                                    <div class="crispcont1">
                                                        <p><?php echo count($entry['photos']) ?> photos uploaded</p>
                                                <?php if (count($entry['photos']) > 1) {
                                                ?>
                                                    <div class="upimgwrap ">

                                                        <div class="big-photo-container ">
                                                            <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $entry['photos'][0]['id']; ?>&postion=0">
                                                                <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  class="upbigimg"/>
                                                            </a>
                                                        </div>
                                                        <div class="upsmimg photo-grid-container">
                                                        <?php
                                                        $postion = 1;
                                                        foreach ($entry['photos'] as $key => $photo) {
                                                            if ($key == 0)
                                                                continue;
                                                        ?>
                                                            <div class="small-photo-container photo-grid-item">
                                                                <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $photo['id']; ?>&postion=<?php echo $postion; ?>">
                                                                    <img src="uploads/<?php echo $photo['file'] ?>" alt="" />
                                                                </a>
                                                            </div>
                                                        <?php $postion++;
                                                        } ?>
                                                    </div>
                                                </div>
                                                <?php } else {
                                                ?>
                                                        <div class="upimgwrap1">

                                                            <div class="big-photo-container1">
                                                                <a class="wall_popup group1" href="wall_popup.php?wall_id=<?php echo $entry['id']; ?>&photoid=<?php echo $entry['photos'][0]['id']; ?>&postion=0">
                                                                    <img src="uploads/<?php echo $entry['photos'][0]['file'] ?>" alt=""  class="upbigimg"/>
                                                                </a>
                                                            </div>
                                                        </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
</div>



















                        <div class="like_comment_share">
                            <a href="#"><span><i class="fa fa-thumbs-up"></i>Like</span></a>

                            <a href="#"><span><i class="fa fa-heart"></i>Love it</span></a>
                                                       <a href="#" class="add-comment-link" rel="<?php echo $entry['id'] ?>" ><span><i class="fa fa-commenting"></i>Comment</span></a>
                            <a href="#"><span><i class="fa fa-share-square-o"></i>Share</span></a>
                        </div>



                        <div class="comment_box" rel="<?php echo $entry['id'] ?>">

                                                                    <form rel="<?php echo $entry['id'] ?>" id="commform_<?php echo $entry['id'] ?>" action="" method="post" enctype="multipart/form-data">


                            <img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="" style="width:37px;height:37px;" >
                            <span><input id="comminput_<?=$entry['id'] ?>" class="comment_box_inline" placeholder="Write your comment here" type="text"></span>
                            <div class="comment_box_icon comment_box_inline"><a href="#"><span><i class="comment_box_left fa fa-camera"></i></span></a>
                            <a href="#"><span><i class="comment_box_left2 fa fa-smile-o"></i></span></a></div>
                            <h5 class="press_enter_post">Press enter to post or press this button: </h5>
                        </div>
<?php //var_dump($_SESSION)?>
<script type="text/javascript">
//@Author: sistemasphpvenezuela.com

$("#comminput_<?=$entry['id'];?>").keypress(function(e) {
    if(e.which == 13) { 
    equis<?=$entry['id'];?>();
    }
});


function equis<?=$entry['id'];?>(){
var curDateTime01 = '<?php echo date('Y-m-d H:i:s');?>';
var current_<?=$entry['id'] ?>=jQuery("#comminput_<?=$entry['id'] ?>").val();

$.ajax({
    type: "POST",
    dataType:"html",
    url: "wall_ajax/index.php",
    data: { 
     author_id:'<?=$session->getSession("userid");?>'
    ,post_id:'<?=$entry['id'];?>'
    ,text:current_<?=$entry['id'];?>
    ,date:curDateTime01
    ,anotherData:'<?php echo trim($_SESSION['profile_pic']);?>'
    ,firstName01:'<?php echo trim($_SESSION['firstname']);?>'
    ,lastName01:'<?php echo trim($_SESSION['lastname']);?>'
}
})
 .done(function( msg ) {
    //alert( "now the html should be insert after here... this alert should be removed later!");
    $("#comminput_<?=$entry['id'];?>").val("");// we clear the input comment box
    //jQuery("div[rel='<?=$entry['id'];?>']").after(msg);
    $("#comment_<?=$entry['id'];?> >.slider_two_title").last().append(msg);

  }) 
}

</script>



<div data="<?php echo $entry['id']; ?>" id="comment_<?php echo $entry['id'] ?>"> 
<?php //echo '<pre>'; print_r($entry['comments']); ?>
                                            <?php
                                                foreach ($entry['comments'] as $comment):
                                                    $cuserdetails = WallModel::getUserDetails($entityManager, $comment['author_id']);
                                                    //echo '<pre>'; print_r($cuserdetails);
                                            ?>
                    
<div class="slider_two_title">
                                <img src="uploads/<?php echo $cuserdetails[0]['profile_pic']; ?>" alt="<?php echo $comment['1firstname'] ?> <?php echo $comment['1lastname'] ?>" style="width:37px;height:37px;">
                                <div class="slider_title_style 1single-comment">
                                    <a href="#"><span class="author_slide_top"><?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></span></a>
                                    <span class="comment_box_bottom_text"><?php echo Functions::addLink($comment['text']) ?></span>
                                    <a href="#"><p class="like_and_reply"><span>Like</span><span class="comment_reply">Reply</span> · <?php echo date('m/d/Y H:i:s', strtotime($comment['date'])) ?></p></a>                                    
                                </div>
                            </div><div class="line"></div>
<?php endforeach ?>
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


        
        
        
        
        
        
        
        <div class="col-sm-3 width_three">
          <div class="right_sidebar profile_page_right_sidebar">
          
            <div class="widget-box">
              <?php $result = $messages->getFriends($entityManager, $session->getSession("userid"), 8); ?>
              <div class="right_sidebar_photos">
                <p><i class="fa fa-user"></i><span><a href="friend_list.php" >Friends(<?php echo $messages->getNumber(true); ?>)</span></p>
              </div>

              <ul class="instagram-photo-list">
                                <?php echo $result; ?>
                
              </ul>
            </div>              

            <div class="find_people">
              <div class="find_people_you_know">
                <p><i class="fa fa-user"></i><span>Find people you know</span></p>
              </div>
            </div>

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
              </div>
            </div>            
            
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
            


            
            
            
          </div>


        </div>

      </div>
      </div>
  </section>
  
  
  </div>
</div>







                                            </body>
                                            </html>


                                            <script>
<?php if ($_GET['msg'] == 'success') { ?>
                        alert("Account added successfully!!!");
                        opener.location.reload();
                        window.close();
                        $('body').show();
                        $('.version').text(NProgress.version);
                        NProgress.start();
                        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
<?php } else if ($_GET['msg'] == 'error') { ?>
                        alert("Oops Already acount availablle!!!");
                        opener.location.reload();
                        window.close();
                        $('body').show();
                        $('.version').text(NProgress.version);
                        NProgress.start();
                        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
<?php } ?>
                    </script>
                    <script>
                        $('body').show();
                        $('.version').text(NProgress.version);
                        NProgress.start();
                        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

                    </script>
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
                    <script src="js/main.js"></script>

                    <script type="text/javascript">
                        //     $(document).ready(function() {
                        //        $("#inst_feeds").click(function(event){
                        //            $('body').show();
                        //            $('.version').text(NProgress.version);
                        //            NProgress.start();
                        //            $('#tabs-container').load('insta_feeds.php');
                        //            setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
                        //        });
                        //    });
    
                        var containerId = '#tabs-container';
                        var tabsId = '.mytabs';

                        $(document).ready(function(){
                            // Preload tab on page load
                            if($(tabsId + ' LI.current A').length > 0){
                                loadTab($(tabsId + ' LI.current A'));
                            }

                            $(tabsId + ' A').click(function(){
                                //$("").val();
          
                                if($(this).parent().hasClass('current')){ return false; }
                                if($(this).attr("href") == 'insta_feeds.php'){
                                    $("#social_menu").val("instagram");
                                    $('body').css('background-image', 'none');
                                    document.body.style.backgroundRepeat="repeat";
                                    document.body.style.height = "100%";
                                    $(tabsId + ' LI.current').removeClass('current');
                                    $(this).parent().addClass('current');

                                    loadTab($(this));
                                }else if($(this).attr("href") == 'twitter_feeds.php'){
                                    $("#social_menu").val("twitter");
                                    $(tabsId + ' LI.current').removeClass('current');
                                    $(this).parent().addClass('current');

                                    loadTab($(this));
                                } else if($(this).attr("href") == 'home.php'){
                
                                    $("#social_menu").val("wdd");
                                    $(tabsId + ' LI.current').removeClass('current');
                                    $(this).parent().addClass('current');

                                    loadWddTab($(this));
                                }
            
                                $('body').show();
                                $('.version').text(NProgress.version);
                                NProgress.start();
            
                                return false;
                            });
                        });

                        function loadTab(tabObj){
                            //        if(!tabObj || !tabObj.length){ return; }
                            //        $(containerId).addClass('loading');
                            //        $(containerId).fadeOut('fast');

                            $(containerId).load(tabObj.attr('href'), function(){
                                //            $(containerId).removeClass('loading');
                                //            $(containerId).fadeIn('fast');
                                setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 500);
                            });
                        }
                        function loadWddTab(tabObj){
                            if(!tabObj || !tabObj.length){ return; }
                            $(containerId).addClass('loading');
                            $(containerId).fadeOut('fast');

                            $(containerId).load('home.php #tabs-container', function(){
                                $(containerId).removeClass('loading');
                                $(containerId).fadeIn('fast');
                                setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 500);
                                $(".wallEntries").append( "<p id='last'></p>" );
                            });
                        }
                    </script>

<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> 

<script src="js/jquery-sortable-photos.js"></script> 

<script src="js/imglazyload.js"></script>
        <script>
            var curDateTime = '<?php echo date('Y-m-d H:i:s');?>';
            var showCount = 0;
            var nowCount=0
            var javaScriptDate = new Date();
            var differSec =0;
        //  alert('CurDaet:'+curDateTime+':Java:'+date);
            /*$.ajax({
                  type: "POST",
                  url: "tweets_ajax.php",
                  data:{curTime:curDateTime},
                
                  success: function(data){
                    $(".wallEntries").prepend(data);
                    
                    $('.notshow').each(function() {
                        var $ids = $('[id=' + this.id + ']');
                        if ($ids.length > 1) {
                            $ids.not(':first').remove();
                        }
                    });
                    
                    showCount = $(".notshow").length;
                    if(showCount>nowCount)
                    {
                        nowCount = showCount;
                        
                        
                        curDateTime = '<?php echo date('Y-m-d H:i:s');?>';
                        var currentMsg ='<p>'+nowCount+' New Posts. </p>';
                        $('.tweetsAct').html(currentMsg);
                        $('.tweetsAct').removeClass('notshow');
                    }
                    setTimeout(function(){
                        checkNewActivity();
                        },2000);
                  }
                });*/
            function checkNewActivity(){
            $.ajax({
                  type: "POST",
                  url: "tweets_ajax.php",
                  data:{curTime:curDateTime,differSec:differSec},
                
                  success: function(data){
                    
                    $(".wallEntries").prepend(data);
                    
                    $('.notshow').each(function() {
                        var $ids = $('[id=' + this.id + ']');
                        if ($ids.length > 1) {
                            $ids.not(':last').remove();
                        }
                    });
                    
                    showCount = $(".notshow").length;
                    if(showCount>nowCount)
                    {
                        nowCount = showCount;
                        var currentMsg ='<p>'+nowCount+' New Posts. </p>';
                        $('.tweetsAct').html(currentMsg);
                        $('.tweetsAct').removeClass('notActshow');
                        var newJavaDate = new Date;
                        differSec = (newJavaDate-javaScriptDate)/1000;
                        //curDateTime = '<?php echo date('Y-m-d H:i:s');?>';
                    }
                    setTimeout(function(){
                        checkNewActivity();
                        },1000);
                  }
                  
                });
        }

$('.tweetsAct').live("click",function(){
                
                $('.notshow').removeClass('notshow');
                    showCount=0;
                    nowCount=0;
                    $('.tweetsAct').addClass('notActshow');
                });
        
            $('.preview img').imgLazyLoad({
                container: window,
                effect: 'fadeIn',
                speed: 600,
                delay: 400,
                callback: function(){

                    $( this ).css( 'opacity', .99 );

                }
            });

            </script>

<script>
$('.photo-grid-container').sortablePhotos({
      selector: '> .photo-grid-item',
      padding: 5
    });
</script>