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
require_once('../database.php');
require_once('../database-settings.php');
require_once('../library.php');
require '../requirelanguage.php';
$con = conexion();

$id=$_GET['id'];	
$resultado = $con->query("SELECT id, name,email,phone,company,state,imagen,tipo_imagen FROM tbl_clients WHERE id='$id'");
isUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $managercustomer; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />

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
							<div class="col-xs-12">
							<!--Botones principales-->

							<h3><?php echo $infouser; ?>:</h3>
							 
							</div>
							<div class="col-xs-12">
								<div class="table-responsive">
								<br>
								<!--Inicio de tabla usuarios-->
									
								<table ui-jq="dataTable" class="table table-striped b-t b-b">
									<thead>
									  <tr>								
										<th><?php echo $edit; ?></th>	
										<th><?php echo $perfilcli; ?></th>
										<th><?php echo $namecli; ?></th>
										<th><?php echo $email1; ?></th>
										<th><?php echo $telefono; ?>o</th>
										<th><?php echo $namecompanys; ?></th>
										<th><?php echo $ciudad; ?></th>
									  </tr>
									</thead>								
									<tbody>
									  <tr>
										<?php while($row = $resultado->fetch_assoc()){ ?> 
										  <td align="center">					
										  <a href="profile_customer.php?id=<?php echo $row['id'];?>">
										  <img src="../img/edit.png"  height="25" width="20"></a></td>	
										  <td align="center">
											<span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"> 
											  <img src="../logo-image/imagen-customer.php?id=<?php echo $row['id']; ?>" class="img-full" height="18" width="18" alt="...">
											</span>
										  </td>
										  <td><?php echo $row['name']; ?></td>
										  <td><?php echo $row['email']; ?></td>
										  <td><?php echo $row['phone']; ?></td>
										  <td><?php echo $row['company']; ?></td> 
										   <td><?php echo $row['state']; ?></td>									            
									  </tr>								
									</tbody>
									<?php } ?>
								</table>
								</div>
							</div>
						</div>					   
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
include("../footer.php");
?>
  <!-- / footer -->

</div>

<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../js/ui-load.js"></script>
<script src="../js/ui-jp.config.js"></script>
<script src="../js/ui-jp.js"></script>
<script src="../js/ui-nav.js"></script>
<script src="../js/ui-toggle.js"></script>

</body>
</html>