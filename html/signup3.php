<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>:WHATSDADILLY:</title>
            <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
            <link rel="stylesheet" href="css/style.css" type="text/css" />
            <!--<link href="css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/jquery.Jcrop.min.js"></script>
            <script type="text/javascript" src="js/crop.js"></script>-->
            <link href="css/bootstrap.min1.css" rel="stylesheet">
                <link href="css/bootstrap-theme.min.css" rel="stylesheet">
                    <link href="css/registration-process1.css" rel="stylesheet">
                        <link href="css/cropcustom.css" rel="stylesheet">
                            <script src="js/jquery-pack.js" type="text/javascript"></script>
                            <script src="js/jquery.js" type="text/javascript"></script>
                            <!--<script src="js/bootstrap.js" type="text/javascript"></script>-->
                            <!-- required plugin for ajax file upload -->
                            <script src="js/fileuploader.js" type="text/javascript"></script>
                            <script src="js/jquery.imgareaselect.min.js" type="text/javascript"></script>
                            <script src="js/cropscript.js" type="text/javascript"></script>


                            <script type="text/javascript">


                                function skipStep(){
                                    $.ajax({
                                        type : 'POST',
                                        url: "crop_script.php",
                                        data: "action=noimage",
                                        success: function(data){
                                            window.location.href = "home.php";
                                        }
                                    });
                                }
                                //$(document).ready(function(){

                                   // $('#save_thumb').click(function() {
										//window.location.href = "home.php";
                                       // $("#multiform").submit();

                                        //                    var formdata =  new FormData($(this)[0]);
                                        //
                                        //                    $.ajax({
                                        //                        type: "POST",
                                        //                        url: "upload.php",
                                        //                        mimeType:"multipart/form-data",
                                        //                        data: formdata,
                                        //                        contentType: false,
                                        //                        cache: false,
                                        //                        processData:false,
                                        //
                                        //                        success: function(){alert('success');}
                                        //                    });
                                   // });

                                //});
                            </script>

                            <style>

                                #login_topblack
                                {
                                    top:0px !important;
                                    position:absolute;
                                }

                                body
                                {
                                    background:#fff !important;
                                }
                                td
                                {
                                    color:#333 !important;
                                }

                            </style>





                            </head>
                            <body>
                                <?php include 'header.php'; ?>


                                <div class="cols-xs">
                                    <div class="StepProgresses">
                                        <div class="Step1Process">
                                            Step 1 <br/>
                                            <small>Invie Your Friends</small>

                                        </div>
                                        <div class="Step2Process">
                                            Step 2 <br/>
                                            <small>Invie Your Friends</small>

                                        </div>
                                        <div class="Step3Process">
                                            Step 3 <br/>
                                            <small>Invie Your Friends</small>

                                        </div>
                                        <div class="Step4Process">
                                            Step 4 <br/>
                                            <small>Invie Your Friends</small>

                                        </div>

                                    </div>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                            <span class="fright" style="margin-right:20px;"><strong>75% </strong>Complete</span>
                                        </div>
                                    </div>
                                    <p class="InviteYourFrieds"><i>Add Your Profile Picture</i></p>
                                    <div class="row">
                                        <div class="col-lg-6" id="crop-section" style="display:none">
                                            <img src="" id="thumbnail" alt="Create Thumbnail" />
                                            <div id="thumb_preview_holder">
                                                <img src=""  alt="Thumbnail Preview" id="thumb_preview" />
                                            </div>
                                            <div>
                                                <input type="hidden" name="filename" value="" id="filename" />
                                                <input type="hidden" name="x1" value="" id="x1" />
                                                <input type="hidden" name="y1" value="" id="y1" />
                                                <input type="hidden" name="x2" value="" id="x2" />
                                                <input type="hidden" name="y2" value="" id="y2" />
                                                <input type="hidden" name="w" value="" id="w" />
                                                <input type="hidden" name="h" value="" id="h" /><br>


                                            </div>
                                        </div>

                                        <div class="col-lg-6" id="uploader-section">
                                            <div class="product_image">
                                                <?php if ($session->getSession("sign_gender") == 'Male') {
                                                ?>
                                                    <img src="uploads/default/Maledefault.png" class="thumbnails" />
                                                <?php } else {
 ?>
                                                    <img src="uploads/default/female.jpg" class="thumbnails" />
<?php } ?>
                                            </div>
                                            <div id="file-uploader">
                                                <button id="upload" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-plus"></span>&nbsp;
                                                    <span class="upload">Change profile picture</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="SaveOrSkip merge"><span style="margin-left:20px; padding-top:20px;vertical-align:middle;"><a href="" style="color:#cccccc;"> <img src="rgimages/back-icon.png"> Back</a></span> <div class="fright">or <a href="javascript:void(0)" onclick="skipStep()">Skip This Step</a>
                                            <a href="#">

                                                <input type="submit" class="btn btn-primary button" name="upload_thumbnail" value="Save & Continue" id="save_thumb" /></a></div></div></form>





                                </div>
                                <div class="FooterBelowHints">Profile pictures and billboard images are public. It is the one distinguishing item that sets you apart from other users. It will also help you have more friends, be more approachable for networking,  and improve your overall social networking experience. </div>

                                <p>&nbsp;</p>
                                <p>&nbsp;</p>

                                <!--  <div class="jumbotron">

                                      <div class="row">
                                          <div class="col-lg-6" id="crop-section" style="display:none">
                                              <img src="" id="thumbnail" alt="Create Thumbnail" />
                                              <div id="thumb_preview_holder">
                                                  <img src=""  alt="Thumbnail Preview" id="thumb_preview" />
                                              </div>
                                              <div>
                                                  <input type="hidden" name="filename" value="" id="filename" />
                                                  <input type="hidden" name="x1" value="" id="x1" />
                                                  <input type="hidden" name="y1" value="" id="y1" />
                                                  <input type="hidden" name="x2" value="" id="x2" />
                                                  <input type="hidden" name="y2" value="" id="y2" />
                                                  <input type="hidden" name="w" value="" id="w" />
                                                  <input type="hidden" name="h" value="" id="h" /><br>

                                                      <input type="submit" class="btn btn-primary button" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" />
                                              </div>
                                          </div>


                                      </div>
                                  </div>-->
                            </body>
                            </html>