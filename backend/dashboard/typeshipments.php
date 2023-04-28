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
$resultado = $con->query("SELECT * FROM type_shipments");	
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $typeship; ?></title>
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
						<h2><?php echo $box; ?></h2>
						<br>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
						<!--Botones principales-->
						<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#nuevo"><i class="fa fa-user-plus"></i>
						 <?php echo $nameproduct; ?></button>						 
						</div>
						<div class="col-xs-12">
							<div class="table-responsive">
							<br>
								<!--Inicio de tabla usuarios-->
								<table ui-jq="dataTable"  class="table table-striped b-t b-b">
								<!--encabezado tabla-->
									<thead>
										<tr>
											<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
											<th><?php echo $edit; ?></th>
											<th><?php echo $delete; ?></th>
											 <?php } ?> 
											<th><?php echo $namebox; ?></th>
											<th><?php echo $typerecipient; ?></th>
											<th><?php echo $cdimension; ?></th>																	
										</tr>
									</thead>
									<tbody>
									  <tr>
										<?php while($row = $resultado->fetch_assoc()){ ?>
										  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
										  <td align="center">					
										  <a href="edit-typeshipment.php?id=<?php echo $row['id'];?>">
										  <img src="img/edit.png"  height="20" width="18"></a></td>	
										  <td align="center">
										  <a href="deletes/delete_typeshipment.php?id=<?php echo $row['id'];?>" onclick="return confirm('<?php echo $DELETEBOX; ?>')">
											<img src="img/delete.png"  height="20" width="18"></a>
										  <?php } ?> 
										  </td>
										  <td><?php echo $row['name']; ?></td>
										  <td><?php echo $row['packaging']; ?></td>
										  <td><?php echo $row['dimensions']; ?></td> 										  
									  </tr>								
									</tbody>
									 <?php } ?>
								</table>
								<!--fin de tabla-->
							</div>
						</div>
					</div>
					
					<!-- Modal nuevo usuario -->
					<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $cerrar; ?></span></button>
							<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i><?php echo $newtypebox; ?></h4>
						  </div>
						  <div class="modal-body">
						  <!--Cuerpo del modal aquí el formulario-->
						<form action="settings/typeshipments/agregar.php"  data-parsley-validate novalidate method="post" class="form-horizontal">
							  <div class="form-group " id="gnombre">
								<label for="name" class="col-sm-4 control-label"><?php echo $namebox; ?></label>
								<div class="col-sm-7">
								  <input type="text" class="form-control name" parsley-trigger="change" required name="name"  placeholder="<?php echo $namebox; ?>" required>
								</div>
							  </div>
							  <div class="form-group" id="gapellido">
								<label for="type-of-packaging" class="col-sm-4 control-label"><?php echo $typerecipient; ?></label>
								<div class="col-sm-7">
								  <input type="text" class="form-control packaging" parsley-trigger="change" required name="packaging"   placeholder="<?php echo $typerecipient; ?>" required>
								</div>
							  </div>
							  <div class="form-group" id="gtelefono">
								<label for="dimensions" class="col-sm-4 control-label"><?php echo $cdimension; ?></label>
								<div class="col-sm-7">
								  <input class="form-control dimensions" parsley-trigger="change" required name="dimensions" placeholder="<?php echo $cdimension; ?>" required>						
								  
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
					<!--fin de modal nuevo usuario-->
					
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
