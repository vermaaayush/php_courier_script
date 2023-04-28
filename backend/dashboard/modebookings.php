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

$resultado = $con->query("SELECT * FROM mode_bookings");
$service_mode = $con->query("SELECT * FROM service_mode");	
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $typeshipment; ?></title>
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
				<div class="row">		
					<div class="col-sm-12">			
					  <div class="panel panel-default">
					  <div class="table-responsive">
						<div class="panel-heading font-bold"><?php echo $boxes; ?></div>
						</br>
						<div class="col-xs-12">
						<!--Botones principales-->
							<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#nuevo"><i class="fa fa-user-plus"></i>
							 <?php echo $nametype; ?></button>					 
						</div>
						</br>
							<div class="panel-body">

								<table ui-jq="dataTable"  class="table table-striped b-t b-b">
									<!--encabezado tabla-->
									<thead>
										<tr>
											<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
											<th><?php echo $edit; ?></th>
											<th><?php echo $delete; ?></th>
											<?php } ?> 
											<th><?php echo $nameshipment; ?></th>
											<th><?php echo $servicename; ?></th>
											<th><?php echo $timedeliverys; ?></th>
											<th><?php echo $observaciones; ?></th>																				
										</tr>
									</thead>
									
									<?php while($row = $resultado->fetch_assoc()){ ?> 
									<tbody>
									  <tr>	
									      <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
										  <td align="center">					
										  <a href="edit-modebookings.php?id=<?php echo $row['id'];?>">
										  <img src="img/edit.png"  height="20" width="18"></a></td>
										  <td align="center">
										  <a href="deletes/delete_modebookings.php?id=<?php echo $row['id'];?>" onclick="return confirm('<?php echo $DELETESERVICE; ?>')">
										 <img src="img/delete.png"  height="20" width="18"></a>	
										 <?php } ?>										 
										  </td>
										  <td><?php echo $row['name']; ?></td>
										  <td><?php echo $row['services']; ?></td>
										  <td><?php echo $row['deliverytime']; ?></td> 
										  <td><?php echo $row['observations']; ?></td>
									  </tr>								
									</tbody>
									<?php } ?>
								</table>
								<!--fin de tabla-->						
							</div>				 
						</div>
					</div>
					</div>
				</div>
				<!-- Modal nuevo usuario -->
				<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i><?php echo $nametype; ?></h4>
					  </div>
					  <div class="modal-body">
					  <!--Cuerpo del modal aquí el formulario-->
						<form action="settings/modebookings/agregar.php"  data-parsley-validate novalidate method="post" class="form-horizontal">
						  <div class="form-group " id="gnombre">
							<label for="name" class="col-sm-4 control-label"><?php echo $nameshipment; ?></label>
							<div class="col-sm-8">
							  <input type="text" class="form-control name" parsley-trigger="change" required name="name"  placeholder="<?php echo $nameshipment; ?>">
							</div>
						  </div>
						  <div class="form-group" id="gapellido">
							<label for="services" class="col-sm-4 control-label"><?php echo $servicenames; ?></label>
							<div class="col-sm-8">
							  <input type="text" class="form-control services" parsley-trigger="change" required name="services"   placeholder="<?php echo $servicenames; ?>">
							</div>
						  </div>
						  <div class="form-group" id="gtelefono">
							<label for="delivery_time" class="col-sm-4 control-label"><?php echo $timedeliverys; ?></label>
							<div class="col-sm-8">
							  <input class="form-control delivery_time" parsley-trigger="change" required name="deliverytime" placeholder="<?php echo $timedeliverys; ?>">						
							  
							</div>
						  </div>
						  <div class="form-group" id="gemail">
							<label for="observations" class="col-sm-4 control-label"><?php echo $Observaciones; ?></label>
							<div class="col-sm-8">
							  <input type="text" class="form-control observations" parsley-trigger="change" required name="observations"  placeholder="<?php echo $Observaciones; ?>">
							</div>
						  </div>					  
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <div class="checkbox">
								<label>
								  <input type="checkbox" name="estado" value="1" checked> <?php echo $estado; ?>
								</label>
							  </div>
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
				<!--fin de modal Tipo Envio-->
  
		  </div>
		</div>
	  </div>
	</div>
	</div>
  </div>
  <!-- / content -->

</div>
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
<script src="js/delivery.js"></script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="js/parsley.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('form').parsley();
	});
</script>

</body>
</html>
