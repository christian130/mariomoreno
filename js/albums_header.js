var shown = false;
function favIcon() {
    if (shown == false) {
        $(".favicon").fadeIn("20");
        shown = true;
    } else {
        $(".favicon").fadeOut("20");
        shown = false;
    }


}


function sendCover($id_album,$id_photo) {
   
    
   $func = "setCover" ;
    var $notifications = $.ajax({
        type: "POST",
        url: "photos.php",
        data: 'func=' + $func + '&id_photo=' + $id_photo + '&id_album=' + $id_album,
        async: true,
        processData: false,
        dataType: "html",
        success: function(response) {
//            alert('Set as cover');
                $(".favicon").fadeOut("20");
        shown = false;
                    },
        error: function() {
            
        }
    }).responseText;
    
}

function fillTitle() {
    //    l=files.length;
    $files = document.getElementById('photos').files;
    //   console.log('here');
    //   console.log($files);
    alert('ha');
    for (var i = 0, l = $files.length; i < l; i++) {
        console.log($files[i].name);
        $("#titles").html($("#titles").html() + '<label>' + $files[i].name + '<img id="img' + i + '" src="#" alt="your image" />Title:<input type="title" name="title"></input></label><br>');
    }
    readURL(document.getElementById('photos'));


}




function titleAlbum() {
    var $func = "alter_title";
    var $title = $('.inputTitle').val();
    $('.postbutton').val('Saving');

    var $notifications = $.ajax({
        type: "POST",
        url: "photos.php",
        data: 'func=' + $func + '&title=' + $title,
        async: false,
        processData: false,
        dataType: "html",
        success: function(response) {
            $('.postbutton').val('Save');
        },
        error: function() {
            alert("had a error trying to get the information");
        }
    });
}

function clearAlbum() {

    var $func = "remove_open";
    var $notifications = $.ajax({
        type: "POST",
        url: "photos.php",
        data: 'func=' + $func,
        async: false,
        processData: false,
        dataType: "html",
        success: function(response) {
            $('.album_lists').html(response);
        },
        error: function() {
            alert("had a error trying to get the information");
        }
    }).responseText;

}

function removeAlbum($id) {
    alert('Removing');
    $res = confirm("Are you sure that you want remove?");
    if ($res == true) {
        var $func = "remove_album";
        var $notifications = $.ajax({
            type: "POST",
            url: "photos.php",
            data: 'func=' + $func + '&id_album=' + $id,
            async: false,
            processData: false,
            dataType: "html",
            success: function(response) {
                var url = "album.php";
                $(location).attr('href', url);
            },
            error: function() {
                alert("had a error trying to get the information");
            }
        });
    }
}

function removePhoto($id) {
    alert('Removing');
    $res = confirm("Are you sure that you want remove?");
    if ($res == true) {
        var $func = "remove_photo";
        var $notifications = $.ajax({
            type: "POST",
            url: "photos.php",
            data: 'func=' + $func + '&id_photo=' + $id,
            async: false,
            processData: false,
            dataType: "html",
            success: function(response) {
                parent.jQuery.colorbox.close();
                parent.$('.photo_lists').html(response);
            },
            error: function() {
                alert("had a error trying to get the information");
            }
        }).responseText;
    }
}

function removeComment($id) {

    var $func = "delete_comment";
    $res = confirm("Are you sure that you want remove?");
    if ($res == true) {
        var $notifications = $.ajax({
            type: "POST",
            url: "photo_comments.php",
            data: 'func=' + $func + '&id_comment=' + $id,
            async: false,
            processData: false,
            dataType: "html",
            success: function(response) {

                $('.comments').html(response);
            },
            error: function() {
                alert("had a error trying to get the information");
            }
        }).responseText;
    }
}


function sendComment() {

    //    e.preventDefault();
    var $comment = $(".comment_input").val();
    var $id_photo = $("#id_photo").val();
    var $func = "send_comment";
    var $infobeforeload = $(".comment_form").html();
    $(".comment_form").html($(".comment_form").html() + '<img src="images/ajax-loader.gif" id="load">');
    var $notifications = $.ajax({
        type: "POST",
        url: "photo_comments.php",
        data: 'func=' + $func + '&comment=' + $comment + '&id_photo=' + $id_photo,
        async: true,
        processData: false,
        dataType: "html",
        success: function(response) {
            $(".comment_input").val(' ');
            $('.comments').html(response);
            $(".comment_form").html($infobeforeload);
            $('body').jScrollPane();

        },
        error: function() {
            $(".comment_form").html($infobeforeload);
        }
    }).responseText;
    $(".comment_input").val(' ');
    $('.comments').html($notifications);
    $(".comment_form").html($infobeforeload);
    $('body').jScrollPane();

}

function showTitlePhotoForm() {
    if (blocked == false) {
        blocked = true;
        $("#titlePhoto").fadeOut(1);
        $("#formTitle").fadeIn(1);
    }
//    alert(blocked);  
}

function sendTitlePhoto() {

    //    e.preventDefault();
    var $comment = $(".inputTitlePhoto").val();
    var $func = "alter_title_photo";
    var $infobeforeload = $("#info").html();
    $("#info").html($("#info").html() + '<img src="images/ajax-loader.gif" id="load">');
    var $notifications = $.ajax({
        type: "POST",
        url: "photos.php",
        data: 'func=' + $func + '&title=' + $comment,
        async: false,
        processData: false,
        dataType: "html",
        success: function(response) {
            $("#info").html($infobeforeload);
            $("#titlePhoto").fadeIn(1);
            $("#formTitle").fadeOut(1);
            $("#titlePhoto").text(' ' + $comment + ' ');
            blocked = false;
            $('body').jScrollPane();
        },
        error: function() {
            alert("had a error trying to get the information");
        }
    });
    $("#info").remove('#load');

}

function refreshAlbum($id) {
    var $subt = '<img id="loading" src="images/ajax-loader.gif" style="float: inside; width: 30px; height: 10px;"></img> ';
    $('#photo_lists_container').html($subt);
    getAlbums('listPhotos', $id, '#photo_lists_container');
}

function getAlbums($func, $qtd, $result) {
    //function get($func,$result){    
    var $notifications = $.ajax({
        type: "POST",
        url: "photos.php",
        data: 'func=' + $func + '&qtd=' + $qtd,
        //            data: 'func='+$func,
        async: false,
        processData: false,
        dataType: "html",
        success: function() {
        },
        error: function() {
            alert("had a error trying to get the information");
        }
    }).responseText;


    $($result).html($notifications);

}

var blocked = false;

$(document).ready(function() {

    timeout = false;
    $(".inputTitle").keypress(function(e) {

        if (timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        lastlength = 0;
        timeout = setTimeout(function() {
            titleAlbum();
        }, 3000);

    });

    $(".inputTitlePhoto").keypress(function(e) {
        //        alert('ha');
        //               alert(e.keyCode);
        if (e.keyCode == 27) {
            blocked = false;
            $("#titlePhoto").fadeIn(1);
            $("#formTitle").fadeOut(1);
        }
        if (e.keyCode == 13) {
            sendTitlePhoto();
        }
    });
    $(".comment_input").keypress(function(e) {
        //          alert('ha!');
        //   
        if (e.keyCode == 13) {
            sendComment();
        }
    });



    $(".album_header").click(function() {
        listAlbum();
    });

    $("#createAlbum").click(function() {
        alert('Enviando request');
        $form = document.forms[0];
        $title = $form['title'];
        $Opriv = $form['priv'];
        var title = $title.value;
        var p = $Opriv.value;
        $title.value = '';
        if (p == 'on') {
            p = 1;
        } else
            p = 0


        var $notifications = $.ajax({
            type: "POST",
            url: "photos.php",
            data: 'func=createAlbum&title=' + title + '&priv=' + p,
            async: false,
            processData: false,
            dataType: "html",
            success: function(response) {
                var url = 'album_detail.php?id=' + response;
                $(location).attr('href', url);
            },
            error: function() {
                alert("had a error trying to get the information");
            }
        }).responseText;
        $('.album_lists').html($notifications);
    });



});

function listAlbum() {
    var $notifications = $.ajax({
        type: "POST",
        url: "photos.php",
        data: 'func=listAlbum',
        //            data: 'func='+$func,
        async: false,
        processData: false,
        dataType: "html",
        success: function() {
        },
        error: function() {
            alert("had a error trying to get the information");
        }
    }).responseText;

    $('.album_lists').html($notifications);
}

