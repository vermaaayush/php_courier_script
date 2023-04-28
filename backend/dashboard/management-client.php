<?php
// *************************************************************************
// *                                                                       *
// *  DEPRIXA -  Integrated Web system                                     *
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

//Get all country data
$querys = $con->query("SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC");

//Count total number of rows
$rowsCount = $querys->num_rows;
	
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Clients data has been inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
isUser();	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $manageuser; ?></title>
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
  <style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
  </style>
  
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
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

			  <!-- service -->
			  <div class="panel hbox hbox-auto-xs no-border">
				<div class="col wrapper">
					
					<div class="row">
						<div class="col-xs-12" align="center">
						<h2><?php echo $addnewcustomer;?></h2>
						<br>
						</div>
					</div>
					<div class="col-xs-12">
						<!--Botones principales-->
						<?php if(!empty($statusMsg)){
							
							echo '<center><div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div></center>';
						}
						?>
						<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#nuevo"><i class="fa fa-user-plus"></i>
						 <?php echo $newuser; ?></button>

						<button type="button" class="btn btn-md btn-black"><a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Clients</a></button>
					</div>
						
					<form action="import_clients/importData.php" method="post" enctype="multipart/form-data" align="center" id="importFrm">
						<a href="import_clients/tbl_clients.csv"><img src="img/csv.png"  height="60" width="50"> &nbsp;&nbsp;Download sample csv.</a></br></br></br>
						<input type="file" name="file" />
						<input type="submit" class="btn btn-primary" name="importSubmit" value="Import">
					</form>
						
					<div class="row">							
						<div class="col-xs-12">						
							<div class="table-responsive">
							<br>
							<!--Inicio de tabla usuarios-->
							
							 <table ui-jq="dataTable"  class="table table-striped b-t b-b">
								<thead>
								  <tr>
									<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
									<th><?php echo $edit; ?></th>
									<th><?php echo $delete; ?></th>
									 <?php } ?> 
									<th><?php echo $namecustomer; ?></th>		
									<th><?php echo $identification; ?></th>
									<th><?php echo $namecompany; ?></th>
									<th><?php echo $telefono1; ?></th>
									<th><?php echo $telefono2; ?></th>
									<th><?php echo $direccion1; ?></th>
									<th><?php echo $paisorigen; ?></th>
									<th><?php echo $email1; ?></th>									
								  </tr>
								</thead>								
								<tbody>
								<?php 
								
									//get rows query
									$query = $con->query("SELECT * FROM tbl_clients ORDER BY id DESC");
									if($query->num_rows > 0){ 
										while($row = $query->fetch_assoc()){

								?>
								  <tr>
									  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
									  
									  <td align="center">					
									  <a href="edit-cliente.php?id=<?php echo $row['id'];?>">
									  <img src="img/edit.png"  height="20" width="18"></a></td>																 
									  <td align="center">
									  <a href="deletes/delete_cliente.php?id=<?php echo $row['id'];?>" onclick="return confirm('<?php echo $DELETECUSTOMER; ?>')">
										<img src="img/delete.png"  height="20" width="18"></a>
									  </td>
									  <?php } ?> 
									  <td><?php echo $row['name']; ?></td>
									  <td><?php echo $row['cc']; ?></td>
									  <td><?php echo $row['company']; ?></td>
									  <td><?php echo $row['phone']; ?></td>
									  <td><?php echo $row['telefono']; ?></td> 
									  <td><?php echo $row['address']; ?></td>
									  <td><?php echo  $row['country']; ?></td>
									  <td><?php echo $row['email']; ?></td>								  
								  </tr>
								 <?php } }else{ ?>
								 <tr><td colspan="10">No member(s) found.....</td></tr>
								 <?php } ?>
								</tbody>							
							</table>
							</div>
						</div>
					</div>
					
					
					<!-- Modal nuevo usuario -->
					<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $cerrar; ?></span></button>
							<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i><?php echo $newcustomer; ?></h4>
						  </div>
						  <div class="modal-body">
						  <!--Cuerpo del modal aquí el formulario-->
						<form action="settings/add-new-clients/agregar.php"  method="post" class="form-horizontal" data-parsley-validate novalidate>
							  <div class="form-group " id="gnombre">
									<label for="office" class="col-sm-2 control-label"><?php echo $namecustomers; ?></label>
									<div class="col-sm-10">
									  <input type="text" class="form-control office" parsley-trigger="change" required name="name"  placeholder="<?php echo $namecustomers; ?>">
									</div>									
							  </div>
							  <div class="form-group " id="gnombre">
							  <label for="officer_name" class="col-sm-2 control-label"><?php echo $CEDULA; ?></label>
									<div class="col-sm-10">
									  <input type="text" class="form-control officer_name" parsley-trigger="change" required name="cc"  placeholder="<?php echo $numbercedula; ?>">
									</div>
								 </div>
							  <div class="form-group " id="gnombre">
							  <label for="officer_name" class="col-sm-2 control-label"><?php echo $companys; ?></label>
									<div class="col-sm-10">
									  <input type="text" class="form-control officer_name" iparsley-trigger="change" required name="company"  placeholder="<?php echo $namecompanys; ?>">
									</div>
								 </div>	
							  <div class="form-group" id="gapellido">
									<label for="address" class="col-sm-2 control-label"><?php echo $direccion; ?></label>
									<div class="col-sm-10">
									  <input type="text" class="form-control address" parsley-trigger="change" required name="address"   placeholder="<?php echo $direccioncustomer; ?>">
									</div>
							  </div>
							  <div class="form-group" id="ptelefonos">
									<label for="address" class="col-sm-2 control-label"><?php echo $telefono; ?></label>
									<div class="col-sm-5">
									  <input class="form-control ph_no" parsley-trigger="change" required name="phone" placeholder="<?php echo $telefonocustomer1; ?>">	
									  
									</div>
									<div class="col-sm-5">
									  <input class="form-control ph_no" parsley-trigger="change" required name="telefono" placeholder="<?php echo $telefonocustomer2; ?>">
									  </div>
							  </div>							  
							  <div class="form-group" id="gusuario">
									<label for="officer_name" class="col-sm-2 control-label"><?php echo $Usuario; ?></label>
									<div class="col-sm-5">
									  <input type="email" class="form-control officer_name" id="emailAddress" parsley-trigger="change" required name="email"  placeholder="demo@demo.com">
									</div>
									<div class="col-sm-5">
									  <input type="text" class="form-control off_pwd" parsley-trigger="change" required name="password"  placeholder="<?php echo $password; ?>">
									</div>					  
							  </div>
							  <div class="form-group" id="gusuario">
									<label for="officer_name" class="col-sm-2 control-label"><?php echo $paisorigen; ?></label>
									<div class="col-sm-5">									   
										<select   class="fa-glass booking_form_dropdown form-control" name ="country" id="country1" parsley-trigger="change" required  >
											<option value=""><?php echo $L_Country_first; ?></option>
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
									<div class="col-sm-5">
										<select type="text" class="fa-glass booking_form_dropdown form-control" name="department" id="state1"  parsley-trigger="change" required>
											<option value=""><?php echo $L_State_first; ?></option>
										</select>
									</div>
									<div class="col-sm-5" style="display:none">
									  <select   name="iso"  id="iso1" class="fa-glass booking_form_dropdown form-control">  
											<option value=""><?php echo $code; ?></option>
										</select>	
									</div>
														  
							  </div>
							  <div class="form-group" id="gusuario">
								<label for="officer_name" class="col-sm-2 control-label"><?php echo $cciudad; ?></label>
									<div class="col-sm-5">
										<select type="text" class="fa-glass booking_form_dropdown form-control" name ="state" id="city1"  parsley-trigger="change" required>
											<option value=""><?php echo $L_City_first; ?></option>
										</select>
									</div>
									<div class="col-sm-5">
									  <input type="text" class="form-control off_pwd" parsley-trigger="change" required name="zipcode"  placeholder="<?php echo $codigopostal; ?>">
									</div>					  
							  </div>
							  <div class="form-group" id="gusuario">
								<label for="officer_name" class="col-sm-2 control-label"><?php echo $language; ?></label>
									<div class="col-sm-5">
									  <select class="form-control" name="lang" >
											<option value="en_customer"><?php echo $english; ?></option>
											<option value="fr_customer"><?php echo $french; ?></option>
											<option value="hindi_customer"><?php echo $hindi; ?></option>
											<option value="es_customer"><?php echo $spanish; ?></option>
										</select>
									</div>														  
							  </div>

							  <div class="form-group">
								</br></br>
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox">
										  <label class="i-checks i-checks-sm">
											<input type="checkbox" name="estado" value="1" onclick="return false" checked >
											<i></i>
											<?php echo $estado; ?>
										  </label>
										</div>
										<div class="checkbox">
										  <label class="i-checks i-checks-sm">
											<input type="checkbox" name="type" value="u" onclick="return false" checked >
											<i></i>
											<?php echo $usertype; ?>
										  </label>
										</div>
									</div>
							  </div>

							<!--Fin del cuerpo del modal-->
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
							<?php echo $cerrar; ?></button>
							<input class="btn btn-success" name="Submit" type="submit"  id="submit" value="Guardar">
						   </div>
						</form>
						</div>
					  </div>
					</div>
					<!--fin de modal nuevo usuario-->		   
					</div>
					<!--fin de modal nuevo usuario-->
				  </div>
				</div>       
			  </div>
			  <!-- / service -->
			</div>
		  </div>
		  <!-- / main -->    
		</div>
    </div>
  </div>
  <!-- / content -->

  <!-- footer -->
<?php
include("footer.php");
?>
  <!-- / footer -->

</div>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>
<script src="js/delivery.js"></script>
<!-- Modal-Effect -->
<script src="assets/modal-effect/js/classie.js"></script>
<script src="assets/modal-effect/js/modalEffects.js"></script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="js/parsley.min.js"></script>

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
		   valido.innerText = "<?php echo $emailtext; ?>";
		} else {
		  valido.innerText = "<?php echo $emailtextx; ?>";
		}
	});
</script>
<script>
	
	$(document).ready(function(){
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'ajaxpais1.php',
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
					url:'ajaxpais1.php',
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
					   url:'ajaxpais1.php',
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