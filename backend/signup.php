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

$db = conexion();
# datos de la compañia
$qryCompany = $db->query("SELECT cname, description, keywords, footer_website FROM company");
$company = $qryCompany->fetch_array();

# datos de la tabla paises
$querys = $db->query("SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC");
$rowsCount = $querys->num_rows;

?>
<!DOCTYPE html>

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $company['cname']; ?> | Register</title>
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
				<div class="col-md-8 col-md-offset-2">	

					<!-- Start Sign In Form -->
					<form action="dashboard/settings/customer_registration/registration.php"  method="POST"  name="mi_formulario" class="fh5co-form animate-box" data-animate-effect="fadeIn" onSubmit="return validar_clave()">
						<h2>Sign Up</h2>
						<div class="form-group">
						<?php if ( isset ( $_GET ['tipo'] ) ) { ?>
							<div class="row alertaCaja" style="display: none;">
								<div class="col-xs-12 col-sm-12 col-md-12" style="float: none; margin: 0 auto;">
									<div class="alert alert-dismissible alert-<?php echo $_GET ['tipo'] ?>">
										<button type="button" class="close" data-dismiss="alert">x</button>
										<strong>Oh something step!</strong> <?php echo $_GET ['mensaje']; ?>
									</div>
								</div>
							</div>
						<?php } ?>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="name" class="sr-only">Name</label>
								<input type="text" class="form-control" id="fname" name="fname" placeholder="Name" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Last name" class="sr-only">Last name</label>
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" autocomplete="off">
							</div>
						</div>	
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Identification" class="sr-only">Identification</label>
								<input type="text" class="form-control" id="name" name="cc" placeholder="Identification" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Language" class="sr-only">Language</label>
								<select class="form-control" name="lang" >
									<option value="en_customer">English</option>
									<option value="fr_customer">French</option>
									<option value="hindi_customer">Hindi</option>
									<option value="es_customer">Spanish</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Email" class="sr-only">Email</label>
								<input type="email" name="email" class="form-control" id="re-password" placeholder="Email" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Company" class="sr-only">Company</label>
								<input type="text" name="company" class="form-control" placeholder="Name of the business" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Phone 1" class="sr-only">Phone 1</label>
								<input type="text" name="phone" class="form-control" placeholder="Phone 1" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Phone 2" class="sr-only">Phone 2</label>
								<input type="text" name="telefono" class="form-control" placeholder="Phone 2" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Country" class="sr-only">Country</label>
								<select type="text" name="country" id="country1" class="form-control" autocomplete="off">
								<option value="">Select Country</option>
									<?php
									
										if($rowsCount > 0){
											while($row = $querys->fetch_assoc()){ 
												echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>';
											}
										}else{
											echo '<option value="">País no disponible</option>';
										}
									?>														
								</select>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="State" class="sr-only">State</label>
								<select name="department" id="state1" class="form-control" autocomplete="off">
									<option value="">Select State first</option>
								</select>
							</div>	
							<div class="col-xs-12 col-sm-3 col-md-3" style="display:none">
								<label for="Iso" class="sr-only">Iso</label>
								<select  type="text" name="iso" id="iso1" class="form-control" autocomplete="off">  
									<option value="">Code</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="City" class="sr-only">City</label>
								<select type="text" name ="state" id="city1" class="form-control" placeholder="Enter city" autocomplete="off">
									<option value="">Select city first</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Address" class="sr-only">Address</label>
								<input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Enter Code Postal" class="sr-only">Enter Code Postal</label>
								<input type="text" name="zipcode" class="form-control" placeholder="Enter Code Postal" autocomplete="off">
							</div>
						</div>
						</br>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Password" class="sr-only">Password</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Re-password" class="sr-only">Re-password</label>
								<input type="password" name="password2" id="repass" class="form-control" placeholder="Confirm Password" autocomplete="off">
							</div>
						</div>
						</br></br>
						<div class="row mb-1">
							<div class="col-xs-4 col-sm-3 col-md-3">
								<fieldset>
									<input type="checkbox" id="remember" class="chk-remember">
									<label for="remember-me"> I Agree</label>
								</fieldset>
							</div>
							<div class="col-xs-4 col-sm-3 col-md-3" style="display:none">
								<fieldset>
									<input type="checkbox" id="remember-me" name="estado"  value="1" class="chk-remember">
									<label for="remember-me"> Status</label>
								</fieldset>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9">
								 <p class="font-small-3">By clicking Register, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.</p>
							</div>
						</div>
						<div class="form-group">
							<p>Already registered? <a href="login.php"><strong>Login</strong></a></p>
						</div>
						<div class="form-group">
							<i class="icon-head"></i><input type="submit" value="Register" class="btn btn-primary" onClick="checkval();">
						</div>
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

	<script>
	$(function alertaBox()
	{
		$("div.alertaCaja").slideDown("fast");
		setTimeout(function(){
			window.history.replaceState( {} , '', document.URL.split('?')[0] );
			$("div.alertaCaja").slideUp("fast");
		}, 8000);
	});
	</script>
	<script LANGUAGE="JavaScript">
		function validar_clave() {
		var caract_invalido = " ";
		var caract_longitud = 6;
		var cla1 = document.mi_formulario.password.value;
		var cla2 = document.mi_formulario.password2.value;
		if (cla1 == '' || cla2 == '') {
		alert('You must enter your password in the two fields.');
		return false;
		}
		if (document.mi_formulario.password.value.length < caract_longitud) {
		alert('Your password should consist of ' + caract_longitud + ' characters.');
		return false;
		}
		if (document.mi_formulario.password.value.indexOf(caract_invalido) > -1) {
		alert("Keys cannot contain spaces");
		return false;
		}
		else {
		if (cla1 != cla2) {
		alert ("Introduced keys are not the same");
		return false;
		}
		else {
		alert('Correct password');
		return true;
			  }
		   }
		}
	</script>
	<script>
	
	$(document).ready(function(){
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'dashboard/ajaxpais1.php',
					data:'country_id='+countryID,
					success:function(html){
						$('#state1').html(html);
						$('#city1').html('<option value="">City</option>'); 
					}
				}); 
			}else{
				$('#state1').html('<option value="">Capital</option>');
				$('#city1').html('<option value="">City</option>'); 
			}
		});
		
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'dashboard/ajaxpais1.php',
					data:'iso='+countryID,
					success:function(html){
						$('#iso1').html(html);
					}
				}); 
			}
		});
		$('#state1').on('change',function(){
			var stateID = $(this).val();
				if(stateID){
					$.ajax({
						type:'POST',
					   url:'dashboard/ajaxpais1.php',
						data:'state_id='+stateID,
						success:function(html){
							$('#city1').html(html);
						}
					}); 
				}else{
					$('#city1').html('<option value="">Select state first</option>'); 
				}
			});
		});		
	</script>
    <!-- END PAGE LEVEL JS-->

	</body>
</html>