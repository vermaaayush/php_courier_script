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
require_once('../library.php');
require_once('../database.php');
require '../requirelanguage.php';
require("barcode/barcode.class.invoice.php");
$bar	= new BARCODE();

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));	
date_default_timezone_set($_SESSION['ge_timezone']);
$cid= (int)$_GET['cid'];
$qname = $_SESSION['user_name']; 
isUser();											 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $facturacliente; ?></title>
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
				
			<!-- Page-Title -->
				<div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
								
								<div class="bg-light lter b-b wrapper-md hidden-print">

									<td><a href class="pull-right" onClick="window.print();">
									<img src="img/print.png" border="0" height="57" width="100"></a></td>
									 
									  <?php
											require_once('../database.php');
											$cons_no= (int)$_GET['cid'];
											$sql_2 = "SELECT * FROM courier_online WHERE cid='$cons_no'";
											$result5 = dbQuery($sql_2);		
												while($data = dbFetchAssoc($result5)) {
												extract($data);
													  
										?>
									  <a href="payments.php?shipping_subtotal=<?php echo $shipping_subtotal; ?>" class="pull-right">
									  <img src="img/checkout-with-paypal.png" border="0" height="58" width="180"></a>
									<?php } ?>
									
									<a href="#myModal<?php echo $row[cid]; ?>" data-toggle="modal" class="pull-right">
									  <img src="img/bank-tranfers.png" border="0" height="58" width="150"></a>
									<br><br>
								</div>
								<?php  
									require_once('../database.php');
									$sql = "SELECT * FROM company WHERE id='1'";
									$result4 = dbQuery($sql);		
									while($data = dbFetchAssoc($result4)) {
									extract($data);
								?>
								<div class="wrapper-md">
								  <div>
									<i><img src="../logo-image/image_logo.php?id=1"></i>
										<br>
										<div class="row">
										  <div class="col-xs-6">
											<p><?php echo $website;?></p>
											<p><?php echo $cname;?><br>
											  <?php echo $caddress;?><br>
											  
											</p>
											<p>
											  <strong><?php echo $telefono; ?>:</strong>  <?php echo $cphone;?><br>
											  <strong><?php echo $email1; ?>:</strong>  <?php echo $cemail;?>
											</p>
										  </div>
										  <?php } ?>

										<?php  
											require_once('../database.php');
											$cons_no= (int)$_GET['cid'];
												$sql_1 = "SELECT * FROM courier_online WHERE cid = '$cons_no' ";
												$result4 = dbQuery($sql_1);		
											while($data = dbFetchAssoc($result4)) {
												extract($data);
										?>			  
										  <div class="col-xs-6 text-right">

											<?php
												$cid= (int)$_GET['cid'];
												$cons_no= (int)$_GET['cons_no'];
												$rs = mysql_query("SELECT cid,cons_no FROM courier_online WHERE cid=$cid");
												if($dato=mysql_fetch_array($rs)) {
													
												$numbrr = $dato['cons_no'];
												$link = $bar->BarCode_link("CODE39", "$numbrr");
												
												}
											?>
											<img src='<?php echo $link; ?>' />
															
											<br><br>										
											<p align="right"><?php echo $FECHA; ?>: <?php echo date("F j, Y"); ?></p>           
										  </div>
										  <?php } ?>
										</div>
	 
											<?php  					
											   $result5 = mysql_query("SELECT * FROM tbl_clients where email='$qname'");
												while($row = mysql_fetch_array($result5)) {							
											?>	
											<div class="col-xs-6">
											  <strong><?php echo $A; ?>:</strong>
											  <h4><?php echo $row ["name"]; ?></h4>
											  <p>
												<strong><?php echo $direccion; ?>:</strong><?php echo $row ["address"]; ?><br>
												<strong><?php echo $telefono; ?>:</strong><?php echo $row ["phone"]; ?><br>
												<strong><?php echo $email1; ?>:</strong><?php echo $row ["email"]; ?><br>
											  </p>
											</div>
											<?php } ?>
									
										<?php  					
										   $result3 = mysql_query("SELECT * FROM courier_online  where status='In_Transit' and cid='$cid'");
											while($row = mysql_fetch_array($result3)) {							
										?>
										<p class="m-t m-b">
											<?php echo $ordenestado; ?>: <span class="label bg-success"><?php echo $row ["status"]; ?></span><br>
											<?php echo $ordenid; ?>: <strong><?php echo $row ["cid"]; ?></strong>
										</p>
										<?php } ?>
										<?php  					
										   $result4 = mysql_query("SELECT * FROM courier_online  where cid='$cid'");
											while($row = mysql_fetch_array($result4)) {							
										?>  
										<p class="m-t m-b">
											<?php echo $fechaorden; ?>: <strong><?php echo $row ["deliverydate"]; ?></strong>
										</p>
										<?php } ?>								
										<table class="table table-striped bg-white b-a">
											<thead>
												<tr>
												  <th><?php echo $CANTIDAD; ?></th>
												  <th><?php echo $PESO; ?></th>
												  <th><?php echo $KG; ?></th>
												  <th><?php echo $ID; ?></th>
												  <th><?php echo $DESCRIPCION; ?></th>
												   <th><?php echo $PRECIO; ?></th>
												  <th><?php echo $ENVIADOA; ?></th>	
												  <th><?php echo $SUBTOTAL; ?></th>
												</tr>
											</thead>
											<tbody>
											  <?php
												require_once('../database.php');
												$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
												$result1 =  mysql_query("SELECT * FROM courier_online where email='$qname' AND payment='Pending' AND cid = '$cid'");
												while($row = mysql_fetch_array($result1)) {		

												?>
												<tr>
												  <td><?php echo $row ["Qnty"]; ?></td>
												  <td><?php echo $row ["weight"]; ?></td>
												   <td><?php echo $company['currency']; ?>&nbsp;<?php echo $row ["variable"]; ?></td>
												  <td><?php echo $row ["cons_no"]; ?></td>
												  <td><?php echo $row ["note"]; ?></td>
												  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $row ["shipping_subtotal"]; ?></td>
												  <td><?php echo $row ["tcity"]; ?></td>										  
												  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $row ["shipping_subtotal"]; ?></td>
												</tr>				
												<tr>
												  <td colspan="7" class="text-right"><strong><?php echo $subtotal; ?></strong></td>
												  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $row ["shipping_subtotal"]; ?></td>
												</tr>
												<tr>
												  <td colspan="7" class="text-right no-border"><strong><?php echo $total; ?></strong></td>
												  <td><strong><?php echo $company['currency']; ?>&nbsp;<?php echo $row ["shipping_subtotal"]; ?></strong></td>
												</tr>
												  <?php } ?>
											</tbody>
										</table> 
										<div class="col-xs-6">
										<p class="lead"><?php echo $metodospagos; ?>:</p>
										<img src="../img/credit/securepayment.png" alt="Methods payments" />           									
									  </div>
								  </div>
								</div>
 							</div>
                    </div><!-- end col-->
                </div>
                <!-- end row -->
				
				<!-- sample modal content -->
				<div id="myModal<?php echo $row['cid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" id="myModalLabel"><?php echo $DETAILBANK; ?></h4>
								<br>
								<hr>
								<h5><?php echo $REALIZAPAY; ?></h5></br>
								<?php echo $namebank; ?>: <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $company['smtp']; ?></strong></br>
								<?php echo $nameaccoung; ?>: <strong><?php echo $company['smtphost']; ?></strong> </br>
								<?php echo $numberaccoung; ?>: <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $company['smtpuser']; ?></strong></p>
								<hr>
							</div>
							<div class="modal-body">
								<h4 class="header-title m-t-0 m-b-20"><?php echo $sendpay; ?></h4>
								<br>								
								<div class="text-xs-center">
								
									<div class="p-10">
										<div class="form-group clearfix">
											<form action="config.inc.php?action=update-bank&cid=<?php echo $cid; ?>" enctype="multipart/form-data" method="post">
											<fieldset class="form-group">
												<?php  
														require_once('../database.php');
														$cons_no= (int)$_GET['cid'];
															$sql_2 = "SELECT * FROM courier_online WHERE cid = '$cons_no' ";
															$result5 = dbQuery($sql_2);		
														while($data = dbFetchAssoc($result5)) {
															extract($data);
												?>	
											    <div class="form-group">
													<label for="address" class="col-sm-2 control-label"><?php echo $numbersend; ?></label>
													<div class="col-sm-5">
													  <input type="text"  name="cons_no" class="form-control cons_no" value="<?php echo $cons_no; ?>" readonly="true">
													</div>
													<div class="col-sm-5">
													  <input class="form-control office" name="office" value="<?php echo $_SESSION['user_name'] ;?>" readonly="true">																  
													</div>
												</div>
												<?php } ?>
											</fieldset>
											<label for="zipcode" class="control-label"><i class="fa fa-upload icon text-default-lter"></i>&nbsp;<?php echo $uploadfile; ?></label>
											<input type="file" name="imagen" id="imagen" class="form-control" />
											<br><br>
											<div class="alert alert-danger alert-dismissible fade in" role="alert">
												<button type="button" class="close" data-dismiss="alert"
														aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<?php echo $filepermitidos; ?>
											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><?php echo $CERRAR; ?></button>
											<button type="submit" name="guardar" class="btn btn-info-outline waves-effect waves-light"><?php echo $UPLOADFILE; ?></button>
											</div>
											<br><br>
											</form>
										</div>
									</div>
									<br>									
								</div>
							</div>
								
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				
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
<script type="text/javascript">
	function printInfo(ele) {
	var prtContent = document.getElementById("printarea");
	var WinPrint = window.open('', '', 'letf=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
	}
</script>
 
</body>
</html>