/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function sendInviteAll($func,$qtd,$txt ){
    $func = "inviteAll";
    var $notifications = $.ajax({        
        type: "POST",
        url:"invites.php",
        data: 'func='+$func,
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
        
}

function sendInvite($func,$qtd,$txt ){
    $func = "invite";
    var $notifications = $.ajax({        
        type: "POST",
        url:"invites.php",
        data: 'func='+$func+'&id_friend='+$qtd+'&name='+$txt,
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
