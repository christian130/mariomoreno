/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){

	setInterval(function updater(){                    

        
        var $notifications = $.ajax({
            type: "POST",
            url:"response.php",
            data: 'getit',        
            async: false,
            processData: false,
            dataType: "html",
			 timeout:5000,
            success:   function(){             
            },
            error: function(){
			setTimeout(updater,1000);
                console.log('had an error to get the information');
            }
        }).responseText;
        obj = JSON.parse($notifications);
       //alert(JSON.stringify(obj.friends, null, 4));
        $('.peopwrap').html(obj.friends_tumbnail);
        $('.jessicatxt').html(obj.tumbnail_text);
        $('.notification').html(obj.getAll);

        $('.friends_request').html(obj.friends_request);
		$('.friends_num').html(obj.friend_request_number);
		$('.notify').html(obj.getAllNumber); 
		$('#notification_popup').html(obj.getFirst); 
		$('#notification_popup').css("display",obj.getNumber2);
		var tx=$('.notify').text();
		
		if(tx=="")
		{
		$('#notification_popup').css("display","none");
		}
		else
		{
		$('#notification_popup').css("display","block"); 
		$('#notification_popup').fadeOut(4000); 
		$('#notification_popup').mouseover(  
		function(){$('#notification_popup').stop();});  
		  $('#notification_popup').mouseout(function()
		  {$('#notification_popup').fadeOut(6000); });    
		}
/* 		 $("body").append(" <b>Appended text</b>.");
		 if(obj.getCount == 1)
		{$('#notification_popup').css("display","none");}
		else
		{$('#notification_popup').css("display","block");}  */
		
    },'4000');
	
	
	
	
	
	
	
	
});