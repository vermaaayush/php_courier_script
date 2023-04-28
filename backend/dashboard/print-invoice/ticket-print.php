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
require '../requirelanguage.php';
require("barcode/barcode.class.php");
	$bar	= new BARCODE();
	
$cid= (int)$_GET['cid'];

$ss=mysql_query("SELECT * FROM courier WHERE cid=$cid");
while($rr=mysql_fetch_array($ss)){

			
$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));


?>

<!DOCTYPE html>
<html>
  <head>

    <title><?php echo $etiqueta; ?> | <?php echo $rr['letra']; ?>-<?php echo $rr['cons_no']; ?></title>
	
	<!-- Define Charset -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- Page Description and Author -->
	<meta name="description" content="<?php echo $company['description']; ?>"/>
    <meta name="keywords" content="<?php echo $company['keywords']; ?>" />
    <meta name="author" content="Jaomweb">	
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../bower_components/animate.css/animate.css" type="text/css" />
	<link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="../../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />

  </head>
  <body onload="window.print();">
    <div class="wrapper">

      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->

		
		<table class="table table-striped" style=" margin-left: auto; margin-right: auto; font-family:Arial, Helvetica, sans-serif;" border="0" width="100%" >
			<tbody>
				<tr>
					<td>						
						<p style="text-align: center;" ><center  width="100%">
							<div class="output" align="center">
								<section class="output">    
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
								</section>
							</div>
						</center></p>
						<p style="text-align: center;" ><font face="arial" color="black" size=7><?php echo $rr['letra']; ?>-<?php echo $rr['cons_no']; ?></font></p>
						<hr />
						<table style="text-align: center; table-layout:fixed;"   cellspacing="2" width="100%" >
							<tbody>
								<tr bgcolor="black" style=" border-top-color:#000000; border-right-color:#333; border-right-width:3px;border-right-style:solid;  border-collapse: collapse;">
									<td>
										<p style="text-align: center;"><font size=5 face="arial" color="white"><strong><?php echo $REMITE; ?></strong></font></p>										
									</td>
									<td>
										<p style="text-align: center;"><font size=5 face="arial" color="white"><strong><?php echo $DESTINA; ?></strong></font></p>										
									</td>
								</tr>
								<tr>
									<td align="center"  style="border-right-color:#333; border-right-width:3px;border-right-style:solid;  border-collapse: collapse;">
										<p style="text-align: center;"><strong><?php echo $code; ?>&nbsp; - <?php echo $rr['iso']; ?>-<?php echo $rr['ciudad']; ?></strong></p>
										<p style="text-align: center;"><?php echo $rr['ship_name']; ?>&nbsp;</p>
									</td>
									<td>
										<font size=4><p style="text-align: center;"><strong><?php echo $code; ?>&nbsp;- <?php echo $rr['iso1']; ?>-<?php echo $rr['city1']; ?></strong></p>
										<p style="text-align: center;"><?php echo $rr['rev_name']; ?> - <?php echo $rr['cc_r']; ?></p></font>
									</td>
								</tr>
							</tbody>
						</table>
						<table  width="100%" style="text-align: center; table-layout:fixed;">
							<tbody>
								<tr bgcolor="black">
									<td>
										<p style="text-align: center;"><font size=5 color="white"><strong><?php echo $ORIGEN; ?></strong></font></p>										
									</td>
									<td>
										<p style="text-align: center;"><font size=5 color="white"><strong><?php echo $DESTINO; ?></strong></font></p>										
									</td>
								</tr>
								<tr>
									<font size=4><td align="center"  style=" border-top-color:#000000; border-right-color:#333; border-right-width:3px;border-right-style:solid;  border-collapse: collapse;">
										<p style="text-align: center; "><?php echo $company['caddress']; ?></p>
										<p style="text-align: center;"><?php echo $company['cphone']; ?>, <?php echo $company['cemail']; ?></p>
									</td>
									<td>
										<p style="text-align: center;"><?php echo $rr['r_add']; ?></p>
										<p style="text-align: center;"><?php echo $rr['r_phone']; ?> - <?php echo $rr['telefono1']; ?>, <?php echo $rr['email']; ?></p>
									</td></font>
								</tr>
							</tbody>
						</table>
						<table    style="text-align: center; table-layout:fixed;" border="1"  width="100%">
							<tbody>
								<tr style="border: hidden;">
									<td>
										<p><strong><?php echo $PESOVOLUMEN; ?></strong></p>
										<p><font size=4><?php echo $rr['altura']; ?> X <?php echo $rr['ancho']; ?> X <?php echo $rr['longitud']; ?> - <?php echo $rr['totalpeso']; ?></font></p>
									</td>
									<td>
										<p><strong><?php echo $TERMINO; ?></strong></p>
										<p><font size=4><strong><?php echo $rr['book_mode']; ?></font></strong></p>
									</td>
								</tr>
								<tr style="border: hidden;">
									<td>
										<p><strong><?php echo $PESOFISICO; ?></strong></p>
										<p><font size=4><?php echo $rr['pesoreal']; ?></font></p>
									</td>
									<td>
										<p><strong><?php echo $PIEZAS; ?></strong></p>
										<p><font size=4><?php echo $rr['qty']; ?></font></p>
									</td>
								</tr>
							</tbody>
						</table>
						<p style="text-align: center;"><strong><?php echo $FECHAEMISION; ?></strong></p>
						<p style="text-align: center;"><font size=4><?php echo $fecha; ?>:&nbsp; <?php  $time = time(); echo date("d-m-Y ", $time); ?></font></p>
						<p style="text-align: left;"><img src="../logo-image/image_logo.php?id=1" alt="" width="150" height="39"></p>
					</td>
				</tr>
			</tbody>
		</table>
		
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="js/app.min.js" type="text/javascript"></script>
  </body>
</html>

<?php } ?>