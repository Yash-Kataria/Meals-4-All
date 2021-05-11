<!DOCTYPE html>
<html lang="en">
<head>
	<title>Meals-4-All Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="Templates/Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Templates/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Templates/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Templates/Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Templates/Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Templates/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Templates/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Templates/Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="Templates/Login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form class="login100-form validate-form" method="POST" action="Php/LoginPage.php">
					<span class="login100-form-title p-b-55">
                        <img src="Templates/SVG/restaurant-cutlery-symbol-of-a-cross.svg" alt="Main Logo">
						&nbsp;Login
                        <!-- <img src="Templates/SVG/restaurant-cutlery-symbol-of-a-cross.svg" alt="Main Logo"> -->

					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="emailid" placeholder="Email Id"
						value="<?php if(isset($_COOKIE["EmailId"]))
									{
										echo $_COOKIE["EmailId"];
									}?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password"
						value="<?php if(isset($_COOKIE["Password"]))
									{
										echo $_COOKIE["Password"];
									}?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="contact100-form-checkbox m-l-4 p-t-20">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remembermebox">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<input type="submit" class="login100-form-btn" name="btnsubmit" value="Login">					
					</div>

					<div class="text-center w-full p-t-20">

						<a class="txt1 bo1 hov1" href="#">
							Forgot Password ?							
						</a>
					</div>

					<div class="text-center w-full p-t-65">
						<span class="txt1">
							Not a member?
						</span>

						<a class="txt1 bo1 hov1" href="CustomerRegistration.html">
							Register Now							
						</a>
					</div>

					<div class="text-center w-full p-t-25">
						<span class="txt1">
							Wanna Apply For Job?
						</span>

						<a class="txt1 bo1 hov1" href="JobApplication.html">
							Apply Now							
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<!--===============================================================================================-->	
	<script src="Templates/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Templates/Login/vendor/bootstrap/js/popper.js"></script>
	<script src="Templates/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Templates/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Templates/Login/js/main.js"></script>

</body>

</html>