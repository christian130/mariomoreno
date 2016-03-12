<style>
	.ba_info td {
		width:50%;
padding:5px;
border-bottom:1px solid #d3d6db;
	}
	.ba_info {
                //border-collapse:separate;
                border-spacing:16px 10px !important;
      width: 430px;	
margin:5px;

    }
</style>
<div style="border-bottom:1px solid #d3d6db;width:100%;height:23px;"><h2 style="font-size:14px;font-weight:bold;color:#333;float:left;margin:3px;" >Contact Info</h2>
                                    <?php if (isset($_GET['profileid']) && (base64_decode($_GET['profileid']) != $session->getSession("userid"))) {
                                    ?>
                                    <?php } else {
 ?>
                                                         <a style="float:right;margin:3px;" href="javascript:void(0)" onclick="contacts();"><?php echo $link; ?></a>
<?php } ?>
                                                </div>	

         <!--<div style="float:left;margin-left:15px;"><b style="color:black;">Work & Education</b></div>-->
<div style="float:left;">                                         
                                                <form name="contact" id="contact" class="contact" action="" method="post">
                                                    <input type="hidden" name="segment" id="segment" value="contact" />
                                                    <div style="padding-top:0px;">
                                                        <table class="ba_info">
                                                            <tr >
                                                                <td style="border-bottom:1px solid #d3d6db;">
                                       <div class="sqicon"> <i class="fa fa-mobile" style="color:#fff;margin:4px;padding-left:4px;"></i>       
             <!-- <div style="float:left;width:25px;"> <img src="images/mobileNew.png" style="width:18px;" /> -->

</div>
																      <div style="float:left;color:#333;">Mobile:</div>
                                                                </td>

                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                    <input type="text" name="phonenumber" id="phonenumber" value="<?php echo $user_det[0]['phonenumber']; ?>" class="proedits" readonly/>
                                                                </td>


                                                            </tr>
															
															<tr>
                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                   
                                       <div class="sqicon"> <i class="fa fa-phone" style="color:#fff;margin:4px;padding-left:3px;"></i>       

<!--<div style="float:left;width:25px;"> <img src="images/HomeP.png" style="width:18px;" /> -->

</div>
																 <div style="float:left;color:#333;">Home: </div>  
                                                                </td>

                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                    <input type="text" name="homenumber" id="homenumber" value="<?php echo $user_det[0]['home']; ?>" class="proedits" readonly/>
                                                               
																</td>

                                                            </tr>
															
															<tr>
                                                                <td style="border-bottom:1px solid #d3d6db;">
                                       <div class="sqicon"> <i class="fa fa-list-alt" style="color:#fff;margin:4px;padding-left:1px;"></i>       
                
 <!-- <div style="float:left;width:25px;"> <img src="images/address.png" style="width:18px;" /> -->


</div> 
																    <div style="float:left;color:#333;">Address:</div>  
                                                                </td>

                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                   <input type="text" name="address" id="address" value="<?php echo $user_det[0]['address']; ?>" class="proedits" readonly/>
																</td>

                                                            </tr>

															<tr>
                                                                <td style="border-bottom:1px solid #d3d6db;">

                   <div class="sqicon"> <i class="fa fa-building" style="color:#fff;margin:4px;padding-left:3px;"></i>       
                              
                    <!-- <div style="float:left;width:25px;"> <img src="images/city.png" style="width:18px;" /> -->

</div> 
																    <div style="float:left;color:#333;">City:</div> 
                                                                </td>

                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                    <input type="text" name="city" id="city" value="<?php echo $user_det[0]['city']; ?>" class="proedits" readonly/>
																</td>

                                                            </tr>
															
															<tr >
                                                                <td style="border-bottom:1px solid #d3d6db;">

                                                  <div class="sqicon"> <i class="fa fa-fax" style="color:#fff;margin:4px;padding-left:2px;"></i>       
                        
 <!-- <div style="float:left;width:25px;"> <img src="images/zip.png" style="width:18px;" /> -->

</div>
																 <div style="float:left;color:#333;">Zip Code:</div>   
                                                                </td>

                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                    <input type="text" name="zipcode" id="zipcode" value="<?php echo $user_det[0]['zip_code']; ?>" class="proedits" readonly/>
															</td>															
															</tr>
															
															<tr >
                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                   
                                                  <div class="sqicon"> <i class="fa fa-globe" style="color:#fff;margin:4px;padding-left:2px;"></i>       

<!--<div style="float:left;width:25px;"> <img src="images/aim.png" style="width:18px;" /> -->
</div>
																   <div style="float:left;color:#333;"> Social:</div> 
                                                                </td>

                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                     <select style=";margin-left:px;padding:0px;border:1px solid #000;"  name="relationship" id="dropdown1" class="dropdown" readonly>
																		<option>Select</option>
																		<option value="AIM" <?php echo $rel == 'Single' ? 'selected' : ''; ?>>AIM</option>
																		<option value="yahoo" <?php echo $rel == 'Divorced' ? 'selected' : ''; ?>>Yahoo</option>
																		<option value="Google Talk" <?php echo $rel == 'Married' ? 'selected' : ''; ?>>Google Talk</option>
																		<option value="Skype" <?php echo $rel == 'Open' ? 'selected' : ''; ?>>Skype</option>
																		<option value="Widowed" <?php echo $rel == 'Widowed' ? 'selected' : ''; ?>>MSN Messenger</option>
																		<option value="Common Law" <?php echo $rel == 'Common Law' ? 'selected' : ''; ?>>Hookt</option>
																		<option value="Dating" <?php echo $rel == 'Dating' ? 'selected' : ''; ?>>Whatsapp</option>
																		<option value="Seeing Someone" <?php echo $rel == 'Seeing Someone' ? 'selected' : ''; ?>>BBM PIN</option>
																		<option value="Engaged" <?php echo $rel == 'Engaged' ? 'selected' : ''; ?>>twitter</option>

																	</select>
															</td>

                                                            </tr>
															
															<tr >
                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                   
                                                  <div class="sqicon"> <i class="fa fa-laptop" style="color:#fff;margin:4px;"></i>       

<!-- <div style="float:left;width:25px;"> <img src="images/website1.png" style="width:18px;" /> -->
</div>
																   <div style="float:left;color:#333;"> Website:</div>
                                                                </td>

                                                                <td style="border-bottom:1px solid #d3d6db;">
                                                                    <input type="text" name="website" id="website" value="<?php echo $user_det[0]['website']; ?>" class="proedits" readonly/>
															</td>

                                                            </tr>
															

                                                            <tr style="display: none;" class="pro_button">
<td style="border-bottom:none !important;"></td>
                                                                <td style="border-bottom:none !important;">
                                                                                                                                   <div style="float:right;margin-right:-20px;">

                                                                    <input type="button" name="Cancel" value="Cancel" class="button" onclick="contactcancel()"/>  

   <input type="button" name="Save" value="Save" class="button" onclick="savecontact()"/> </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </form>
</div>
										