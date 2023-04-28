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
require_once('database-settings.php');
require 'requirelanguage.php';
require_once('library.php');
$con = conexion();

date_default_timezone_set($_SESSION['ge_timezone']);
$resultado = $con->query("SELECT * FROM scheduledpickup");
isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $chargetype; ?></title>
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
				  <i class="fa fa-circle-o text-info m-r-sm pull-right"></i>
				  <h4 class="font-thin m-t-none m-b-none text-primary-lt"><?php echo $nowhere; ?></h4>
				  <span class="m-b block text-sm text-muted"></span>				 	         
					  <tr>
					  <td class="TrackTitle" valign="top"><div  align=""><h3 class="classic-title1"><span><strong></strong></span></h3>
					</tr>
					<div class="row">
							<div class="col-xs-12" align="center">
							<h2><?php echo $addcharge; ?></h2>
							<br>
							</div>
					</div>
				<p class="margin-bottom-15"><?php echo $tarife; ?></p>								  
            <div class="col-md-12">
			<form action="settings/shipping_charge/agregar.php" data-parsley-validate novalidate method="post" class="form-horizontal" enctype="multipart/form-data" >
				<table>
					<div class="row">
					 <div class="col-md-2 margin-bottom-3" >
						<label class="control-label" ><strong><?php echo $namecompany; ?></strong></label>
						<input type="text" class="form-control" parsley-trigger="change" required name="name_courier" placeholder="<?php echo $namecompanyss; ?>"><br>
											
					  </div>                 
			 
					  <div class="col-md-2 margin-bottom-3">
						<label class="control-label" ><strong><?php echo $typeser; ?></strong></label>
						<input type="text" class="form-control" parsley-trigger="change" required name="services" placeholder="<?php echo $typeser; ?>" > 
											
					  </div>
					  <div class="col-md-1 margin-bottom-3">
						<label class="control-label" ><strong><?php echo $chargetase; ?></strong></label>
						<input type="number" class="form-control" parsley-trigger="change" required name="rate" placeholder="$ Tasa" > 
											
					  </div>
					  <div class="col-md-1 margin-bottom-3">
						<label class="control-label" ><strong><?php echo $Longitud; ?></strong></label>
						<input type="number" class="form-control" parsley-trigger="change" required name="Length" placeholder="34 cm" > 
											
					  </div>
			 
					  <div class="col-md-1 margin-bottom-3">
						<label class="control-label" ><strong><?php echo $Ancho; ?></strong></label>
						<input type="number" class="form-control" parsley-trigger="change" required name="Width" placeholder="45 cm" > 
											
					  </div>
					  <div class="col-md-1 margin-bottom-3">
						<label class="control-label" ><strong><?php echo $Altura; ?></strong></label>
						<input type="number" class="form-control" parsley-trigger="change" required name="Height" placeholder="67 cm" > 
											
					  </div>
			 
					  <div class="col-md-1 margin-bottom-3">
						<label class="control-label" ><strong><?php echo $weith; ?></strong></label>
						<input type="number" class="form-control" parsley-trigger="change" required name="Weight" placeholder="10 kg/lb" > 
											
					  </div>
					  <div class="col-md-1 margin-bottom-3">
						<label class="control-label" ><strong><?php echo $weithtype; ?></strong></label>
						<select type="text" class="form-control" id="WeightType" name="WeightType" placeholder="kg/lb" >
								<option value="Kg">Kg</option>
								<option value="Lb">Lb</option>
						</select>					
					  </div>
					  <div class="col-md-2 margin-bottom-4">
						<label class="control-label" ><i class="fa fa-upload icon text-default-lter"></i>&nbsp;<strong><?php echo $companyimage; ?></strong></label>
						<input type="file" name="imagen" id="imagen"  class="form-control" />              					
					  </div>
					</div>				
					<br>
				  <div class="row templatemo-form-buttons">			  
					<div class="col-md-12">
					  <button name="Submit" type="submit"  id="submit" class="btn btn-primary"><?php echo $UPDATE; ?></button>               
					</div>
				  </div>				
				</table>
			</form>
			 <table ui-jq="dataTable"  class="table table-striped b-t b-b">
				<thead>
				  <tr>
					  <th data-toggle="true">
						  <?php echo $namecompanys; ?>
					  </th>
					  <th>
						  <?php echo $typeser; ?>
					  </th>
					  <th data-hide="phone,tablet">
						  <?php echo $chargetase; ?>
					  </th>
					  <th data-hide="phone,tablet" data-name="Date Of Birth">
						  <?php echo $Longitud; ?>
					  </th>
					  <th data-hide="phone">
						  <?php echo $Ancho; ?>	
					  </th>
					  <th data-hide="phone">
						  <?php echo $Altura; ?>
					  </th>
					  <th data-hide="phone">
						  <?php echo $weith; ?>
					  </th>
					  <th data-hide="phone">
						  <?php echo $weithtype; ?>
					  </th>
					  <th data-hide="phone">
						 <?php echo $companyimage; ?>
					  </th>
					  <th data-hide="borrar">
						<?php echo $delete; ?>
					  </th>
				  </tr>
				</thead>
				<?php while($row = $resultado->fetch_assoc()){ ?> 	
				<tbody>
				  <tr>  										  
					  <td><?php echo  $row['name_courier']; ?></td>
					  <td><?php echo  $row['services']; ?></td>
					  <td><?php echo  $row['rate']; ?></td>
					  <td><?php echo  $row['Length']; ?></td>
					  <td><?php echo  $row['Width']; ?></td>
					  <td><?php echo  $row['Height']; ?></td>
					  <td><?php echo  $row['Weight']; ?></td>
					  <td><?php echo  $row['WeightType']; ?></td>
					  <td><span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"> 
						<img src="logo-image/imagen-schedule-courier.php?cid=<?php echo $row['cid']; ?>" class="img-full" height="18" width="18" alt="...">
					  </span></td>
					  <td><a href="#" onclick="del_list_charse(<?php echo $row['cid']; ?>);">
						<img src="img/delete.png"  height="20" width="18"></a></td>
				  </tr> 	
				</tbody>
				<?php } ?>
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
<script src="js/delivery.js"></script>
	
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="js/parsley.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('form').parsley();
	});
</script>	

<script type="text/javascript">
	function del_list_charse(cid) {
		if (window.confirm("<?php echo $DELETEADMIN; ?>")) {
			window.location = "deletes/delete_list_charse.php?action=del&cid="+cid; 
		}
	}
</script>

</body>
</html>
