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
require_once('../funciones.php');
require '../requirelanguage.php';

date_default_timezone_set($_SESSION['ge_timezone']);
$cons = $_POST['cons'];
$qname = $_SESSION['user_name']; 

$styling=mysql_fetch_array(mysql_query("SELECT * FROM styles")); 
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $Paneladministracioncliente; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
  
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />
  <script type="text/javascript" charset="utf8">
  $(document).ready(function () {
        $('#grid').DataTable();
    });
	</script>	
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>

  <!-- Style Status -->
  <style><?php echo $styling['style']; ?></style>

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
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <h1 class="m-n font-thin h3 text-black"><?php echo $dashboard; ?></h1>
          <small class="text-muted"><?php echo $bienvenidosa; ?> <?php echo $company['cname']; ?></small>
        </div>        
      </div>
    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
      <!-- stats -->
      <div class="row">
        <div class="col-md-5">
          <div class="row row-sm text-center">
			<div class="col-xs-12">
				<div class="inline" align="center">
				<?php  					
					$result3 = mysql_query("SELECT * FROM tbl_clients WHERE  email='".$_SESSION["user_name"]."' ");
					while($row = mysql_fetch_array($result3)) {					
				?> 
				<div ui-jq="easyPieChart" ui-options="{
						percent: 100,
						lineWidth: 5,
						trackColor: '#e8eff0',
						barColor: '#23b7e5',
						scaleColor: false,
						color: '#3a3f51',
						size: 134,
						lineCap: 'butt',
						rotate: -90,
						animate: 1000
					  }">
					<div class="thumb-xl">
					  <img src="../logo-image/imagen-customer.php?id=<?php echo $row['id']; ?>" class="img-circle" alt="...">
					</div>
				</div>
					<div class="h4 m-t m-b-xs"><?php echo $row['name']; ?></div>
					<small class="text-muted m-b"><?php echo $CLIENTE; ?></small>
				</div> 
				<?php } ?>
            </div>         
            <div class="col-xs-6">
			<?php
				// Always first connect to the database mysql
				$sql = "SELECT * FROM online_booking WHERE  status = 'Pending' AND email='".$_SESSION["user_name"]."'";  // sentence sql
				$result = mysql_query($sql);
				$numero1 = mysql_num_rows($result); // get the number of rows
			?>
              <div class="panel padder-v item">
                <div class="h1 text-info font-thin h1"><?php echo $numero1; ?></div>
                <span class="text-muted text-xs"><?php echo $enviopendiente; ?></span>
                <div class="top text-right w-full">
                  <i class="fa icon-plane text-warning m-r-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <a href class="block panel padder-v bg-info item">
                <span class="text-white font-thin h1 block">
				<?php
				$result = mysql_query("SELECT SUM(shipping_subtotal) as total FROM courier_online WHERE  office='".$_SESSION["user_name"]."' AND payment='Pending'");   
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				echo $s.formato($row["total"]);	
				
				?></span>
                <span class="text-muted text-xs"><?php echo $totalfactura; ?></span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-money text-muted m-r-sm"></i>
                </span>
              </a>
            </div>              
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel wrapper">

		<h1 class="m-n font-thin h3 text-black"><?php echo $reservaonline; ?></h1>
          <small class="text-muted"><?php echo $heredetail; ?></small>
        
			<div class="table-responsive">
			  <table  ui-jq="dataTable" class="table table-striped b-t b-b">
				<thead>
					<tr>
					  <th>
						  <?php echo $fechareserva; ?>
					  </th>
					  <th>
						  <?php echo $de; ?>
					  </th>
					  <th>
						  <?php echo $a; ?>
					  </th>
					  <th>
						  <?php echo $detalles; ?>
					  </th>
					  <th>
						  <?php echo $estado; ?>
					  </th>					  
					</tr>
				</thead>
				<tbody>
					<?php  					
					   $result3 = mysql_query("SELECT * FROM online_booking  where email='$qname' AND status='Pending'");
						while($row = mysql_fetch_array($result3)) {							
					?>  
					<tr>
						<td><?php echo $row ["booking_date"]; ?></td>
						<td><?php echo $row ["state"]; ?>,<?php echo $row ["country"]; ?>.</td>
						<td><?php echo $row ["sstate"]; ?>,<?php echo  $row ["scountry"]; ?>.<br></td>
						<td><?php echo $row ["note"]; ?></td>
						<td><span class="label <?php echo $row['status']; ?> label-large"><?php echo $row['status']; ?></span></br><?php echo $row['reasons']; ?></td>
					</tr>
					<?php } ?>	
				</tbody>
			  </table>
			</div>
          </div>
        </div>
      </div>
      <!-- / stats -->
	  
	  <!-- service courier-->
      <div class="panel hbox hbox-auto-xs no-border">
        <div class="col wrapper">
           <h1 class="m-n font-thin h3 text-black"><?php echo $estadoenvio; ?></h1>
          <small class="text-muted"><?php echo $listaenvios; ?></small>
			<div class="table-responsive">
				<table  ui-jq="dataTable" class="table table-striped b-t b-b">
					<thead>
					  <tr>
						  <th></th>				  
						  <th><?php echo $tracking; ?></th>
						  <th><?php echo $modopago; ?></th>
						  <th><?php echo $remitente; ?></th>
						  <th><?php echo $destinatario; ?></th>
						  <th><?php echo $fechaenvio; ?></th>
						  <th><?php echo $estadodelenvio; ?></th>
					  </tr>
					</thead>

					<tbody>
					  <tr>
							<?php
								//$result3 = mysql_query("SELECT * FROM courier WHERE status != 'delivered' ORDER BY cid DESC");
								$result3 = mysql_query("SELECT c.cid, c.cons_no, c.letra, c.book_mode, c.ship_name, c.rev_name, c.pick_date, s.color, c.status
                                          FROM courier c, service_mode s
                                         WHERE s.servicemode = c.status
                                           AND c.status != 'delivered'
                                           AND c.email='$qname'
                                         ORDER BY c.cid DESC");

								while($row = mysql_fetch_array($result3)) {
							?>							
								  <td align="center"><a target="_blank" href="../print-invoice/invoice-print.php?cid=<?php echo $row['cid']; ?>">
								  <img src="../img/print.png"  height="20" width="20"></a></td>							  						  
								  <td><font color="#000"><?php echo $row['letra']; ?>-<?php echo $row['cons_no']; ?></font></td>
								  <td><span class="label <?php echo $row['book_mode']; ?> label-large"><?php echo $row['book_mode']; ?></span></td> 							 
								  <td><?php echo $row['ship_name']; ?></td>
								  <td><?php echo $row['rev_name']; ?></td>
								  <td><?php echo $row['pick_date']; ?></td>
								  <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span>
								  </td>           
					  </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
        </div>
      </div>
      <!-- / service -->
	  
	  

      <!-- service -->
      <div class="panel hbox hbox-auto-xs no-border">
        <div class="col wrapper">
           <h1 class="m-n font-thin h3 text-black"><?php echo $estadoaprobadosonline; ?></h1>
          <small class="text-muted"><?php echo $hereaprobados; ?></small>
			<div class="table-responsive">
			  <table  ui-jq="dataTable" class="table table-striped b-t b-b">
				<thead>
					<tr>
					  <th></th>
					  <th><?php echo $tracking; ?> </th>
					  <th><?php echo $de; ?> </th>
					  <th><?php echo $a; ?>  </th>
					  <th><?php echo $reseren; ?></th>
					  <th><?php echo $entregapro; ?> </th>
					  <th><?php echo $estado; ?> </th>			  
					</tr>
				</thead>
				<tbody>

										 
				  <?php
					//$result1 = mysql_query("SELECT * FROM courier WHERE status != 'delivered' ORDER BY cid DESC");
					$result1 = mysql_query("SELECT c.cid, c.cons_no,c.ship_name, c.ciudad, c.city1, c.deliverydate, c.date, c.email, c.paymode, c.payment, c.shipping_subtotal, s.color,s.servicemode, c.status FROM courier_online c, service_mode s  WHERE s.servicemode = c.status AND email='$qname' ORDER BY c.cid DESC");
					while($row = mysql_fetch_array($result1)) {
					?>
					<tr>
					  <td align="center"><a target="_blank" href="../print-invoice/invoice-print-online.php?cid=<?php echo $row['cid']; ?>">
					  <img src="../img/print.png"  height="20" width="20"></a></td>	
					  <td><?php echo $row ["cons_no"]; ?></td>
					  <td><?php echo $row ["ciudad"]; ?></td>
					  <td><?php echo $row ["city1"]; ?></td>
					  <td><?php echo $row ["date"]; ?></td>
					  <td><?php echo $row ["deliverydate"]; ?></td>
					  <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span></td>
					</tr>
					<?php } ?>
				</tbody>
			  </table>
			</div>
        </div>
        <div class="col wrapper-lg w-lg bg-light dk r-r">
          <h4><i class="fa fa-cubes"></i>&nbsp;&nbsp;<?php echo $enviodispo; ?></a></h4>
			<div class="table-responsive">
					<table  ui-jq="dataTable" class="table table-striped b-t b-b">
						<thead>
							<tr>
								<th><?php echo $tracking; ?></th>
								<th><?php echo $estado; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result5 = mysql_query("SELECT c.cid, c.cons_no,c.ship_name, c.ciudad, c.city1, c.deliverydate, c.date, c.email, c.paymode, c.payment, c.shipping_subtotal, s.color,s.servicemode, c.status FROM courier_online c, service_mode s  WHERE s.servicemode = c.status AND c.email='$qname' ORDER BY c.cid DESC");
								while($row = mysql_fetch_array($result5)) {				
							?>  
							<tr>
								<td><font color="#000"><?php echo $row['cons_no']; ?></font></td>								
								<td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span></td> 
							</tr>
							<?php } ?>
						</tbody>
					</table>
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
  <!-- /content -->


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

<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.js"></script>


</body>
</html>
