$(document).ready(function(){
    
//    added by marcel
    var show = false;
                 
       $("#confirmLink").click(function(){
        if(!show){
            show = true;
            $(".menuConfirm").fadeIn("slow").scroll("slow");
        }else{
            show = false;
            $(".menuConfirm").fadeOut("slow").scroll("slow");
        }
            
    });
//    added by marcel        
  
    
    $(".editlink").on("click", function(e){
        e.preventDefault();
        var dataset = $(this).prev(".datainfo");
        var savebtn = $(this).next(".savebtn");
        var theid   = dataset.attr("id");
        var newid   = theid+"-form";
        var currval = dataset.text();
		
        dataset.empty();
		
        $('<input type="text" name="'+newid+'" id="'+newid+'" value="'+currval+'" class="hlite">').appendTo(dataset);
		
        $(this).css("display", "none");
        savebtn.css("display", "block");
    });
    $(".savebtn").on("click", function(e){
        e.preventDefault();
        var elink   = $(this).prev(".editlink");
        var dataset = elink.prev(".datainfo");
        var newid   = dataset.attr("id");
        var cinput  = "#"+newid+"-form";
        var einput  = $(cinput);
        var newval  = $("#"+newid+"-form").val();//einput.attr("value");
        $.ajax({
            url: "profile_edit.php?id="+newid+"&value="+newval,
            dataType: "json",
            type: "POST",
            success: function(data){
                response(data);
            }
        });
        $(this).css("display", "none");
        einput.remove();
        if(newid == 'firstname'){
            dataset.html('<h1>'+newval+'</h1>');
        } else {
            dataset.html(newval);
        }
		
        elink.css("display", "block");
    });
});

//added by marcel

function friendsAction($func,$qtd ,$result){
     var $notifications = $.ajax({
        type: "POST",
        url:"friends.php",
        data: 'func='+$func+'&id_friend='+$qtd,
        //            data: 'func='+$func,
        async: false,
        processData: false,
        dataType: "html",
        success:   function(){             
            location.href="home.php"
        },
        error: function(){
            //alert("had a error trying to get the information");
        }
    }).responseText;
     

     
}

//added by marcel