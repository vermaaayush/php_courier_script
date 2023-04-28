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
require_once('../database.php');
require_once('../library.php');
require_once('../funciones.php');
require '../requirelanguage.php';
require_once('../database-settings.php');
$db = conexion();	

date_default_timezone_set($_SESSION['ge_timezone']);
$qname = $_SESSION['user_name']; 

# datos de la tabla paises
$querys = $db->query("SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC");
$rowsCount = $querys->num_rows;
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $_SESSION['ge_cname']; ?> </title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>

  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />
   <script type= "text/javascript" src="../../process/countries.js"></script>  
   
   	<style type="text/css">
	.parsley-error {
	  border-color: #ff5d48 !important; }

	.parsley-errors-list {
	  display: none;
	  margin: 0;
	  padding: 0; }

	.parsley-errors-list.filled {
	  display: block; }
	  
	.parsley-errors-list > li {
	  font-size: 12px;
	  list-style: none;
	  color: #ff5d48;
	  margin-top: 5px; }
	</style>

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

			<div class="wrapper-md">
			  <div class="row">
				<div class="col-sm-12">
					  <div class="blog-post">                   
						<div class="panel">
							<div class="wrapper-lg">           
								<div>
									<tbody>
										<tr>				
										<h3 class="classic-title"><span><strong><i class="fa fa-truck icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $addenviocus; ?></strong></h3>
										<form action="../settings/panel_customer/booking.php" data-parsley-validate novalidate method="post">
											<table border="0" align="center" width="100%">
									
												<!-- START Checkout form -->
												
														<div class="row">
														<?php  
															require_once('../database.php');
															$sql = "SELECT * FROM tbl_clients where email='$qname' LIMIT 1";
															$result = dbQuery($sql);		
															while($data = dbFetchAssoc($result)) {
															extract($data);
														?> 
															<!-- START Receiver info  -->
															<fieldset class="col-md-6">
																<legend><?php echo $datosremite; ?></legend>
																<div class="row">
																	<!-- Name -->
																	
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $StaffRole; ?><span class="required-field">*</span></label>
																		<input type="text"  name="officename" id="officename" value="<?php echo $_SESSION['user_name'] ;?>" class="form-control"  readonly="true">
																	</div>
																	
																	<!-- Name -->
																	<div class="col-sm-8 form-group">
																		<label  class="control-label"><?php echo $NOMBREREMITENTE; ?><span class="required-field">*</span></label>
																		 <input name="name" parsley-trigger="change" parsley-trigger="change" required  type="text" class="form-control" value="<?php echo $name;?>"  placeholder="Full name" readonly>
																		
																	</div>
																</div>
																<!-- Adress and Phone -->
																<div class="row">
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $EMAIL;?><span class="required-field">*</span></label>
																		<input name="email" value="<?php echo $_SESSION['user_name']; ?>"  class="form-control" type="text"  placeholder="yourname@gmail.com" readonly>
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label  class="control-label">&nbsp;<?php echo $CEDULA;?></label>
																		<input name="shipname_cc" class="form-control" parsley-trigger="change" required  type="text"  value="<?php echo $cc;?>" readonly>
																	</div>

																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $TELEFONO;?></label>
																		<input name="phone" class="form-control"  type="text"  value="<?php echo $phone;?>"  readonly>
																	</div>
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $DIRECCION;?></label>
																		<input name="address" class="form-control"  type="text" value="<?php echo $address;?>"   readonly>
																	</div>																																
																</div>
																<div class="row">
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><?php echo $PAISORIGEN; ?><span class="required-field">*</span></label>
																		<input name="country" value="<?php echo $country;?>"  class="form-control" type="text" readonly>
																	</div>
																	
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><?php echo $CIUDAD; ?></label>
																		<input name="state" class="form-control"  type="text"  value="<?php echo $department;?> | <?php echo $state;?>"  readonly>
																	</div>
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><?php echo $CODIGO; ?></label>
																		<input name="iso" class="form-control"  type="text" value="<?php echo $iso;?>"   readonly>
																	</div>
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><?php echo $CODIGOPOSTAL; ?></label>
																		<input name="zipcode" class="form-control" type="text" value="<?php echo $zipcode;?>"   readonly>
																	</div>													
																</div>
															</fieldset>
															<?php } ?>
															<fieldset class="col-md-6">
																<legend><?php echo $Informaciondeenvio; ?>:</legend>
																<strong><?php echo $notapeso;?></strong>
																<div class="row" >																								
																
																	<div class="col-sm-3 form-group">
																		<label class="control-label"><?php echo $Altura;?><span class="required-field">*</span></label>
																		<input onblur="if(this.value == ''){this.value='0'}"  onKeyUp="volumetrico();" id="volume1" name="height" class="form-control"  parsley-trigger="change" required placeholder="<?php echo $Altura;?>">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $Ancho;?><span class="required-field">*</span></label>
																		<input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="svolumetrico();" id="volume2" name="width" class="form-control" parsley-trigger="change" required placeholder="<?php echo $Ancho;?>">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $Longitud;?><span class="required-field">*</span></label>
																		 <input type="text" onblur="if(this.value == ''){this.value='0'}" onKeyUp="volumetrico();" id="volume3" name="length" class="form-control" parsley-trigger="change" required placeholder="<?php echo $Longitud;?>">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $PesoFisico; ?><span class="required-field">*</span></label>
																		<input id="totalpeso" name="weight" class="form-control"  parsley-trigger="change" required placeholder="<?php echo $PesoKg; ?>">
																	</div>
																	
																</div>
																
																<div class="row" >
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><?php echo $CantidadPaquetes; ?><span class="required-field">*</span></label>
																		<input type="number"   id="Qnty" name="Qnty" class="form-control"  parsley-trigger="change" required placeholder="<?php echo $CantidadPaquetesen; ?>" >
																	</div>
																
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><?php echo $MododelServicio; ?><span class="required-field">*</span></label>
																		<select name="service" class="fa-glass booking_form_dropdown form-control" id="service" onclick="clear_service();">
																			<option value="Normal" ><?php echo $normal; ?></option>
																			<option value="Express" ><?php echo $express; ?></option>
																		</select>
																	</div>												

																	<div class="col-sm-4 form-group">
																		<label class="control-label"><?php echo $typeproduct;?><span class="required-field">*</span></label>
																		<select name="type"   class="fa-glass booking_form_dropdown form-control" parsley-trigger="change" required id="service" onclick="clear_service();">
																				<?php 
																						$sql=mysql_query("SELECT name FROM type_shipments  GROUP BY name");
																						while($row=mysql_fetch_array($sql)){
																						if($cliente==$row['name']){
																						echo '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>';
																						}else{
																						echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
																					 }
																					}
																				?> 
																			</select>
																	</div>												
																</div>
																
																
																<!-- Name -->
																<div class="row" >
																	<div class="col-sm-12 form-group">
																		<label class="control-label"><?php echo $DetallesdelEnvio; ?></i></label>
																		<textarea id="note" name="note" class="form-control" type="text"  parsley-trigger="change" required placeholder="<?php echo $detailplace; ?>" ></textarea>																	
																	</div>
																</div>

															</fieldset>
															<fieldset class="col-md-6">
																<legend><?php echo $DatosDestinatario; ?>:</legend>
																<div class="row">
																	<!-- Name -->
																	<div class="col-sm-8 form-group">
																		<label  class="control-label"><?php echo $NOMBREDESTINATARIO; ?><span class="required-field">*</span></label>
																		 <input  id="name_delivery" name="name_delivery" type="text" class="form-control" parsley-trigger="change" required placeholder="<?php echo $nameplace; ?>" >
																		
																	</div>
																	<div class="col-sm-4 form-group">
																		<label  class="control-label"><?php echo $CEDULA;?><span class="required-field">*</span></label>
																		<input type="text"  name="Receivercc" id="Receivercc"class="form-control" parsley-trigger="change" required placeholder="<?php echo $cedulaplace; ?>">
																	</div>
																</div>	
																<!-- Adress and Phone -->
																<div class="row">
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $DIRECCION; ?><span class="required-field">*</span></label>
																		<input id="address_delivery" name="address_delivery"  class="form-control" type="text" parsley-trigger="change" required placeholder="<?php echo $dirplace; ?>">
																	</div>
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><?php echo $EMAIL; ?><span class="required-field">*</span></label>
																		<input id="email_delivery" name="email_delivery"  class="form-control" type="text" parsley-trigger="change" required placeholder="<?php echo $emailplace; ?>">
																	</div>
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO1; ?></label>
																		<input type="tel" id="phone_delivery" name="phone_delivery" class="form-control" parsley-trigger="change" required placeholder="(054)-828 0085">
																	</div>
																	<div class="col-sm-3 form-group">
																		<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;<?php echo $TELEFONO2; ?></label>
																		<input type="tel" id="phone_delivery2" name="phone_delivery2" class="form-control" parsley-trigger="change" required placeholder="(054)-828 0085">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong><?php echo $PAISDESTINO; ?></strong></label>															
																		<select    name="scountry" class="form-control" id="country1" > 
																			<option value=""><?php echo $L_Country_first; ?></option>
																			<?php
																			
																				if($rowsCount > 0){
																					while($row = $querys->fetch_assoc()){ 
																						echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>';
																					}
																				}else{
																					echo '<option value="">Country not available</option>';
																				}
																			?>														
																		</select>								
																	</div>
																	<div class="col-sm-3 form-group" style="display:none">
																		<label class="text-info"><strong><?php echo $CODIGO; ?></strong></label>															    
																			<select   name="iso1"  id="iso1" class="form-control">  
																				<option value=""><?php echo $L_codigo; ?></option>
																			</select>								
																	</div>	
																	
																	<!-- Oficina destino-->
																	<div class="col-sm-3 form-group">
																		<label class="text-info"><strong><?php echo $L_STATE; ?></strong></label>  
																		<select name="sstates" id="state1" class="form-control" parsley-trigger="change" required>
																				<option value=""><?php echo $L_State_first; ?></option>
																		</select>
																		
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label class="text-info"><strong><?php echo $CIUDAD; ?></strong></label>  
																		<select type="text" name="sstate" id="city1" parsley-trigger="change" required class="form-control">
																			<option value=""><?php echo $L_City_first; ?></option>
																		</select>									
																	</div>
																	<div class="col-sm-3 form-group">
																		<label class="text-info"><strong><?php echo $CODEPOSTAL; ?></strong></label>  
																			<input  type="text"  id="zipcode1" name="zipcode1"   parsley-trigger="change" placeholder="<?php echo $L_postal; ?>" required class="form-control"> 								
																	</div>
																</div>													
															</fieldset>
															
															<div class="col-md-6 text-left">
																<br>
																<br>
																<input class="btn btn-primary" name="Submit" type="submit"  id="submit"  value="<?php echo $enviarsolicitud; ?>">
															</div>
														</div>					
													</article>				
												  <div class="clearfix"></div>
											   </div>		
											</table>
										</form>	
								</tbody>
							</div>
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
  <!-- footer -->
	<?php include("../footer.php"); ?>
  <!-- / footer -->

</div>

	<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
	<script src="../../bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/ui-load.js"></script>
	<script src="../js/ui-jp.config.js"></script>
	<script src="../js/ui-jp.js"></script>
	<script src="../js/ui-nav.js"></script>
	<script src="../js/ui-toggle.js"></script>

	<!-- Validation js (Parsleyjs) -->
	<script type="text/javascript" src="../js/parsley.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('form').parsley();
		});
	</script>	

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
			  valido.innerText = "Email Correcto";
			} else {
			  valido.innerText = "Email Incorrecto";
			}
		});
		
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

	<script>
	
	$(document).ready(function(){
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'../ajaxpais1.php',
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
					url:'../ajaxpais1.php',
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
					   url:'../ajaxpais1.php',
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
</body>
</html>
