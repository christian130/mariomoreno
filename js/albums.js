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
     $('.notify').text('0');
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
            alert("had a error trying to get the information");
        }
    }).responseText;
        
    alert($notifications);
}
function getFriends($func,$qtd ,$result){
    //function get($func,$result){
              
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
     if($func == "friend_confirm"){
         $local="#request_"+$qtd;
         $($local).html('<div class="friendsresult">Request Accepted</div>');
         $('.friends_num').html(parseInt($('.friends_num').text(), 10)-1);
     }
     if($func == "friend_ignore"){
         $local="#request_"+$qtd;
         $($local).html('<div class="friendsresult">Request Ignored</div>');
         $('.friends_num').html(parseInt($('.friends_num').text(), 10)-1);
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
    

    
    