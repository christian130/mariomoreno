<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <!--link rel="stylesheet" href="css/style.css" type="text/css" /-->
        <script type="text/javascript" src="js/jquery-latest.js"></script>



<link rel="icon" href="images/favicon.ico">
<title>WHATSDADILLY</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- custom CSS -->
<link href="css/Landingstyle.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="fonts/stylesheet.css" rel="stylesheet">





        
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>
    <body>
        <?php include 'header.php'; ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#AuthForm").validate({
                    rules: {
                        firstname:{
                            required:true
                        },
                        lastname:{
                            required: true
                        },
                        email:{
                            required:true,
                            email:true,
                            validusername:true
                        },
                        retypeemail:{
                            required:true,
                            email: 'required',
                            equalTo: '#email'
                        },
                        password:{
                            required:true
                        },
                        gender:{
                            required:true
                        },
                        dmonth:{
                            required:true
                        },
                        dday:{
                            required:true
                        },
                        dyear:{
                            required:true
                        }
                    },
                    messages: {
                        firstname:{
                            required: ""
                        },
                        lastname:{
                            required: ""
                        },
                        email:{
                            required:"",
                            validusername:"Email already exist"
                        },
                        retypeemail:{
                            required:"",
                            required : "",
                            equalTo : "Email not matched"
                        },
                        password:{
                            required:""

                        },
                        gender:{
                            required:""
                        },
                        dmonth:{
                            required:""
                        },
                        dday:{
                            required:""
                        },
                        dyear:{
                            required:""
                        }
                    }
                });
            });
            $.validator.addMethod('validusername',function(value){
                var getURL = "validusername.php";
                var email = $("#email").val();
                var result;
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       'email='+email,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 1)
                        {
                            result = false;
                        }
                        else if(data.success == 0)
                        {
                            result = true;
                        }
                    }
                });
                return result;
            }, '');
        </script>
      <div id="body">
		<div class="login_outer">
<div class="container">
<div class="login_form">
<div class="row">
<div class="col-sm-8">
  <div class="landing_left">
  	<h1>Welcome to WhatsDaDilly.com !</h1>
    <p>A place where all of your entertainment and social
essentials are merged  into one, so you won’t miss a thing!</p>
  </div>
</div>
<div class="col-sm-4">
                <div class="form1 form_outer">
                <div class="form_inn">
                <h2>Sign Up For Free!!</h2>
                	<form id="AuthForm" class="form-horizontal" action="signup.php" method="POST" accept-charset="utf-8">
                      <div class="form-group">
                        <div class="col-sm-6 padding_right">
                          <input type="text" class="form-control" name="firstname" id="firstname" value=""  placeholder="First name">
                        </div>
                        <div class="col-sm-6 padding_left">
                          <input type="text" class="form-control" id="inputName" name="lastname" id="lastname" value="" placeholder="Last name">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="email" class="form-control"  name="email" id="email"  value=""  placeholder="Email">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="email" class="form-control" name="retypeemail" id="retypeemail" value="" placeholder="Re Enter Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="password" class="form-control" name="password" id="password" value=""  placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <h1>Birthday</h1>
                          
                          <fieldset class="birthdayPicker">
                          <select name="dmonth" id="dmonth" class="birthMonth span2">
                            <option value="0">Month</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>
                          <select  name="dday" id="dday"  class="birthDate span2">
                            <option value="">Date</option>
                                                <?php for ($i = 01; $i <= 31; $i++) {
 ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php } ?>
                          </select>
                          <select  name="dyear" id="dyear"  class="birthYear span2">
                           <option value="">Year</option>
<?php for ($i = 1950; $i <= 2013; $i++) { ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php } ?>
                          </select>
                          <input type="hidden" name="birthDay" class="birthDay" value="2010-01-04">
                        </fieldset>  
                        
                        </div>
                        
                        <div class="male_femail">
                             <div class="col-sm-4">
                              <label>
                        	    <input type="radio" name="gender" id="gender" value="Male">
                        	    Male</label>
                        	  </div>
                              <div class="col-sm-4">
                        	  <label>
                        	    <input type="radio" name="gender" id="gender" value="Female">
                        	    Female</label>
                        	  </div>
                        </div>
                      </div>
                      <p>By clicking Sign Up, you agree to our <a href="http://whatsdadilly.com/betaPhase/terms.php">Terms</a> and that you have read our <a href="#">Data Policy</a>, 
including our <a href="#">Cookie Use.</a></p>

					<div class="form-group">
                        
                        <div class="col-sm-5">
						<input type="submit" value="SIGN UP"  class="btn btn_ss btn-sm btn-warning" style="margin-bottom:10px;"/>
                         
                        </div>
                        
                        <div class="col-sm-8"></div>
                        
                      </div>

                
                </div>
                
                <div class="col-sm-4"></div>
            </div>
            </div>
</div>
</div>
</div>
</div>
	</div>
                                           <?php include 'html/footer.php'; ?>

                                            </div>
                                            </body>
                                            </html>