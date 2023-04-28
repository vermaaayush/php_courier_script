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
require("barcode/barcode.class.php");
	$bar	= new BARCODE();
	
$etrack= (int)$_GET['etrack'];
$id= (int)$_GET['id'];
$cons_no= $_GET['cons_no'];
$neto=0;$item=0;
$sql="SELECT * FROM consolidate WHERE id=$id AND track=$etrack";
$resul1 = mysql_query ( $sql )  or die ( mysql_error ());
while($rr=mysql_fetch_array($resul1)){

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
?>

<!DOCTYPE html>
<html>
  <head>

    <title>Etiqueta | <?php echo $rr['etrack']; ?></title>
	
	<!-- Define Charset -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- Page Description and Author -->
    <meta name="description" content="<?php echo $company['description']; ?>"/>
    <meta name="keywords" content="<?php echo $company['keywords']; ?>" />
    <meta name="author" content="Jaomweb">	
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />	
	
    <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
	  <link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
	  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
	  <link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />

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
						<table style="text-align: center; table-layout:fixed;"   cellspacing="2" width="100%" >
							<tbody>
								<tr>
									<td align="center" >
										<p style="text-align: center;" ><font face="arial"><span style="font-size:55pt;"><?php echo $rr['code1']; ?>.<?php echo $rr['ciudad']; ?></span></font></p>
									</td>
								</tr>
							</tbody>
						</table>					
						<p style="text-align: center;" ><center  width="100%">
							<div class="output" align="center">
								<section class="output">    
									<?php
										$etrack= $_GET['etrack'];
										$id= (int)$_GET['id'];
										$cons_no= (int)$_GET['cons_no'];
										$rs = mysql_query("SELECT id,etrack FROM consolidate WHERE id=$id");
										if($dato=mysql_fetch_array($rs)) {
											
										$numbrr = $dato['etrack'];
										$link = $bar->BarCode_link("CODE39", "$numbrr");
										
										}
									?>
										<img src='<?php echo $link; ?>' />
								</section>
							</div>
						</center></p>						
						<hr />
						<table style="text-align: center; table-layout:fixed;"   cellspacing="2" width="100%" >
							<tbody>
								<tr>
									<td align="center" >
										<p style="text-align: center;" ><font face="arial" color="black" size=10><?php echo $rr['etrack']; ?></font></p>
									</td>
								</tr>
							</tbody>
						</table>
						<hr />
						<table  style="text-align: center; table-layout:fixed;" cellspacing="2" width="100%">
							<tbody>
								<tr>
									<td align="center">
										<p style="text-align: center; "><font face="arial" color="black" size=10><span style="font-size:20pt;">SELLOS (1)</span></font></p>
									</td>									
								</tr>
							</tbody>
						</table>
						<table  width="100%" style="text-align: center; table-layout:fixed;">
							<tbody>
								<tr>
									<td align="center">
										<p style="text-align: center; "><strong><font face="arial"><span style="font-size:45pt;"><?php echo $rr['master']; ?></span></font></strong></p>
									</td>									
								</tr>
							</tbody>
						</table>
						<table    style="text-align: center; table-layout:fixed;" border="1"  width="100%">
							<tbody>
								<tr>
									<td>
										<p><strong>PACKAGES</strong></p>
										<p><font size=4><?php echo $rr['paquetes']; ?></font></p>
									</td>
									<td>
										<p><strong>DIMENSIONS</strong></p>
										<p><font size=4><strong><?php echo $rr['neto1']; ?> x <?php echo $rr['neto2']; ?> x <?php echo $rr['neto3']; ?></font></strong></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><strong>WEIGHT F&Iacute;SICO</strong></p>
										<p><font size=4><?php echo $rr['neto4']; ?></font></p>
									</td>
									<td>
										<p><strong>WEIGHT VOLUME</strong></p>
										<p><font size=4><?php echo $rr['neto']; ?></font></p>
									</td>
								</tr>
							</tbody>
						</table>
						<p style="text-align: center;"><font size=4>Date:&nbsp; <?php  $time = time(); echo date("d-m-Y ", $time); ?></font></p>
						<p style="text-align: left;"><img src="../logo-image/image_logo.php?id=1" alt="" height="45" width="241"></p>
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