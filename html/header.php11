<?php
//require_once '../model/Notification.php';
//require_once '../model/Friends.php';
?>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.crypt.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<script type="text/javascript">
    $(document).ready(function() {
        $("#AuthForm_log").validate({
            rules: {
                login_username:{
                    required:true,
                    email:true
                },
                login_password:{
                    required:true
                }
            },
            messages: {
                login_username:{
                    required:"Enter username"
                },
                login_password:{
                    required:"Enter password"

                }
            }
        });
        $('#login_btn').click( function() {
            if($("#AuthForm_log").valid()){
                var getURL = "userlogin.php";
                var login_username = $("#login_username").val();
                var pwd = $("#login_password").val();
                var password = $().crypt({
                    method: "md5",
                    source: pwd
                });
                var result;
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       'login_username='+login_username+"&login_password="+password,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 'faild')
                        {
                            $(".log_errr").show();
                            $('.loading-text').remove();
                            $(".demo-cb-tweets").prepend('<center><p class="loaded-text"><b>Wrong credientials..</b></p></center>');
                            $(".loaded-text").delay(3000).fadeOut("slow");
                            $(".log_errr").delay(3000).fadeOut("fast");
                            //$(".log_errr").delay(3000).css("display", "none");
                        }
                        else if(data.success == 'success')
                        {
                            var url = "home.php";
                            $(location).attr('href',url);
                        }
                        else if(data.success == 'wrongpwd')
                        {
                            var url = "wrongpassword.php";
                            $(location).attr('href',url);
                        }
                    }
                });
                return result;
            }
           
            
        });
    });
</script>

<?php
require_once 'classes/Session.class.php';
$session = new Session();
//print_r($_SESSION);
?>

<?php if ($session->getSession("userid") == '') {
?>
    <div id="login_topblack">
        <div class="topinner">
            <div id="login_logo"><a href=""><img src="images/logo.png" alt="WHATSDADILLY" /></a></div>
            <div id="header_login">
                <form id="AuthForm_log" class="Form FancyForm AuthForm" action="#" method="POST" accept-charset="utf-8">
                    <div class="header_loginleft">
                        <input type="text" name="login_username" id="login_username" value="" placeholder="Username">
                        <div><input type="checkbox" value=""><span>Keep me logged in</span></div>
                    </div>
                    <div class="header_loginright">
                        <input type="password" name="login_password" id="login_password" value="" placeholder="Password">
                        <span><a href="">Forgot your password?</a></span>
                    </div>
                    <div class="header_loginbtn">
                        <input type="button" value="Login" id="login_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } else {
?>
    <script type="text/javascript" src="js/home_header.js"></script>
    <script type="text/javascript" src="js/messages.js"></script>
    <div id="topblack">
        <div class="topinner2">
            <div id="logo"><a href=""><img src="images/logo.png" alt="WHATSDADILLY" /></a></div>
            <div class="infomenu">
                <ul>
                <?php $result = $notifications->getNotifications($entityManager, $session->getSession('userid')); ?>
                <li><a href="#" class="first">info</a> <span class="notify" id="notify"><?php echo $notifications->getNumber() ?> </span>
                    <div class="notification">
                        <?php echo $result; ?>
                    </div>
                </li>
                <li class="second"><a href="#">msg</a><div class="message_num"> </div>
                    <div class="messages" >
                        <div class="messageswrap">
                            <img src="images/dr1.jpg" alt="" class="dimg" />
                            <h4>Message!</h4>
                            <p>Wants to add you as a friend</p>

                        </div>
                        <div class="messageswrap nobg">
                            <img src="images/dr1.jpg" alt="" class="dimg" />
                            <h4>Message!</h4>
                            <p>Wants to add you as a friend</p>

                        </div>
                    </div>
                </li>
                <?php $result = $messages->getFriendsRequest($entityManager, $session->getSession('userid')); ?>
                        <li class="third"><a href="#">friends</a><div class="friends_num"> <?php echo $messages->getNumberRequest() ?></div>
                            <!--toggle -->
                            <div class="frienddropwrap" id="friend_requ">
                                <h3 id="friend_requ">Friends Request</h3>
                                <Div class="friends_request">
                            <?php echo $result; ?>
                        </Div>
                    </div>
                    <!--toggle end-->
                </li>
            </ul>
        </div>
        <div class="searchwrap">
            <input type="text" class="searchinput" id="searchinput" />
            <input type="image" src="images/search.png" />
            <div class="results">
                <ul id="resultdiv">

                </ul>

            </div>
        </div>
        <div class="homhicon"><a href="home.php"><img src="images/homicon.png" alt="" /></a></div>
        <div class="smicons"><a href="profile.php"><img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" width="40px;" height="35px;" style="border-radius:4px; "/></a></div>
        <span class="jessic"><?php echo ucfirst($session->getSession("firstname")); ?> <br><?php echo ucfirst($session->getSession("lastname")); ?></span>
        <div class="setting"><a href="#"><img src="images/setting.png" /></a>
            <ul class="settings">
                <a href="#"><li>Privacy</li></a>
                <a href="settings.php"><li>Setting</li></a>
                <a href="accounts.php" ><li class="">List Accounts</li></a>
                <a href="logout.php" ><li class="">Logout</li></a>
            </ul>
        </div>
    </div>
</div>
<?php } ?>
       
