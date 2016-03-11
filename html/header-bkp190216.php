<?php
//require_once '../model/Notification.php';
//require_once '../model/Friends.php';
include 'executeNotification.php';
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript" src="js/jquery.validate.js"></script>
<!--<script type="text/javascript" src="js/jquery.crypt.js"></script>-->
<link rel="stylesheet" href="css/1style.css" type="text/css" />
<link rel="stylesheet" href="css/notification-bar.css" type="text/css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" href="css/1responsive.css" type="text/css" />




<style>
    .infomenu li a:hover
    {
    }


    .active {

        color:#fff !important;
    }
    .beeperNub
    {

        background-image: url('https://fbstatic-a.akamaihd.net/rsrc.php/v2/yp/r/7JuI99HGK-f.png');
        background-repeat: no-repeat;
        background-size: auto;
        background-position: -26px -167px;
        left: auto;
        position: absolute;
        top:-30px;
    }

</style>



<script>
    $(document).ready(function() {
        $('.infomenu li a i.fa').on('click', changeClass);


    });




    function changeClass() {
        $('.infomenu li a i.fa').removeClass('active');
        $(this).toggleClass('active');


    }



</script>

<script type="text/javascript">
    $(document).ready(function() {
	
        $(".first").click(function(){
            $( ".notify" ).replaceWith( " " );
	  
	   
        });
	   
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
                $( "#AuthForm_log" ).submit();
            }
           
            
        });
    });
	
	
</script>

<?php
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
$session = new Session();

if ($session->getSession("userid") == '') {
?>
<div id="container">
 
  
	<div id="header">
		<header>
  <div class="login_header black_1">
    <div class="container black_2">
      <div class="row black_3">
        <div class="col-sm-3 black_4">
          <div class="logo"><a href="index.htm"><img src="images/logo.png" alt=""></a></div>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6 pading_30">
          <div class="form1">
            <form id="AuthForm_log" action="userlogin.php" method="POST" class="form-horizontal FancyForm AuthForm">
              <div class="form-group landing_form">
                <div class="col-sm-1 padding_all"></div>
                <div class="col-sm-4 padding_all">
                  <input type="text" name="login_username" id="login_username" value="" class="form-control" placeholder="Email">
                  <div class="checkbox checkbox_cu">
                    <label>
                      <input type="checkbox" value="">
                      Remember me</label>
                  </div>
                </div>
                <div class="col-sm-4 padding_all">
                  <input type="password" name="login_password" id="login_password" value="" class="form-control"  placeholder="Password">
                  <a href="forgotpassword.php">Forgot Password?</a> </div>
                <div class="col-sm-3 padding_all">
				                        <input type="button" value="Login" id="login_btn" class="submit_btn" >

                </div>
              </div>
            </form>
			<div class="col-sm-3 padding_all create_accounttp">
					<input type="button" class="create_new_account" value="Create New Account">
			</div>
			<div class="Forgottenyourpassword"><a href="forgotpassword.php">Forgot your password?</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
	</div>
<?php
} else {
    $data = array(
        "sign_uid" => $session->getSession("userid")
    );
    $activation = Signup::getActivationLink($data, $entityManager);

    $registerdate = $activation[0]['registerdate'];
?>
    <script type="text/javascript" src="js/home_header.js"></script>
    <script type="text/javascript" src="js/messages.js"></script>
<?php if ($activation[0]['registeration_status'] == 'PENDING') {
 ?>
        <style type="text/css">
            #topblack{
                margin-top: 23px;
            }
        </style>
        <link rel="stylesheet" href="css/notification-bar.css" type="text/css" />
        <div class="jquery-bar">
            <span class="notificationheader">
                <p class="font-style">&laquo; Verify you email - <a href="activation.php?action=<?php echo base64_encode('verifymail'); ?>" target="_balnk">Verify you email</a></p>
                <p class="jquery-arrow down">&laquo; Verify you email - <a href="activation.php?action=<?php echo base64_encode('resendmail'); ?>&url=<?php echo base64_encode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]); ?>">Resend Activation link</a></p>
            </span>
        </div>
<?php } ?>
    <div id="topblack">
        <div class="topinner2">
            <div id="logo"><a href=""><img src="images/logo.png" alt="WHATSDADILLY" /></a></div>

            <div class="infomenu">
                <ul>
                <?php
                $result = $notifications->getNotifications($entityManager, $session->getSession('userid'));
                $messages->updateNotifications($entityManager, $session->getSession('userid'));
                ?>
                <li><a href="#" class="first" style="border:none !important;" "><i onClick="changeClass();" class="fa fa-globe fa-2"></i></a> <span class="notify" id="notify"><?php echo $notifications->getNumber() ?> </span>

                    <div class="notification" >
                        <i class="fa fa-sort-asc fa-2x" style="color:#333;float:left;margin-left:12px;margin-top:-11px;"></i>
                            <?php echo $result; ?>
                    </div>    
                </li>
                <li class="second"><a href="#" "><i onClick="changeClass();" class="fa fa-weixin"></i></a><div class="message_num"> </div>
                    <div class="messages" >

                        <i class="fa fa-sort-asc fa-2x" style="color:#333;float:left;margin-left:12px !important;margin-top:-11px !important;"></i>



                        <div class="messageheader"><h4 style="margin:5px;font-weight:bold;font-size:12px !important;">Inbox(6)</h4> </div>
                        <div class="messagewrapmain">
                            <div class="messageswrap">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>

                            <div class="messageswrap">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="messageswrap">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="messageswrap">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="messageswrap">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="messageswrap">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>

                            <div class="messageswrap">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="messageswrap nobg">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <img src="images/dr1.jpg" alt="" class="dimg" /></td>
                                        <td><h4 style="font-weight:bold;margin:0px;font-size:12px !important;">Message!</h4>
                                            <p style="color:#ccc;">Wants to add you as a friend</p></td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        <div class="messagefooter"><h4 style="margin:5px;text-align:center;font-weight:bold;font-size:12px !important;">See all</h4> </div>


                    </div>
                </li>
<?php $result = $messages->getFriendsRequest($entityManager, $session->getSession('userid')); ?>
                <li class="third" style="border:none !important;"><a href="#" "><i onClick="changeClass();" class="fa fa-users"></i> </a><div class="friends_num"> <?php echo $messages->getNumberRequest() ?></div>
                    <!--toggle -->
                    <div class="frienddropwrap" id="friend_requ">
                        <i class="fa fa-sort-asc fa-2x" style="color:#333;float:left;margin-left:12px;margin-top:-11px;"></i>

                        <div class="messageheader"><h4 style="float:left;margin:5px;font-weight:bold;font-size:12px !important;">Friend requests</h4>
                            <h4 style="margin:5px;float:right;font-weight:bold;font-size:12px !important;">Invite friends</h4></div>
                        <Div class="friends_request">

<?php echo $result; ?>
                        </Div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="searchwrap">
        <div class="search_new">
            <input type="text" class="searchinput" id="searchinput" />
            <input type="image" src="images/search.png" />
            <div class="results">
                <ul id="resultdiv">

                </ul>

            </div>
            </div>
        </div>
        <?php
                // echo "cnt".count($session->getSession("profile_pic"));
        ?>
        <div class="all_settings">
                <div class="homhicon"><a href="home.php"><img src="images/homicon.png" alt="" /></a></div>
                <div class="smicons">
                    <a href="profile.php?profileid=<?php echo base64_encode($_SESSION['userid']); ?>">
                <?php if (count($session->getSession("profile_pic")) != 0) { ?>
                    <img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" width="40px;" height="35px;" style="border-radius:4px; "/>
                <?php
                } else {
                    if ($session->getSession("gender") == 'Male') {
                ?>
                        <img src="uploads/default/Maledefault.png" alt="" width="40px;" height="35px;" style="border-radius:4px; "/>
                <?php } else {
 ?>
                        <img src="uploads/default/female.jpg" alt="" width="40px;" height="35px;" style="border-radius:4px; "/>
                <?php }
                } ?>
            </a>
        </div>
        <span class="jessic"><?php echo ucfirst($session->getSession("firstname")); ?> <br><?php echo ucfirst($session->getSession("lastname")); ?></span>
        <div class="setting"><a href="#"><img src="images/setting.png" /></a>
            <ul class="settings">
                <a href="#"><li>Privacy</li></a>
                <a href="settings.php"><li>Setting</li></a>
                <a href="accounts.php" ><li class="">List Accounts</li></a>
                <a href="logout.php" ><li class="">Logout</li></a>
            </ul>
        </div>
        <div id="notification_popup" style="background:gray;width:200px;height:100px;display:none;">
        </div>
    </div>
    </div>
</div>
<?php } ?>