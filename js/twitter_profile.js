/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    $(function() {
//        $("#tabs" ).tabs();
//        $("#tabs-2").hide();
//        $("#tabs-3").hide();
//        $("#tabs-4").hide();
        
        $("a#twitter_dm").click(function(){
            $("#fancy_ajax").animate({ scrollTop: $("#tabs-2").scrollHeight}, 1000);
            $("#dmessage").show();
 
        });
        $("a#twitter_rp").click(function(){
            $("#fancy_ajax").animate({ scrollTop: $("#tabs-2").scrollHeight}, 1000);
            $("#tw_reply").show();
        })
        $("#dm_cancel").click(function(){
            $("#dmessage").hide(); 
        });
        $("#rp_cancel").click(function(){
            $("#tw_reply").hide(); 
        });
//        $("a#tabs2").click(function(){
//            $("#tabs-1").hide();
//            $("#tabs-2").show();
//            $("#tabs-3").hide();
//            $("#tabs-4").hide();
//        });
//        $("a#tabs3").click(function(){
//            $("#tabs-1").hide();
//            $("#tabs-3").show();
//            $("#tabs-2").hide();
//            $("#tabs-4").hide();
//        });
//
        
//        $("a#tabs4").click(function(){
//            var getURL = "twitter_ajax/twitter_profile_fav.php";
//            var screenname = "<?php echo $_GET['screenname']; ?>";
//            $.ajax({
//                cache:      false,
//                async:      false,
//                type:       'get',
//                data:       'screenname='+screenname,
//                url:        getURL,
//                beforeSend: function () {
//                    $(".pop_demo-cb-tweets").prepend('<p class="loading-text">Loading favorities...</p>');
//                },
//                complete: function(){
//                    $('.loading-text').remove();
//                    // $(".demo-cb-tweets").prepend('<p class="loading-text"></p>');
//                },
//                success:    function(msg){
//                    $("#tabs-1").hide();
//                    $("#tabs-4").html(msg).show();
//                    $("#tabs-3").hide();
//                    $("#tabs-2").hide();
//
//                }
//            });
//
//        });
        
//        $("a#tabs1").click(function(){
//            $("#tabs-2").hide();
//            $("#tabs-1").show();
//            $("#tabs-3").hide();
//            $("#tabs-4").hide();
//        });
        
        
        
        
         
        $("#rp_send").click(function()
        {
            var getURL = "twitter_ajax/tweet_post.php";
            var re_text = $("#rp_text").val();
            $.ajax({
                cache:      false,
                async:      false,
                type:       'POST',
                data:       'updateme='+re_text,
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
                        $("#tw_reply").hide(); 
                        $('.loading-text').remove();
                        $(".pop_demo-cb-tweets").prepend('<p class="loaded-text">Send</p>');
                        $(".loaded-text").delay(1000).fadeOut("slow");
                        $("#tweet-txt"+tweet_id).addClass("favorited");
                    }
                    else
                    {
                        $('.loading-text').remove();
                        $(".pop_demo-cb-tweets").prepend('<p class="tweeterror-text">'+resObj.success+'</p>');
                        $(".tweeterror-text").delay(1000).fadeOut("slow");
                    }
                } 
            });
        });
        
        $("#twitter_ff").click(function()
        {
            var getURL = "twitter_ajax/twitter_ff.php";
            var screenname = "<?php echo $_GET['screenname']; ?>";
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
                    //$(".demo-cb-tweets").prepend('<p class="loading-text"></p>');
                },
                success:    function(msg){
                    var resObj = jQuery.parseJSON(msg);
                    if(resObj.success == 1)
                    {
                        $('.loading-text').remove();
                        $(".pop_demo-cb-tweets").prepend('<p class="loaded-text">Followed</p>');
                        $(".loaded-text").delay(1000).fadeOut("slow");
                        $("#tweet-txt"+tweet_id).addClass("favorited");
                    }
                    else
                    {
                        $('.loading-text').remove();
                        $(".pop_demo-cb-tweets").prepend('<p class="tweeterror-text">'+resObj.success+'</p>');
                        $(".tweeterror-text").delay(1000).fadeOut("slow");
                    }
                } 
            });
        });
        
        $("#twitter_uf").click(function()
        {
            var getURL = "twitter_ajax/twitter_uf.php";
            var screenname = "<?php echo $_GET['screenname']; ?>";
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
                    //$(".demo-cb-tweets").prepend('<p class="loading-text"></p>');
                },
                success:    function(msg){
                    var resObj = jQuery.parseJSON(msg);
                    if(resObj.success == 1)
                    {
                        $('.loading-text').remove();
                        $(".pop_demo-cb-tweets").prepend('<p class="loaded-text">Unfollwed</p>');
                        $(".loaded-text").delay(1000).fadeOut("slow");
                     //   $("#tweet-txt"+tweet_id).addClass("favorited");
                    }
                    else
                    {
                        $('.loading-text').remove();
                        $(".pop_demo-cb-tweets").prepend('<p class="tweeterror-text">'+resObj.success+'</p>');
                        $(".tweeterror-text").delay(1000).fadeOut("slow");
                    }
                } 
            });
     });
});
