<?php 
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system		                               *
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
require_once('database.php');
require_once('library.php');
require 'requirelanguage.php';

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
$qname = $_SESSION['user_name']; 	
$qrole = $_SESSION['user_type']; 
isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $configure; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />

</head>
<body>
 <?php include("header.php"); ?> 
  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
     
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3"><?php echo $CONFIGURE; ?></h1>
</div>
<div class="wrapper-md">
  <div class="row">
    <div class="col-sm-12">
      <div class="blog-post">                   
        <div class="panel">
          <div>           
          </div>
			<div class="wrapper-lg">           
				<div>
					<table border="0" align="center" width="100%">
						<tbody>
							<tr>				
							<h3 class="classic-title"><span><strong><i class="icon-wrench icon text-warning-lter"></i>&nbsp;&nbsp;<?php echo $configure; ?></strong></h3>
						
							<!-- START Checkout form -->
													
								<?php		
									$result4 = mysql_query("SELECT * FROM company WHERE  id='1' ");
									while($rr = mysql_fetch_array($result4)) {								
									?>	
									
								<div class="row">
									<form action="settings/company/settings.php"  method="POST"  class="form-horizontal" > 
										<!-- START Presonal information -->
										<fieldset class="col-md-6">								
										
											<legend><?php echo $DETAILCOMPANIES; ?>:</legend>
											
											<!-- Country and state -->								
											<div class="row">
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><?php echo $NAMECOMPANIES; ?></label>
													<input type="text" class="form-control" value="<?php echo $rr['cname']; ?>"  name="cname">
												</div>
												<div class="col-sm-3 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa-hashtag icon text-default-lter"></i>&nbsp;<?php echo $NIT; ?></label>
													<input type="text" class="form-control" value="<?php echo $rr['nit']; ?>"  name="nit">
												</div>
												
												<div class="col-sm-3 form-group">
													<label class="control-label"><i class="fa fa-phone-square icon text-default-lter"></i>&nbsp;<?php echo $PHONECOM; ?></label>
													<input type="text" class="form-control" value="<?php echo $rr['cphone']; ?>"  name="cphone" >
														
												</div>									
											</div>
											<!-- Qnty -->
											<div class="row">
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa-at icon text-default-lter"></i>&nbsp;<?php echo $EMAILNOTI; ?></label> 
													<input type="email" class="form-control" value="<?php echo $rr['bemail']; ?>"  name="bemail">
												</div>
												
											<!-- Origin Office -->
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa fa-edge icon text-default-lter"></i>&nbsp;<?php echo $website; ?></label>
													<input value="<?php echo $rr['website']; ?>"  placeholder="http://www.example.com" name="website" class="form-control" >																				
												</div>	
											</div>												
											 <!-- Payment Mode -->
											 <div class="row">
												
											</div>
											<div class="row">
												<!-- Text area -->
												<div class="col-sm-6 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-map-marker icon text-default-lter"></i>&nbsp;<?php echo $companydir; ?></label>
													<textarea class="form-control" name="caddress" required > <?php echo $rr['caddress']; ?></textarea>
												</div>
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa fa-edge icon text-default-lter"></i>&nbsp;<?php echo $footerweb; ?></label>
													<input value="<?php echo $rr['footer_website']; ?>"  placeholder="" name="footer_website" class="form-control" >																				
												</div>
											</div>
											<div class="row">
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa  fa fa-map icon text-default-lter"></i>&nbsp;<?php echo $paisorigen; ?></label>
													<input class="form-control" name="country" required  value="<?php echo $rr['country']; ?>">
												</div>
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa fa-map-o icon text-default-lter"></i>&nbsp;<?php echo $cciudad; ?></label>
													<input class="form-control" name="city" required  value="<?php echo $rr['city']; ?>">
												</div>															
												<!-- Destination Office -->															
												<div class="col-sm-2 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-usd icon text-default-lter"></i>&nbsp;<?php echo $moneda; ?></label>
													<input class="form-control" name="currency" required  value="<?php echo $rr['currency']; ?>">
												</div>
												<div class="col-sm-2 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-sort-alpha-asc icon text-default-lter"></i>&nbsp;<?php echo $prefix; ?></label>
													<input class="form-control" name="prefijo" required  value="<?php echo $rr['prefijo']; ?>">
												</div>
												<div class="col-sm-2 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $datereg; ?></label>
													<input type="text" class="form-control" name="date" value="<?php echo $rr['date']; ?>" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
												</div>													
											</div>
											<div class="row">
												<!-- Text area -->
												<div class="col-sm-6 form-group">
													<label for="inputTextarea" class="control-label"><?php echo $metad; ?></label>
													<textarea class="form-control" name="description" required > <?php echo $rr['description']; ?></textarea>
												</div>
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><?php echo $metakey; ?></label>
													<textarea class="form-control" name="keywords" required > <?php echo $rr['keywords']; ?></textarea>																				
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6 form-group">
													<label for="lan"><i class="fa fa-language icon text-danger-lter" aria-hidden="true"></i>&nbsp;<?php echo $language; ?></label>
													<select class="form-control" name="lang" >
														<option value="en"  <?php if($company['lang']=='en'){ echo 'selected'; } ?> ><?php echo $english; ?></option>
														<option value="fr"  <?php if($company['lang']=='fr'){ echo 'selected'; } ?> ><?php echo $french; ?></option>
														<option value="hindi"  <?php if($company['lang']=='hindi'){ echo 'selected'; } ?> ><?php echo $hindi; ?></option>
														<option value="es"  <?php if($company['lang']=='es'){ echo 'selected'; } ?>><?php echo $spanish; ?></option>
													</select>
												</div>
												<div class="col-sm-6 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $timezone; ?></label>
													<input type="text" class="form-control" name="timezone" value="<?php echo $rr['timezone']; ?>"  id="datepicker-autoclose">
												</div>
											</div>
											<div class="col-md-6 text-left">
												<br>
												<br>
												<button name="Submit" type="submit" class="btn btn-large btn-success"><?php echo $UPDATEINFO; ?></button>											
											</div>
	
										</fieldset>
										<!-- START Email configuration  -->									
									
											<fieldset class="col-md-6">
											<legend><?php echo $DETAILBANK; ?></legend>
												<div class="row">	
													<div class="col-sm-4 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-bank (alias) icon text-default-lter"></i>&nbsp;<?php echo $namebank; ?></label>
														<input class="form-control" name="smtp" required  value="<?php echo $rr['smtp']; ?>">
													</div>
													<div class="col-sm-4 form-group"> 
														<label for="inputTextarea" class="control-label"><i class="fa fa-sort-numeric-desc icon text-default-lter"></i>&nbsp;<?php echo $nameaccoung; ?></label>
														<input class="form-control" name="smtphost" required  value="<?php echo $rr['smtphost']; ?>">
													</div>
													<div class="col-sm-4 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-hdd-o icon text-default-lter"></i>&nbsp;<?php echo $numberaccoung; ?></label>
														<input class="form-control" name="smtpuser" required  value="<?php echo $rr['smtpuser']; ?>">
													</div>																												
												</div>																									
											</fieldset>
											<fieldset class="col-md-6">
											<legend><?php echo $detailpaypal; ?></legend>
												<div class="row">																									
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-paypal icon text-default-lter"></i>&nbsp;<?php echo $emailpaypal; ?><span class="required-field">*</span></label>
														<input type="email" class="form-control" value="<?php echo $rr['cemail']; ?>"  name="cemail" required>																				
													</div>															
												</div>																									
											</fieldset>	
											<?php } ?>	
									</form>
									<div style="line-height:80px;padding:0;margin:0">&nbsp;</div>
									
										<!-- START Receiver info  -->
										<fieldset class="col-md-6">
										<br>
											<legend><?php echo $logosettings; ?></legend>
											<div class="row">
												<?php
													//conexion a la base de datos
													error_reporting(E_ERROR | E_WARNING | E_PARSE);
													require_once('database.php');


													//le dimos click al boton grabar?
													if (isset($_POST['guardar']))
													{
													$nombre = $_FILES['imagen']['name'];
													$imagen_temporal = $_FILES['imagen']['tmp_name'];
													$type = $_FILES['imagen']['type'];
													//archivo temporal en binario
													$itmp = fopen($imagen_temporal, 'r+b');
													$imagen = fread($itmp, filesize($imagen_temporal));
													fclose($itmp);
													//escapando los caracteres
													$imagen = mysql_real_escape_string($imagen);$respuesta = mysql_query("UPDATE subir_imagen SET nombre_imagen='$nombre',imagen='$imagen',tipo='$type'", $dbConn);
													//redireccionamos
													echo "<script type=\"text/javascript\">
															alert(\"The logo was updated correctly.\");
															window.location = \"preferences.php\"
														</script>";	
													}
													//guardado OK
													if (isset($_GET['ok']))
													{
													echo '<p>Saved successfully</p>';}
													//si no se guardo de manera correcta?
													if (isset($_GET['error']))
													{
													echo '<p>Occurred an error when it comes to the inclusion...</p>';}

													//formulario que nos permite subir a la BD el archivo
													echo '													
													<form action="preferences.php" enctype="multipart/form-data" method="post">
														<div class="col-sm-6 form-group">
														 <label for="zipcode" class="control-label"><i class="fa fa-upload icon text-default-lter"></i>&nbsp;'.$UPDATELOGOS.'</label>
														 <input type="file" name="imagen" id="imagen" class="form-control" />
														<br><br>
														 <button type="submit" name="guardar" class="btn btn-large btn-info">'.$UPDATELOGOS.'</button>
														<br><br>													
														</div>
													</form>';
													
												?>
											</div>
												<br><br>
											<div class="row">									
												<div class="col-sm-6 form-group">
													<label for="currentPassword"><strong><?php echo $logopresent; ?></strong></label></br></br>
													<img src="logo-image/image_logo.php?id=1"/>												
												</div>											
											</div>
											
										</fieldset>
								</div>	
						</tbody>
					</table>
				</div>
			</div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
 <!-- / content -->	


<?php
include("footer.php");
?>

</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.custom-select').fancySelect(); // Custom select
		$('[data-toggle="tooltip"]').tooltip() // Tooltip
	});
</script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
</body>

</html>