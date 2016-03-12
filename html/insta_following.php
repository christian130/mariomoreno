<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>:WHATSDADILLY:</title>
    <input type="hidden" name="pcurrent_url" id="pcurrent_url" value="<?php echo $pcur_url; ?>" />
    <link href="css/video-js.css" rel="stylesheet">
    <!--<link href="css/instagram.css" rel="stylesheet">-->
    <script src="js/video.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/IGoptions.css" type="text/css" />
    <script type="text/javascript" src="js/IGprofile.js"></script>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tweet_options.css">
    <style>
        .jquery-bar {
            margin: -14px 0 0 -5px !important;
        }
    </style>

</head>
<body class="nobg">
    <div class="main_content">


        <div class="hommidIG main" >
            <div id="insta_followers">
                <div class="wallEntriesIgFollowing" id="postedComments" style="margin-top: 34px;">

                    <?php
                    $instagram = new Instagram(IG_CONSUMER_KEY);
                    $instagram->setAccessToken($oauth_token);
                    $user_follwers = $instagram->getUserFollows($insta_user_id, 5);
                    // echo '<pre>';
                    // print_r($user_follwers);
                    foreach ($user_follwers->data as $k => $details) {
                        echo '<div data-userid="' . $insta_user_id . '" data-cursor="' . $user_follwers->pagination->next_cursor . '" class="stream-container" style="border-radius: 5px 5px 0 0;">';
                        echo '<ol class="stream-items">';
                        $following = '';
                        $followings = '';
                        $user_relationship = $instagram->getUserRelationship($details->id);
                        //$ret = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=' . $screenname_b . '&target_screen_name=' . $details->screen_name);

                        if ($user_relationship->data->outgoing_status == "follows") {
                            $following = '<span class="button-text following-text" id="spn' . $details->screen_name . '"><i class="follow"></i> Following</span>';
                            $followings = 'followings-text';
                            echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="1" />';
                        } else {
                            $following = '<span class="button-text follow-text" data="' . $details->screen_name . '" id="spn' . $details->screen_name . '"><i class="follow"></i> Follow</span>';
                            $followings = 'follows';
                            echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="2" />';
                        }

                        echo '<li class="js-stream-item stream-item stream-item">';
                        echo '<div data-user-id="' . $details->id . '" data-screen-name="' . $details->username . '" class="account  js-actionable-user js-profile-popup-actionable ">';
                        echo '<div data-protected="false" data-name="' . $details->username . '" data-screen-name="' . $details->username . '" data-user-id="' . $details->id . '" class="user-actions btn-group following can-dm including  ">';
                        // echo "<div class='tweet-pic'><img src='" . $details->profile_image_url . "' title='" . $details->name . "' class='profile_pic'></div>";
                        echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '" id="' . $details->id . '" data="' . $details->username . '" onclick="makeRelationship(this.id)">';
                        echo $following;
                        echo '</button>';
                        echo '</div>';
                        echo '<div class="content">
                                 <div class="stream-item-header">
                                      <div class="ProfileCard js-actionable-user">
                                 <a class="ProfileCard-bg" href="#" style="background-color: #0084B4;background-image: url(images/banner.jpg);">
                                </a>
                                  <div class="ProfileCard-content">
                                    <a href="instagram_ajax/insta_profile.php?screenname=' . $details->username . '" tabindex="-1" class="ProfileCard-avatarLink fancybox fancybox.ajax"><img data-user-id="' . $details->id . '" alt="' . $details->full_name . '" src="' . $details->profile_picture . '" class="ProfileCard-avatarImage avatar js-action-profile-avatar "></a>
                                  </div></div>    <strong class="fullname js-action-profile-name" style="color:#3f729b !important;font-size:12px;">' . $details->full_name . '</strong>
                                         <span>&rlm;</span>
                                         <span class="username js-action-profile-name" style="color:#3f729b !important">@' . $details->username . '</span>
                                      </a>
                                    <p class="bio" style="margin:0;color:black !important;">' . $details->bio . ' </p>
                                </div>
                             </div>';
                        echo '</div>';
                        echo '</li>';
                        echo '</ol>';
                        echo '</div>';
                        $k++;
                    }
                    ?>

                    <div id="loadorders"></div>
                    <div id="loadMoreComments" style="display:none;" ></div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.fancybox').fancybox();
            $("img.media").lazy();
            var page_name = $(location).attr('search');
            if(page_name != '?followers'){
                timeout = setInterval("load_newIGpost()",30000);
            }
            $("#postedComments").append( "<p id='last'></p>" );
            $(window).data('ajaxready', true).scroll(function(e) {
                if ($(window).data('ajaxready') == false) return;
                var distanceTop = $('#last').offset().top - $(window).height();
                if  ($(window).scrollTop() >= parseInt(distanceTop)){
                    // alert("window = "+$(window).scrollTop()+"popup"+parseInt(distanceTop));
                    $(window).data('ajaxready', false);
                    var lastid = $(".stream-container:last").attr("data-cursor"); //$(".grid:first").attr('data');
                    var userid = $(".stream-container:last").attr("data-userid");
                    //alert(lastid);
                    // $( ".wallEntries" ).append( "<p>Test</p>" );
                    $(window).data('ajaxready', false);
                    //if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                    // $('div#loadmoreajaxloader').show();

                    $.ajax({
                        cache: false,
                        dataType : "html" ,
                        type:       'POST',
                        url: "./instagram_ajax/ig_infinite_load_followers.php?nextid="+lastid+"&userid="+userid,
                        success: function(html) {
                            if(html != '0' || html== ''){
                                $( ".wallEntries" ).append( html );
                                //                                                              $("#loadorders").append(html);
                                $("#last").remove();
                                $("#postedComments").append( "<p id='last'></p>" );
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