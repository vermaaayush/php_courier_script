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
require_once('database.php');
require_once('library.php');
require_once('funciones.php');
require 'requirelanguage.php';
require("barcode/barcode.class.php");
$bar	= new BARCODE();

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
date_default_timezone_set($_SESSION['ge_timezone']);
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $pconso; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta HTTP-EQUIV="Refresh" CONTENT="1; URL=consolidate_proccess.php">


  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />
  

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
			<div class="col-sm-12">
				<div class="card-box table-responsive">
					<div align="center">
						  <tr>
							<td></br></br>
								<table class="table table-bordered">
								  <tr class="well">
									<td><h2 align="center"><?php echo $PRINTCONSO; ?></h2></td>
								  </tr>
								</table>
								
								<div class="row-fluid">
									<div class="col-sm-6 form-group">
										<table class="table table-bordered">
											<tr>
												<td>
													<center>
													<div id="imprimeme">
														<table width="95%">
															<tr>
																<td>
																	<center>
																		<?php  					
																			$result3 = mysql_query("SELECT * FROM consolidate ORDER BY id DESC LIMIT 1");
																			while($row = mysql_fetch_array($result3)) {					
																		?> 
																			<a target="_blank" href="print-invoice/consolidado-print.php?id=<?php echo $row['id']; ?>">
																			<img src="img/print-consolidate.jpg"  height="240" width="240"></a>
																		<?php } ?>	
																	</center>
																</td>																
															</tr>
														</table>
														
													</div>
													</center>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<?php 
										######## GUARDAMOS LA INFORMACION DE LA FACTURA
											if(!empty($_POST['econtenedor'])){
												$econtenedor= limpiar($_POST['econtenedor']);
												$master= limpiar($_POST['master']);
												$comentario= limpiar($_POST['comentario']);
												$fecha_status=date('Y-m-d');
												$user=$_SESSION['user_name'];
												
												$sql1=mysql_query("SELECT MAX(cons_no)as id_maximo FROM consolidate WHERE user='$user'");				
													if($row=mysql_fetch_array($sql1)){
													if($row['id_maximo']==NULL){
														$cons_no='1';
													}else{
														$cons_no=$row['id_maximo']+1;
													}
													}	
												
													
												$ss=mysql_query("SELECT * FROM caja_tmp WHERE user='$user'");
												while($row=mysql_fetch_array($ss)){
													$econtenedor= $_POST['econtenedor'];
													$master= $_POST['master'];
													$comentario= $_POST['comentario'];
													$fecha_status=date('Y-m-d');
													$user=$_SESSION['user_name'];	
													$netoO= $_POST['neto'];
													$neto=$netoO;
													$paquetess= $_POST['paquetes'];
													$paquetes=$paquetess;
													$neto11= $_POST['neto1'];
													$neto1=$neto11;
													$neto22= $_POST['neto2'];
													$neto2=$neto22;
													$neto33= $_POST['neto3'];
													$neto3=$neto33;
													$neto34= $_POST['neto4'];
													$neto4=$neto34;
													mysql_query("INSERT INTO consolidate (cons_no,track,name,destina,telefono,total,neto1,neto2,neto3,neto,totalreal,neto4,paquetes,estado,fecha,tipo,destino,code1,ciudad,dirdesti,cc_d,teledes,nota, fecha_status,econtenedor,etrack,master,comentario,user) VALUES 
													('$cons_no','".$row['track']."','".$row['name']."','".$row['destina']."','".$row['telefono']."','".$row['total']."','$neto1','$neto2','$neto3','$neto','".$row['totalreal']."','$neto4','$paquetes','".$row['estado']."','".$row['fecha']."','".$row['tipo']."','".$row['destino']."','".$row['code1']."','".$row['ciudad']."','".$row['dirdesti']."','".$row['cc_d']."','".$row['teledes']."','".$row['nota']."','$fecha_status','$econtenedor','COEE-$econtenedor','$master','$comentario','$user')");
													
												}	
													
											}											
											
											
										mysql_query("DELETE FROM caja_tmp WHERE user='$user'");
									?>
							</td>
						  </tr>
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

</body>
</html>
