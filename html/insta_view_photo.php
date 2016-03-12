<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$instagram = new Instagram(IG_CONSUMER_KEY);
$instagram->setAccessToken($oauth_token);
$insta_result = $instagram->getMedia('909195057195037181_703882475');
$media_comments = $instagram->getMediaComments('909195057195037181_703882475');
$media_likes = $instagram->getMediaLikes('909195057195037181_703882475');
$screenname = $insta_result->data->user->username;
$text = htmlentities($insta_result->data->caption->text, ENT_QUOTES, 'utf-8');
$text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $text);
$text = preg_replace('/@(\w+)/', '<a href="instagram_ajax/insta_profile.php?screenname=$1" class="fancybox fancybox.ajax" title="Profile Summary">@$1</a>', $text);
$text = preg_replace('/\s#(\w+)/', ' <a href="instagram_ajax/insta_tag_search.php?q=$1" class="fancybox fancybox.ajax">#$1</a>', $text);
//echo '<pre>';
//print_r($media_likes);
//die();
?>
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
    <script src="js/IGprofile.js"></script>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <style>
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

</head>
<body class="nobg">
    <div class="main_content">
        <?php include 'header.php' ?>

        <div class="container">
            <div class="main">
                <div class="tweet_count_dis"></div>
                <div class="wallEntries" id="postedComments">
                    <div id="outer_box" >
                        <div class="pop_demo-cb-tweets" style="text-align:center;"></div>
                        <div id="tabs">

                            <div class="profile_description">
                                <div>

                                    <div style="float: left"><img src="<?php echo $insta_result->data->user->profile_picture; ?>" width="40px" height="40px" /></div>

                                    <div style="display: inline;margin-left:10px;">
                                        <b style="font-size:18px;"><?php echo ucfirst($insta_result->data->user->full_name); ?></b><br/>
                                        <span style="color:#999;margin-left:10px;">@ <?php echo ucfirst($screenname); ?></span>
                                    </div>
                                </div>
                            </div>


                            <div id="jp-container" class="jp-container">
                                <?php
                                if ($insta_result->data->type === 'video') {
                                    // video
                                    $poster = $insta_result->data->images->standard_resolution->url;
                                    $source = $insta_result->data->videos->standard_resolution->url;
                                    echo $source;
                                    $content .= "<video class=\"media video-js vjs-default-skin\" width=\"640px\" height=\"640px\" poster=\"{$poster}\"
                            data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                                } else {
                                    $image = $insta_result->data->images->standard_resolution->url;
                                    $content .= "<img style='border-radius:5px;border:0px solid;' width='100%' height='100%' data-id=\"{$insta_result->data->id}\" class=\"media\" src=\"{$image}\" data-src=\"{$image}\" />";
                                }
                                echo $content;
                                ?>
                                <div class="timelineLikes">
                                    <?php if ($insta_result->user_has_liked == 1) {
                                    ?>
                                        <a class="timelineLikeButton timelineLiked" title="Toggle like" href="javascript:;">
                                            <span class="i-like-pop timelineLikeButtonAnimation"></span>
                                        </a>
                                    <?php } else {
                                    ?>
                                        <a class="timelineLikeButton" title="Toggle like" href="javascript:;">
                                            <span class="timelineLikeButtonAnimation"></span>
                                        </a>
                                    <?php } ?>
                                    <div class="mediaMoreButtonContainer">
                                        <a role="button" title="More" href="javascript:;" class="mediaMoreButton" aria-haspopup="true"> </a>
                                    </div>
                                    <div class="timelineLikeList">
                                        <?php if ($insta_result->data->likes->count > 0) {
                                        ?>
                                            <span class="LikeList">
                                            <?php
                                            $i = 0;
                                            foreach ($media_likes->data as $likes) {
                                                if ($i <= 2) {
                                            ?>
                                                    <span></span>
                                                    <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $likes->username; ?>" class="llNameLink fancybox fancybox.ajax"><?php echo $likes->username; ?></a>
                                                    <span>, </span>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                            <span> and </span>
                                            <span class="llRemainingCount"><?php echo $insta_result->data->likes->count - $i; ?></span>
                                            <span> others like this.</span>
                                        </span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="timelineComments">
                                    <div class="timelineComment timelineCaption">
                                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $insta_result->data->user->username; ?>" class="fancybox fancybox.ajax">
                                            <div class="timelineCommentAvatar Image" src="<?php echo $insta_result->data->user->profile_picture; ?>">
                                                <div style="background-image:url('<?php echo $insta_result->data->user->profile_picture; ?>');" class="iImage">
                                                </div>
                                            </div>
                                        </a>
                                        <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $insta_result->data->user->username; ?>" class="timelineCommentUsername fancybox fancybox.ajax"><?php echo $insta_result->data->user->username; ?></a>
                                        <span class="timelineCommentText">
                                            <?php echo $text; ?>
                                        </span>
                                        <a class="delete-comment"></a>
                                    </div>

                                    <div class="scrollArea scrollAreaOpen scrollAreaInitialized">
                                        <div class="scrollAreaContents">
                                            <?php
                                            foreach ($media_comments->comments as $comments) {
                                                $cmt = htmlentities($comments->text, ENT_QUOTES, 'utf-8');
                                                $cmt = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">' . $disp_url . '</a>', $cmt);
                                                $cmt = preg_replace('/@(\w+)/', '<a href="instagram_ajax/insta_profile.php?screenname=$1" class="fancybox fancybox.ajax" title="Profile Summary">@$1</a>', $cmt);
                                                $cmt = preg_replace('/\s#(\w+)/', ' <a href="instagram_ajax/insta_tag_search.php?q=$1" class="fancybox fancybox.ajax">#$1</a>', $cmt);
                                            ?>
                                                <div class="timelineComment">
                                                    <a href="instagram_ajax/insta_profile.php?screenname=<?php echo $comments->from->username; ?>" class="fancybox fancybox.ajax"><?php echo $comments->from->username; ?>
                                                        <div class="timelineCommentAvatar Image" src="<?php echo $comments->from->profile_picture; ?>">
                                                            <div style="background-image:url('<?php echo $comments->from->profile_picture; ?>');" class="iImage">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <!--<a  href="instagram_ajax/insta_profile.php?screenname=<?php //echo $comments->from->username;      ?>" class="fancybox fancybox.ajax timelineCommentUsername"><?php //echo $comments->from->username;      ?></a>-->
                                                    <span class="timelineCommentText">
                                                    <?php echo $cmt; ?>
                                                </span>
                                                <a class="delete-comment"></a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.fancybox').fancybox();
            $("img.media").lazy();
              
        });
    </script>
</body>
</html>