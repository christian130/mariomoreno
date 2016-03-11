
  
 
$(document).ready(function(){
    var notification = false;                 
    var friends = false;
    var results = false;
     
    $(".first").click(function(){
        //        alert('ine');
        notification = !notification;
        $(this).css('border','3px solid #e6e6e6');     
        $(this).css('border-radius','3px');   
        if(notification){
            $(".notification").fadeIn(1); 
        }else{
            $(this).css('border','');     
            $(".notification").fadeOut(1);         
        } 
        if(friends){
            $(".frienddropwrap").fadeOut(1)
            $('.third').css('border','');     
            friends = !friends;
        }
        $(".readAll").click(function(){                             
            getNotifications('ClearAll',0,'.notification');                             
        });
    });
       
    $(".third").click(function(){                         
        friends = !friends;
        $(this).css('border','3px solid #e6e6e6');     
        $(this).css('border-radius','3px');
        if(notification){
            $(".notification").fadeOut(1);
            notification = !notification;
            $('.first').css('border','');     
        }
        if(friends){
            $(".frienddropwrap").fadeIn(1);    
        }else{ 
            $(this).css('border','');     
            $(".frienddropwrap").fadeOut(1);    
        }
        $(".friendAll").click(function(){
            var url = "friend_list.php";
            $(location).attr('href',url);  
        });
    });  
        
    $(".ignorebutton,.confirmbutton").mouseover(function (){
        friends = false;
    } );
    $(".ignorebutton,.confirmbutton").mouseout(function (){
        friends = true;
    } );
                            
    $(".midwht,.homlft,.hommid,.friendright").mouseover(function (){                        
        //        $(".topinner").mouseout(function(){                        
        
        if(friends){
            $(".frienddropwrap").fadeOut(1);         
            $('.third').css('border','');     
            friends = false;
        }
        if(notification){
            $(".notification").fadeOut(1);
            $('.first').css('border','');     
            notification = false;
        }
    });        
    $(".midwht,.homlft,.hommid,.friendright").click(function (){                        
        //        $(".topinner").mouseout(function(){                        
        if(friends){
            $(".frienddropwrap").fadeOut(1);                 
            $('.third').css('border','');     
            friends = false;
        }
        if(notification){
            $(".notification").fadeOut(1);     
            $('.first').css('border','');     
            notification = false;
        }
        if(results){
            $('.results').fadeOut(1);           
            $('.searchinput').val('');
            results = false;
        }
    });      
      
       
            
               
    $(".setting").click(function(){
        $(".settings").fadeIn(1);
    });
    //        added by marcel
  
   
    $(".second").click(function(){                                
        $(".messages").slideToggle("slow");                    
    });    
  

    
    
    
    /**
     * Modified the way that the event are triggered 
     */
    timeout = false;
    $(".searchinput").keypress(function(e){        
        
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }        
        
        lastlength = 0;
        timeout = setTimeout(function(){
            //            alert('hello')
        
            if($(".searchinput").val().length >=2 && lastlength <  $(".searchinput").val().length){            
                $('.results').fadeIn(1);   
                $("#resultdiv").html('<li><image class="loading" src="images/ajax-loader.gif" title="Loading"  > </li>')                 
                sended = search('search', $(".searchinput").val(), '#resultdiv');            
        
            
                results = true;
            }else {
                $('.results').fadeOut(1);           
                results = false;
            }
            lastlength = $(".searchinput").val().length ;    
        },1700);
                      
    });                                
/**
     * --Modified  --
     */   
});

function readNotification($qtd){
    $val =parseInt($('.notify').text(), 10)-1;
    if($val == 0) $val = '';                
    $('.notify').html($val);         
    $('#read_'+$qtd).hide();
    getNotifications('readNotification', $qtd, '.notifications');
        
}
