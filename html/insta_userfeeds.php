<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
$username = $_SESSION['ig_photo_section'];
$insta_user = $instagram->searchUser($username);

$insta_user_id = $insta_user->data[0]->id;
$insta_result = $instagram->getUserMedia($insta_user_id); //$instagram->getUserMedia();//getUserFeed();//getUserMedia();
//$inst_more = $instagram->getUserMoreFeeds($limit = 0, $oauth_token, '908012919341039717_16494719');
//echo $insta_result->pagination->next_max_id.'<br>';
//echo $inst_more->pagination->next_max_id.'<br>';
//echo '<pre>';
//print_r($insta_result);
//die();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>:WHATSDADILLY:</title>
        <link href="css/video-js.css" rel="stylesheet">
        <!--<link href="css/instagram.css" rel="stylesheet">-->
        <script src="js/video.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" href="css/IGoptions.css" type="text/css" />
        <script src="js/IGprofile.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.colorbox.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.lazy.min.js"></script>
        <script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <script src="js/jquery.hoverGrid.js"></script>
        <link href="css/jquery.hoverGrid.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="js/build/coverphoto.css" />
        <script type="text/javascript" src="js/build/coverphoto.js"></script>
        <link rel="stylesheet" href="css/marcel1.css" type="text/css" /> 
        <style>
            #layout { width:995px; height:auto; margin:0 auto;}
            .jquery-bar {
                margin: -14px 0 0 -5px !important;
            }
            .tweet_count_dis{
                margin-top: -46px;
                padding-bottom: 3px;
                padding-left: 223px;
                position: fixed;
                text-align: center;
                width: 579px;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#layout').hoverGrid();
                $("#openBox").colorbox({rel: 'openBox', iframe: true, width: "100%", height: "85%",
                    onClosed: function() {
                        clearAlbum();
                    }
                });

                $(".coverphoto").CoverPhoto({
                    currentImage: '<?php echo $cover_photo; ?>',

                    editable: false

                });
            });
        </script>
    </head>

    <body  class="nobg">
        <?php include 'header.php'; ?>

        <div class="midwht">
            <div id="banner"><div class="coverphoto"></div></div>
            <div class="hommid">
                <div style="width:988px;margin-top:-39px;margin-left: 10px;">
                  
                    <div class="album_lists"  style="width:988px;display: inline-block;margin-top:-45px;">
                         <a class="newbutton"  style="z-index:100;position:relative;" href="javascript:void(0)" onclick="window.history.back();" title="New Album" style="margin-bottom: 4px;">
                        Back to Album
                    </a>
                        <h4 class="album_header">Photos</h4>
                        <div class="tweet_count_dis"></div>
                        <div class="wallEntries" id="postedComments">
                            <div class="ltimeline" id="layout">
                                <?php
                                foreach ($insta_result->data as $user_medias) {

                                    if ($user_medias->type == 'video') {
                                        $media_type = 'View Video';
                                    } else {
                                        $media_type = 'View Photo';
                                    }
                                ?>
                                    <div class="item" data-id="<?php echo $insta_result->pagination->next_max_id; ?>"> <img width="200" height="200" src="<?php echo $user_medias->images->standard_resolution->url; ?>" alt="my image" title="my image" />
                                        <div class="caption" style="display: none;">
                                            <h2><?php echo $user_medias->comments->count; ?> Comments</h2>
                                            <p><?php echo $user_medias->likes->count; ?> Likes</p>
                                            <p><a href="instagram_ajax/view_photo.php?ig_userid=<?php echo $user_medias->id; ?>" tabindex="-1" class="ProfileCard-avatarLink fancybox fancybox.ajax"><?php echo $media_type; ?></a></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div id="loadorders"></div>
                            <div id="loadMoreComments" style="display:none;" ></div>
                        </div>
                    </div>
                </div>
                <div class="friendright" >

                </div></div>
        </div>

    </body>


    <script>
        $(document).ready(function() {
            $('.fancybox').fancybox();
            $("img.media").lazy();

            $("#layout").append( "<p id='last'></p>" );
            $(window).data('ajaxready', true).scroll(function(e) {
                if ($(window).data('ajaxready') == false) return;
                var distanceTop = $('#last').offset().top - $(window).height();

                if  ($(window).scrollTop() >= parseInt(distanceTop)){
                    // alert("window = "+$(window).scrollTop()+"popup"+parseInt(distanceTop));
                    $(window).data('ajaxready', false);
                    var lastid = $(".item:last").attr("data-id"); //$(".grid:first").attr('data');
                    // alert(lastid);
                    // $( ".wallEntries" ).append( "<p>Test</p>" );
                    $(window).data('ajaxready', false);
                    //if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                    // $('div#loadmoreajaxloader').show();

                    $.ajax({
                        cache: false,
                        dataType : "html" ,
                        url: "./instagram_ajax/ig_infinite_userload.php?nextid="+lastid,
                        success: function(html) {
                            if(html != '0' || html== ''){
                                $( ".ltimeline" ).append( html );
                                //                                                              $("#loadorders").append(html);
                                $("#last").remove();
                                $("#layout").append( "<p id='last'></p>" );
                                //                                                           $('div#loadMoreComments').hide();
                            }else{
                                $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                            }
                            $(window).data('ajaxready', true);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>