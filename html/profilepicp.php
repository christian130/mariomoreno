<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript">
    $(window).load(function(){

        var button = $('#change_button');
        var spinner = $('#spinner');

        button.css('opacity', 0);
        spinner.css('top', ($('.profile_pic').height() - spinner.height()) / 2)
        spinner.css('left', ($('.profile_pic').width() - spinner.width()) / 2)

        $('.profile_pic').hover(function() {
            button.css('opacity', .5);
            button.stop(false,true).fadeIn(200);
        },
        function() {
            button.stop(false,true).fadeOut(200);
        });

        new AjaxUpload(button,{
            action: 'update_upload.php',
            name: 'myfile',
            onSubmit : function(file, ext){
                spinner.css('display', 'block');
                this.disable();
            },
            onComplete: function(file, response){
                button.stop(false,true).fadeOut(200);
                spinner.css('display', 'none');
                $('#profile_img').attr('src', response);
                $('#hprofile_img').attr('src', response);
                this.enable();
            }
        });

    });

    function rmprofilepic()
    {
        var getURL = "removephoto.php";
        $.ajax({
            cache:      true,
            async:      true,
            type:       'post',
            url:        getURL,
            beforeSend: function () {
                $(".demo-cb-tweets").prepend('<p class="loading-text">removing...</p>');
            },
            success:    function(msg){
                $('#profile_img').attr("src",msg);
            }
        });
    }
    $(document).ready(function() {
        $(".orginal_profilepic").colorbox({
            fixed:true,
            scrolling:false,
            rel:'orginal_profilepic'});
        $(document).bind('cbox_open', function() {
            $('html').css({ overflow: 'hidden' });
        }).bind('cbox_closed', function() {
            $('html').css({ overflow: '' });
        });
    });
</script>
<style type="text/css">
    div.profile_pic{
        position:relative;
        width:125px;
    }
    div.change_button{
        position:absolute;
        bottom:0px;
        left:0px;
        display:none;
        background-color:black;
        font-family: 'tahoma';
        font-size:11px;
        text-decoration:underline;
        color:white;
        width:185px;
    }
    div.change_button_text{
        padding:10px;
        text-align: center;
    }
    #spinner{
        position:absolute;
    }
</style>
<div class='profile_pic' style="left:5px;">
    <div id="spinner" style="display:none">
        <img src="spinner_large.gif" border="0">
    </div>
    <?php if (count($session->getSession("profile_pic")) != 0) {
    ?>
    <a class="orginal_profilepic group1" href="viewProfilepic.php?profileid=<?php echo $session->getSession("userid"); ?>"><img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" style="border-radius:4px; " id="profile_img" width="185px" height="185px"/></a>
    <?php
    } else {
        if ($session->getSession("gender") == 'Male') {
    ?>
            <img src="uploads/default/Maledefault.png" alt="" style="border-radius:4px; " id="profile_img" width="185px" height="185px"/>
    <?php } else {
 ?>
            <img src="uploads/default/female.jpg" alt="" style="border-radius:4px; " id="profile_img" width="185px" height="185px"/>
    <?php }
    } ?>
    <div class='change_button' id='change_button'>
        <div class='change_button_text'>Change my photo</div>
    </div>
</div>
<br><br><a href="javascript:void(0)" onclick="rmprofilepic()">Remove Photo</a>