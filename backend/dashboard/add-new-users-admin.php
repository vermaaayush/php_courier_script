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
require_once('database.php');
require_once('database-settings.php');
require_once('library.php');
require 'requirelanguage.php';
$con = conexion();	

date_default_timezone_set($_SESSION['ge_timezone']);

$resultado = $con->query("SELECT cid, name_parson,name,email,phone,office,role,pwd,estado FROM manager_admin");						
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $adminsystem; ?></title>
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
						<h2><?php echo $addadmin; ?></h2>
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
						<!--Botones principales-->

						<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#nuevo"><i class="fa fa-user-plus"></i>
						 <?php echo $newuser; ?></button>						
						 
						</div>
						<div class="col-xs-12">
							<div class="table-responsive">
							<br>
							<!--Inicio de tabla usuarios-->
								
							<table ui-jq="dataTable"  class="table table-striped b-t b-b">
								<thead>
								  <tr>								
									<th><?php echo $edit; ?></th>	
									<th><?php echo $delete; ?></th>
									<th><?php echo $nameadmin; ?></th>
									<th><?php echo $placeuser; ?></th>
									<th><?php echo $email1; ?></th>
									<th><?php echo $telefono; ?></th>
									<th><?php echo $usertype; ?></th>
								  </tr>
								</thead>								
								<tbody>
								  <tr>
									<?php while($row = $resultado->fetch_assoc()){ ?> 
									  <td align="center">					
									  <a href="edit-profile.php?cid=<?php echo $row['cid'];?>">
									  <img src="img/edit.png"  height="20" width="20"></a></td>																 
									  <td align="center">
									  <a href="deletes/delete_user.php?cid=<?php echo $row['cid'];?>" onclick="return confirm('<?php echo $DELETEADMIN; ?>')">
										<img src="img/delete.png"  height="20" width="18"></a>																  
									  </td>
									  <td><?php echo $row['name_parson']; ?></td>
									  <td><?php echo $row['name']; ?></td>
									  <td><?php echo $row['email']; ?></td>
									  <td><?php echo $row['phone']; ?></td> 
									   <td><?php echo $row['role']; ?></td>									            
								  </tr>								
								</tbody>
								<?php } ?>
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
							<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i><?php echo $newadmin; ?></h4>
						  </div>
						  <div class="modal-body">
						  <!--Cuerpo del modal aquí el formulario-->
								<form action="settings/addusersadmin/agregar.php"  data-parsley-validate novalidate method="post" class="form-horizontal" enctype="multipart/form-data">
								  <div class="form-group " id="gnombrepa">
									<label for="off_name" class="col-sm-2 control-label"><?php echo $name; ?></label>
									<div class="col-sm-10">
									  <input type="text" class="form-control off_name" parsley-trigger="change" required name="name_parson"  placeholder="<?php echo $nameadmin; ?>">
									</div>
								  </div>
								  <div class="form-group" id="gapellido">
									<label for="email" class="col-sm-2 control-label"><?php echo $email1; ?></label>
									<div class="col-sm-5">
									  <input type="text" class="form-control email" name="email"  id="id_mail" placeholder="demo@demo.com" required onKeyUp="javascript:validateMail('id_mail')">
									  <strong><span id="emailOK"></span></strong>
									<p class="error"></p>
									</div>
									<div class="col-sm-5">
									  <input class="form-control phone" name="phone" parsley-trigger="change" required placeholder="<?php echo $telefono; ?>">																		  
									</div>
								  </div>
								  <div class="form-group" id="gemail">
									<label for="office" class="col-sm-2 control-label"><?php echo $noffice; ?></label>
									<div class="col-sm-5">
									  <input type="text" class="form-control office" parsley-trigger="change" required name="office"  placeholder="<?php echo $naoffice; ?>">
									</div>
									<div class="col-sm-5">
									<select type="text" class="form-control role" name="role" >
									  <option value="Administrator"><?php echo $adminn; ?></option>											
									</select>
									</div>
								  </div>
								  <div class="form-group " id="gnombre">
									<label for="off_name" class="col-sm-2 control-label"><?php echo $Usuario; ?></label>
									<div class="col-sm-10">
									  <input type="text" class="form-control off_name" parsley-trigger="change" required name="name"  placeholder="<?php echo $placeuser; ?>">
									</div>
								  </div>
								  <div class="form-group" id="gpassword">
									<label for="pwd" class="col-sm-2 control-label"><?php echo $password; ?></label>
									<div class="col-sm-10">
									  <input type="text" class="form-control pwd" parsley-trigger="change" required name="pwd"  placeholder="<?php echo $password; ?>">
									</div>
								  </div>
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
											<input type="checkbox" name="type" value="a" onclick="return false" checked >
											<i></i>
											<?php echo $usertype; ?>
										  </label>
										</div>
									</div>
								  
									<!--Fin del cuerpo del modal-->
								</div>
								 </br></br>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
										<?php echo $cerrar; ?></button>
									<input class="btn btn-success" name="Submit" type="submit"  id="submit" value="<?php echo $save; ?>">
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


</body>
</html>
