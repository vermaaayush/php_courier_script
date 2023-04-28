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
require_once('../database-settings.php');
require_once('../database.php');
require_once('../library.php');
require_once('../funciones.php');
require '../requirelanguage.php';
$con = conexion();	

date_default_timezone_set($_SESSION['ge_timezone']);
$id=$_GET['id'];
$resultado = $con->query("SELECT id,name,cc,email,phone,telefono,address,password,company,country,zipcode,lang,state,iso,date,imagen,tipo_imagen FROM tbl_clients WHERE  id='$id'");
isUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $managecustomer; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />

</head>
<body>
 <?php include("header.php"); ?> 
  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
     
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3"><?php echo $perfil; ?></h1>
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
							<h3 class="classic-title"><span><strong><i class="fa fa-users icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $PERFIL; ?></strong></h3>
						
								<!-- START Checkout form -->
								<?php while($row = $resultado->fetch_assoc()){ ?> 
									<form action="../settings/panel_customer/update.php"  name="modificar_usuario" method="POST" enctype="multipart/form-data" > 
									<div class="row">
										
											<!-- START Presonal information -->
											<fieldset class="col-md-6">		
											
																				
												<legend><?php echo $infouser; ?>:</legend>
												
												<!-- Country and state -->								
												<div class="row">
													<div class="col-sm-8 form-group">
													 <input type="hidden" name="id" value="<?php echo $id; ?>">
														<label for="zipcode" class="control-label"><?php echo $NOMBRECLI; ?></label>
														<input type="text" class="form-control" value="<?php echo $row['name']; ?>"  name="name">
													</div>
													<div class="col-sm-4 form-group">
														<label for="zipcode" class="control-label"><?php echo $CEDULA; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['cc']; ?>"  name="cc">
													</div>
												</div>
												<!-- Qnty -->
												<div class="row">
													<div class="col-sm-3 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-at icon text-default-lter"></i>&nbsp;<?php echo $email1; ?></label> 
														<input  type="text" class="form-control" value="<?php echo $row['email'] ;?>"  name="email"   readonly >
													</div>
													
												<!-- Origin Office -->
												   <!-- Destination Office -->	
													<div class="col-sm-3 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-plane icon text-default-lter"></i>&nbsp;<?php echo $PAISORIGEN; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['country']; ?>"  name="country">
													</div>
													<div class="col-sm-3 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-rocket icon text-default-lter"></i>&nbsp;<?php echo $CIUDAD; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['state']; ?>"  name="state">
													</div>
													<div class="col-sm-3 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-rocket icon text-default-lter"></i>&nbsp;<?php echo $CODIGO; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['iso']; ?>"  name="iso">
													</div>															
												</div>		
												<div class="row">
													<div class="col-sm-2 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-sort-numeric-asc icon text-default-lter"></i>&nbsp;<?php echo $CODIGOPOSTAL; ?></label>
														<input type="text" class="form-control" name="zipcode" value="<?php echo $row['zipcode']; ?>" id="datepicker-autoclose">
													</div>
													<div class="col-sm-4 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-map-marker icon text-default-lter"></i>&nbsp;<?php echo $DIRECCION; ?></label>
														<textarea class="form-control" name="address" required > <?php echo $row['address']; ?></textarea>
													</div>
													<div class="col-sm-3 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['phone']; ?>"  name="phone">
													</div>
													<div class="col-sm-3 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO2; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['telefono']; ?>"  name="telefono">
													</div>
												</div>
												<div class="row">
													<!-- Destination Office -->	
													<div class="col-sm-4 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-suitcase icon text-default-lter"></i>&nbsp;<?php echo $COMPANY; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['company']; ?>"  name="company">
													</div>
													<div class="col-sm-4 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $FECHAREGI; ?></label>
														<input type="text" class="form-control" name="date" value="<?php echo $row['date']; ?>"  id="datepicker-autoclose">
													</div>	
												</div>	
												<!-- START Receiver info  -->
												<div class="col-sm-6 form-group">
													<legend><?php echo $LOGOIDEAL; ?></legend>
												
													<input type="file" name="imagen" id="imagen" class="form-control"  />
													
													<br><br>
												</div>	
												<div class="col-md-6 text-center">
													<label for="currentPassword"><?php echo $PRESENT; ?></label></br>
													<span class="thumb-lg w-auto-folded avatar m-t-sm">
													  <img src="../logo-image/imagen-customer.php?id=<?php echo $row['id']; ?>" class="img-full" alt="...">
													</span>	 														
												</div>	
																																			
											</fieldset>

											<!-- START Receiver info  -->
											<fieldset class="col-md-6">
												<legend><?php echo $legendcustomers; ?></legend>
													<div class="col-sm-4 form-group">
														<label class="control-label"><i class="fa fa-key icon text-default-lter"></i>&nbsp;<?php echo $CONTRA; ?></label>
														<input type="password" class="form-control" placeholder="Password"  name="password" required >
															
													</div>
													<div class="row">
														<div class="col-sm-6 form-group">
															<label for="lan"><i class="fa fa-language" aria-hidden="true"></i>&nbsp;<?php echo $language; ?></label>
															<select class="form-control" name="lang" >
																<option value="en_customer"  <?php if($row['lang']=='en_customer'){ echo 'selected'; } ?> ><?php echo $english; ?></option>
																<option value="fr_customer"  <?php if($row['lang']=='fr_customer'){ echo 'selected'; } ?> ><?php echo $french; ?></option>
																<option value="hindi_customer"  <?php if($row['lang']=='hindi_customer'){ echo 'selected'; } ?>><?php echo $hindi; ?></option>
																<option value="es_customer"  <?php if($row['lang']=='es_customer'){ echo 'selected'; } ?>><?php echo $spanish; ?></option>																
															</select>
														</div>
													</div>																									
													<div class="col-md-6 text-left">
														<br>
														<br>
														<button name="Guardar" type="submit" class="btn btn-large btn-success"><?php echo $ACTUALIZAR; ?></button>	
													</div>
											</fieldset>
									</form>
								<?php } ?>
								</div>					
							</article>				
						  <div class="clearfix"></div>									  									
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
include("../footer.php");
?>

</div>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../js/ui-load.js"></script>
<script src="../js/ui-jp.config.js"></script>
<script src="../js/ui-jp.js"></script>
<script src="../js/ui-nav.js"></script>
<script src="../js/ui-toggle.js"></script>
<script>
	$(document).ready(function() {
		$('.custom-select').fancySelect(); // Custom select
		$('[data-toggle="tooltip"]').tooltip() // Tooltip
	});
</script>


</body>

</html>