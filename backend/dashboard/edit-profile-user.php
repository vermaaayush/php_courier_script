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
require_once('database-settings.php');
require_once('database.php');
require_once('library.php');
require 'requirelanguage.php';
$con = conexion();

date_default_timezone_set($_SESSION['ge_timezone']);
$fechai=date('Y-m-d');

$cid=$_GET['cid'];	
$resultado = $con->query("SELECT cid,name_parson,name,email,phone,office,role,pwd,date,imagen,tipo_imagen FROM manager_user WHERE cid='$cid' ");
isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $editperfiluser; ?></title>
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
									<form action="settings/adduser/update.php"  name="modificar_usuario" method="POST" enctype="multipart/form-data" > 
									<div class="row">
										
											<!-- START Presonal information -->
											<fieldset class="col-md-6">								
											
												<legend><?php echo $userinformation; ?>:</legend>
												
												<!-- Country and state -->								
												<div class="row">
													<div class="col-sm-6 form-group">
													 <input type="hidden" name="cid" value="<?php echo $cid; ?>">
														<label for="zipcode" class="control-label"><?php echo $NOMBRE; ?></label>
														<input type="text" class="form-control" value="<?php echo $row['name_parson']; ?>"  name="name_parson">
													</div>
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $NAMEUSER; ?></label>
														<input type="text" class="form-control" value="<?php echo $row['name'] ;?>"  name="name">
													</div>								
												</div>
												<!-- Qnty -->
												<div class="row">
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-at icon text-default-lter"></i>&nbsp;<?php echo $email1; ?></label> 
														<input type="email" class="form-control" value="<?php echo $row['email']; ?>"  name="email" >
													</div>
													
												<!-- Origin Office -->
												   <div class="col-sm-6 form-group">
													 <label for="zipcode" class="control-label"><i class="fa fa-info-circle icon text-default-lter"></i>&nbsp;<?php echo $usertype;?><span class="required-field">*</span></label>
													  <input type="email" class="form-control" value="<?php echo $row['role']; ?>"  name="role" readonly>											
													</div>	
												</div>												
												 <!-- Payment Mode -->
												 <div class="row">
													
												</div>
												<div class="row">
													<!-- Text area -->
													<div class="col-sm-6 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-map-marker icon text-default-lter"></i>&nbsp;<?php echo $ubicationoffice; ?></label>
														<textarea class="form-control" name="office" required > <?php echo $row['office']; ?></textarea>
													</div>																										
													<!-- Destination Office -->	
													<div class="col-sm-3 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $telefono; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['phone']; ?>"  name="phone">
													</div>
													<div class="col-sm-3 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $registrydate; ?></label>
														<input type="text" class="form-control" name="date" value="<?php echo $row['date']; ?>" placeholder="mm/dd/yyyy" id="datepicker-autoclose" readonly>
													</div>												
												</div>	
												<!-- START Receiver info  -->
												<div class="col-sm-6 form-group">
													<legend><?php echo $logodimenssion; ?></legend>
													
														<input type="file" name="imagen" id="imagen" class="form-control" />
														<br><br>																			
												
												</div>
												<div class="col-md-6 text-center">
														<label for="currentPassword"><?php echo $logopresent; ?></label></br>
														<span class="thumb-lg w-auto-folded avatar m-t-sm">
														   <img src="logo-image/imagen-user.php?cid=<?php echo $row['cid']; ?>" class="img-full" alt="...">
														</span>	 														
												</div>	
												
											</fieldset>											
											
											<!-- START Receiver info  -->
											<fieldset class="col-md-6">
											
											<legend><?php echo $legendcustomer; ?></legend>
											
												<div class="row">
													<div class="col-sm-6 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-key icon text-default-lter"></i>&nbsp;<?php echo $PASSWORD; ?></label>
														<input class="form-control" type="password" name="pwd" placeholder="Password"  required>
													</div>
												</div>	
												<div class="col-md-6 text-left">
												<br>
												<br>
												<button name="Guardar" type="submit" class="btn btn-large btn-success"><?php echo $UPDATE; ?></button>
												<a href="add-new-users.php"  class="btn btn-large btn-warning"><?php echo $RETORNAR; ?></a>	
												
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
include("footer.php");
?>

</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>


</body>

</html>