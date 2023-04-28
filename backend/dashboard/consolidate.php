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
		$id=limpiar($_GET['del']);
		mysql_query("DELETE FROM caja_tmp WHERE id='$id'");
		header("Location: consolidate.php");
	}
isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $lconso; ?></title>
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
																$pa=mysql_query("SELECT tracking FROM  courier 
																");				
																while($row=mysql_fetch_array($pa)){
																	echo '<option value="'.$row['tracking'].'">';
																}
															?> 
														</datalist>
													</form>
												</div>
												<div class="col-sm-2 form-group">
													<center><a href="consolidate_report.php" class="btn btn-primary"><i class="icon-list"></i> <strong><?php echo $xexcel; ?></strong></a></center>
														
															
												</div>
											</div>
										</td>
									  </tr>
									</table>
									<?php
										
										$user=$_SESSION['user_name'];
										if(!empty($_POST['buscar'])){
											$buscar=limpiar($_POST['buscar']);
											$poa=mysql_query("SELECT tracking,ship_name,rev_name,r_phone,altura,ancho,longitud,totalpeso,pesoreal,status,pick_date,type,paisdestino,iso1,city1,r_add,cc_r,telefono1,comments FROM courier 
											WHERE  (tracking='$buscar' or ship_name='$buscar') GROUP BY ship_name");	
											if($roow=mysql_fetch_array($poa)){
												$tracking=$roow['tracking'];
												$ship_name=$roow['ship_name'];
												$rev_name=$roow['rev_name'];
												$r_phone=$roow['r_phone'];
												$altura=$roow['altura'];
												$ancho=$roow['ancho'];
												$longitud=$roow['longitud'];
												$totalpeso=$roow['totalpeso'];
												$pesoreal=$roow['pesoreal'];							
												$status=$roow['status'];
												$pick_date=$roow['pick_date'];
												$type=$roow['type'];
												$paisdestino=$roow['paisdestino'];
												$iso1=$roow['iso1'];
												$city1=$roow['city1'];
												$r_add=$roow['r_add'];
												$cc_r=$roow['cc_r'];
												$telefono1=$roow['telefono1'];
												$comments=$roow['comments'];
												$pa=mysql_query("SELECT * FROM caja_tmp WHERE track='$tracking' and user='$user' and name='$ship_name'");	
												if($row=mysql_fetch_array($pa)){								
													$name=$row['name'];
													$destina=$row['destina'];
													$telefono=$row['telefono'];
													$alturas=$row['alturas'];
													$anchos=$row['anchos'];
													$longituds=$row['longituds'];
													$total=$row['total'];
													$totalreal=$row['totalreal'];								
													$estado=$roow['estado'];
													$fecha=$roow['fecha'];
													$tipo=$roow['tipo'];
													$destino=$roow['destino'];
													$code1=$roow['code1'];
													$ciudad=$roow['ciudad'];
													$dirdesti=$roow['dirdesti'];
													$cc_d=$roow['cc_d'];
													$teledes=$roow['teledes'];
													$nota=$roow['nota'];
												}else{
													mysql_query("INSERT INTO caja_tmp (track,name,destina,telefono,alturas,anchos,longituds,total,totalreal,estado,fecha,tipo,destino,code1,ciudad,dirdesti,cc_d,teledes,nota, user) VALUES ('$tracking','$ship_name','$rev_name','$r_phone','$altura','$ancho','$longitud','$totalpeso','$pesoreal','$status','$pick_date','$type','$paisdestino','$iso1','$city1','$r_add','$cc_r','$telefono1','$comments','$user')");	
												}
											}else{
												echo $mensages;	
											}
										}
									?>
									<div class="row-fluid">
										<div class="col-sm-10 form-group">
											<div style="width:100%; height:300px; overflow: auto;">
											<table class="table table-bordered">
												<tr class="well">
													<td><strong><center><?php echo $TRACK; ?></center></strong></td>
													<td><strong><center><?php echo $REMITE; ?></center></strong></td>
													<td><strong><center><?php echo $DESTINA; ?></center></strong></td>
													<td><strong><center><?php echo $DIRECCION; ?></center></strong></td>
													<td><strong><center><?php echo $PAISDESTINO; ?></center></strong></td>
													<td><strong><center><?php echo $TELEFONO; ?></center></strong></td>
													<td><strong><div align="right"><?php echo $TOTAL; ?></div></strong></td>
													<td></td>
												</tr>
												<?php 
													$neto=0;$item=0;$neto1=0;$item1=0;$neto2=0;$item2=0;$neto3=0;$item3=0;
													$sql="SELECT id,tracking,name,destina,dirdesti,destino,telefono,alturas,anchos,longituds,total,totalreal FROM caja_tmp, courier WHERE track=courier.tracking";	
													$resul1 = mysql_query ( $sql )  or die ( mysql_error ());
													while($row=mysql_fetch_array($resul1)){
														$item=$item+$row['total'];$item1=$item1+$row['alturas'];$item2=$item2+$row['anchos'];$item3=$item3+$row['longituds'];
														$item4=$item4+$row['totalreal'];
														$neto=$item;
														$neto1=$item1;
														$neto2=$item2;
														$neto3=$item3;
														$neto4=$item4;
														
												?>
												<tr>
													<td><center><?php echo $row['tracking']; ?></center></td>
													<td><center><?php echo $row['name']; ?></center></td>
													<td><center><?php echo $row['destina']; ?></center></td>
													<td><center><?php echo $row['dirdesti']; ?></center></td>
													<td><center><?php echo  $row['destino']; ?></center></td>
													<td><center><?php echo $row['telefono']; ?></center></td>								
													<td><div align="right"><?php echo $row['total']; ?></div></td>
													<td>
														<center>
															<a href="consolidate.php?del=<?php echo $row['id']; ?>" class="btn btn-primary"  title="<?php echo $RLISTADO; ?>">
																<i class="fa fa-trash-o"></i>
															</a>
														</center>
													</td>
												</tr>
												
												<?php } ?>
											</table>
											</div>
										</div>
										<div class="col-sm-2 form-group">
											<table class="table table-bordered">
												<tr>
													<td>
														<center><strong><?php echo $preal; ?></strong>
														<pre><h2 class="text-success" align="center"><?php echo $company['currency']; ?>&nbsp;<?php echo formato($neto4); ?></h2></pre>
														<strong><?php echo $numberpackage; ?>: <br><span class="badge badge-success">
														<?php
															// primero conectamos siempre a la base de datos mysql
															$sql1 = "SELECT * FROM caja_tmp";  // sentencia sql
															$result1 = mysql_query($sql1);
															$paquetes = mysql_num_rows($result1); // obtenemos el n�mero de filas
															echo ''.$paquetes.'';  // imprimos en pantalla el n�mero generado
															?>
														</span></strong></center>
														</br>
														<center><strong><?php echo $cdimension; ?>: <br><span class="text-success">
														<?php echo $neto1; ?> x <?php echo $neto2; ?> x <?php echo $neto3; ?>
														</span></strong></center>
													</td>
												</tr>
											</table>
											
											<table class="table table-bordered">
												<tr>
													<td>
														<div align="center">
															<a href="#con-close-modal" role="button" class="btn btn-success" data-toggle="modal">
																<i class="icon-shopping-cart"></i> <strong><?php echo $pconsolidado; ?></strong>
															</a>
														</div>
													</td>
												</tr>
											</table>
											
										</div>
									</div>
									
								</td>
							  </tr>
						</div>

					<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog">				
							<div class="modal-content">
							<form name="contado" action="consolidate_proccess.php" method="post">
								<div class="modal-header"> 
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
									<h3 class="modal-title"><?php echo $updateconso; ?></h3> 
								</div> 
								<div class="modal-body">
									<div class="row">
										<div class="col-md-2"> 
											<div class="form-group"> 
												<label for="field-2" class="control-label">*</label> 
												<input value="COEE" class="form-control" >													
											</div> 
										</div> 
										<div class="col-md-4"> 
											<div class="form-group"> 
												<label for="field-1" class="control-label"><?php echo $CONTENEDOR; ?>:</label> 
												<?php
													$sql2=mysql_query("SELECT MAX(econtenedor)as maximo FROM consolidate WHERE user='$user'");				
													if($row=mysql_fetch_array($sql2)){
													if($row['maximo']==NULL){
														$econtenedor='100000001';
													}else{
														$econtenedor=$row['maximo']+1;
													}
													}
											?>			
												<input  name="econtenedor" value="<?php echo "".$econtenedor; ?>" class="form-control">
											</div> 
										</div> 
										<div class="col-md-6"> 
											<div class="form-group"> 
												<label for="field-2" class="control-label"><?php echo $SELLO; ?></label> 
												<input name="master" class="form-control" placeholder="00-00000">													
											</div> 
										</div> 
									</div> 
									<div class="row"> 										
										<div class="col-md-2" style="display:none">
											<div class="form-group"> 
												<label for="field-2" class="control-label">Altura</label> 
												<input name="neto1" value="<?php echo $neto1; ?>" class="form-control" >													
											</div>
										</div>
										<div class="col-md-2" style="display:none">
											<div class="form-group"> 
												<label for="field-2" class="control-label">Ancho</label> 
												<input name="neto2" value="<?php echo $neto2; ?>" class="form-control" >													
											</div>
										</div>	
										<div class="col-md-2" style="display:none">
											<div class="form-group"> 
												<label for="field-2" class="control-label">Longitud</label> 
												<input name="neto3" value="<?php echo $neto3; ?>" class="form-control" >													
											</div>											
										</div>
										<div class="col-md-2" style="display:none"> 
											<div class="form-group"> 
												<label for="field-2" class="control-label">P. Volumen</label> 
												<input name="neto" value="<?php echo $neto; ?>" class="form-control" >													
											</div>
										</div>
										<div class="col-md-2" style="display:none"> 
											<div class="form-group"> 
												<label for="field-2" class="control-label">Peso Fisico</label> 
												<input name="neto4" value="<?php echo $neto4; ?>" class="form-control" >													
											</div>
										</div>
										<div class="col-md-2" style="display:none"> 
											<div class="form-group"> 
												<label for="field-2" class="control-label">Paquetes</label> 
												<input name="paquetes" value="<?php echo $paquetes; ?>" class="form-control" >													
											</div> 
										</div>
 										<div class="col-md-4" > 
											<div class="form-group"> 
												<label for="field-2" class="control-label"><?php echo $cciudad; ?></label> 
												<input name="ciudad" value="<?php echo $ciudad; ?>" class="form-control" >													
											</div> 
										</div> 
										<div class="col-md-8"> 
											<div class="form-group"> 
												<label for="field-3" class="control-label"><?php echo $COMENTARIOS; ?></label> 
												<textarea class="form-control" name="comentario"  placeholder="Añadir comentario del cambio de estado" required></textarea> 
											</div> 
										</div> 
									</div>  
								</div> 
								<div class="modal-footer" id="contenido"> 
									<button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $CCERRAR; ?></button> 
									<input name="submit" type="submit" class="btn btn-success" value="<?php echo $GGUARDAR; ?>"></a>
								</div>
							</form>	
							</div>				
						</div>
					</div><!-- /.modal -->
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
