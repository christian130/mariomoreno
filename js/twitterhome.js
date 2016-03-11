/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor. but in twitter and facebook is really fast. My suggestion please use ajax for all the page and load the content with out loading a page. 
 * the infinite scrolling very fast it's great job and designing in fantastic.  
 */
var timeout;
var ajax_load = "<center><img src='images/load.gif' alt='loading...' /></center>";    
//var rt_loader = "<center><img src='images/rt-loader.gif' /></center>";
$(document).ready(function() {
    $(".fancybox-skin").easydrag();
    $("#postedComments").append( "<p id='last'></p>" );
    $(window).data('ajaxready', true).scroll(function(e) {
        if ($(window).data('ajaxready') == false) return;
        var distanceTop = $('#last').offset().top - $(window).height();
                  var style_display = $("#postedComments").css("display");
        if  ($(window).scrollTop() >= parseInt(distanceTop)){
            var condition = $("#twitter_condition").val();
            if(condition == '1') {
                if(style_display.toString() !='none'){
                $(window).data('ajaxready', false);
                //if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                $('div#loadmoreajaxloader').show();
                        
                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "./twitter_ajax/tweet_infinite_load.php?twittid="+ $(".tweet-outer:last").attr('data')+"&count="+$(".tweet-outer:last").attr('data-count'),
                    success: function(html) {
                        if(html != '0' || html== ''){
                            //$("#postedComments").append(html);
                            $("#loadorders").append(html);
                            $("#last").remove();
                            $("#postedComments").append( "<p id='last'></p>" );
                            $('div#loadMoreComments').hide();
                        }else{
                            $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                        }
                        $('.fancybox').fancybox();
                        $(".fancybox-wrap").easydrag();
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
                        $(window).data('ajaxready', true);
                    }
                });
           }
            } else if(condition =='2'){
                $(window).data('ajaxready', false);
                //if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                var tid = $("#current_tid").val();
                var screen =$("#current_tscreen").val();
                $('div#loadmoreajaxloader').show();

                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "./twitter_ajax/twitter_user_infiniteload.php?tid="+tid+"&screen="+screen+"&twittid="+ $(".tweet-outer:last").attr('data')+"&count="+$(".tweet-outer:last").attr('data-count'),
                    success: function(html) {
                        if(html != '0' || html== ''){
                            //$("#postedComments").append(html);
                            $("#loadorders").append(html);
                            $("#last").remove();
                            $("#postedComments").append( "<p id='last'></p>" );
                            $('div#loadMoreComments').hide();
                        }else{
                            $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                        }
                        $('.fancybox').fancybox();
                        $(".fancybox-wrap").easydrag();
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
                        $(window).data('ajaxready', true);
                    }
                });
            }
            else if(condition == '4')
            {
                $(window).data('ajaxready', false);
                // if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                $('div#loadmoreajaxloader').show();
                  
                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "./twitter_ajax/followers_infinite_load.php?next_cursor="+ $(".stream-container:last").attr('data-cursor'),
                    success: function(html) {
                        if(html != '0' || html== ''){
                            $("#loadorders").append(html);
                            $("#last").remove();
                            $("#postedComments").append( "<p id='last'></p>" );
                            $('div#loadMoreComments').hide();
                        }else{
                            $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                        }
                        $('.fancybox').fancybox();
                        $(".fancybox-wrap").easydrag();
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
                        $(window).data('ajaxready', true);
                    }
                }); 
            // }
            } else if(condition == '5')
{
                $(window).data('ajaxready', false);
                $('div#loadmoreajaxloader').show();
                        
                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "./twitter_ajax/following_infinite_load.php?next_cursor="+ $(".stream-container:last").attr('data-cursor'),
                    success: function(html) {
                        if(html != '0' || html== ''){
                            $("#loadorders").append(html);
                            $("#last").remove();
                            $("#postedComments").append( "<p id='last'></p>" );
                            $('div#loadMoreComments').hide();
                        } else if(html == 0){
                            $('div#loadmoreajaxloader').hide();
                        }
                        else{
                            $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                        }
                        $('.fancybox').fancybox();
                        $(".fancybox-wrap").easydrag(); 
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
                        $(window).data('ajaxready', true);
                    }
                });     
            } else if(condition == '6')
{
                $(window).data('ajaxready', false);
                // if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                $('div#loadmoreajaxloader').show();
                var screen =$("#current_tscreen").val();
                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "./twitter_ajax/userfollowers_infinite_load.php?screen="+screen+"&next_cursor="+ $(".stream-container:last").attr('data-cursor'),
                    success: function(html) {
                        if(html != '0' || html== ''){
                            $("#loadorders").append(html);
                            $("#last").remove();
                            $("#postedComments").append( "<p id='last'></p>" );
                            $('div#loadMoreComments').hide();
                        }else{
                            $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                        }
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
                        $(window).data('ajaxready', true);
                    }
                }); 
            // }
            } else if(condition == '7')
{
                $(window).data('ajaxready', false);
                // if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                $('div#loadmoreajaxloader').show();
                var screen =$("#current_tscreen").val();
                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "./twitter_ajax/userfollowing_infinite_load.php?screen="+screen+"&next_cursor="+ $(".stream-container:last").attr('data-cursor'),
                    success: function(html) {
                        if(html != '0' || html== ''){
                            $("#loadorders").append(html);
                            $("#last").remove();
                            $("#postedComments").append( "<p id='last'></p>" );
                            $('div#loadMoreComments').hide();
                        }else{
                            $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                        }
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
                        $(window).data('ajaxready', true);
                    }
                }); 
            // }
            } 
        }
    });
//    $('#photoimg').live('change', function()			{ 
//        $("#preview").html('');
//        $("#preview").html('<img src="images/loader.gif" alt="Uploading...."/>');
//        $("#imageform").ajaxForm({
//            target: '#preview'
//        }).submit();
//		
//    });
}); 
$(window).load(function() {
    page_load();
});
function page_load()
{
    var urlParams;
    (window.onpopstate = function () {
        var match,
        pl     = /\+/g, 
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) {
            return decodeURIComponent(s.replace(pl, " "));
        },
        query  = window.location.search.substring(1);
        
        urlParams = {};
        while (match = search.exec(query))
            urlParams[decode(match[1])] = decode(match[2]);
    })();
    var page_name = urlParams['opt'];
    switch (page_name) {
        case 'index':
            // load_index();
            break;
        case 'followers':
            load_followers();
            break;
        case 'following':
            load_following();
            break;
        case 'mentions':
            load_mentions();
            break;
        case 'usertimeline':
            load_connect();
            break;
        case 'usermentions':
            load_usermentions();
            break;
        case 'userfollowers':
            load_usersfollower();
            break;
        case 'userfollowing':
            load_usersfollowing();
            break;
    }
}
function load_newtweet()
{
    var condition = $("#twitter_condition").val();
    if(condition == 1) {
        var getURL = "./twitter_ajax/tweet_load.php";
        var count = $(".tweet-outer:first").attr('data-count');
        var tweet_id =  $(".tweet-outer:first").attr('data');
        var screen_name = $("#oauthscreen_name").val();
        $.ajax({
            cache:      false,
            async:      false,
            type:       'POST',
            data:       'tweet_id='+tweet_id+"&screen_name="+screen_name,
            url:        getURL,
            beforeSend: function () {
            //  $(".demo-cb-tweets").prepend('<p class="loading-text">Loading...</p>');
            },
            success:    function(msg){
                //    alert(msg);
                if(msg != '')
                {
                    var resObj = jQuery.parseJSON(msg);
                    document.title = resObj.title+"Twitter";
                    $('div.tweet_count_dis').html(resObj.divtxt);
                }
            } 
        });
    }
}
var page_url = $("#pcurrent_url").val();
if(page_url == 'profile.php' || page_url == 'twitter_feeds.php'){
    timeout = setInterval("load_newtweet()",180000);
}
function load_new_tweets(current_cnt)
{
    // window.location.reload();
    var getURL = "./twitter_ajax/tweet_load_new.php";
    var since_id = $(".tweet-outer:first").attr('data');
    var count = $(".tweet-outer:first").attr('data-count');
    var screen_name = $("#oauthscreen_name").val();
    $.ajax({
        cache:      false,
        async:      false,
        type:       'POST',
        data:       'since_id='+since_id+'&count='+count+'&current_cnt='+current_cnt+'&screen_name'+screen_name,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Loading...</p>');
        },
        success:    function(msg){
            document.title = "Twitter";
            $(".tweet_list").prepend(msg);
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
           
function posttweet()
{
    var getURL = "./twitter_ajax/tweet_post.php";
    var updateme = $("#updateme").val();
    $.ajax({
        cache:      false,
        async:      false,
        type:       'POST',
        data:       'updateme='+updateme,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Tweet posting...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {   
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Tweet posted!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#updateme").val("");
                           
            }
            else if(resObj.success == 0)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to posting the tweete!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
function retweet(tweet_id)
{
    var screen =$("#current_tscreen").val();
    var getURL = "./twitter_ajax/tweet_retweet.php";
    var retweet_id = $("#tweet_id"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'retweet_id='+retweet_id+"&screen="+screen,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Retweeting...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Retweeted!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#tweet-txt"+tweet_id).addClass("retweeted");
            }
            else if(resObj.success == 0)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to retweeting!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}


function pop_retweet(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_retweet.php";
    var retweet_id = $("#tweet_ids"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'retweet_id='+retweet_id,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Retweeting...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Retweeted!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#tweet-txt"+tweet_id).addClass("retweeted");
            }
            else if(resObj.success == 0)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to retweeting!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
function childpop_retweet(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_retweet.php";
    var retweet_id = $("#tweet_ids"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'retweet_id='+retweet_id,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Retweeting...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $.fn.custombox('close');
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Retweeted!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#tweet-txt"+tweet_id).addClass("retweeted");
            }
            else if(resObj.success == 0)
            {
                $.fn.custombox('close');
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to retweeting!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        }
    });
}

function undofavorite_tweet(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_destory.php";
    var retweet_id = $("#tweet_id"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'retweet_id='+retweet_id+'&action=undofav',
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Undo Favorite...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Success!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#tweet-txt"+tweet_id).removeClass("favorited");
            }
            else if(resObj.success == 0)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to Unod Favorite!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
            
             
function destory_tweet(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_destory.php";
    var retweet_id = $("#uretweet_id"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'retweet_id='+retweet_id,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Undo Retweeting...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Success!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#tweet-txt"+tweet_id).removeClass("retweeted");
            }
            else if(resObj.success == 0)
            {
                $("#myModals"+tweet_id).css("visibility", "hidden");
                $(".reveal-modal-bg").css("display","none");
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to Unod retweeting!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
            
function delete_tweet(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_destory.php";
    var retweet_id = $("#tweet_id"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'retweet_id='+retweet_id+'&action=delete',
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Deleting..</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                          
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Deleted!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $('#tweet-outer'+tweet_id).remove();
            }
            else if(resObj.success == 0)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to Deleting!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
            
function pfavorite(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_favorite.php";
    var favorite_id = $("#tweet_ids"+tweet_id).val();
    //	alert(retweet_id);
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'favorite_id='+favorite_id,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Favorite...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Favorited!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#tweet-txt"+tweet_id).addClass("favorited");
            }
            else if(resObj.success == 0)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to favorite!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}            
           
            
function favorite(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_favorite.php";
    var favorite_id = $("#tweet_id"+tweet_id).val();
    //	alert(retweet_id);
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'favorite_id='+favorite_id,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Favorite...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Favorited!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#tweet-txt"+tweet_id).addClass("favorited");
            }
            else if(resObj.success == 0)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to favorite!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
function reply(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_reply.php";
    var reply_id = $("#tweet_id"+tweet_id).val();
    var screen_name = $("#screen_name"+tweet_id).val();
    var reply_message = $("#reply_message"+tweet_id).val();
			
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'reply_id='+reply_id+'&screen_name='+screen_name+'&reply_message='+reply_message,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Replaying...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Successfully sent!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                            
            }
            else if(resObj.success == 0)
            {
	
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to Reply!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
function childpreply(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_reply.php";
    var reply_id = $("#tweet_ids"+tweet_id).val();
    var screen_name = $("#pscreen_name"+tweet_id).val();
    var reply_message = $("#preply_message"+tweet_id).val();

    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'reply_id='+reply_id+'&screen_name='+screen_name+'&reply_message='+reply_message,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Replaying...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $.fn.custombox('close');
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Successfully sent!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#ptweet-reply"+tweet_id).slideToggle("slow");

            }
            else if(resObj.success == 0)
            {
                $.fn.custombox('close');
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to Reply!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        }
    });
}
function preply(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_reply.php";
    var reply_id = $("#tweet_ids"+tweet_id).val();
    var screen_name = $("#pscreen_name"+tweet_id).val();
    var reply_message = $("#preply_message"+tweet_id).val();
			
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'reply_id='+reply_id+'&screen_name='+screen_name+'&reply_message='+reply_message,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Replaying...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="loaded-text">Successfully sent!!!</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");
                $("#ptweet-reply"+tweet_id).slideToggle("slow");
                            
            }
            else if(resObj.success == 0)
            {
                $('.loading-text').remove();
                $(".demo-cb-tweets").prepend('<p class="tweeterror-text">Error to Reply!!!</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
			
function getReplies(tweet_id)
{
    var getURL = "./twitter_ajax/tweet_replied.php";
    var reply_id = $("#reply_to_status_id"+tweet_id).val();
				
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'reply_id='+reply_id,
        url:        getURL,
        beforeSend: function () {
            $(".demo-cb-tweets").prepend('<p class="loading-text">Loading...</p>');
        },
        success:    function(msg){
            $('.loading-text').remove();
            $("#replied"+tweet_id).hide();
            //$("#hreplied"+tweet_id)."+show();
            $("#hreplied"+tweet_id).css('display',"");
            $("#tweet-replied"+tweet_id).html(msg).slideToggle("slow");
        } 
    });
}
function displayRetweeters(tweet_id)
{
    displaymedia(tweet_id);
   // getReplies(tweet_id);
   // displayreply(tweet_id);
    var getURL = "./twitter_ajax/tweet_retweeters.php";
    var tweets_id = $("#rtweet_id"+tweet_id).val();
    $("#retweet_img"+tweet_id).hide();
    $("#hretweet_img"+tweet_id).css('display',"");
    $("#tweet-retweeters"+tweet_id).slideToggle("slow");
    $("#rtweet-replies"+tweet_id).show();
    $("#tweet-reply"+tweet_id).show();
    //$("#tweet-reply"+tweet_id).slideToggle("fast");
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        data:       'tweets_id='+tweets_id,
        url:        getURL,
        beforeSend: function () {
        // $(".demo-cb-tweets").prepend('<p class="loading-text">Loading...</p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.msg == 1)
            {
                $('.loading-text').remove();
            
                $("#tweet-retweeters"+tweet_id).html(resObj.rtr);
                if(resObj.replr != null){
                    $("#rtweet-replies"+tweet_id).html(resObj.replr);
                }
            }
        } 
    });
}
function displaymedia(id)
{
    $("#yfrog"+id).slideToggle("slow");
    $("#tweet-reply"+id).slideToggle("slow");
    // $("#yfrog"+id).show();
   // $("#tweet-reply"+id).show();
}
function displaysummary(tweet_id){
    $("#tweets-summary"+tweet_id).slideToggle("slow");
    $("#tweet-reply"+tweet_id).slideToggle("slow");
    $("#tweet_summ"+tweet_id).hide();
    $("#htweet_summ"+tweet_id).show();
    var getURL = "./twitter_ajax/tweet_view_summary.php";
    var retweet_id = $("#tweet_id"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        timeout: 6000,
        data:       'retweet_id='+retweet_id,
        url:        getURL,
        beforeSend: function () {
        //  $(".demo-cb-tweets").prepend('<p class="loading-text">Loading.</p>');
        },
        success:    function(msg){
            //  $("#summary"+tweet_id).show();
            $("#tweets-summary"+tweet_id).html(msg);
        // $('.loading-text').remove();
        //$(".demo-cb-tweets").prepend('<p class="loaded-text">Deleted!!!</p>');
        //$(".loaded-text").delay(1000).fadeOut("slow");
        //$('#tweet-outer'+tweet_id).remove();
        }
    });
}
function hidesummary(tweet_id){
    $("#tweets-summary"+tweet_id).slideToggle("slow");
    $("#tweet-reply"+tweet_id).slideToggle("slow");
    $("#tweet_summ"+tweet_id).show();
    $("#htweet_summ"+tweet_id).hide();
}
function displaymediavine(id){
    $("#video_vine"+id).slideToggle("slow");
    $("#tweet-reply"+id).slideToggle("slow");
    var vine_id = $("#vinevid"+id).attr("data-vine");
    var getURL = "./twitter_ajax/twitter_vine.php";
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        timeout: 6000,
        data:       'vine_id='+vine_id,
        url:        getURL,
        beforeSend: function () {
        //  $(".demo-cb-tweets").prepend('<p class="loading-text">Loading.</p>');
        },
        success:    function(msg){
            //  $("#summary"+tweet_id).show();
            $("#video_vine"+id).html(msg);
        // $('.loading-text').remove();
        //$(".demo-cb-tweets").prepend('<p class="loaded-text">Deleted!!!</p>');
        //$(".loaded-text").delay(1000).fadeOut("slow");
        //$('#tweet-outer'+tweet_id).remove();
        }
    });
}
function displmed(tweet_id){
    $("#tweets-med"+tweet_id).slideToggle("slow");
    $("#tweet-reply"+tweet_id).slideToggle("slow");
    $("#tweet_med"+tweet_id).hide();
    $("#htweet_med"+tweet_id).show();
    var getURL = "./twitter_ajax/tweet_soundcloud.php";
    var retweet_id = $("#tweet_id"+tweet_id).val();
    $.ajax({
        cache:      true,
        async:      true,
        type:       'post',
        timeout: 6000,
        data:       'retweet_id='+retweet_id,
        url:        getURL,
        beforeSend: function () {
        //  $(".demo-cb-tweets").prepend('<p class="loading-text">Loading.</p>');
        },
        success:    function(msg){
            //  $("#summary"+tweet_id).show();
            $("#tweets-med"+tweet_id).html(msg);
        // $('.loading-text').remove();
        //$(".demo-cb-tweets").prepend('<p class="loaded-text">Deleted!!!</p>');
        //$(".loaded-text").delay(1000).fadeOut("slow");
        //$('#tweet-outer'+tweet_id).remove();
        }
    });
}
function hidemedia(tweet_id){
    $("#tweets-med"+tweet_id).slideToggle("slow");
    $("#tweet-reply"+tweet_id).slideToggle("slow");
    $("#tweet_med"+tweet_id).show();
    $("#htweet_med"+tweet_id).hide();
}
function displayphoto(id)
{
    $("#yfrogs"+id).slideToggle("slow");
// $("#tweet-reply"+id).slideToggle("slow");
}
function displayreply(id)
{
    $("#tweet-reply"+id).slideToggle("slow");
}
function pdisplayreply(id)
{
    $("#ptweet-reply"+id).slideToggle("slow");
}
function displayConversation(tweet_id)
{
    $("#hreplied"+tweet_id).css('display',"none");
    $("#tweet-replied"+tweet_id).slideToggle("slow");
    $("#replied"+tweet_id).show();
}
function hideRetweeters(id)
{$("#yfrog"+id).hide();
    $("#tweet-reply"+id).hide();
    $("#rtweet-replies"+id).hide();
    $("#hretweet_img"+id).css('display',"none");
    $("#tweet-retweeters"+id).slideToggle("slow");
   // $("#tweet-reply"+id).slideToggle("slow");
    $("#tweet-reply"+id).hide();
    $("#retweet_img"+id).show();
}
function load_connect(){
    var tid = $("#current_tid").val();
    var screen =$("#current_tscreen").val();
    $(".tweet_list").html(ajax_load).load("./twitter_ajax/usertimeline.php?tid="+tid+"&screen="+screen,
        function(){
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

        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "usertimeline", page_url+'opt=usertimeline');
    $("#twitter_condition").val(2);
    $("#loadmoreajaxloader").hide();
    $(".WhiteboardGrey").remove();

}
function load_mentions() {
    var screen =$("#current_tscreen").val();
    $(".tweet_list").html(ajax_load).load("./twitter_ajax/mentions.php?screen="+screen,
        function(){
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

        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "mentions", page_url+'opt=mentions');
    $("#twitter_condition").val(3);
    $("#loadmoreajaxloader").hide();
    $(".WhiteboardGrey").remove();

}
function load_usermentions() {
    var screen =$("#current_tscreen").val();
    $(".tweet_list").html(ajax_load).load("./twitter_ajax/user_mentions.php?screen="+screen,
        function(){
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

        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "mentions", page_url+'opt=usermentions');
    // $("#twitter_condition").val(3);
    // $("#loadmoreajaxloader").hide();
    $(".WhiteboardGrey").remove();
}
//function load_userfav() {
//    var screen =$("#current_tscreen").val();
//    $(".tweet_list").html(ajax_load).load("./twitter_ajax/twitter_profile_fav.php?screen"+screen,
//        function(){
//            $('.fancybox').fancybox();
//            $(".fancybox-effects-a").fancybox({
//                helpers: {
//                    title : {
//                        type : 'outside'
//                    },
//                    overlay : {
//                        speedOut : 0
//                    }
//                }
//            });
//
//        });
//    var page_url = $("#current_url").val();
//    window.history.pushState("", "mentions", page_url+'opt=userfav');
//    // $("#twitter_condition").val(3);
//    // $("#loadmoreajaxloader").hide();
//    $(".WhiteboardGrey").remove();
//}

function load_userfav(){
    //var tid = $("#current_tid").val();
    var screen =$("#current_tscreen").val();
    $(".tweet_list").show().html(ajax_load).load("./twitter_ajax/twitter_profile_fav.php?screen="+screen,
        function(){
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
        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "following", page_url+'opt=userfav');
    $(".WhiteboardGrey").remove();
    $("#twitter_condition").val(8);
}
function load_index(){
    //  $(".tweet_count_dis").hide();
    $(".tweet_count_dis").show();
    $("#loadmoreajaxloader").hide();
    $(".tweet_list").html(ajax_load).load("twitter_feeds.php?option=index .home_timeline",
        function(){
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

        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "index", page_url+'opt=index');
    $("#twitter_condition").val(1);
}

function load_timeline(){
    //$("tweet_count_dis").show();
    //var screenname = $("#oauthscreen_name").val();
    $(".tweet_list").html(ajax_load).load("index.php?option=com_community&view=uprofile .home_timeline",
        function(){
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

        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "index", page_url+'opt=userindex');
}
function load_followers(){
    //$(".tweet_count_dis").hide();
    $(".tweet_list").show().html(ajax_load).load("./twitter_ajax/followers.php",
        function(){
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
        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "followers", page_url+'opt=followers');
    $("#twitter_condition").val(4);
  
}
function load_following(){
    $(".tweet_count_dis").hide();

    $(".tweet_list").show().html(ajax_load).load("./twitter_ajax/following.php",
        function(){
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
        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "following", page_url+'opt=following');
    $("#twitter_condition").val(5);
    
}
function load_usersfollower(){
    var screen =$("#current_tscreen").val();
    $(".tweet_list").show().html(ajax_load).load("./twitter_ajax/user_followers.php?screen="+screen,
        function(){
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
        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "followers", page_url+'opt=userfollowers');
    $("#twitter_condition").val(6);
}
function load_usersfollowing(){
    //var tid = $("#current_tid").val();
    var screen =$("#current_tscreen").val();
    $(".tweet_list").show().html(ajax_load).load("./twitter_ajax/user_following.php?screen="+screen,
        function(){
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
        });
    var page_url = $("#current_url").val();
    window.history.pushState("", "following", page_url+'opt=userfollowing');
    $("#twitter_condition").val(7);
    
}
function goToByScroll(){
    $('html,body').animate({
        scrollTop: $("#movetounordered").offset().top
    },'slow');
}
function scrollToTop() {
    $('html, body').animate({
        scrollTop:0
    }, 'slow');
}
function do_follow(screenname){
    // var screenname = $("#btn"+id).attr("data");
    var con = $("#f_condition"+screenname).val();
    var getURL
    if(con == '2'){
        getURL = "./twitter_ajax/twitter_ff.php";
    } else if(con == '1'){
        getURL = "./twitter_ajax/twitter_uf.php";
    }
    if(con == '2'){
        $('#'+screenname).removeClass("follows");  
        $('#'+screenname).addClass("followings-text"); 
        $('#spn'+screenname).text('Following');
        $("#f_condition"+screenname).val(1);
                    
    } else if(con == '1'){
        $('#'+screenname).removeClass("followings-text");  
        $('#'+screenname).addClass("follows");  
        $('#spn'+screenname).text('Follow');
        $("#f_condition"+screenname).val(2);
    }
    $.ajax({
        cache:      false,
        async:      false,
        type:       'POST',
        data:       'screenname='+screenname,
        url:        getURL,
        beforeSend: function () {
            $(".pop_demo-cb-tweets").prepend('<p class="loading-text">Requesting..</p>');
        },
        complete: function(){
            $('.loading-text').remove();
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                if(con == '2'){
                    $('#'+screenname).removeClass("follows");  
                    $('#'+screenname).addClass("followings-text"); 
                    $('#spn'+screenname).text('Following');
                    $("#f_condition"+screenname).val(1);
                    
                } else if(con == '1'){
                    $('#'+screenname).removeClass("followings-text");  
                    $('#'+screenname).addClass("follows");  
                    $('#spn'+screenname).text('Follow');
                    $("#f_condition"+screenname).val(2);
                }
            }
            else
            {
                $('.loading-text').remove();
                $(".pop_demo-cb-tweets").prepend('<p class="tweeterror-text">'+resObj.success+'</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        } 
    });
}
function sendDM(){
    var getURL = "twitter_ajax/twitter_dm.php";
    var screenname = $("#dm_screenname").val();
    var dm_text = $("#dm_text").val();
    $.ajax({
        cache:      false,
        async:      false,
        type:       'POST',
        data:       'screenname='+screenname+"&dm_text="+dm_text,
        url:        getURL,
        beforeSend: function () {
            $(".pop_demo-cb-tweets").prepend('<p class="loading-text">Sending</p>');
        },
        complete: function(){
            $('.loading-text').remove();
        //$(".demo-cb-tweets").prepend('<p class="loading-text"></p>');
        },
        success:    function(msg){
            var resObj = jQuery.parseJSON(msg);
            if(resObj.success == 1)
            {
                $.fn.custombox('close');
                $('.loading-text').remove();
                $(".pop_demo-cb-tweets").prepend('<p class="loaded-text">Send</p>');
                $(".loaded-text").delay(1000).fadeOut("slow");

            }
            else
            {
                $('.loading-text').remove();
                $(".pop_demo-cb-tweets").prepend('<p class="tweeterror-text">'+resObj.success+'</p>');
                $(".tweeterror-text").delay(1000).fadeOut("slow");
            }
        }
    });
}


$(function() {
    "use strict";

    /*
     ----------------------------
     Tooltip
     ----------------------------
     */
    var $window = $(window);

    if ( $window.width() < 360 ) {
        $(document.getElementById('tooltip')).css('right', 0);
    }

    if( navigator.appVersion.indexOf("MSIE 8.") == -1 ) {
        $(document.getElementById('tooltip')).animate({
            top:    '-45px',
            opacity: 1
        }, 600);
    }

    /*
     ----------------------------
     Show code without jQuery
     ----------------------------
     */
    $(document.getElementById('actiontutorial')).on('click', function () {
        $(document.getElementById('tutorial')).slideToggle();
    });

    /*
     ----------------------------
     Custom sidebar
     ----------------------------
     */
    var $sidebar = $(document.getElementById('sidebar')),
    sidebar_width = $sidebar.width();

    if ( $window.width() > 1170 && $sidebar.height() < $window.height() ) {
        $window.on('scroll', function () {
            var $this = $(this);
            if( $this.scrollTop() > 155 && $this.width() > 980 ) {
                $(document.getElementById('tooltip')).hide();
                $sidebar.css({
                    position:   'fixed',
                    top:        '20px',
                    width:      sidebar_width + 'px'
                });
            } else if ( $this.scrollTop() <= 155 ) {
                $(document.getElementById('tooltip')).show();
                $sidebar.removeAttr('style');
            }
        });
    }

    /*
     ----------------------------
     Fadein
     ----------------------------
     */
    $('.fadein').on('click', function ( e ) {
        $.fn.custombox( this, {
            effect: 'fadein'
        });
        e.preventDefault();
    });

});
function show_mentions(){
    $("#ltimeline").hide();
    $("#mentions").show();
    $("#tw_following").hide();
    $("#tw_favorites").hide();
    $("#tw_followers").hide();
        var f_data =  $("#mentions").text();
    if(f_data.length == 14){
        var getURL = "twitter_ajax/tw_child_mentions.php";
        var screenname = $("#dm_screenname").val();
        $.ajax({
            cache:      false,
            async:      false,
            type:       'GET',
            data:       'screenname='+screenname,
            url:        getURL,
            beforeSend: function () {
                $("#mentions").prepend('<p class="loading-text">Loading</p>');
            },
            complete: function(){
                $('.loading-text').remove();
            },
            success:    function(msg){

                $('.loading-text').remove();
                $("#mentions").html(msg);

            }
        });
    }
}
function show_home(){
    $("#ltimeline").show();
    $("#mentions").hide();
    $("#tw_following").hide();
    $("#tw_favorites").hide();
    $("#tw_followers").hide();
}
function show_following(){
    $("#ltimeline").hide();
    $("#mentions").hide();
    $("#tw_following").show();
    $("#tw_favorites").hide();
    $("#tw_followers").hide();
    var f_data =  $("#tw_following").text();
    if(f_data.length == 14){
        var getURL = "twitter_ajax/tw_child_following.php";
        var screenname = $("#dm_screenname").val();
        $.ajax({
            cache:      false,
            async:      false,
            type:       'GET',
            data:       'screenname='+screenname,
            url:        getURL,
            beforeSend: function () {
                $("#tw_following").prepend('<p class="loading-text">Loading</p>');
            },
            complete: function(){
                $('.loading-text').remove();
            },
            success:    function(msg){

                $('.loading-text').remove();
                $("#tw_following").html(msg);
           
            }
        });
    }
}
function show_followers(){
    $("#ltimeline").hide();
    $("#mentions").hide();
    $("#tw_following").hide();
    $("#tw_favorites").hide();
    $("#tw_followers").show();
    var f_data =  $("#tw_followers").text();
    if(f_data.length == 15){
        var getURL = "twitter_ajax/tw_child_followers.php";
        var screenname = $("#dm_screenname").val();
        $.ajax({
            cache:      false,
            async:      false,
            type:       'GET',
            data:       'screenname='+screenname,
            url:        getURL,
            beforeSend: function () {
                $("#tw_followers").prepend('<p class="loading-text">Loading</p>');
            },
            complete: function(){
                $('.loading-text').remove();
            },
            success:    function(msg){
                $('.loading-text').remove();
                $("#tw_followers").html(msg);
            }
        });
    }
}
function show_favorites()
{
    $("#ltimeline").hide();
    $("#mentions").hide();
    $("#tw_following").hide();
    $("#tw_favorites").show();
    $("#tw_followers").hide();
        var f_data =  $("#tw_favorites").text();
    if(f_data.length == 14){
        var getURL = "twitter_ajax/tw_child_favorities.php";
        var screenname = $("#dm_screenname").val();
        $.ajax({
            cache:      false,
            async:      false,
            type:       'GET',
            data:       'screenname='+screenname,
            url:        getURL,
            beforeSend: function () {
                $("#tw_favorites").prepend('<p class="loading-text">Loading</p>');
            },
            complete: function(){
                $('.loading-text').remove();
            },
            success:    function(msg){

                $('.loading-text').remove();
                $("#tw_favorites").html(msg);

            }
        });
    }
}