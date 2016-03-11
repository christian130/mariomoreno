/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */   


var last_messages =0;
var last_notification=0;
  
function posts(){
    get('posts',$('.posts_number').text(),'.posts');
    $(".posts_number").text('0');
}
 /**
  * --MOdified--
  * Modified the way that the client request the info
  */  
sended = false;
function search($func,$qtd ,$result){       
    if(sended==false){
        var $notifications = $.ajax({
            type: "POST",
            url:"search.php",
            data: 'func='+$func+'&term='+$qtd,        
            async: false,
            processData: false,
            dataType: "html",
            beforeSend: function(){
                sended = true;
            },
            success:   function(){             
                sended = false;
            },
            error: function(){
                //            alert("had a error trying to get the information");
                sended = false;
            }
        }).responseText;
        
        $($result).html($notifications);  
        return sended;
    } 
}
/**
 * MOdified
 */

function getNotifications($func,$qtd ,$result){       

    var $notifications = $.ajax({
        type: "POST",
        url:"notification.php",
        data: 'func='+$func+'&qtd='+$qtd,        
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
    if($func == "getAll"){
        getNotifications('getNumber',0,'.notify');            
    }
    if($func == "ClearAll"){
        $('.notify').text('');
        $('.notification').html('<h5>No notifications</h5><h5>See all</h5>');                   
    }
    
       
}

    
function getMessages($func,$qtd ,$result){
    //function get($func,$result){
                      
    var $notifications = $.ajax({
        type: "POST",
        url:"messages.php",
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
    
function sendFriendRequest($func,$qtd,$txt ){
    
    var $notifications = $.ajax({
        type: "POST",
        url:"friends.php",
        data: 'func='+$func+'&id_friend='+$qtd,
        //            data: 'func='+$func,
        async: false,
        processData: false,
        dataType: "html",
        success:   function(){             
        },
        error: function(){
            //alert("had a error trying to get the information");
        }
    }).responseText;
        
    alert($notifications);
}

function getFriends($func,$qtd ,$result){
    //function get($func,$result){

    if($func == "friend_confirm"){
        $val =parseInt($('.friends_num').text(), 10)-1;
        if($val == 0) $val = '';
        $local="#request_"+$qtd;
       $($local).html('<div class="friendsresult">You and '+$result+' are now Friends</div>');
        $('.friends_num').html($val);
        $('.totalfriends').html(parseInt($('.totalfriends').text(), 10)+1);
    }
    if($func == "friend_ignore_first"){
        $local="#request_"+$qtd;
        $($local).html('<div class="friendsresult">Request Ignored <br>Wants do Block</div>                <input type="submit" class="ignorebutton" value="Just Ignore"  onclick=\'getFriends("friend_ignore",'+$qtd+',"");\'/ >                           <input type="submit" class="confirmbutton" value="Block" onclick=\'getFriends("friend_block",'+$qtd+',"");\'/>');
        $val =parseInt($('.friends_num').text(), 10)-1;
        if($val == 0) $val = '';
        $('.friends_num').html($val);
        return;
    }
    var $notifications = $.ajax({
        type: "POST",
        url:"friends.php",
        data: 'func='+$func+'&id_friend='+$qtd,
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
     
    if($func == "friends_request"){
        getFriends('friend_request_number',0,'.friends_num');
    }
       
        
    $($result).html($notifications);
        
}
    
function get($func,$qtd ,$result){
    //function get($func,$result){
                      
    var $notifications = $.ajax({
        type: "POST",
        url:"message.php",
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
    if($func != 'posts'){
        $($result).html($notifications);
    }else{
        $posts = $($result).html();            
        $($result).html($notifications+$posts);
    }
}
  
    
    