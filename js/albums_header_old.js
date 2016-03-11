function readURL($files) {
    for (var i=0, l=$files.length; i<l; i++) {
        var reader = new FileReader();
         
        $local = '#img'+i;
        reader.onload = function(e) {
            var li = '<li>\
               <img class="img-thumbnail" src="' + e.target.result + '" \
               title="'+ escape(file.name) +'" /> \
               <p>Name: ' + escape(file.name) +
            ' (' + file.type + ') \
               size: '+ file.size + '</p></li>';
            fup.outputImages.push(li);
            ul.append(li);
        };
            
        reader.readAsDataURL(input.files[i]);
    }
}

function fillTitle(){
    //    l=files.length;
    $files = document.getElementById('photos').files;
    //   console.log('here');
    //   console.log($files);
    alert('ha'); 
    for (var i=0, l=$files.length; i<l; i++) {
        console.log($files[i].name);
        $("#titles").html($("#titles").html()+'<label>'+$files[i].name+'<img id="img'+i+'" src="#" alt="your image" />Title:<input type="title" name="title"></input></label><br>');        
    }    
    readURL(document.getElementById('photos'));
    
    
}



function triggerClick(){
//    alert('ha');
    $('#startUpload').each().trigger('click');

}

function sendPhoto(){
    $form = document.forms[0];
    //        var formData = new FormData($form);
    //        var xhr = new XMLHttpRequest();
    //        
    //        xhr.open('POST', 'album_upload.php', true);
    //        xhr.send(formData);        
    var data = new FormData($form);
    
    //    data.append('file',this.files[0]);
    $upload = $.ajax({
        url: "album_upload.php",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,        
        success: function (response) {
            //            console.log(response);
            $('#res').html('');
            $('#res').html(response);
            $('#message').html('<font class="confirm">Your has been uploaded</font>');            
            document.getElementById('photo2').setAttribute('value', '');
            $('#photoUp').attr('src', "#");            
            $('#title').val('');                        
            //For other browsers
            $("#photo").val(""); 
            $("#photo").replaceWith($("#photo").clone(true));   
        },
        error: function(response){
            $('#message').html('<font class="error">Error - Your hasnt been uploaded</font>');
        }
    });    
        
        
}

function titleAlbum(){
    var $func = "alter_title";
    var $title = $('.inputTitle').val();
    $('.postbutton').val('Saving');
  
    var $notifications = $.ajax({
        type: "POST",
        url:"photos.php",
        data: 'func='+$func+'&title='+$title,        
        async: false,
        processData: false,
        dataType: "html",
        success:   function(response){ 
            $('.postbutton').val('Save');
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    });
}

function clearAlbum(){
    
    var $func = "remove_open";
    var $notifications = $.ajax({
        type: "POST",
        url:"photos.php",
        data: 'func='+$func,        
        async: false,
        processData: false,
        dataType: "html",
        success:   function(response){                         
            $('.album_lists').html(response); 
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    }).responseText;
            
}

function removeAlbum($id){
    alert('Removing');
    var $func = "remove_album";
    var $notifications = $.ajax({
        type: "POST",
        url:"photos.php",
        data: 'func='+$func+'&id_album='+$id,        
        async: false,
        processData: false,
        dataType: "html",
        success:   function(response){
            var url = "album.php";
            $(location).attr('href',url); 
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    });
            
}

function removePhoto($id){
    alert('Removing');
    var $func = "remove_photo";
    var $notifications = $.ajax({
        type: "POST",
        url:"photos.php",
        data: 'func='+$func+'&id_photo='+$id,        
        async: false,
        processData: false,
        dataType: "html",
        success:   function(response){
            parent.jQuery.colorbox.close();
            parent.$('.photo_lists').html(response); 
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    }).responseText;
            
}

function removeComment($id){
    
    var $func = "delete_comment";
    var $notifications = $.ajax({
        type: "POST",
        url:"photo_comments.php",
        data: 'func='+$func+'&id_comment='+$id,        
        async: false,
        processData: false,
        dataType: "html",
        success:   function(response){             
            
            $('.comments').html(response); 
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    }).responseText;
            
}

function sendComment(){

    //    e.preventDefault();
    var $comment = $(".comment_input").val();
    var $id_photo = $("#id_photo").val();
    var $func = "send_comment";
    var $infobeforeload = $(".comment_form").html();
    $(".comment_form").html($(".comment_form").html()+'<img src="images/ajax-loader.gif" id="load">'); 
    var $notifications = $.ajax({
        type: "POST",
        url:"photo_comments.php",
        data: 'func='+$func+'&comment='+$comment+'&id_photo='+$id_photo,        
        async: false,
        processData: false,
        dataType: "html",
        success:   function(response){             
            $(".comment_input").val(' ');
            $('.comments').html(response);             
            $(".comment_form").html($infobeforeload); 
            $('body').jScrollPane(); 
            
        },
        error: function(){            
            $(".comment_form").html($infobeforeload); 
            alert("had a error trying to get the information");
        }
    });
    
}

function showTitlePhotoForm(){
    if(blocked==false){
        blocked = true;                  
        $("#titlePhoto").fadeOut(1);
        $("#formTitle").fadeIn(1);
    }
//    alert(blocked);  
}

function sendTitlePhoto(){

    //    e.preventDefault();
    var $comment = $(".inputTitlePhoto").val();        
    var $func = "alter_title_photo";
    var $infobeforeload = $("#info").html();
    $("#info").html($("#info").html()+'<img src="images/ajax-loader.gif" id="load">');
    var $notifications = $.ajax({
        type: "POST",
        url:"photos.php",
        data: 'func='+$func+'&title='+$comment,        
        async: false,
        processData: false,
        dataType: "html",
        success:   function(response){                         
            $("#info").html($infobeforeload);
            $("#titlePhoto").fadeIn(1);
            $("#formTitle").fadeOut(1);
            $("#titlePhoto").text(' '+$comment+' ');                        
            blocked = false;
            $('body').jScrollPane();             
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    });
    $("#info").remove('#load'); 
    
}

function refreshAlbum($id){
    var $subt= '<img id="loading" src="images/ajax-loader.gif" style="float: inside; width: 30px; height: 10px;"></img> ';
    $( '.photo_lists').html($subt);
    getAlbums('listPhotos', $id, '.photo_lists') ;
}

function getAlbums($func,$qtd ,$result){
    //function get($func,$result){    
    var $notifications = $.ajax({
        type: "POST",
        url:"photos.php",
        data: 'func='+$func+'&qtd='+$qtd,
        //            data: 'func='+$func,
        async: false,
        processData: false,
        dataType: "html",
        success:   function(){             
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    }).responseText;
    
    
    $($result).html($notifications);

}

var blocked = false;
    
$(document).ready(function(){                     
    
    $(".inputTitlePhoto").keypress(function(e){  
        //        alert('ha');
        //               alert(e.keyCode);
        if(e.keyCode == 27){
            blocked = false;
            $("#titlePhoto").fadeIn(1);
            $("#formTitle").fadeOut(1);
        }            
        if(e.keyCode == 13){            
            sendTitlePhoto();
        }
    });
    $(".comment_input").keypress(function(e){ 
        //          alert('ha!');
        //   
        if(e.keyCode == 13){
            sendComment();
        }
    });
   
  
      
    $(".album_header").click(function(){
        listAlbum();
    });
           
    $("#createAlbum").click(function(){
        alert('Enviando request');
        $form = document.forms[0];
        $title = $form['title'];
        $Opriv = $form['priv'];
        var title = $title.value;
        var p = $Opriv.value;                       
        $title.value = '';        
        if(p == 'on'){
            p = 1;            
        }else p = 0
        
        
        var $notifications = $.ajax({
            type: "POST",
            url:"photos.php",
            data: 'func=createAlbum&title='+title+'&priv='+p,            
            async: false,
            processData: false,
            dataType: "html",
            success:   function(response){             
                var url = 'album_detail.php?id='+response;
                $(location).attr('href',url);
            },
            error: function(){
                alert("had a error trying to get the information");
            }
        }).responseText;        
        $('.album_lists').html($notifications);
    }); 

 

});

function hideIcon($id){
    $('#'+$id).fadeOut(20);
}
function showIcon($id){
    $('#'+$id).fadeIn(20);
}

function listAlbum(){
    var $notifications = $.ajax({
        type: "POST",
        url:"photos.php",
        data: 'func=listAlbum',
        //            data: 'func='+$func,
        async: false,
        processData: false,
        dataType: "html",
        success:   function(){                         
        },
        error: function(){
            alert("had a error trying to get the information");
        }
    }).responseText;
    
    $('.album_lists').html($notifications);
}

