/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function show_home(){
    $("#layout").show();
    $("#ig_followers").hide();
    $("#ig_following").hide();
}
function show_followers(){
    $("#layout").hide();
    $("#ig_following").hide();
    $("#ig_followers").show();

    var f_data =  $("#ig_followers").text();
    if(f_data.length == 15){
        var getURL = "instagram_ajax/ig_user_followers.php";
        var userid = $("#ig_user_id").val();
        $.ajax({
            cache:      false,
            async: true,
            type:       'GET',
            data:       'userid='+userid,
            url:        getURL,
            beforeSend: function () {
                $("#ig_followers").prepend('<p class="loading-text">Loading</p>');
            },
            complete: function(){
                $('.loading-text').remove();
            },
            success:    function(msg){
                $('.loading-text').remove();
                $("#ig_followers").html(msg);
            }
        });
    }
}
function show_following(){
    $("#layout").hide();
    $("#ig_followers").hide();
    $("#ig_following").show();
    var f_data =  $("#ig_following").text();
    if(f_data.length == 15){
        var getURL = "instagram_ajax/ig_user_following.php";
        var userid = $("#ig_user_id").val();
        $.ajax({
            cache:      false,
            async: true,
            type:       'GET',
            data:       'userid='+userid,
            url:        getURL,
            beforeSend: function () {
                $("#ig_following").prepend('<p class="loading-text">Loading</p>');
            },
            complete: function(){
                $('.loading-text').remove();
            },
            success:    function(msg){
                $('.loading-text').remove();
                $("#ig_following").html(msg);
            }
        });
    }
}

function load_newIGpost()
{
    
    var getURL = "./instagram_ajax/IGnewpost_load.php";
    var lastIGpost = $(".timelineItem:first").attr('data-rec-id');
    $.ajax({
        cache:      false,
        async: true,
        type:       'POST',
        data:       'lastIGpost='+lastIGpost,
        url:        getURL,
        beforeSend: function () {
        //  $(".demo-cb-tweets").prepend('<p class="loading-text">Loading...</p>');
        },
        success:    function(msg){
            //    alert(msg);
            if(msg != '')
            {
                var resObj = jQuery.parseJSON(msg);
                document.title = resObj.title+" Instagram";
                $('div.tweet_count_dis').html(resObj.divtxt);
            }
        }
    });
}

function load_new_ig_post()
{
    // window.location.reload();
    var getURL = "./instagram_ajax/IGnewpost_load_new.php";
    var lastIGpost = $(".timelineItem:first").attr('data-rec-id');
    $.ajax({
        cache:      false,
        async: true,
        type:       'POST',
        data:       'lastIGpost='+lastIGpost,
        url:        getURL,
        beforeSend: function () {
        //$(".demo-cb-tweets").prepend('<p class="loading-text">Loading...</p>');
        },
        success:    function(msg){
            document.title = "Instagram";
            $(".wallEntries").prepend(msg);
            $('.loading-text').remove();
            $(".WhiteboardGrey").remove();
        }

    });
    $('.fancybox').fancybox();
    $(".fancybox-effects-a").fancybox({
        helpers: {
            title : {
                type : 'outside'
            },
            overlay : {
                speedOut : 0
            }
        }
    });
}
function addMediaLike(mediaid){
    var getURL = "instagram_ajax/ig_media_like.php";
    var isLiked = $( "#"+mediaid ).hasClass( "timelineLiked" );
    var action;
    if(isLiked == true){
        action = 'unlike';
        $("#"+mediaid).removeClass( "timelineLiked" );
    } else {
        action = 'like';
        $("#"+mediaid).addClass("timelineLiked");
    }
    $.ajax({
        cache:      false,
        async: true,
        type:       'POST',
        data:       'mediaid='+mediaid+'&action='+action,
        url:        getURL,
        beforeSend: function () {
            $("#ig_following").prepend('<p class="loading-text">Loading</p>');
        },
        complete: function(){
            $('.loading-text').remove();
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.action == 'like'){
                $("#"+mediaid).addClass("timelineLiked");
            }else {
                $("#"+mediaid).removeClass( "timelineLiked" );
            }
        }
    });
}
function makeRelationship(userid){
    var getURL = "instagram_ajax/ig_relationship.php";
    var isLiked = $("#"+userid ).hasClass( "followings-text" );
    var action;
    if(isLiked == true){
        // alert("Already following");
        action = 'unfollow';
        $("#"+userid).removeClass( "followings-text" );
        $("#"+userid).addClass("follows");
        $("#"+userid+" span").html("<i class='follow'></i>Follow");
    } else {
        //alert("Already follow");
        action = 'follow';
        $("#"+userid).removeClass( "follows" );
        $("#"+userid).addClass("followings-text");
        $("#"+userid+" span").html("<i class='follow'></i>Following");
    }
    $.ajax({
        cache:      false,
        async: true,
        type:       'POST',
        data:       'userid='+userid+'&action='+action,
        url:        getURL,
        beforeSend: function () {
            $("#ig_following").prepend('<p class="loading-text">Loading</p>');
        },
        complete: function(){
            $('.loading-text').remove();
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.action == 'follow'){
                action = 'follow';
                $("#"+userid).removeClass( "follows" );
                $("#"+userid).addClass("followings-text");
                $("#"+userid+" span").html("<i class='follow'></i>Following");
            }else if(resObj.action == 'requested'){
                action = 'follow';
                $("#"+userid).removeClass( "follows" );
                $("#"+userid).addClass("followings-text");
                $("#"+userid+" span").html("<i class='follow'></i>Requested");
            }else {
                action = 'unfollow';
                $("#"+userid).removeClass( "followings-text" );
                $("#"+userid).addClass("follows");
                $("#"+userid+" span").html("<i class='follow'></i>Follow");
            }
        }
    });
    
}
function commentPost(post_id){
    var getURL = "instagram_ajax/ig_post_comments.php";
    var data = $("#cmtfrm_"+post_id).serialize();
    $.ajax({
        cache:      false,
        async: true,
        type:       'POST',
        data:       data,
        url:        getURL,
        beforeSend: function () {
        // $("#ig_following").prepend('<p class="loading-text">Loading</p>');
        },
        complete: function(){
        //$('.loading-text').remove();
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            
        }
    });

}