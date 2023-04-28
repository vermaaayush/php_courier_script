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
require_once('database-settings.php');
require_once('database.php');
require_once('library.php');
require_once('funciones.php');
require 'requirelanguage.php';
$con = conexion();

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
date_default_timezone_set($_SESSION['ge_timezone']);

$posted= (int) $_GET['id'];
$sql = "SELECT * FROM online_booking WHERE id = $posted "; 	
$result = dbQuery($sql);
while($data = dbFetchAssoc($result)) {
extract($data);		
isUser();														 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $approvesent; ?></title>
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
  
  <script src="js/jquery-1.11.1.min.js"></script>

</head>
<body>
<?php
include("header.php");
?>
  
  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3"><?php echo $namecli; ?>: <font style="color:#090;"><?php echo $row['name']; ?></font></h1>
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
			<tbody>
			<table border="0" align="center" width="100%">
	
				<tr>				
					<h3 class="classic-title"><span><strong><i class="fa fa-truck icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $addonlinesent; ?></strong></h3>
				
					<!-- START Checkout form -->
					
				<form  method="post" action="settings/approve_shipping/approved.php" class="form-horizontal" > 
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
									<label class="control-label" ><?php echo $NOMBREREMITENTE; ?><span class="required-field">*</span></label>
										<input type="text" name="ship_name" required value="<?php echo $name; ?>" class="form-control" readonly="true">
																		 									   									                                  
									 </div>
								</div>
								
								<div class="row" >
									<div class="col-sm-3 form-group">
										<label  class="control-label"><?php echo $EMAIL; ?><span class="required-field">*</span></label>
										<input type="text"  name="email" class="form-control" required  value="<?php echo $email; ?>" readonly="true">
									</div>
									
									<div class="col-sm-3 form-group">
										<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $DIRECCION; ?></label>
										<input type="text" class="form-control" name="s_add" required  value="<?php echo $address; ?>" readonly="true">
									</div>
									
									<div class="col-sm-3 form-group">
										<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO; ?></label>
										<input type="text" class="form-control" name="s_phone"required  value="<?php echo $phone; ?>" readonly="true">
									</div>
									<div class="col-sm-3 form-group">
										<label class="control-label"><?php echo $CEDULA; ?></i></label>
										<input type="text" name="shippercc" id="shippercc" class="form-control"  value="<?php echo $shipname_cc; ?>" autocomplete=" off" required readonly="true">
									</div>
									<div class="col-sm-3 form-group">
										<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $PAISORIGEN; ?></strong></label>															
											<input  name="countries" id="Shippercountry" class="form-control"  value="<?php echo $country; ?>" readonly="true"> 														  							
									</div>
									<div class="col-sm-3 form-group">
										<label class="text-info"><strong><?php echo $CODIGO; ?></strong></label>															    
											<input name="iso" id="iso" class="form-control" value="<?php echo $iso; ?>" readonly="true">  
																			
									</div>	
									<div class="col-sm-3 form-group">
										<label class="text-info"><strong><?php echo $CIUDAD; ?></strong></label>  
											<input  type="text"  id="ciudad" name="ciudad"   class="form-control" value="<?php echo $state; ?>" readonly="true"> 								
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
										 <label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $OFICINAORIGEN; ?></strong></label>
										  <select name="office_origin"  class="form-control" >
												<?php
													$sql="SELECT * FROM offices"; 
														$query=$db->query($sql); 
														if($query->num_rows>0){ 
															while($row=$query->fetch_array()){ 
															echo '<option data-value="'.$row['off_name'].'">'.utf8_encode($row['off_name']).'</option>';
														}
													}														

												?>
										   </select>
										</div>
										<div class="col-sm-3 form-group" >
											<label><?php echo $CantidadPaquetes; ?></label>
											<input type="text" class="form-control" name="Qnty"  value="<?php echo $Qnty; ?>"  />
										</div>
										
										<div class="col-sm-3 form-group">
											<label class="control-label"><?php echo $DetallesdelEnvio; ?></label>
											<input name="type" value="<?php echo $type; ?>" class="form-control" >											
										</div>
										
										<div class="col-sm-3 form-group">
											<label class="control-label"><i class="fa fa-database icon text-default-lter"></i>&nbsp;<strong><?php echo $Pagos; ?></strong></label>
											<select name="bookingmode" class="form-control"  id="Bookingmode">
												<option selected="selected" value="Effective"><?php echo $Effective; ?></option>
												<option value="Debit_card"><?php echo $Debitcard; ?></option>
												<option value="Credit_card"><?php echo $Creditcard; ?></option>
												<option value="Transfer"><?php echo $Transfer; ?></option>
												<option value="Online"><?php echo $Payonline; ?></option>
											</select>
										</div>
													
										<div class="col-sm-3 form-group">
											<label class="control-label"><i class="fa fa-plane icon text-default-lter"></i>&nbsp;<?php echo $MododelServicio; ?></label>
											<input name="service" value="<?php echo $service; ?>" class="form-control"  id="mode">
																			
										</div>
										<div class="col-sm-9 form-group">
											<label for="ccv" class="control-label"><i class="fa fa-file-text icon text-default-lter"></i>&nbsp;<strong><?php echo $descriptiondeliver; ?></strong></i></label>
											<input name="note" required  class="form-control" placeholder="comments" value="<?php echo $note; ?>" >
										</div>
									</div>
									
									 <!-- Payment Mode -->
									 <div class="row">										
										
										<div class="col-sm-3 form-group" >
											<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $ValorDeclarado; ?><strong></label>
											<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum2"  name="declarate" class="form-control"  value="0" required />														
										</div>
										<div class="col-sm-3 form-group" >
											<label class="text-danger"><strong><?php echo $Declarado; ?><strong></label>
											<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum5"  name="declarado" class="form-control"  value="4" required />														
										</div>
										<div class="col-sm-3 form-group">
											<label for="ccv" class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $ValorRecogida; ?><strong></label>
											<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();"  id="sum3"   class="form-control" name="recogida" value="0"  required />
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $PrimerKilo; ?><strong></label>
											<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="suma();" id="sum1"   class="form-control" name="variable" value="12" required />
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $KiloAdicional; ?><strong></label>
											<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="suma();" id="sum6"   class="form-control" name="kiloadicional" value="8" required />
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-danger"><strong><?php echo $PesoKg; ?><strong></label>
											<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="suma();" id="sum4"  class="form-control" name="weight" value="0" required />
										</div>																						
										<div class="col-sm-3 form-group">
											<label class="text-danger"><strong><?php echo $SubtotalEnvio; ?><strong></i></label>
											<input  type="text" class="form-control" name="shipping_subtotal" id="resultado" placeholder="0,00" />
										</div>
										<div class="col-sm-3 form-group">
											<label class="text-danger"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $PesoFisico; ?><strong></label>
											<input type="text" name="pesoreal" onblur="if(this.value == ''){this.value='0'}"  class="form-control" required />
										</div>
										
										<legend><?php echo $pesovolumetrico; ?>:</legend>
												
												<!-- Peso Volumetrico -->
																					
											<div class="col-sm-3 form-group">
												<label class="text-primary"><strong><?php echo $Altura; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="volumetrico();" id="volume1"   class="form-control" name="altura" value="<?php echo $height; ?>" required />
											</div>
											<div class="col-sm-3 form-group">
												<label class="text-primary"><strong><?php echo $Ancho; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="svolumetrico();" id="volume2"   class="form-control" name="ancho" value="<?php echo $width; ?>" required />
											</div>
											<div class="col-sm-3 form-group">
												<label class="text-primary"><strong><?php echo $Longitud; ?><strong></label>
												<input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="volumetrico();" id="volume3"  class="form-control" name="longitud" value="<?php echo $length; ?>" required />
											</div>
																																					
											<div class="col-sm-3 form-group">
												<label class="text-primary"><strong><?php echo $TotalPesoVolumetrico; ?><strong></i></label>
												<input  type="text" class="form-control" name="totalpeso" id="totalpeso" value="<?php echo $weight; ?>" />
												
											</div>
										
										<div class="col-sm-4 form-group ">
											<label for="month" class="control-label"><i class="fa fa-sort-amount-asc icon text-default-lter"></i>&nbsp;<?php echo $estado; ?></label>
											<select class="form-control" name="status" id="status" required>
												<?php
													$sql="SELECT servicemode FROM service_mode  GROUP BY servicemode"; 
														$query=$db->query($sql); 
														if($query->num_rows>0){ 
															while($row=$query->fetch_array()){ 
															echo '<option data-value="'.$row['servicemode'].'">'.utf8_encode($row['servicemode']).'</option>';
														}
													}
												?>
												
											</select>
										</div>
									</div>	
														
							</fieldset>

							<!-- START Receiver info  -->
							<fieldset class="col-md-6">
								<legend><?php echo $DatosDestinatario; ?>:</legend>
								
								<!-- Name -->
								<div class="form-group">
									<label  class="control-label"><?php echo $NOMBREDESTINATARIO; ?><span class="required-field">*</span></label>
									<input type="text" class="form-control" name="rev_name" required  value="<?php echo $name_delivery; ?>" >									
								</div>								
								<!-- Adress and Phone -->
								<div class="row">
									<div class="col-sm-3 form-group">
										<label  class="control-label"><?php echo $DIRECCION; ?><span class="required-field">*</span></label>
										<input type="text"  name="r_add"  class="form-control" required  value="<?php echo $address_delivery; ?>" >
									</div>									
									<div class="col-sm-3 form-group">
										<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO; ?></label>
										<input type="text" class="form-control" name="r_phone" required value="<?php echo $phone_delivery; ?>" >
									</div>
									<div class="col-sm-3 form-group">
										<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO2; ?></label>
										<input type="tel"  class="form-control" name="r_phone1" id="telefono1" autocomplete="off" value="<?php echo $phone_delivery2; ?>" required >
									</div>
									<div class="col-sm-3 form-group">
										<label class="control-label"><?php echo $CEDULA; ?></i></label>
										<input type="text" name="receivercc_r" id="receivercc_r" class="form-control"   value="<?php echo $Receivercc; ?>" autocomplete="off" required>
									</div>
									<div class="col-sm-3 form-group">
										<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $PAISDESTINO; ?></strong></label>															
											<input    name="paisdestino" class="form-control" id="country1" value="<?php echo $scountry; ?>" > 								
									</div>
									<div class="col-sm-3 form-group">
										<label class="text-info"><strong><?php echo $CODIGO; ?></strong></label>															    
											<input   name="iso1"  id="iso1" class="form-control" value="<?php echo $iso1; ?>">  								
									</div>	
									
									<!-- Oficina destino-->

									<div class="col-sm-3 form-group">
										<label class="text-info"><strong><?php echo $CIUDAD; ?></strong></label>  
											<input type="text" name="city1" id="city1" class="form-control" value="<?php echo $sstate; ?>"> 
																			
									</div>
									<div class="col-sm-3 form-group">
										<label class="text-info"><strong><?php echo $CODIGOPOSTAL; ?></strong></label>  
											<input  type="text"  id="zipcode1" name="zipcode1"   class="form-control" value="<?php echo $zipcode1; ?>"> 								
									</div>
									<div class="col-sm-12 form-group">
										<p class="error"></p>
										<label class="control-label"><?php echo $EMAIL; ?><font color="#FF6100"><?php echo $notaemail; ?></font></i></label>
										<input type="email" name="receiveremail" id="id_mail" class="form-control"   value="<?php echo $email_delivery; ?>" autocomplete=" off" required onKeyUp="javascript:validateMail('id_mail')">
										<strong><span id="emailOK"></span></strong>
										<p class="error"></p>
									</div>
								</div>														
								<br>
								<br>								
								<!-- Name -->
								<div class="form-group">
									<?php
												$sql="SELECT count(cons_no) as maximo FROM courier"; 
												$query=$db->query($sql); 
												if($query->num_rows>0){ 
													while($dato=$query->fetch_array()){ 
														$DesdeNumero2 = 1;
														$HastaNumero2 = 1;
														$DesdeNumero3 = 1000000;
														$HastaNumero3 = 10000000;
														$DesdeNumero = 0;
														$HastaNumero = 10000;
														$numeroAleatorio2 = chr(rand(ord($DesdeNumero2), ord($HastaNumero2)));
														$numeroAleatorio3 = ($DesdeNumero3);
														$numeroAleatorio = rand($DesdeNumero, $HastaNumero);
														$numbrr = $dato['maximo']+1;
														$numberW = "".$numeroAleatorio3."".$numbrr;
													}
												}
											?>
									<label for="name-card" class="control-label"><font color="#FF6100"><strong><?php echo $NUMEROENVIO; ?></strong></font></label>
									<input type="text" class="form-control" name="cons_no"  value="<?php echo $company['prefijo']; ?>-<?php echo "".$numberW; ?>" id="ConsignmentNo"  />
								</div>
								<div class="row">
								<!-- Destination Office -->
								<div class="col-sm-6 form-group">
									<label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<?php echo $DELACIUDAD; ?></label>
									<input name="fcity" required value="<?php echo $state; ?>, <?php echo $country; ?>" class="form-control" readonly="true" >																			
								</div>															
								<div class="col-sm-6 form-group">
									<label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<?php echo $ALACIUDAD; ?></label>
									<input name="tcity" required value="<?php echo $sstate; ?>, <?php echo $scountry; ?>" class="form-control" readonly="true" >																				
								</div>		
								<!-- Status and Pickup Date -->

									<div class="col-sm-6 form-group">
										<label for="month" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $FECHARECOLECCIONENVIO; ?></label>
										<input class="form-control" name="date" required  value="<?php echo $booking_date; ?>" readonly="true" >											
									</div>								
								<div class="col-sm-6 form-group">
										<label for="dtp_input1" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $fechaestimadadeliver; ?></i></label>										
										<div class="input-group date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
										<input class="form-control" name="deliverydate" required  onClick="ds_sh(this);" type="TEXT" value="<?php echo $booking_date; ?>">
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>									
							</fieldset>
							 </tr><?php if($status !='Approved'){?><tr>
							<input name="office" id="office" value="<?php echo $email; ?>" type="hidden"> 
							<input name="cid" id="cid" value="<?php echo $id; ?>" type="hidden">
							<div class="col-md-6 text-left">
								<input class="btn btn-primary" name="Submit" type="submit"  value="<?php echo $APPRESER; ?>">
							</div>
						</div>					
				    </article>				
				  <div class="clearfix"></div>
			   </div>
			  </div>
			 </tbody></table></td>
				<br>
				</form>
				<?php } ?>
				<br>
				<br>				
				<table border="0" align="center" width="100%">
				<?php if($status !='Cancelled' AND $status !='Approved'){?>
				<table border="0" align="center" width="50%">
					<br><br>
					<form method="post" action="settings/approve_shipping/cancelled_booking.php" class="form-horizontal" > 
					
						<fieldset class="col-md-6">
							<legend><?php echo $cancelreser; ?>:</legend>	
							<!-- Text area -->
							<div class="form-group">
								<label for="inputTextarea" class="control-label"><i class="fa fa-comments icon text-default-lter"></i><?php echo $motivecancel; ?> : <?php echo  $email; ?>  )</label>
								<textarea class="form-control" name="reasons"></textarea>
								<input name="cid" id="cid" value="<?php echo $id; ?>" type="hidden"> 
								<input name="name"  value="<?php echo $name; ?>" type="hidden" >
								<input name="email"  value="<?php echo $email; ?>" type="hidden">
							</div>
						</fieldset>
						<br>			
						<div class="col-md-12 text-left">
							<input class="btn btn-danger" name="Submit" type="submit"  value="<?php echo $cancelreser; ?>">
						</div>
					 </form>
				</table>									  
			   <?php } ?>	
		   </div>
            <div class="line line-lg b-b b-light"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
  <!-- / content -->

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


<script type="text/javascript">

	function validateMail(idMail)
	{
		//We create an object or
		object=document.getElementById(idMail);
		valueForm=object.value;
	 
		// Pattern for the mail
		var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		if(valueForm.search(patron)==0)
		{
			//Mail correct
			object.style.color="#36D900";
			return;
		}
		//Mail incorrect
		object.style.color="#FF4000";
	}
	//-->
	document.getElementById('id_mail').addEventListener('input', function() {
		campo = event.target;
		valido = document.getElementById('emailOK');
			
		emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
		//Se muestra un texto a modo de ejemplo, luego va a ser un icono
		if (emailRegex.test(campo.value)) {
		 valido.innerText = "<?php echo $emailtext; ?>";
		} else {
		  valido.innerText = "<?php echo $emailtextx; ?>";
		}
	});
	
	function suma(){														
																			
		var num2 = "5.56789";
		var sum1 = document.getElementById("sum1");
		var sum2 = document.getElementById("sum2");
		var sum3 = document.getElementById("sum3");
		var sum4 = document.getElementById("sum4");
		var sum5 = document.getElementById("sum5");
		var sum6 = document.getElementById("sum6");
		var input = document.getElementById("resultado");
		resultado = parseFloat(Math.round(sum1.value) + parseFloat(sum2.value * sum5.value/100)  + parseFloat(sum3.value) +  parseFloat(sum4.value * sum6.value - sum6.value)).toFixed(2);
		input.value= resultado;
	}
	
	function volumetrico(){
		
		var num2 = "1.341";
		var volume1 = document.getElementById("volume1");
		var volume2 = document.getElementById("volume2");
		var volume3 = document.getElementById("volume3");
		var input = document.getElementById("totalpeso");
		totalpeso = parseFloat(Math.round(volume1.value * volume2.value * volume3.value) /6000 ).toFixed(2);
		input.value= totalpeso;
		
	}
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
 <?php } ?>
</body>
</html>
