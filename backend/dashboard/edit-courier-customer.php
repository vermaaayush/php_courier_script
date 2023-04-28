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
require_once('database.php');
require_once('library.php');
require_once('funciones.php');
require 'requirelanguage.php';
isUser();

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
date_default_timezone_set($_SESSION['ge_timezone']);

if ($_POST['cons']=="") {	
    $cid = $_GET['cid'];
	$sql = "SELECT * FROM courier_online WHERE cid ='$cid'";
} else {	
	$posted = $_POST['cons'];
	$sql = "SELECT * FROM courier_online WHERE cons_no ='$posted'";
}	
	$result = dbQuery($sql);
	$count=mysql_num_rows($result );
if ($count > 0){
while($data = dbFetchAssoc($result)) {
	extract($data);
															 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $editarenvioclient; ?></title>
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
  
  	<!-- Plugins css -->
	<link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="assets/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="assets/plugins/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

</head>
<body>
<?php
include("header.php");
?>
  
  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3"><?php echo $manejoenvio; ?>: <font style="color:#090;"><?php echo $cons_no; ?></font></h1>
</div>
<div class="wrapper-md">
  <div class="row">
    <div class="col-sm-12">
      <div class="blog-post">                   
        <div class="panel">
          <div class="wrapper-lg">
            <div>
				<div>
					<h4 class="header-title m-t-0 m-b-20"><?php echo $editonline; ?></h4>
				</div>
			</div><!-- end col-->
          </div>
        <div class="wrapper-lg">         
			<div>			
					<table border="0" align="center" width="100%">
						<form  action="settings/add_courier_online/update.php" method="post" class="form-horizontal" name="formulario">
							<div class="row">
							
								<!-- START Presonal information -->
								<fieldset class="col-md-6">
									<legend><?php echo $generaldetail; ?>:</legend>
									
									<!-- Name -->
									<div class="row" >
									<div class="col-sm-4 form-group">
											<label  class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $StaffUser; ?><span class="required-field">*</span></label>
											<input type="text"  name="user" id="user" value="<?php echo $_SESSION['user_name'] ;?>" class="form-control"  readonly="true" >
									</div>
									<div class="col-sm-8 form-group">
										<label class="control-label" ><?php echo $nameclienteonline; ?><span class="required-field">*</span></label>
											<input type="text" name="ship_name" required value="<?php echo $ship_name; ?>" class="form-control" readonly="true">
																																													  
										 </div>
									</div>
									
									<div class="row" >
										<div class="col-sm-3 form-group">
											<label  class="control-label"><?php echo $EMAIL; ?><span class="required-field">*</span></label>
											<input type="text"  name="email" class="form-control" required  value="<?php echo  $email; ?>" readonly="true">
										</div>
										
										<div class="col-sm-3 form-group">
											<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $DIRECCION; ?></label>
											<input type="text" class="form-control" name="s_add" required  value="<?php echo $s_add; ?>" readonly="true">
										</div>
										
										<div class="col-sm-3 form-group">
											<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO; ?></label>
											<input type="text" class="form-control" name="s_phone"required  value="<?php echo $s_phone; ?>" readonly="true">
										</div>
										<div class="col-sm-3 form-group">
											<label class="control-label"><?php echo $CEDULA; ?></i></label>
											<input type="text" name="shippercc" id="shippercc" class="form-control"  value="<?php echo $shippercc; ?>" autocomplete=" off" required readonly="true">
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $PAISORIGEN; ?></strong></label>															
												<input  name="countries" id="Shippercountry" class="form-control"  value="<?php echo $countries; ?>" readonly="true"> 														  							
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-info"><strong><?php echo $CODIGO; ?></strong></label>															    
												<input name="iso" id="iso" class="form-control" value="<?php echo $iso; ?>" readonly="true">  
																				
										</div>	
										<div class="col-sm-3 form-group">
											<label class="text-info"><strong><?php echo $CIUDAD; ?></strong></label>  
												<input  type="text"  id="ciudad" name="ciudad"   class="form-control" value="<?php echo $ciudad; ?>" readonly="true"> 								
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-info"><strong><?php echo $CODIGOPOSTAL; ?></strong></label>  
												<input  type="text"  id="zipcode" name="zipcode"   class="form-control" value="<?php echo $zipcode; ?>" readonly="true"> 								
										</div>
									</div>	
									
									<!-- Adress and Phone -->
									
									<!-- START Shipment information -->
								
									<legend><?php echo $Informaciondeenvio; ?>:</legend>
									
										<!-- Country and state -->
										<div class="row">
											<div class="col-sm-3 form-group">
											 <label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo  $OFICINAORIGEN; ?></strong></label>
											  <input name="office_origin"  value="<?php echo  $office_origin; ?>" class="form-control" ></div>																  
											<div class="col-sm-3 form-group" >
												<label><?php echo $CantidadPaquetes; ?></label>
												<input type="text" class="form-control" name="Qnty"  value="<?php echo  $Qnty; ?>"  />
											</div>
											
											<div class="col-sm-3 form-group">
												<label class="control-label"><?php echo  $TipodeProducto; ?></label>
												<input name="type" value="<?php echo $type; ?>" class="form-control" >											
											</div>
											
											<div class="col-sm-3 form-group">
												<label class="control-label"><i class="fa fa-database icon text-default-lter"></i>&nbsp;<strong><?php echo $typepay; ?></strong></label>
												<input name="bookingmode" value="<?php echo $bookingmode; ?>" class="form-control" >
													
											</div>
														
											<div class="col-sm-3 form-group">
												<label class="control-label"><i class="fa fa-plane icon text-default-lter"></i>&nbsp;<?php echo $MododelServicio; ?></label>
												<input name="service" value="<?php echo $service; ?>" class="form-control" >
																				
											</div>
											<div class="col-sm-9 form-group">
												<label for="ccv" class="control-label"><i class="fa fa-file-text icon text-default-lter"></i>&nbsp;<strong><?php echo $descriptiondeliver; ?></strong></i></label>
												<input name="note" value="<?php echo $note; ?>" class="form-control" >
											</div>
										</div>
										
										 <!-- Payment Mode -->
										 <div class="row">										
											
											<div class="col-sm-3 form-group" >
												<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $ValorDeclarado; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum2"  name="declarate" class="form-control"  value="<?php echo $declarate; ?>"  />														
											</div>
											<div class="col-sm-3 form-group" >
												<label class="text-danger"><strong><?php echo $Declarado; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum5"  name="declarado" class="form-control"  value="<?php echo $declarado; ?>"  />														
											</div>
											<div class="col-sm-3 form-group">
												<label for="ccv" class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $ValorRecogida; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();"  id="sum3"   class="form-control" name="recogida" value="<?php echo $recogida; ?>" />
											</div>
											<div class="col-sm-3 form-group">
												<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $PrimerKilo; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="suma();" id="sum1"   class="form-control" name="variable" value="<?php echo $variable; ?>" />
											</div>
											<div class="col-sm-3 form-group">
												<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $KiloAdicional; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="suma();" id="sum6"   class="form-control" name="kiloadicional" value="<?php echo $kiloadicional; ?>" />
											</div>
											<div class="col-sm-3 form-group">
												<label class="text-danger"><strong><?php echo $PesoKg; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum4"  class="form-control" name="weight" value="<?php echo $weight; ?>" />
											</div>																						
											<div class="col-sm-3 form-group">
												<label class="text-danger"><strong><?php echo $SubtotalEnvio; ?><strong></i></label>
												<input  type="text" class="form-control" name="shipping_subtotal" id="resultado" value="<?php echo $shipping_subtotal; ?>" />
											</div>
											<div class="col-sm-3 form-group">
												<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $PesoFisico; ?><strong></label>
												<input type="text" name="pesoreal" onblur="if(this.value == ''){this.value='0'}"  class="form-control" value="<?php echo $pesoreal; ?>" />
											</div>
											
											<legend><?php echo $pesovolumetrico; ?>:</legend>
													
													<!-- Peso Volumetrico -->
																						
												<div class="col-sm-3 form-group">
													<label class="text-primary"><strong><?php echo $Altura; ?><strong></label>
													<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="volumetrico();" id="volume1"   class="form-control" name="altura" value="<?php echo $altura; ?>" required />
												</div>
												<div class="col-sm-3 form-group">
													<label class="text-primary"><strong><?php echo $Ancho; ?><strong></label>
													<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="svolumetrico();" id="volume2"   class="form-control" name="ancho" value="<?php echo $ancho; ?>" required />
												</div>
												<div class="col-sm-3 form-group">
													<label class="text-primary"><strong><?php echo $Longitud; ?><strong></label>
													<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="volumetrico();" id="volume3"  class="form-control" name="longitud" value="<?php echo $longitud; ?>" required />
												</div>
																																						
												<div class="col-sm-3 form-group">
													<label class="text-primary"><strong><?php echo $TotalPesoVolumetrico; ?><strong></i></label>
													<input  type="text" class="form-control" name="totalpeso" id="totalpeso" value="<?php echo $totalpeso; ?>" />
													
												</div>
											
											<div class="col-sm-4 form-group ">
												<label for="month" class="control-label"><i class="fa fa-sort-amount-asc icon text-default-lter"></i>&nbsp;<?php echo $ESTADO; ?></label>
												<select class="form-control" name="status" value="<?php echo $status; ?>">
													<?php
															$sql=mysql_query("SELECT servicemode FROM service_mode  GROUP BY servicemode");
															while($row=mysql_fetch_array($sql)){
															if($cliente==$row['servicemode']){
															echo '<option value="'.$row['servicemode'].'" selected>'.$row['servicemode'].'</option>';
															}else{
															echo '<option value="'.$row['servicemode'].'">'.$row['servicemode'].'</option>';
														 }
														}
													?>
												</select>
											</div>
										</div>																
								</fieldset>

								<!-- START Receiver info  -->
								<fieldset class="col-md-6">
									<legend><?php echo $DetallesdelEnvio; ?>:</legend>
									
									<!-- Name -->
									<div class="form-group">
										<label  class="control-label"><?php echo $NOMBREDESTINATARIO; ?><span class="required-field">*</span></label>
										<input type="text" class="form-control" name="rev_name" required  value="<?php echo $rev_name; ?>" >									
									</div>								
									<!-- Adress and Phone -->
									<div class="row">
										<div class="col-sm-3 form-group">
											<label  class="control-label"><?php echo $DIRECCION; ?><span class="required-field">*</span></label>
											<input type="text"  name="r_add"  class="form-control" required  value="<?php echo $r_add; ?>" >
										</div>									
										<div class="col-sm-3 form-group">
											<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO; ?></label>
											<input type="text" class="form-control" name="r_phone" required value="<?php echo $r_phone; ?>" >
										</div>
										<div class="col-sm-3 form-group">
											<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO2; ?></label>
											<input type="tel"  class="form-control" name="r_phone1" id="telefono1" autocomplete="off" value="<?php echo $r_phone1; ?>" required >
										</div>
										<div class="col-sm-3 form-group">
											<label class="control-label"><?php echo $CEDULA; ?></i></label>
											<input type="text" name="receivercc_r" class="form-control"   value="<?php echo $receivercc_r; ?>" >
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $PAISDESTINO; ?></strong></label>															
												<input   name="paisdestino" class="form-control" value="<?php echo $paisdestino; ?>" > 								
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-info"><strong><?php echo $CODIGO; ?></strong></label>															    
												<input   name="iso1"  iclass="form-control" value="<?php echo $iso1; ?>">  								
										</div>	
										
										<!-- Oficina destino-->

										<div class="col-sm-3 form-group">
											<label class="text-info"><strong><?php echo $CIUDAD; ?></strong></label>  
												<input type="text" name="city1" class="form-control" value="<?php echo $city1; ?>"> 
																				
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-info"><strong><?php echo $CODIGOPOSTAL; ?></strong></label>  
												<input  type="text" name="zipcode1"   class="form-control" value="<?php echo $zipcode1; ?>"> 								
										</div>
										<div class="col-sm-12 form-group">
											<p class="error"></p>
											<label class="control-label"><?php echo $EMAIL; ?><font color="#FF6100"><?php echo $notaemail; ?></font></i></label>
											<input type="email" name="receiveremail" class="form-control"   value="<?php echo $receiveremail; ?>"  onKeyUp="javascript:validateMail('id_mail')">
											<strong><span id="emailOK"></span></strong>
											<p class="error"></p>
										</div>
									</div>														
									<br>
									<br>								
									<!-- Name -->
									<div class="form-group">										
										<label for="name-card" class="control-label"><font color="#FF6100"><strong><?php echo $NUMEROENVIO; ?></strong></font></label>
										<input type="text" class="form-control" name="cons_no"  value="<?php echo $cons_no; ?>" id="ConsignmentNo"  />
									</div>
									<div class="row">
									<!-- Destination Office -->
									<div class="col-sm-6 form-group">
										<label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<?php echo $DELACIUDAD; ?></label>
										<input name="fcity" required value="<?php echo $fcity; ?>" class="form-control" readonly="true" >																			
									</div>															
									<div class="col-sm-6 form-group">
										<label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<?php echo $ALACIUDAD; ?></label>
										<input name="tcity" required value="<?php echo $tcity; ?>" class="form-control" readonly="true" >																				
									</div>		
									<!-- Status and Pickup Date -->

										<div class="col-sm-6 form-group">
											<label for="month" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $FECHADEENVIO; ?></label>
											<input class="form-control" name="date" required  value="<?php echo  $date; ?>" readonly="true" >											
										</div>								
									<div class="col-sm-6 form-group">
											<label for="dtp_input1" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo  $FECHAESTIMADA; ?></i></label>										
											<div class="input-group date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
											<input class="form-control" name="deliverydate" required  onClick="ds_sh(this);" type="TEXT" value="<?php echo $deliverydate; ?>">
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>									
								</fieldset>
										<input name="cid" id="cid" value="<?php echo $cid; ?>" type="hidden">
										<div class="col-md-6 text-left">
											<input class="btn btn-primary" name="Submit" type="submit"  value="<?php echo $ACTUALIZARENVIOON; ?>">
										</div>
									</div>					
								</article>				
							  <div class="clearfix"></div>
							<br>
						</form>
					</table>	
			
				<?php  } ?>
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
<script>
	$(document).ready(function() {
		$('.custom-select').fancySelect(); // Custom select
		$('[data-toggle="tooltip"]').tooltip() // Tooltip
	});
</script>
<script language="javascript" type="text/javascript">
	function suma(){
		
		var sum1 = document.getElementById("sum1");
		var sum2 = document.getElementById("sum2");
		var sum3 = document.getElementById("sum3");
		var sum4 = document.getElementById("sum4");
		var sum5 = document.getElementById("sum5");
		var input = document.getElementById("resultado");
		resultado = parseInt(sum1.value) + parseInt(sum2.value * sum5.value/100)  + parseInt(sum3.value) +  parseInt(sum4.value * 10 - 10);
		input.value= resultado;
	}	
</script>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/clockpicker/bootstrap-clockpicker.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="assets/pages/jquery.form-pickers.init.js"></script>
 <?php } ?>
</body>
</html>
