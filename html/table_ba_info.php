<style>
.basic_text {
    left: 2% !important;}
	.ba_info td {
      width: 415px;	
         }
	.ba_info {
                //border-collapse:separate;
                border-spacing:16px 10px !important;
      width: 430px;	
      margin:5px;
    }
.sqicon
{
width: 24px;
height: 24px;
background: #333;
border-radius: 3px;
margin-right: 2px;
float:left;
}


</style>
<div class="basic_information_title">
<p><span class="basic_text">Basic Information</span>

                                    <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                    ?>
                                    <?php } else {
                                    ?>
 <a href="javascript:void(0)" onclick="basicinfos();"><span class="basic_information_edit">Edit</span></a>
                                    <?php } ?>
                                </div>
 <!-- <div style="float:left;margin-left:15px;"><b style="color:black;">Basic Info</b></div>-->
							   
								<form name="basicinfo" id="basicinfo" class="basicinfo" action="" method="post">
                                    <input type="hidden" name="segment" id="segment" value="basicinfo" />
                                    <div class="col-sm-9 col-md-12 col-lg-12 left_side_padding_left">
                                       <div class="right_side_basic_information">
										<ul>
											<li>
												<img src="img/icons/cal.png" alt="">
												<span class="basic_span_left">Basic information: </span><span class="basic_span_right"> <input type="text" name="dob" id="dob" value="<?php echo ucfirst(Date($user_det[0]['dob']->date)); ?>" class="proedits" readonly/></span>
											</li>
											<li>
												<img src="img/icons/gendar.png" alt="">
												<span class="basic_span_left">Gendar: </span><span class="basic_span_right"><?php echo ucfirst($user_det[0]['gender']); ?></span>
											</li>
											<li>
												<img src="img/icons/live.png" alt="">
												<span class="basic_span_left">Lives in: </span><span class="basic_span_right"><input style=";" type="text" name="current_city" id="current_city" value="<?php echo ucfirst($current_city[0]['city']); ?> <?php echo ucfirst($current_city[0]['country']); ?>" class="proedits" readonly/>
                                                    <input type="hidden" name="current_city_id" id="current_city_id" value="<?php echo $user_det[0]['current_city']; ?>" />
                                                </span>
											</li>
											<li>
												<img src="img/icons/home.png" alt="">
												<span class="basic_span_left">Home: </span><span class="basic_span_right"><input sty le=";"type="text" name="home_city" id="home_city" value="<?php echo ucfirst($home_city[0]['city']); ?> <?php echo ucfirst($home_city[0]['country']); ?>" class="proedits" readonly/>
                                                    <input type="hidden" name="home_city_id" id="home_city_id" value="<?php echo $user_det[0]['home_city']; ?>" />
                                                 </span>
											</li>
											<li>
												<img src="img/icons/relation.png" alt="">
													<span class="basic_span_left">Relationship: </span>
													<span class="basic_span_right"> 
                                                                                                  <?php $rel = $user_det[0]['relationship']; ?>
							<select class="basic_information_select" name="relationship" id="dropdown1" readonly>
<option>Select</option>
                                                        <option value="Single" <?php echo $rel == 'Single' ? 'selected' : ''; ?>>Single</option>
                                                        <option value="Divorced" <?php echo $rel == 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                                                        <option value="Separated" <?php echo $rel == 'Separated' ? 'selected' : ''; ?>>Separated</option>
                                                        <option value="Married" <?php echo $rel == 'Married' ? 'selected' : ''; ?>>Married</option>
                                                        <option value="Open" <?php echo $rel == 'Open' ? 'selected' : ''; ?>>Open</option>
                                                        <option value="Widowed" <?php echo $rel == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                                                        <option value="Common Law" <?php echo $rel == 'Common Law' ? 'selected' : ''; ?>>Common Law</option>
                                                        <option value="Dating" <?php echo $rel == 'Dating' ? 'selected' : ''; ?>>Dating</option>
                                                        <option value="Seeing Someone" <?php echo $rel == 'Seeing Someone' ? 'selected' : ''; ?>>Seeing Someone</option>
                                                        <option value="Engaged" <?php echo $rel == 'Engaged' ? 'selected' : ''; ?>>Engaged</option>
														</select> 
													</span>
											</li>
											<li><?php $inter = $user_det[0]['interested']; ?>
												<img src="img/icons/interset.png" alt="">
												<span class="basic_span_left">Interseted in: </span>
												<span class="basic_span_right"> 
	<select class="basic_information_select" name="interested" id="dropdown" readonly>
														<option value="Male" <?php echo $inter == 'Male' ? 'selected' : ''; ?>>Male</option>
                                                        <option value="Female" <?php echo $inter == 'Female' ? 'selected' : ''; ?>>Female</option>
                                                        <option value="Both" <?php echo $inter == 'Both' ? 'selected' : ''; ?>>Both</option>
													</select> 
												</span>
											</li>
											<li>
												<img src="img/icons/political.png" alt="">
												<span class="basic_span_left">Political Views: </span><span class="basic_span_right">                                                    <input style=";"  type="text" name="politicalview" id="politicalview" value="<?php echo ucfirst($user_det[0]['politicalview']); ?>" class="proedits" readonly/> </span>
											</li>
											<li>
												<img src="img/icons/religion.png" alt="">
												<span class="basic_span_left">Religion: </span><span class="basic_span_right"><input style=";" type="text" name="religion" id="religion" value="<?php echo ucfirst($user_det[0]['religion']); ?>" class="proedits" readonly/></span>
											</li>
											<li>
												<img src="img/icons/language.png" alt="">
												<span class="basic_span_left">Languages: </span><span class="basic_span_right"><input style=";" type="text" name="language" id="language" value="<?php echo ucfirst($user_det[0]['language']); ?>" class="proedits" readonly/> </span>
											</li>
											<li class="last_border_bottom">
												<img src="img/icons/last_login.png" alt="">
												<span class="basic_span_left">Last login: </span><span class="basic_span_right"> <?php echo ucfirst($user_det[0]['last_login']); ?> </span>
											</li>
<li class="last_border_bottom pro_button" style="display: none;height:50px;" >
												
												  <div style="float:right;">

                                                    <input type="button" name="Cancel" value="Cancel" class="button" onclick="basiccancel()"/>
                                                  
 <input type="button" name="Save" value="Save" class="button" onclick="savebasicinfo()"/> </div>
											</li>
										</ul>
									</div>
                                    </div>
                                </form>
							  
                               