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

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
date_default_timezone_set($_SESSION['ge_timezone']);

$user=$_SESSION['cod_name'];
if(!empty($_GET['del'])){
		$idi=limpiar($_GET['del']);
		mysql_query("DELETE FROM consolidado_tmp WHERE idi='$idi'");
		header("Location: consolidate_report.php");
	}	
isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $reportconso; ?></title>
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
						<h4><i class="icon-plane"></i><strong><?php echo $LISTACONSO; ?></strong></a></h4>
						<br>
						<div align="center">
							  <tr>
								<td></br>
									<table class="table table-bordered">
									  <tr>
										<td>
											<div class="row-fluid">
												<div class="col-sm-10 form-group">
													<form name="form2" action="" method="post">
														<strong><?php echo $codeproducto; ?></strong><br>
														<input type="text" autofocus list="browsers" name="buscar" autocomplete="off" class="form-control" required>
														<datalist id="browsers">
															<?php
																$pa=mysql_query("SELECT track FROM  consolidate 
																");				
																while($row=mysql_fetch_array($pa)){
																	echo '<option value="'.$row['track'].'">';
																}
															?> 
														</datalist>
													</form>
												</div>
											</div>
										</td>
									  </tr>
									</table>
									<?php
										
										$user=$_SESSION['user_name'];
										if(!empty($_POST['buscar'])){
											$buscar=limpiar($_POST['buscar']);
											$poa=mysql_query("SELECT cons_no,etrack,track,master,total,destina,dirdesti,code1,ciudad,telefono,teledes,cc_d,comentario,neto FROM consolidate 
											WHERE  (track='$buscar' or cons_no='$buscar') GROUP BY cons_no");	
											if($roow=mysql_fetch_array($poa)){
												$cons_no=$roow['cons_no'];
												$etrack=$roow['etrack'];												
												$track=$roow['track'];
												$master=$roow['master'];
												$total=$roow['total'];
												$destina=$roow['destina'];
												$dirdesti=$roow['dirdesti'];
												$code1=$roow['code1'];
												$ciudad=$roow['ciudad'];
												$telefono=$roow['telefono'];							
												$teledes=$roow['teledes'];
												$cc_d=$roow['cc_d'];
												$comentario=$roow['comentario'];
												$neto=$roow['neto'];
												
												$pa=mysql_query("SELECT cons_noi,tracki,trackingi,masteri,totali,destinai,dirdestii,code1i,ciudadi,telefonoi,teledesi,cc_di,comentarioi,netoi FROM consolidado_tmp WHERE trackingi='$track' and cons_noi='$cons_no'");	
												if($row=mysql_fetch_array($pa)){
													$cons_noi=$row['cons_noi'];
													$trackingi=$row['trackingi'];
													$masteri=$row['masteri'];
													$totali=$row['totali'];
													$destinai=$row['destinai'];
													$dirdestii=$row['dirdestii'];
													$code1i=$row['code1i'];
													$ciudadi=$row['ciudadi'];
													$telefonoi=$row['telefonoi'];								
													$teledesi=$roow['teledesi'];
													$cc_di=$roow['cc_di'];
													$comentarioi=$roow['comentarioi'];
													$netoi=$roow['netoi'];													
												}else{
													mysql_query("INSERT INTO consolidado_tmp (cons_noi,tracki,trackingi,masteri,totali,destinai,dirdestii,code1i,ciudadi,telefonoi,teledesi,cc_di,comentarioi,netoi, user) VALUES ('$cons_no','$etrack','$track','$master','$total','$destina','$dirdesti','$code1','$ciudad','$telefono','$teledes','$cc_d','$comentario','$neto','$user')");	
												}
											}else{
												echo $mensages;	
											}
										}
									?>
									<div class="row-fluid">
										<div class="col-sm-9 form-group">
											<table class="table table-bordered">
												<tr class="well">
													<td><strong><center><?php echo $CONTENEDOR; ?></center></strong></td>
													<td><strong><center><?php echo $SELLO; ?></center></strong></td>
													<td><strong><center><?php echo $GUIA; ?></center></strong></td>
													<td><strong><center><?php echo $PESO; ?></center></strong></td>
													<td><strong><center><?php echo $NOMBRE; ?></center></strong></td>
													<td><strong><center><?php echo $CIUDAD; ?></center></strong></td>
													<td><strong><div align="right"><?php echo $TPESO; ?></div></strong></td>
													<td></td>
												</tr>
												<?php 
													$neto=0;													
														$resul1=mysql_query("SELECT idi,etrack,masteri,trackingi,totali,destinai,ciudadi,netoi FROM consolidado_tmp, consolidate WHERE trackingi=consolidate.track");	
														while($row=mysql_fetch_array($resul1)){
															$neto=$neto+$row['netoi'];	
												?>
												<tr>

													<td><center><?php echo $row['etrack']; ?></center></td>
													<td><center><?php echo $row['masteri']; ?></center></td>
													<td><center><?php echo $row['trackingi']; ?></center></td>
													<td><center><?php echo $row['totali']; ?></center></td>
													<td><center><?php echo $row['destinai']; ?></center></td>
													<td><center><?php echo $row['ciudadi']; ?></center></td>								
													<td><div align="right"><?php echo $row['netoi']; ?></div></td>
													<td>
														<center>
															<a href="consolidate_report.php?del=<?php echo $row['idi']; ?>" class="btn btn-primary"  title="Remover de la Lista de Consolidados">
																<i class="fa fa-trash-o"></i>
															</a>
														</center>
													</td>
												</tr>
												<?php } ?>
												<tr>
													<td colspan="6"><div align="right"><strong>Total:</strong> </div></td>
													<td><div align="right"><strong><?php echo $company['currency']; ?>&nbsp; <?php echo number_format($neto); ?></strong></div></td>
												</tr>												
											</table>
										</div>
										<div class="col-sm-3 form-group">
											<table class="table table-bordered">
												<tr>
													<td>
														<center><strong><?php echo $tpeso; ?></strong>
														<pre><h2 class="text-success" align="center"><?php echo $company['currency']; ?>&nbsp;<?php echo number_format($neto); ?></h2></pre>
														<strong><?php echo $numberpackage; ?>: <br><span class="badge badge-success">
														<?php
															// primero conectamos siempre a la base de datos mysql
															$sql1 = "SELECT * FROM consolidado_tmp";  // sentencia sql
															$result1 = mysql_query($sql1);
															$paquetes = mysql_num_rows($result1); // obtenemos el n�mero de filas
															echo ''.$paquetes.'';  // imprimos en pantalla el n�mero generado
															?>
														</span></strong></center>
													</td>
												</tr>
											</table>
											
											<table class="table table-bordered">
												<tr>
													<td>
														<div align="center">
														
															<?php
															
																
																$url='Contenedor='.$etrack;
																echo '<center><a href="reports_excel/reporte_consolidado.php?'.$url.'" class="btn btn-primary"><i class="icon-list"></i> <strong>'.$imprimirreporte.' </strong></a></center>';
																
															?>
															</br>
															 <form method="POST" action="borrar-consolidados.php"> 
																<input type="submit" value="<?php echo $btabla; ?>" class="btn btn-danger" name="B1">
															</form>
														</div>
													</td>
												</tr>
											</table>
											
										</div>
									</div>
									
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
<script type="text/javascript">
            function cambiarcont(pagina) {
                       $("#contenido").load(pagina);
            }
</script>
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
<script src="assets/notifications/notify.min.js"></script>
<script src="assets/notifications/notify-metro.js"></script>
<script src="assets/notifications/notifications.js"></script>

</body>
</html>
