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

$id=$_GET['id'];	
$resultado = $con->query("SELECT * FROM offices WHERE id='$id' ");
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
  <h1 class="m-n font-thin h3"><?php echo $editoffice; ?></h1>
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
							<h3 class="classic-title"><span><strong><i class="fa fa-users icon text-default-lter"></i>&nbsp;&nbsp;<?php echo$OFICINAS; ?> <?php echo $company['cname']; ?></strong></h3>
						
								<!-- START Checkout form -->
								<?php while($row = $resultado->fetch_assoc()){ ?> 
									<form action="settings/add-offices/update.php"   method="POST" > 
									<div class="row">
										
											<!-- START Presonal information -->
											<fieldset class="col-md-6">								
											
												<legend><?php echo $infooffice; ?>:</legend>
												
												<!-- Country and state -->								
												<div class="row">
													<div class="col-sm-6 form-group">
													 <input type="hidden" name="id" value="<?php echo $id; ?>">
														<label for="zipcode" class="control-label"><?php echo $NAMEOFFICE; ?></label>
														<input type="text" class="form-control" value="<?php echo $row['off_name']; ?>"  name="off_name">
													</div>
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-map-marker icon text-default-lter"></i>&nbsp;<?php echo $DIRECCION; ?></label>
														<input type="text" class="form-control" value="<?php echo $row['address'] ;?>"  name="address">
													</div>																					
												</div>
												<!-- Qnty -->
												<div class="row">																									
													<div class="col-sm-6 form-group">
														<label class="control-label"><i class="fa  fa-building icon text-default-lter"></i>&nbsp;<?php echo $CIUDAD; ?></label>
														<input type="text" class="form-control" value="<?php echo $row['city']; ?>"  name="city">
															
													</div>	
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $NUMBERPHONE; ?></label> 
														<input type="text" class="form-control" value="<?php echo $row['ph_no']; ?>"  name="ph_no">
													</div>														
												</div>																								
											</fieldset>

											<!-- START Receiver info  -->
											<fieldset class="col-md-6">
												<legend><?php echo $horapublic; ?></legend>
												
												<div class="row">												
													<!-- Origin Office -->
												   <div class="col-sm-6 form-group">
													 <label for="zipcode" class="control-label"><i class="fa fa-info-circle icon text-default-lter"></i>&nbsp;<?php echo $HORAOFFICE;?><span class="required-field">*</span></label>
													  <input type="text" class="form-control" value="<?php echo $row['office_time']; ?>"  name="office_time" >											
													</div>
													<!-- Text area -->
													<div class="col-sm-6 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $CONTACTPER; ?></label>
														<input  type="text" class="form-control" name="contact_person" value="<?php echo $row['contact_person']; ?>" >
													</div>																										
																								
												</div>																				
											</fieldset>
											
											<div class="col-md-6 text-left">
												<br>
												<br>
												<button name="Guardar" type="submit" class="btn btn-large btn-success"><?php echo $UPDATE; ?></button>												
												<a href="add-office.php"  class="btn btn-large btn-warning"><?php echo $RETORNAR; ?></a>
												
											</div>
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