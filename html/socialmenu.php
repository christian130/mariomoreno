<link rel="stylesheet" type="text/css" href="css/1style_tab.css" />
                   	<script src="js/main.js"></script>

<script type="text/javascript">

    function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('ul.dropdown > li');
        this.val = '';
        this.index = -1;
        this.initEvents();
    }
    DropDown.prototype = {
        initEvents : function() {
            var obj = this;

            obj.dd.on('click', function(event){
                $(this).toggleClass('active');
                return false;
            });

            obj.opts.on('click',function(){
                var opt = $(this);
                obj.val = opt.text();
                obj.index = opt.index();
                obj.placeholder.text(obj.val);
            });
        },
        getValue : function() {
            return this.val;
        },
        getIndex : function() {
            return this.index;
        }
    }

    $(function() {

        var dd = new DropDown( $('#dd') );
        var dd1 = new DropDown( $('#dd1') );

        $(document).click(function() {
            // all dropdowns
            $('.wrapper-dropdown-3').removeClass('active');
        });
        

    });
    function gettwitterscreen(twitter_screenid,process){

        if(process == 'true'){
            var getURL = "twitter_session.php";
            $.ajax({
                cache:      false,
                async:      false,
                type:       'POST',
                data:       'twitter_screenid='+twitter_screenid,
                url:        getURL,
                beforeSend: function () {
                    $(".pop_demo-cb-tweets").prepend('<p class="loading-text">Sending</p>');
                },
                complete: function(){
                    $('.loading-text').remove();
                    //$(".demo-cb-tweets").prepend('<p class="loading-text"></p>');
                },
                success:    function(msg){
                    var resObj = jQuery.parseJSON(msg);
                    if(resObj.success == 1)
                    {
                        var page_url = $("#pcurrent_url").val();
                        if(page_url == 'undefined' || page_url == null || page_url == 'insta_feeds.php'){
                            window.location.href = 'twitter_feeds.php';
                        } else {
                            window.location.href =  page_url;
                        }
                    }
                    else
                    {
                    
                    }
                }
            });
        } else {
            var url = "twitter_add.php";
            window.open(url,'popUpWindow','height=600,width=800,left=100,top=100,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
            //window.location.href ="twitter_add.php"
        }
    }
    function instagramRedirect(){
    window.location.href = 'insta_feeds.php';
    }
    function openWall(){
        $("#userwall").css("display", "block");
        //$("#userwall").next("em").css({ display: "block", opacity: 0 }).animate({ opacity: "show" }, "fast");
      $("#postedComments").css("display", "none");
      $("#post_box").css("display", "none");
       $("#wall_post_box").css("display", "block");
        //$("#postedComments").next("em").css({ display: "none", opacity: 0 }).animate({ opacity: "show" }, "fast");
        $("#loadmoreajaxloader").css("display", "none");
    }
</script>

	<div class="impor wrapper-dropdown-3" id="dd" >										
								<ul class="dropdown_girl dropdown">
 <?php
        //  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $session->getSession('auth_token_twitter'), $session->getSession('auth_secret_twitter'));
        //  $live_timeline = $connection->get('statuses/home_timeline', array('screen_name' => $session->getSession('screen_name_twitter'), 'count' => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));
        if ($session->getSession("twitter") == 1) {
        ?>


        <?php foreach ($screen_name as $screens) {
        ?>
                <li><a href="javascript:void(0);" onclick="gettwitterscreen(<?php echo $screens['screen_id']; ?>,'true')"><img src="img/icons/boy.png" alt="" /><span>@<?php echo $screens['screen_name']; ?></span></a></li>
        <?php } ?>
        <?php } ?>
        <li><a href="javascript:void(0);" onclick="gettwitterscreen('add','false')"><img src="img/icons/girl.png" alt="" /><span>+Add Account</span></a></li>

									
								</ul> 
							</div>

<!--div class="impor">										
								<ul class="dropdown_girl">
        <?php
   
        //  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $session->getSession('auth_token_twitter'), $session->getSession('auth_secret_twitter'));
        //  $live_timeline = $connection->get('statuses/home_timeline', array('screen_name' => $session->getSession('screen_name_twitter'), 'count' => 50, "contributor_details" => true, "include_entities" => true, "include_my_retweet" => true));
        if ($session->getSession("instagram") == 1) {
        ?>

               <li><a href="javascript:void(0);" onclick="instagramRedirect();"><img src="img/icons/girl.png" alt="" /><span>@<?php echo $session->getSession('screen_name_instagram'); ?></span></a></li>
        <?php } ?>
  	
								</ul> 
							</div-->