<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('dashboard/database-settings.php');
require_once('dashboard/database.php');
require_once('dashboard/library.php');

$db = conexion();
# datos de la compa–ia
$qryCompany = $db->query("SELECT cname, description, keywords, footer_website FROM company");
$company = $qryCompany->fetch_array();
?>
<!DOCTYPE html>

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $company['cname']; ?> | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $company['description']; ?>"/>
	<meta name="keywords" content="<?php echo $company['keywords']; ?>" />
	<meta name="author" content="Jaomweb">

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="dashboard/css/login/css/bootstrap.min.css">
	<link rel="stylesheet" href="dashboard/css/login/css/animate.css">
	<link rel="stylesheet" href="dashboard/css/login/css/style.css">
	<style type="text/css">
		.userform{width: 400px;}
		.userform p {
			width: 100%;
		}
		.userform label {
			width: 120px;
			color: #333;
			float: center;
		}
		input.error {
			border: 2px dotted red;

		}
		label.error{
			width: 100%;
			color: red;
			font-style: italic;
			margin-center: 120px;
			margin-bottom: 15px;
		}
		.userform input.submit {
			margin-center: 120px;
		}
	</style>

	<!-- Modernizr JS -->
	<script src="dashboard/css/login/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="menu">
						<img src="dashboard/logo-image/image_logo.php?id=1" height="45" width="241" />
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					

					<!-- Start Sign In Form -->
					<form  class="fh5co-form animate-box" data-animate-effect="fadeIn" name="form1" id="userForm" method="post" novalidate>
					
						<h2>Sign In</h2>
						<?php
						if(isset($_POST['user'])&& md5($_POST['password'])) {
							$error = verify_users($_POST['user'],md5($_POST['password']));	 								
						} else {
								echo '
									<div class="form-group">
										<label for="username" class="sr-only">Username</label>
										<input type="text" class="form-control" id="user-name" name="user" placeholder="Your Username" tabindex="1" required data-validation-required-message= "Please enter your username.">
									</div>
									<div class="form-group">
										<label for="password" class="sr-only">Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" tabindex="2" required data-validation-required-message= "Please enter valid passwords." autocomplete="off">
									</div>
									<div class="form-group">
										<label for="remember"><input type="checkbox" id="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<p>Not registered? <a href="signup.php">Sign Up</a> | <a href="recover-password.php">Forgot Password?</a></p>
									</div>
									<div class="form-group">
										<input type="submit" value="Sign In" class="btn btn-success">
									</div>';
							}	
						?>
					</form>
					<!-- END Sign In Form -->

				</div>
			</div>
			<div class="row" style="padding-top: 60px; clear: both;">
				<div class="col-md-12 text-center"><p><small><?php echo $company['footer_website']; ?></small></p></div>
			</div>
		</div>
	
	<!-- jQuery -->
	<script src="dashboard/css/login/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="dashboard/css/login/js/bootstrap.min.js"></script>
	<!-- Placeholder -->
	<script src="dashboard/css/login/js/jquery.placeholder.min.js"></script>
	<!-- Waypoints -->
	<script src="dashboard/css/login/js/jquery.waypoints.min.js"></script>
	<!-- Main JS -->
	<script src="dashboard/css/login/js/main.js"></script>
	<script src="process/jquery.validate.js"></script>
	<script>
	$.validator.setDefaults({
		submit: function() {
			alert("submitted!");
		}
	});

	$(document).ready(function() {
		$("#userForm").validate({
			rules: {
				name: "required",
				user: {
					required: true,
				},
				password: {
					required: true,
					minlength: 3
				},
				
			   
			},
			messages: {
				name: "Please enter your user name",           
				user: {
						required: "Please enter your user name",
				},
				name: "Please enter your password",           
				password: {
						required: "Please enter your password",
						minlength: "Your password must consist of at least 6 characters"
				}, 	
			}
		});
	});
	</script>


	</body>
</html>

