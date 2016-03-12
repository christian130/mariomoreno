function findUrls(text)
{
    var source = (text || '').toString();
    var urlArray = [];
    var url;
    var matchArray;
    var regexToken = /(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g;

    while ((matchArray = regexToken.exec(source)) !== null)
    {
        var token = matchArray[0];
        urlArray.push(token);
    }

    return urlArray;
}
var lastParsedUrl = '';
var interval = false;
var semaphore = false;

function swithPhoto(move)
{
    var max = $('.image-wrapper').length - 1;
    var current = parseInt($('.image-wrapper:not(.hidden)').attr('rel'));
    var next = current + move;
    if (next === -1)
    {
        next = max;
    }
    else if (next > max)
    {
        next = 0;
    }

    $('#link_image').val($('.image-wrapper[rel="' + next + '"] img').attr('src'));
    $('.image-wrapper').addClass('hidden');
    $('.image-wrapper[rel="' + next + '"]').removeClass('hidden');


}

function attachFileReader(fileInput)
{
    if (window.FileReader) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(fileInput).siblings('.preview').append($('<img></img>').attr('src', e.target.result)
                .width(100));
            /*and now add one more*/
            var next = $('<div></div>').addClass('one-photo');
            var preview = $('<div></div>').addClass('preview');
            var icon= $('<i></i>').addClass('fa fa-plus');
            var input = $('<input></input>').attr('type', 'file').addClass('fileUpload').attr('name', 'photo_' + $('.fileUpload').length);
            var removeThisPicture = $('<div></div>').addClass('removePhoto').html('x').click(function(e)
            {
                e.preventDefault();
                next.remove();
            });


            next.append(input);
            next.append(removeThisPicture);
next.append(icon);
            next.append(preview);


            $(fileInput).parent('.one-photo').after(next);

            input.change(function() {
                attachFileReader(this);
            });

        };

        reader.readAsDataURL($(fileInput)[0].files[0]);
    }
    else
    {
        
        var next = $('<div></div>').addClass('one-photo');
        var preview = $('<div></div>').addClass('preview');
        var input = $('<input></input>').attr('type', 'file').addClass('fileUpload').attr('name', 'photo_' + $('.fileUpload').length);
        input.change(function() {
            attachFileReader(this);
        });
            
        var removeThisPicture = $('<div></div>').addClass('removePhoto').html('x').click(function(e)
        {
            e.preventDefault();
            next.remove();
        });
            var icon= $('<i></i>').addClass('fa fa-plus');



        next.append(input);
        next.append(removeThisPicture);
next.append(icon);
        next.append(preview);
        $(fileInput).parent('.one-photo').after(next);
        
    }
}

function attachWallEvents()
{

    $('.add-comment textarea,.add-comment input').focus(function()
    {
        clearInterval(interval);
    });

    $('.add-comment-link').click(function(e)
    {
        // alert($(this).attr('rel'));
        clearInterval(interval);
        e.preventDefault();
        $('.add-comment[rel="' + $(this).attr('rel') + '"]').fadeIn(500);
    });

    $('.add-comment input[type="file"]').change(function()
    {
        var textarea = $(this).siblings('textarea');
        $(textarea).off('keydown');
        $(textarea).keydown(function(e)
        {
            if (e.keyCode === 13)
            {
        /*submit dat form!*/
        }
        });
    });
    //    $('.fancybox').click(function(e)
    //    {
    //        e.preventDefaulf();
    //    });

    //    $('.fancybox').fancybox({
    //        'transitionIn': 'elastic',
    //        'transitionOut': 'elastic',
    //        'speedIn': 600,
    //        'speedOut': 200
    //    });

    $('.add-comment textarea').keydown(function(e)
    {
        var id = $(this).parent('form').attr('rel');

        if (e.keyCode === 13)
        {
            /*enter*/
            e.preventDefault();
            /*ajax*/

            $.ajax(
            {
                type: 'post',
                url: 'wall.php',
                data: {
                    add_comment: true,
                    id: id,
                    text: $(this).val()
                },
                success: function(data)
                {
                    /*reload the wall*/
                    $('.wallEntries').html(data);
                    attachWallEvents();
                }
            }
            );
        }
    });
}

var lastHtml = '';

function getWallAjax()
{
   
    semaphore = true;
    $.ajax(
    {
        type: 'post',
        url: 'wall.php',
        data: {
            ajax_get: true,
            limit: $('input[name="limit"]').val()
        },
        success: function(data)
        {
            if (lastHtml === data)
            {

            }
            else
            {
                $('.wallEntriessss').html(data);
                lastHtml = data;
                attachWallEvents();
            }
            $('.lazyLoader').html('');
            semaphore = false;
        }
    }
    );
}
 


$(document).ready(function()
{
    // $('.postbutton').click(function(e)
    //        {
    //        $("#upload_photos").submit(function(event)
    //      {
    //          // var myData = $( "#upload_photos" ).serialize();
    //            var myData = new FormData(document.getElementById("upload_photos"));
    //
    //           $.ajax({
    //                type: "POST",
    //                enctype: 'multipart/form-data',
    //                url: "home.php",
    //                data: myData,
    //                success: function( data )
    //                {
    //                     alert( data );
    //                }
    //           });
    //           return false;
    //      });
    //        });

    $(".wallEntries").append( "<p id='last'></p>" );
    $(window).data('ajaxready', true).scroll(function(e) {
       // alert("test");
        if ($(window).data('ajaxready') == false) return;
        //alert("test");
        var distanceTop = $('#last').offset().top - $(window).height();
        var style_display = $("#postedComments").css("display");
//alert("Window:"+$(window).scrollTop()+"  Distance"+parseInt(distanceTop));
        if  ($(window).scrollTop() >= parseInt(distanceTop)){
            $(window).data('ajaxready', false);
          //  alert(style_display);
            var social_active = $("#social_menu").val();
           // alert(social_active);
            if(social_active =='twitter'){
                $(window).data('ajaxready', false);
                //if($(".stream-container:last").attr('data-cursor') != 'undefined') {
                $('div#loadmoreajaxloader').show();

                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "./twitter_ajax/tweet_infinite_load.php?twittid="+ $(".tweet-outer:last").attr('data')+"&count="+$(".tweet-outer:last").attr('data-count'),
                    beforeSend: function()
                    {
                        $('body').show();
                        $('.version').text(NProgress.version);
                        NProgress.start();
                    },
                    complete: function(){
                        setTimeout(function() {
                            NProgress.done();
                            $('.fade').removeClass('out');
                        }, 500);
                    },
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
            }else if(social_active == 'wdd') {
                //  alert();
                $.ajax({
                    cache: false,
                    dataType : "html" ,
                    url: "wall_infinite_load.php?wall_id="+ $(".crispbxmain:last").attr('data')+"&count="+$(".crispbxmain:last").attr('data-count'),
                    beforeSend: function()
                    {
                        $('body').show();
                        $('.version').text(NProgress.version);
                        NProgress.start();
                    },
                    complete: function(){
                        setTimeout(function() {
                            NProgress.done();
                            $('.fade').removeClass('out');
                        }, 500);
                    },
                    success: function(html) {
                        //alert(html);
                        if(html != '0' || html != ''){
                            $("#loadorders").append(html);
                            $("#last").remove();
                            $(".wallEntries").append( "<p id='last'></p>" );
                            $('div#loadMoreComments').hide();
                        }else{
                        
                            $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                        }
                  
                        $(window).data('ajaxready', true);
                    }
                });
            }else if(social_active == 'instagram'){
                var ig_active = $("#ig_menu_active").val();
                // alert(ig_active);
                if(ig_active == 'ig_home_wall'){
                    var lastid = $(".timelineItem:last").attr("data-id");
                    //alert(social_active);
                    //alert(lastid);
                    $.ajax({
                        cache: false,
                        dataType : "html" ,
                        url: "./instagram_ajax/ig_infinite_load.php?nextid="+lastid,
                        beforeSend: function()
                        {
                            $('body').show();
                            $('.version').text(NProgress.version);
                            NProgress.start();
                        },
                        complete: function(){
                            setTimeout(function() {
                                NProgress.done();
                                $('.fade').removeClass('out');
                            }, 500);
                        },
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
                else if(ig_active == 'ig_user_wall'){
                    var lastidus = $(".timelineItem:last").attr("data-id");
                    $.ajax({
                        cache: false,
                        dataType : "html" ,
                        url: "./instagram_ajax/ig_infinite_load_userwall.php?nextid="+lastidus,
                        beforeSend: function()
                        {
                            $('body').show();
                            $('.version').text(NProgress.version);
                            NProgress.start();
                        },
                        complete: function(){
                            setTimeout(function() {
                                NProgress.done();
                                $('.fade').removeClass('out');
                            }, 500);
                        },
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
                } else if(ig_active == 'ig_user_followers'){
                    var lastidf = $(".stream-container:last").attr("data-cursor");
                    var userid = $(".stream-container:last").attr("data-userid");
                    $.ajax({
                        cache: false,
                        dataType : "html" ,
                        type:       'POST',
                        url: "./instagram_ajax/ig_infinite_load_followers.php?nextid="+lastidf+"&userid="+userid,
                        beforeSend: function()
                        {
                            $('body').show();
                            $('.version').text(NProgress.version);
                            NProgress.start();
                        },
                        complete: function(){
                            setTimeout(function() {
                                NProgress.done();
                                $('.fade').removeClass('out');
                            }, 500);
                        },
                        success: function(html) {
                            if(html != '0' || html== ''){
                                $( ".wallEntriesIgFollowers" ).append( html );
                                $("#loadorders").append(html);
                                $("#last").remove();
                                $("#postedComments").append( "<p id='last'></p>" );
                                $('div#loadMoreComments').hide();
                            }else{
                                $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                            }
                            $(window).data('ajaxready', true);
                        }
                    });
                }else if(ig_active == 'ig_user_following'){
                    var lastidfw = $(".stream-container:last").attr("data-cursor");
                    var useridfw = $(".stream-container:last").attr("data-userid");
                    $.ajax({
                        cache: false,
                        dataType : "html" ,
                        type:       'POST',
                        url: "./instagram_ajax/ig_infinite_load_following.php?nextid="+lastidfw+"&userid="+useridfw,
                        beforeSend: function()
                        {
                            $('body').show();
                            $('.version').text(NProgress.version);
                            NProgress.start();
                        },
                        complete: function(){
                            setTimeout(function() {
                                NProgress.done();
                                $('.fade').removeClass('out');
                            }, 500);
                        },
                        success: function(html) {
                            if(html != '0' || html== ''){
                                $( ".wallEntriesIgFollowing" ).append( html );
                                $("#loadorders").append(html);
                                $("#last").remove();
                                $("#postedComments").append( "<p id='last'></p>" );
                                $('div#loadMoreComments').hide();
                            }else{
                                $('div#loadmoreajaxloader').html('<center><h3><b>Time limit exceed please try after some times.</b></h3></center>');
                            }
                            $(window).data('ajaxready', true);
                        }
                    });
                }
            }
        }
    });

    $('.removePhoto').click(function()
    {
        $(this).parent('.one-photo').remove();
    });

    $('.picon').click(function(e)
    {
        e.preventDefault();
        $('#picture').fadeIn(500);
        //$('textarea.grybord').css('display','none');

        $('.postbutton').off('click');
        $('.postbutton').click(function(e)
        {
            // $('#upload_photos').submit();
         
            });


    });

    $('.grybord').focus(function()
    {
        if ($(this).val() === 'Whats in your head?')
        {
            $(this).val('');
        }
    });

    $('#picture input[type="file"]').change(function()
    {
        attachFileReader(this);
    });

    /*$("#tabs").tabs();*/

    if (typeof $('.wallEntries')[0] !== 'undefined')
    {
        interval = setInterval(function()
        {
            getWallAjax();
        }, 17500);

    }
    getWallAjax();

    $('.postbutton').click(function(e)
    {
        e.preventDefault();

        $(this).after($('<div></div>').addClass('ajax-loader'));

        $.ajax({
            url: 'wallentry.php',
            type: 'post',
            data: {
                ajax_add: 'true',
                text: $('.grybord').val(),
                link: $('#link').val(),
                link_photo: $('#link_image').val(),
                link_title: $('input[id="link_title"]').val(),
                link_description: $('input[id="link_description"]').val()
            },
            success: function(msg)
            {
                $(".wallEntries").prepend(msg);
                $('.ajax-loader').remove();
                $('#link').val('');
                $('#link_image').val('');
                $('input[id="link_title"]').val('');
                $('input[id="link_description"]').val('');
                $('textarea[name="status"]').val('');
                $('#link_info').html('');
                $('#link_info').css('display', 'none');
                lastParsedUrl = false;
            }
        });


    });
    $('.postbutton-comments').click(function(e)
    {
        //alert($(this).attr('id'));
        var wall_id = $(this).attr('id');
        var formdata = $("#commform_"+wall_id).serialize();
        $.ajax({
            url: 'wall_comment_post.php',
            type: 'post',
            data: formdata,
            success: function(msg)
            {
                $('#comment_'+wall_id).prepend(msg);
                $("#comment_"+wall_id).css("display","block");
            }
        });
    //wall_comment_post

    });
    /*analise status to getch http or https*/
    $('textarea.grybord').keyup(function()
    {
        /*get url*/

        var urls = findUrls($('textarea.grybord').val());
        if (urls.length > 0 && lastParsedUrl !== urls[0])
        {
            $.ajax({
                url: ajaxUrl,
                type: 'post',
                data: {
                    action: 'getUrlData',
                    url: urls[0]
                },
                beforeSend: function()
                {
                    lastParsedUrl = urls[0];
                    $('#link_info').html('');
                    $('#link_info').css('display','table').addClass('info_linkbox');
                    $('#link_info').append($('<div></div>').addClass('ajax-loader'));
                },
                dataType: 'json',
                success: function(data)
                {
                    $('#link_info').css('display','table').addClass('info_linkbox');
             
                    $('.ajax-loader').remove();
                    $('#link_info').html('');
                    /*now render the link*/
                    var photos = $('<div class="photo-browser" style="width:200px;height:200px;"></div>');
                    var title = $('<p class="scrapedTitle" style="float:right;width:330px;font-size:16pt;line-height:1.0em;"></p>').html(data.title);
                    var description = $('<p style="float:right;width:350px;font-size:12pt;line-height:1.0em;"></p>').html(data.description);
                   

                    var left = $('<div style="display:none;">&laquo</div>').addClass('left-arrow').click(function(e)
                    {
                        e.preventDefault();
                        swithPhoto(-1);
                    });
                    var right = $('<div style="display:none;">&raquo</div>').addClass('right-arrow').click(function(e)
                    {
                        e.preventDefault();
                        swithPhoto(1);
                    });

                    var terminator = $('<a style="float:right;margin:5px;color: #ccc;font-weight: bold;cursor:pointer;"></a>').addClass('terminator').html('X').click(function()
                    {
                        $('#link_info').html('');
                        $('#link_info').css('display', 'none');
                    });

                    $('#link_info').append(terminator);

                    $('#link_info').append(title);
                    $('#link_info').append(description);
					//var link_image = $('<input></input>').attr('type', 'hidden').attr('id', 'link_image').val(data.images);
                   // $('#link_info').append(link_image);
                    //var img = $('<img width="150px" height="120px" align="center"></img>').attr('src', data.images);
                    // $('#link_info').append(img);
                    $(photos).append(left);
                    $(photos).append(right);

                    var i;
                    for (i = 0; i < data.images.length; i++)
                    {
                        var imgWrapper = $('<div></div>').addClass('image-wrapper').attr('rel', i);
                        var img = $('<img style="width:200px;height:200px;"></img>').attr('src', data.images[i]);
                        if (i > 0)
                        {
                            imgWrapper.addClass('hidden');
                        }
                        else
                        {
                            var link_image = $('<input></input>').attr('type', 'hidden').attr('id', 'link_image').val(data.images[i]);
                           if(data.contenttype != 'video'){
                                $('#link_info').append(link_image);
                            }
                        }
                        $(imgWrapper).append(img);
                        $(photos).append(imgWrapper);
                    }

                    var link_title = $('<input></input>').attr('id', 'link_title').val(data.title).attr('type', 'hidden');
                    var link = $('<input></input>').attr('id', 'link').val(urls[0]).attr('type', 'hidden');
                    var link_description = $('<input></input>').attr('id', 'link_description').val(data.description).attr('type', 'hidden');
                    $('#link_info').append(link_title);
                    $('#link_info').append(link);
                    $('#link_info').append(link_description);

                    $('#link_info').append(photos);

                }
            });
        }

    });
    $('.add-comment-link').click(function(e){
        var id = $(this).attr("rel");
        $("#comment_"+id).css("display","block");
    })
    $(window).scroll(function(e) {
        var scroll = parseInt($(window).scrollTop());
        var height = parseInt($(window).height());
        var percent = scroll / height;


        if (percent > 0.8 && !semaphore)
        {
            semaphore = true;
            $('input[name="limit"]').val(parseInt($('input[name="limit"]').val()) + 10);
            $('.lazyLoader').append($('<div></div>').addClass('ajax-loader'));
        }
    });
    $("#back-top").hide();

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
});