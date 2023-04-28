<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
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
require_once('../funciones.php');
require_once('../requirelanguage.php');
require("barcode/barcode.class.invoice.php");
	$bar	= new BARCODE();

$cid= (int)$_GET['cid'];
$tracking= (int)$_GET['tracking'];
$sql = "SELECT *
		FROM courier
		WHERE cid = $cid and tracking=$tracking";	
$result = dbQuery($sql);		
while($row = dbFetchAssoc($result)) {
extract($row);
}
$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
$fecha=date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <title><?php echo $company['cname']; ?> | <?php echo $tracking; ?></title>
	
	<!-- Define Charset -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- Page Description and Author -->
	<meta name="description" content="<?php echo $company['description']; ?>"/>
    <meta name="keywords" content="<?php echo $company['keywords']; ?>" />
    <meta name="author" content="Jaomweb">	
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/print-invoice.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="barcode.js"></script>
  </head>
  <body onload="window.print();">
    <div class="wrapper">

      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
			  <span><img src="../logo-image/image_logo.php?id=1" width="150" height="39" ></span>
              <small class="pull-right"><?php  setlocale(LC_ALL,"es_ES");
					echo strftime("%A %d de %B del %Y");  ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            <?php echo $REMITE; ?>
            <address>
              <h4><strong><?php echo $ship_name; ?></strong></h4><br>

               <b><?php echo $telefono; ?>:</b>  <?php echo $phone; ?><br/>
              <b><?php echo $direccion; ?>:</b> <?php echo $s_add; ?><br/>
			  <b><?php echo $paisorigen; ?>:</b> <?php echo $pick_time; ?><br/>
			  <b><?php echo $ciudadorigen; ?>:</b> <?php echo $ciudad; ?><br/>
			  <b><?php echo $idcliente; ?>:</b> <?php echo $cc; ?><br/>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <?php echo $DESTINA; ?>
            <address>
              <h4><strong><?php echo $rev_name; ?></strong></h4><br>
              
              <b><?php echo $telefono1; ?>:</b> <?php echo $r_phone; ?><br/>
			  <b><?php echo $telefono2; ?>:</b> <?php echo $telefono1; ?><br/>
			  <b><?php echo $direccion1; ?>:</b> <?php echo $r_add; ?><br/>
			  <b><?php echo $email1; ?>:</b> <?php echo $email; ?><br/>
              <b><?php echo $paisdestino1; ?>:</b> <?php echo $paisdestino; ?><br/>
			  <b><?php echo $ciudaddestino; ?>:</b> <?php echo $city1; ?><br/>
			  <b><?php echo $idcliente1; ?>:</b> <?php echo $cc_r; ?><br/>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
		  <table>
				<tr>
					<td>
						<center>
							<?php
								$cid= (int)$_GET['cid'];
								$cons_no= (int)$_GET['cons_no'];
								$rs = mysql_query("SELECT cid,cons_no,letra FROM courier WHERE cid=$cid");
								if($dato=mysql_fetch_array($rs)) {
									
								$numbrr = $dato['cons_no'];
								$numbrrr = $dato['letra'];
								$link = $bar->BarCode_link("CODE39", "$numbrrr-$numbrr");
								
								}
							?>
								<img src='<?php echo $link; ?>' />
						</center>
					</td>
					
				</tr>
			</table>
			<br/>
            <b><?php echo $ordenid; ?>:</b>&nbsp;&nbsp;<?php echo $cid; ?><br/>
            <b><?php echo $pesoenvio; ?>:</b>&nbsp;<?php echo $weight; ?><br/>
			<b><?php echo $metodopago; ?>:</b> <small class="label label-danger"><i class="fa fa-money"></i>&nbsp;&nbsp;<?php echo $book_mode; ?></small><br/> 
			<b><?php echo $seguroenvio; ?>:</b>&nbsp;<?php echo $company['currency']; ?>&nbsp;<?php echo $declarate; ?><br/>
          </div><!-- /.col -->		 
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><?php echo $cantidad; ?></th>
                  <th><?php echo $producto; ?></th>
                  <th><?php echo $estadoi; ?></th>
                  <th><?php echo $descripcion; ?></th>
                  <th><?php echo $subtotal; ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $qty; ?></td>
                  <td><?php echo $type; ?></td>
                  <td><small class="label label-success"><?php echo $status; ?></small></td>
                  <td><?php echo $comments; ?></td>
                  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $shipping_subtotal; ?></td>
                </tr>               
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->
		<br>
		<br>
        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead"><?php echo $metodospagos; ?>: <?php echo $payment_mode; ?></p>
            
            <?php 
             if($payment_mode=="Bitcoin")
             {
                 ?>
                <img src="../img/credit/Bitcoin-Accepted-3x1-2-1.jpg" alt="Methods payments" width="100%" />
            <?php     
             }
             elseif($payment_mode=="PayPal")
             {
                 ?>
                 <img src="../img/credit/paypal-registracziya.jpg" alt="Methods payments" width="100%" /> 
            <?php        
             }
             else
             {
                 ?>
                 <img src="../img/credit/securepayment.png" alt="Methods payments" width="100%" />
            <?php      
             }
            ?>
           
            
            
            
            
            
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              <?php echo $sucomodidad; ?>
            </p>
          </div><!-- /.col -->
          <div class="col-xs-6">
            <p class="lead"><?php echo $monto; ?></p>
            <div class="table-responsive">
              <table class="table">
                  <tr>
                  <th style="width:50%">Advance Amount:</th>
                  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $advance_price; ?></td>
                </tr>
                <tr>
                  <th style="width:50%">Pending Amount:</th>
                  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $pending_price; ?></td>
                </tr>
                <tr>
                  <th style="width:50%"><?php echo $subtotal; ?>:</th>
                  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $shipping_subtotal; ?></td>
                </tr>
                <tr>
                  <th><?php echo $total; ?>:</th>
                  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $shipping_subtotal; ?></td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="js/app.min.js" type="text/javascript"></script>
  </body>
</html>
