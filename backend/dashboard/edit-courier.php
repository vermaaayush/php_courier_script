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
require 'requirelanguage.php';
require_once('funciones.php');
isUser();

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
date_default_timezone_set($_SESSION['ge_timezone']);

if ($_POST['cons']=="") {	
    $cid = $_GET['cid'];
	$sql = "SELECT * FROM courier WHERE cid ='$cid'";
} else {	
	$posted = $_POST['cons'];
	$sql = "SELECT * FROM courier WHERE cons_no ='$posted'";
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
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $editarenvio; ?></title>
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

  <!-- Required - Form style -->
  <script type= "text/javascript" src="../process/countries.js"></script> 

</head>
<body>
<?php
include("header.php");
?>
  
 <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <div class="col">
    <!-- main header -->
    <div class="bg-light lter b-b wrapper-md">

    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

					  <!-- service -->
					<div class="panel hbox hbox-auto-xs no-border">
						<div class="col wrapper">
														<div class="row">
								<div class="col-xs-12 col-lg-12 col-xl-7">
									<div class="card-box">
										<div class="text-xs-center">
												<tbody>										
													<h3 class="classic-title"><span><strong><i class="fa fa-truck icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $actualizarenvio; ?></strong></h3>																					
													<!-- START Checkout form -->
													
													<form action="settings/add_courier/update.php" name="formulario" method="post"> 
														<table border="0" align="center" width="100%" >
																<div class="row">
																
																	<!-- START Presonal information -->
																	<fieldset class="col-md-6">
																		<legend><strong><?php echo $datosremite; ?></strong></legend>	
																		<!-- Name -->
																		<div class="row" >
																		<div class="col-sm-3 form-group">
																				<label  class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $StaffRole; ?><span class="required-field">*</span></label>
																				<input type="text"  name="officename" id="officename" value="<?php echo $_SESSION['user_type'] ;?>" class="form-control"  readonly="true" >
																		</div>
																		<div class="col-sm-3 form-group">
																				<label  class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $StaffUser; ?><span class="required-field">*</span></label>
																				<input type="text"  name="user" id="user" value="<?php echo $_SESSION['user_name'] ;?>" class="form-control"  readonly="true" >
																		</div>
																		<div class="col-sm-6 form-group">
																		
																			<label class="control-label" ><?php echo $NOMBREREMITENTE; ?><span class="required-field">*</span></label>								
																			 <input type="text" name="Shippername"  class="form-control" autocomplete="off" required value="<?php echo  $ship_name; ?>" >									                                  
																		</div>
																		</div>
																		
																		<div class="row" >
																			<div class="col-sm-5 form-group">
																				<label  class="control-label"><?php echo $DIRECCION; ?><span class="required-field">*</span></label>
																				<input type="text"  name="Shipperaddress" class="form-control" required value="<?php echo $s_add; ?>" >
																			</div>
																			
																			<div class="col-sm-3 form-group">
																				<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO; ?></label>
																				<input type="text" class="form-control" name="Shipperphone" required value="<?php echo $phone; ?>">
																			</div>
																			
																			<div class="col-sm-4 form-group">
																				<label class="control-label"><?php echo $CEDULA; ?></i></label>
																				<input type="text" name="Shippercc" class="form-control"  value="<?php echo $cc; ?>"  required>
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $PAISORIGEN; ?></strong></label>															
																					<input  name="Pickuptime" value="<?php echo $pick_time; ?>" class="form-control"  > 														  							
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-info"><strong><?php echo $CODIGO; ?></strong></label>															    
																					<input name="iso" value="<?php echo $iso; ?>" class="form-control">  
																													
																			</div>	
																			<div class="col-sm-3 form-group">
																				<label class="text-info"><strong><?php echo $CIUDAD; ?></strong></label>  
																					<input  type="text"  value="<?php echo $ciudad; ?>" name="ciudad"   class="form-control"> 								
																			</div>
																		</div>	
																		
																		<!-- Adress and Phone -->
																		
																		<!-- START Shipment information -->
																	
																		<legend><strong><?php echo $Informaciondeenvio; ?></strong></legend>
																		
																		<!-- Country and state -->
																		<div class="row">
																			<div class="col-sm-3 form-group">
																				<label class="control-label"><i class="fa fa-database icon text-default-lter"></i>&nbsp;<strong><?php echo $Pagos; ?></strong></label>
																				<input name="Bookingmode" class="form-control"  id="Bookingmode" value="<?php echo $book_mode; ?>" readonly="true">
																					
																			</div>
																			
																			<div class="col-sm-5 form-group">
																				<label class="control-label"><?php echo $TipodeProducto; ?></label>
																				<input  name="Shiptype" class="form-control" id="Shiptype"  value="<?php echo $type; ?>" >											
																					
																			</div>
																			<div class="col-sm-4 form-group">
																				<label class="control-label"><i class="fa fa-plane icon text-default-lter"></i>&nbsp;<?php echo $MododelServicio; ?></label>
																			  <input name="Mode" class="form-control"  id="Mode" value="<?php echo $mode; ?>">
																				
																			</div>
																		</div>
																		<!-- Qnty -->
																		<div class="row">

																		<!-- Origin Office -->
																		
																			<div class="col-sm-3 form-group">
																				
																				
																				<label><?php echo $CantidadPaquetes; ?></label>
																				<input type="text" class="form-control" name="Qnty"  value="<?php echo $qty; ?>"  />
																			</div>
																		   <div class="col-sm-4 form-group">
																			 <label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<?php echo $OFICINAORIGEN; ?></label>
																			  <input name="Invoiceno" id="Invoiceno" class="form-control" value="<?php echo $invice_no; ?>">
																					
																			</div>
																			<!-- Destination Office -->
																			<div class="col-sm-5 form-group">
																				<label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<?php echo $OFICINADESTINO; ?></label>
																				<input name="Pickuptime" id="Pickuptime" class="form-control" value="<?php echo $pick_time; ?>">
																														
																			</div>		
																		</div>	
																		
																		 <!-- Payment Mode -->
																		<div class="row">
																			<div class="col-sm-3 form-group" >
																				<label class="text-success"><?php echo $company['currency']; ?>&nbsp;<?php echo $ValorDeclarado; ?></i></label>
																				<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum2"  name="Totaldeclarate" class="form-control" value="<?php echo $declarate; ?>"/>
																			</div>
																			<div class="col-sm-3 form-group" >
																				<label class="text-success"><?php echo $Declarado; ?></i></label>
																				<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum5"  name="Totaldeclarado" class="form-control" value="<?php echo $declarado; ?>"/>
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-success"><?php echo $company['currency']; ?>&nbsp;<?php echo $ValorRecogida; ?></label>
																				<input  type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();"  id="sum3" class="form-control" name="Totalfreight" value="<?php echo $freight; ?>"  />
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-success"<?php echo $company['currency']; ?>&nbsp;><?php echo $PrimerKilo; ?></label>
																				<input  type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="suma();" id="sum1" class="form-control" name="variable" value="<?php echo $variable; ?>"  />
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-success"><?php echo $company['currency']; ?>&nbsp;<?php echo $KiloAdicional; ?></label>
																				<input  type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="suma();" id="sum6" class="form-control" name="kiloadicional" value="<?php echo $kiloadicional; ?>"  />
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-success"><?php echo $PesoKg; ?></label>
																				<input  type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum4" class="form-control" name="Weight" value="<?php echo $weight; ?>"  />
																			</div>
																			
																			<div class="col-sm-3 form-group">
																				<label class="text-success"><?php echo $company['currency']; ?>&nbsp;<?php echo $SubtotalEnvio; ?></i></label>
																				<input  type="text"  class="form-control" name="shipping_subtotal" id="resultado" value="<?php echo $shipping_subtotal; ?>" />
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-success"><?php echo $company['currency']; ?>&nbsp;<?php echo $PesoFisico; ?></i></label>
																				<input  type="text"  class="form-control" name="pesoreal"   value="<?php echo $pesoreal; ?>" />
																			</div>
																		</div>
																		<div class="row">												
																			<div class="col-sm-3 form-group">
																				<label class="text-danger"><?php echo $Altura; ?></label>
																				<input  type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="volumetrico();" id="volume4" class="form-control" name="altura" value="<?php echo $altura; ?>"  />
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-danger"><?php echo $Ancho; ?></label>
																				<input  type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="volumetrico();" id="volume1" class="form-control" name="ancho" value="<?php echo $ancho; ?>"/>
																			</div>														
																			<div class="col-sm-3 form-group">
																				<label for="ccv" class="text-danger"><?php echo $Longitud; ?></strong></i></label>
																				<input  type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="volumetrico();"  id="volume3" class="form-control" name="longitud" value="<?php echo $longitud; ?>" />
																			</div>
																			<div class="col-sm-3 form-group">
																				<label class="text-danger"><?php echo $TotalPesoVolumetrico; ?></i></label>
																				<input  type="text" class="form-control" name="totalpeso" id="totalpeso" value="<?php echo $totalpeso; ?>" />
																			</div> 
																			
																			
																		</div>
																		
																		<div class="row">
																			<!-- Text area -->
																			<div class="col-sm-12 form-group">
																				<label for="inputTextarea" class="control-label"><i class="fa fa-comments icon text-default-lter"></i>&nbsp;<?php echo $DetallesdelEnvio; ?></label>
																				<input class="form-control" name="Comments" id="Comments" value="<?php echo $comments; ?>">
																			</div>
																		</div>																		
																	</fieldset>


																	<!-- START Receiver info  -->
																	<fieldset class="col-md-6">
																		<legend><strong><?php echo $DatosDestinatario; ?></strong></legend>
																		<div class="row">
																			<!-- Name -->
																			<div class="col-sm-11 form-group">
																				<label  class="control-label"><?php echo $NOMBREDESTINATARIO; ?><span class="required-field">*</span></label>
																				<input type="text" class="form-control" name="Receivername" value="<?php echo $rev_name; ?>">
																				
																			</div>
																		</div>
																		<!-- Adress and Phone -->
																		<div class="row">
																			<div class="col-sm-5 form-group">
																				<label  class="control-label"><?php echo $DIRECCION; ?><span class="required-field">*</span></label>
																				<input type="text"  name="Receiveraddress" class="form-control"  required value="<?php echo $r_add; ?>">
																			</div>
																			
																			<div class="col-sm-3 form-group">
																				<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO; ?></label>
																				<input type="text" class="form-control" name="Receiverphone" required value="<?php echo $r_phone; ?>">
																			</div>
																			
																			<div class="col-sm-3 form-group">
																					<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO2; ?></label>
																					<input type="tel"  class="form-control" name="telefono1" id="telefono1" autocomplete="off" required value="<?php echo $telefono1; ?>" >
																				</div>
																				
																				<div class="col-sm-3 form-group">
																					<label class="control-label"><?php echo $CEDULA; ?></i></label>
																					<input type="text" name="Receivercc_r" id="Receivercc_r" class="form-control"   value="<?php echo $cc_r; ?>" autocomplete="off" required>
																				</div>
																				<div class="col-sm-3 form-group">
																					<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $PAISDESTINO; ?></strong></label>															
																						<input    name="paisdestino" class="form-control" value="<?php echo $paisdestino; ?>" > 																						  							
																				</div>
																				<div class="col-sm-3 form-group">
																					<label class="text-info"><strong><?php echo $CODIGO; ?></strong></label>															    
																						<input   name="iso1"  value="<?php echo $iso1; ?>" class="form-control">  
																															
																				</div>	
																				
																				<!-- Oficina destino-->

																				<div class="col-sm-3 form-group">
																					<label class="text-info"><strong><?php echo $CIUDAD; ?></strong></label>  
																						<input type="text" name="city1" value="<?php echo $city1; ?>"" class="form-control"> 
																														
																				</div>
																			<div class="col-sm-11 form-group">
																				<label class="control-label"><?php echo $EMAIL; ?><font color="#FF6100"><?php echo $notaemail; ?></font></i></label>
																				<input type="text" name="Receiveremail" id="Receiveremail" class="form-control" value="<?php echo $email; ?>"  required readonly="true">
																			</div>
																		</div>							
																	
																		<br>
																		<br>
																		
																		<div class="row">
																			<!-- Name -->
																			<div class="col-sm-11 form-group">
																				<label for="name-card" class="text-success"><strong><?php echo $NUMEROENVIO; ?></strong></label>
																				<input type="text" class="form-control"   value="<?php echo $letra; ?>-<?php echo $cons_no; ?>" id="ConsignmentNo"  readonly="true"/>
																			</div>
																																				
																			<!-- Status and Pickup Date -->
																			<div class="col-sm-11 form-group">
																				<label for="dtp_input1" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $FECHARECOLECCIONENVIO; ?></i></label>
																				<div>
																					<div class="input-group">
																						<input type="text" class="form-control" name="Packupdate" value="<?php echo $pick_date; ?>"  id="datepicker-autoclose" readonly="true">
																						<span class="input-group-addon bg-custom b-0"><i class="glyphicon glyphicon-calendar"></i></span>
																					</div><!-- input-group -->
																				</div>		
																			</div>										
																		</div>														
																		<div class="row">
																			<div class="col-sm-4 form-group">
																				<label for="month" class="control-label"><i class="fa fa-sort-amount-asc icon text-default-lter"></i>&nbsp;<?php echo $estado; ?></label>
																				<input class="form-control" name="status" id="status" value="<?php echo $status; ?>" readonly="true">
																			</div>								
																			<div class="col-sm-7 form-group">
																					<label for="dtp_input1" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $FechadeEntrega; ?></i></label>
																				<div>
																					<div class="input-group">
																						<input type="text" class="form-control" name="Schedule" value="<?php echo $schedule; ?>"  id="datepicker">
																						<span class="input-group-addon bg-custom b-0"><i class="glyphicon glyphicon-calendar"></i></span>
																					</div><!-- input-group -->
																				</div>		
																					
																				</fieldset>
																				<div class="col-sm-12 form-group">
																					<br>
																					<br>
																					<input class="btn btn-success" name="Submit" type="submit"  id="submit" value="<?php echo $ACTUALIZARENVIO; ?>">
																					<input name="cid" id="cid" value="<?php echo $cid; ?>" type="hidden">
																				</div>
																			</div>					
																		</div>
																</div>
														</table>
													</form>
												</tbody>							
										   
											<?php  } ?>											
										</div>
																							
													<div class="col-xs-12 col-lg-12 col-xl-5">
														<div class="card-box">
															<div class="table-responsive">
															<br><br><br>
															  <h4 class="header-title m-t-0 m-b-30"><?php echo $HISTORIALDEENVIOS; ?></h4>
															  <br>
																<table ui-jq="dataTable" ui-options="" class="table table-striped b-t b-b">
																	<thead>
																		<tr>
																			<th><?php echo $_Tracking; ?></th>
																			<th><?php echo $NUEVAUBICACION; ?></th>
																			<th><?php echo $estado; ?></th>
																			<th><?php echo $FechayTiempo; ?></th>
																			<th><?php echo $Observaciones; ?></th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php  					
																			$result3 = mysql_query("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
																			while($row = mysql_fetch_array($result3)) {					
																		?> 												
																		<tr>
																			<td><?php echo $row['cons_no']; ?></td>
																			<td><?php echo $row['pick_time']; ?></td>
																			<td><?php echo $row['status']; ?></td>
																			<td><?php echo $row['bk_time']; ?></td>				
																			<td><?php echo $row['comments']; ?></td>
																		</tr>
																		<?php } ?>
																	</tbody>													
																</table>
															</div>
														</div>
													</div><!-- end col-->
									</div>
								</div><!-- end col-->
							</div>
							<!-- end row -->
						

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
<script src="js/ui-client.js"></script>

<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/clockpicker/bootstrap-clockpicker.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="assets/pages/jquery.form-pickers.init.js"></script>

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

	function volumetrico(){
		
		var volume1 = document.getElementById("volume1");
		var volume2 = document.getElementById("volume2");
		var volume3 = document.getElementById("volume3");
		var input = document.getElementById("totalpeso");
		totalpeso = parseInt(volume1.value * volume2.value * volume3.value/6000);
		input.value= totalpeso;
	}
</script>
</body>
</html>
<?php } ?>
