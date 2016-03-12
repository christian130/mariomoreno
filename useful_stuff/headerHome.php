<?php
//require_once '../model/Notification.php';
//require_once '../model/Friends.php';
include 'executeNotification.php';
?>

<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	
	<!-- Meta Informations -->
	<meta name="description" content="virtual medals">
	<meta name="keywords" content="virtual medals">
	<meta name="author" content="virtual medals">
	
	<!-- favicon -->
    <link href="img/favicon.ico" type="image/x-icon" rel="shortcut icon">	
	
	<!-- =========================
	   All Style Sheets
	============================== -->
	
	<!-- font awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">	
	
	<!-- Bootstrap and Normalize CSS -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">	
	
    <!-- Owl Carousel Assets -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
	
		
	<!-- Main CSS -->
	<link rel="stylesheet" href="css/profilestyle.css">
	<link rel="stylesheet" href="css/profile.css">
	
	<!-- Responsive CSS-->
	<link rel="stylesheet" href="css/profileresponsive.css">
	
	<!-- Fonts CSS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	
	<!-- Header scripts -->
	<script src="js/modernizr-2.8.3.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
 <script type="text/javascript" src="js/home_header.js"></script>
    <script type="text/javascript" src="js/messages.js"></script>
  
<style>
.namtitwrap 
{
float:right;
width:88%;

}

.mfrienwrap
{
display: table;
    float: right;
    width: 100%;
background: #fff;
    padding-bottom: 5px;
}

.IgnoreBtn
{

border: 1px solid #D5CFCF;
    padding: 5px 4px;
    background: #FAFBFB none repeat scroll 0% 0%;
    color: #82838A;
    font-weight: bold;
    font-size: 14px;
    float: left;
    position: relative;
        margin-top: 1px;

}
.ConformBtn
{
background: #171717;
padding: 5px 4px;
    color: #fff;
float:left;
font-size:14px;
    position: relative;
        margin-top: 0px;

}
.friednamewrap
{
float:left;
width:65%;
}
.m320
{
float:left;
width:35%;


}

.accept_friend_request_confirm,.add_friend_slider_div
{
width:50%;
float:left;
}
.add_friend_slider_div
{
width:50%;
float:left;
margin-top:0px;


}
</style>

<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-xs-12 width_three">
				    <!-- logo -->
					<div class="logo">
					    <img src="images/logo.png" alt="logo" />
					</div>
				</div>
				<div class="col-sm-2 col-xs-12 width_three">
					<div class="information">
						<ul>
							<!-- notification -->
 <?php
                $result = $notifications->getNotifications($entityManager, $session->getSession('userid'));
                $messages->updateNotifications($entityManager, $session->getSession('userid'));
                ?>
							<li class="notification_show"> 								
								<span><img src="img/icons/header_icon_one.png" alt="" /></span>
								<img class="notification_red_simble" src="img/icons/notification.png" alt="" />
								<div class="notification_numbar first_n_number">
									<span class="notification_number n_n_f">12</span>	
								</div>	
								<ul class="n_dropdown">
									<li class="d_f_n">
										<img class="icon_top" src="img/icons/top_move.png" alt="" />
										<div class="dropdown_notification">
											<div class="d_notification_title">
												<p>Notifications <span>Mark All as Read</span></p>
											</div>
											
                            <div style="max-height:300px;overflow-x:hidden;overflow-y:scroll;"><?php echo $result; ?></div>
												
											
											
											<div class="d_notification_dropdown">
												<a href="#"><span>See All</span></a>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<!-- message -->
							<li class="notification_show"> 								
								<span><img src="img/icons/header_icon_two.png" alt="" /></span>
								<img class="notification_red_simble" src="img/icons/notification.png" alt="" />
								<div class="notification_numbar secund_n_number">
									<span class="notification_number n_n_s">10</span>	
								</div>	
								<ul class="n_dropdown">
									<li class="d_f_nn">
										<img class="icon_top" src="img/icons/top_move.png" alt="" />
										<div class="dropdown_notification">
											<div class="d_notification_title">
												<p>Recent(13) <span> <span class="d_message_reqused">Message Requests(12)</span> Mark All as Read</span></p>
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin1.png" alt="" />
												<div class="notification_person">
												<img class="n_image_right" src="img/notification/message1.png" alt="" />
													<p><strong>Daniel Barnes </strong> <span>added you to the public group M R Car</span></p>
													<p>he writing 21 987600530.</p>
													<p>2 hours ago</p>													
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin2.png" alt="" />
												<div class="notification_person">
												<img class="n_image_right" src="img/notification/message2.png" alt="" />
													<p><strong>Daniel Barnes </strong> <span>added you to the public group M R Car</span></p>
													<p>he writing 21 987600530.</p>
													<p>2 hours ago</p>													
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin1.png" alt="" />
												<div class="notification_person">
												<img class="n_image_right" src="img/notification/message3.png" alt="" />
													<p><strong>Daniel Barnes </strong> <span>added you to the public group M R Car</span></p>
													<p>he writing 21 987600530.</p>
													<p>2 hours ago</p>													
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin3.png" alt="" />
												<div class="notification_person">
												<!-- <img class="n_image_right" src="img/notification/notificatin1.png" alt="" /> -->
													<p><strong>Daniel Barnes </strong> <span>added you to the public group M R Car</span></p>
													<p>he writing 21 987600530.</p>
													<p>2 hours ago</p>													
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin2.png" alt="" />
												<div class="notification_person">
												<!-- <img class="n_image_right" src="img/notification/notificatin4.png" alt="" /> -->
													<p><strong>Daniel Barnes </strong> <span>added you to the public group M R Car</span></p>
													<p>he writing 21 987600530.</p>
													<p>2 hours ago</p>													
												</div>												
											</div>
											<div class="d_notification_dropdown">
												<a href="#"><span>See All</span></a>
											</div>
										</div>
									</li>
								</ul>
							</li>					
							
							<!-- friend request  -->
							<?php $result = $messages->getFriendsRequest($entityManager, $session->getSession('userid')); ?>

							<li class="notification_show">
								<span><img src="img/icons/header_icon_three.png" alt="" />
								<img class="notification_red_simble" src="img/icons/notification.png" alt="" />
								<div class="notification_numbar">
									<span class="notification_number n_n_t">&nbsp;<?php echo $messages->getNumberRequest() ?></span>	
								</div>									
								<ul class="n_dropdown">
									<li>
										<img class="icon_top" src="img/icons/top_move.png" alt="" />
										<div class="dropdown_notification d_notification_chat">
											<div class="d_notification_title">
												<p>Accepted Requests <span><a href="Friend_Request.php" style="color:#fff;">Find Friends</a></span></p>
											</div>
											<div class="notification_content">
												<div class="widget-box chat_widget">
													<!-- WIDGET CONTENT -->
													<ul class="instagram-photo-list">
														<li>
															<a href="#" target="_blank"><img src="img/notification/chat1.png" alt="Instagram" /></a>
														</li>
														<li>
															<a href="#" target="_blank"><img src="img/notification/chat2.png" alt="Instagram" /></a>
														</li>
														<li>
															<a href="#" target="_blank"><img src="img/notification/chat2.png" alt="Instagram" /></a>
														</li>
														<li>
															<a href="#" target="_blank"><img src="img/notification/chat1.png" alt="Instagram" /></a>
														</li>
													</ul>
												</div>
												<div class="accepted_friend">
													<p><strong>Mike, Tati </strong>and 3 others accepted your friend requests.</p>
													<img src="img/icons/accepted.png" alt="" />
													<span>7 hours ago</span>
												</div>
											</div>
											<div class="friend_request_bar">
												<span>Friend Requests</span>
											</div>
<?php echo $result; ?>
											
											<div class="d_notification_dropdown">
												<a href="Friend_Request.php"><span>See All</span></a>
											</div>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>				
				</div>
				<div class="col-sm-4 col-xs-12 width_three">
					<div class="search">
						<div class="search_top_bar">
							<input type="text" name="search" id="id" />						
							<span><i class="fa fa-search top_search_bar"></i></span>
						</div>
								<ul class="n_dropdown search_dropdown">
									<li class="d_search">
										<img class="icon_top" src="img/icons/top_move.png" alt="" />
										<div class="dropdown_notification">
											<div class="d_notification_title">
												<p>Recent searches <span>Edit</span></p>
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin1.png" alt="" />
												<div class="notification_person">
													<p><strong>Daniel Barnes </strong> 
													<p>he writing 21 987600530.</p>
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin2.png" alt="" />
												<div class="notification_person">
													<p><strong>Daniel Barnes </strong> 
													<p>he writing 21 987600530.</p>
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin1.png" alt="" />
												<div class="notification_person">
													<p><strong>Daniel Barnes </strong> 
													<p>he writing 21 987600530.</p>
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin3.png" alt="" />
												<div class="notification_person">
													<p><strong>Daniel Barnes </strong> 
													<p>he writing 21 987600530.</p>
												</div>
												
											</div>
											<div class="notification_content">
												<img src="img/notification/notificatin2.png" alt="" />
												<div class="notification_person">
													<p><strong>Daniel Barnes </strong> 
													<p>he writing 21 987600530.</p>
												</div>												
											</div>
											<div class="d_notification_dropdown">
												<a href="#"><span>Custom Searchs</span></a>
											</div>
										</div>
									</li>
								</ul>
					</div>				
				</div>
				<div class="col-sm-1 col-xs-12 width_three">
					<div class="home_iocn_top">
						<a href="home.php" style="color:#fff;"><span class="home_iocn_top_span" ><i class="fa fa-home"></i></span>
						<div class="home_text_top"><span class="home_text hone_text_span">Home</span></div></a>
						
					</div>
				</div>
				<div class="col-sm-2 col-xs-12 width_three">
					<div class="author_image_and_name">	
 <?php
                // echo "cnt".count($session->getSession("profile_pic"));
        ?>	
						<div class="top_small_profile_pic home_left">
<a href="profile.php?profileid=<?php echo base64_encode($_SESSION['userid']); ?>">
                <?php if (count($session->getSession("profile_pic")) != 0) { ?>
                    <img src="uploads/<?php echo $session->getSession("profile_pic"); ?>" alt="" class="top_pic" style="width:42px;height:51px;"/>
                <?php
                } else {
                    if ($session->getSession("gender") == 'Male') {
                ?>
                        <img src="uploads/default/Maledefault.png" alt="" class="top_pic" style="width:42px;height:51px;"/>
                <?php } else {
 ?>
                        <img src="uploads/default/female.jpg" alt="" class="top_pic" style="width:42px;height:51px;"/>
                <?php }
                } ?>
            </a>
							<!--img class="top_pic" src="img/top_profile_pic.jpg" alt="small profile picture" /-->
							<p class="author_name"><?php echo ucfirst($session->getSession("firstname")); ?> <br><?php echo ucfirst($session->getSession("lastname")); ?></p>
							<span class="setting_icon" ><i class="setting_left_icon fa fa-cog"></i></span>
						</div>
					</div>
					<div class="setting_dropdown_menu">
					<img class="icon_top setting_icon_arror" src="img/icons/top_move.png" alt="" />
						<ul class="setting_dropdown">
							<li><a href="#"><img src="img/icons/s.png" alt="" /><span>Privacy</span></a></li>
							<li><a href="settings.php"><img src="img/icons/lock.png" alt="" /><span>Settings</span></a></li>
							<li><a href="accounts.php"><img src="img/icons/manage.png" alt="" /><span>Manage Accounts</span></a></li>
							<li><a href="logout.php"><img src="img/icons/log_our.png" alt="" /><span>Log Out</span></a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</header>
	<div style="clear:both;"></div>