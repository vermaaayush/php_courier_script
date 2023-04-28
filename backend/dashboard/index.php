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
require_once('funciones.php');
require_once('library.php');
require 'requirelanguage.php';
	
date_default_timezone_set($_SESSION['ge_timezone']);	
$styling=mysql_fetch_array(mysql_query("SELECT * FROM styles"));

	$meses = array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept','Oct','Nov','Dic');
	for($x=1;$x<=12;$x=$x+1){
		$dinero[$x]=0;	
	}
	
	$anno=date('Y');
	
	$sql=mysql_query("SELECT * FROM courier");
	while($row=mysql_fetch_array($sql)){
		$y=date("Y", strtotime($row['book_date']));
		
		$mes=(int)date("m", strtotime($row['book_date'])); 
		
		if($y==$anno){
			$dinero[$mes]=$dinero[$mes]+$row['shipping_subtotal'];
		}
	}
		for($x=1;$x<=12;$x=$x+1){
		$dineros[$x]=0;	
	}
	$sql_1=mysql_query("SELECT * FROM courier_online");
	while($row=mysql_fetch_array($sql_1)){
		$y=date("Y", strtotime($row['date']));
		
		$mes=(int)date("m", strtotime($row['date'])); 
		
		if($y==$anno){
			$dineros[$mes]=$dineros[$mes]+$row['shipping_subtotal'];
		}
	}
isUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $ADMINISTRACION; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

   <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />
  <!-- Plugins css -->
  
  <script src="js/amcharts.js" type="text/javascript"></script>
  <script src="js/serial.js" type="text/javascript"></script>
  
  <script type="text/javascript">
		 $(document).ready(function () {
				$('#grid').DataTable();
			});
	</script>
	  <!-- Style Status -->
	<style><?php echo $styling['style']; ?></style>
</head>
<body>

<?php include("header.php"); ?>
  
  
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
          <h1 class="m-n font-thin h3 text-black"><?php echo $paneldecontrol; ?></h1>
          <small class="text-muted"><?php echo $bienvenidosa; ?> <?php echo $_SESSION['ge_cname']; ?></small>
        </div>
      </div>
    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

	<!-- stats -->
	
	<?php include("header-stats.php"); ?>
	
	<!-- / stats -->
	
      <!-- service -->
      <div class="panel hbox hbox-auto-xs no-border">
        <div class="col wrapper">
          <i class="fa fa-circle-o text-info m-r-sm pull-right"></i>
          <h4><i class="icon-plane"></i>&nbsp;&nbsp;<?php echo $LISTADEENVÍOPRINCIPAL ?></a></h4>
			<br>
			<div class="table-responsive">
			<table ui-jq="dataTable" class="table table-striped b-t b-b">
				<thead>
				  <tr>
					<?php
							if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') {
						  ?>
					   <th>&nbsp;</th>
					  <?php } ?>
					  <th>&nbsp;</th>
					  <th>&nbsp;</th>
					  <th>&nbsp;</th>
					  <th>&nbsp;</th>
					  <th>&nbsp;</th>
					  <th><?php echo $entregar; ?></th>					  
					  <th><?php echo $numerotracking; ?></th>
					  <th><?php echo $modopago; ?></th>
					  <th><?php echo $remite; ?></th>
					  <th><?php echo $destina; ?></th>
					  <th><?php echo $fecha; ?></th>
					  <th><?php echo $empleado; ?></th>
					  <th></th>
				  </tr>
				</thead>

				<tbody>
				  <tr>
						<?php
							$result3 = mysql_query("SELECT c.cid, c.tracking, c.cons_no, c.letra, c.book_mode, c.ship_name, c.rev_name, c.pick_date, c.user, s.color, c.status
													FROM courier c, service_mode s WHERE s.servicemode = c.status AND c.status != 'delivered' ORDER BY cid DESC");
													
							while($row = mysql_fetch_array($result3)) {
						?>
						<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
					  <td align="center">
					  <a href="#" alt="Borrar Registro" onclick="del_list_admin(<?php echo $row['cid']; ?>);">
						<img src="img/delete.png"  height="20" width="18"></a></td>																  
					  <?php } ?>					
					  <td align="center"><a href="edit-courier.php?cid=<?php echo $row['cid']; ?>">
					  <img src="img/edit.png"  height="20" width="18"></a></td>				
					  <td align="center"><a data-target="#con-close-modal<?php echo $row['cid']; ?>" data-toggle="modal">
					  <img src="img/update-status.png"  height="20" width="20"></a></td>							  
					  <td align="center"><a target="_blank" href="print-invoice/invoice-print.php?cid=<?php echo $row['cid']; ?>">
					  <img src="img/print.png"  height="20" width="20"></a></td>
					  <td align="center"><a target="_blank" href="print-invoice/ticket-print.php?cid=<?php echo $row['cid']; ?>">
					  <img src="img/ticket.png"  height="20" width="20"></a></td>							  
					  <td align="center"><a  href="barcode/courier/html/BCGcode39.php?tracking=<?php echo $row['tracking']; ?>" target="_blank">
					  <img src="img/barcode.png"  height="20" width="20"></a></td>
					 
					  <td class="gentxt" align="center">
					  <a href="settings/add_courier/status_delivered.php?cid=<?php echo $row['cid']; ?>"
					  onclick="return confirm('<?php echo $DELIVERY; ?>')">
						<img src="img/delivery.png"  height="20" width="20"></a></td>						  
					  <td><font color="#000"><?php echo $row['letra']; ?>-<?php echo $row['cons_no']; ?></font></td>
					  <td><span class="label <?php echo $row['book_mode']; ?> label-large"><?php echo $row['book_mode']; ?></span></td> 							 
					  <td><?php echo $row['ship_name']; ?></td>
					  <td><?php echo $row['rev_name']; ?></td>
					  <td><?php echo $row['pick_date']; ?></td>
					   <td><?php echo $row['user']; ?></td>
					  <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span>
					  </td>           
				  </tr>
					<?php } ?>
				</tbody>
			</table>
		  </div>
		  
        </div>
        <div class="col wrapper-lg w-lg light dk r-r">
          <h4><i class="fa fa-spinner"></i>&nbsp;&nbsp;<?php echo $enviosrecientes; ?></a></h4>
			<div class="table-responsive">
					<table ui-jq="dataTable" class="table table-striped b-t b-b">
						<thead>
							<tr>
								<th><?php echo $tracking; ?></th>
								<th><?php echo $fechainicio; ?></th>
								<th><?php echo $estado; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result1 = mysql_query("SELECT c.cid, c.tracking, c.status, s.color,s.servicemode, c.book_date FROM courier c, service_mode s 
								WHERE  LEFT(book_date, 10) = CURDATE() AND s.servicemode = c.status");
								while($row = mysql_fetch_array($result1)) {					
							?> 
							<tr>
								<td><font color="#000"><?php echo $row['tracking']; ?></font></td>
								<td><?php echo $row['book_date']; ?></td>
								 <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span>    
							</tr>
							<?php } ?>
						</tbody>
					</table>
			</div> 
        </div>
      </div>
      <!-- / service -->
		<?php
			// Always first connect to the database mysql
			$sql = "SELECT * FROM courier_online WHERE  status='En-Transito' ";  // sentence sql
			$result = mysql_query($sql);
			$numero2 = mysql_num_rows($result); // get the number of rows
		?>
      <!-- tasks -->
      <div class="panel wrapper">
        <div class="row">
          <div class="col-md-10 b-r b-light no-border-xs">
            <a href class="text-muted pull-right text-lg"><i class="icon-arrow-right"></i></a>
            <h4><i class="icon-envelope-open"></i>&nbsp; <strong><span class="text-danger text-uppercase m-b-15 m-t-10"><?php echo $numero2; ?></span></strong>&nbsp;<?php echo $LISTAENVIORESERVAONLINE; ?></a></h4>
			<br>
			<div class="table-responsive">
			<table ui-jq="dataTable" class="table table-striped b-t b-b">
					<thead>
					  <tr> 						  
						  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
						  <th>&nbsp;</th>
						  <?php } ?>
						  <th>&nbsp;</th>
						  <th>&nbsp;</th>
						  <th>&nbsp;</th>
						  <th>&nbsp;</th>
						  <th><?php echo $entregar; ?></th>
						  <th><?php echo $numerotracking; ?></th>
						  <th><?php echo $apagar; ?></th>
						  <th><?php echo $pagos; ?></th>
						  <th><?php echo $cliente; ?></th>
						  <th><?php echo $de; ?></th>
						  <th><?php echo $destina; ?></th>
						  <th><?php echo $a; ?></th>
						  <th><?php echo $fecha; ?></th>
						  <th>&nbsp;</th>
					  </tr>
					</thead>	
					
					<tbody>
					<tr>
						<?php
							$result3 = mysql_query("SELECT c.cid, c.cons_no,c.ship_name, c.ciudad, c.city1, c.deliverydate, c.paymode, c.rev_name, c.payment, c.shipping_subtotal, s.color, c.status FROM courier_online c, service_mode s WHERE s.servicemode = c.status AND c.status != 'delivered' ORDER BY cid DESC");
													
							while($row = mysql_fetch_array($result3)) {
						?>
							<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>															  
							 <td align="center">
								<a href="#" onclick="del_list_online(<?php echo $row['cid']; ?>);"><img src="img/delete.png"  height="20" width="18"></a></td>	
							  <?php } ?>							  																				
							  <td align="center"><a href="edit-courier-customer.php?cid=<?php echo $row['cid']; ?>"><img src="img/edit.png"  height="20" width="18"></a></td>
			
							  <td align="center"><a data-target="#con-close-modal-status-online<?php echo $row['cid']; ?>" data-toggle="modal"><img src="img/update-status.png"  height="20" width="20"></a></td>							  
							  <td align="center"><a target="_blank" href="print-invoice/invoice-print-online.php?cid=<?php echo $row['cid']; ?>">
							  <img src="img/print.png"  height="20" width="20"></a></td>
							  <td align="center"><a  href="barcode/courier-online/html/BCGcode39.php?cons_no=<?php echo $row['cons_no']; ?>" target="_blank"><img src="img/barcode.png"  height="20" width="20"></a></td>								  						  
							  <td align="center"><a data-target="#con-close-modal-online<?php echo $row['cid']; ?>" data-toggle="modal">
							  <img src="img/delivery.png"  height="20" width="20"></a></td>												  
							  <td><font color="#000"><?php echo $row['cons_no']; ?></td>
							  <td><strong><?php echo $company['currency']; ?><?php echo $s.formato($row['shipping_subtotal']); ?></strong></td>															  
							   <td align="center"><span class="label <?php echo $row['payment']; ?> label-large"><?php echo $row['payment']; ?></span>&nbsp;
							   <span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['paymode']; ?></span></td>															  
							  <td><?php echo $row['ship_name']; ?></td>
							  <td><?php echo $row['ciudad']; ?></td>
							  <td><?php echo $row['rev_name']; ?></td>
							  <td><?php echo $row['city1']; ?></td>
							  <td><?php echo $row['deliverydate']; ?></td>
							  <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span>         
					  </tr>
						<?php } ?>
					</tbody>												
			</table>
			</div>
		  </div>
          <div class="col-md-2">            
            <div class="row row-sm">
				<div class="table-responsive">
				  <div class="col-xs-12 text-center">
					<br>				  
					<div id="container" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
				  </div>
				</div>
			</div>	
          </div>

        </div>
      </div>
      <!-- / tasks -->
    </div>
  </div>
  <!-- / main -->
</div>
</div>
</div>
<!-- /content -->  
 <!-- Modal Update Courier -->
	
<?php include("modal-status/modal-update-courier.php"); ?>

<!-- / Modal Update Courier -->

<!-- Modal Update Courier Online -->

<?php include("modal-status/modal-update-courier-online.php"); ?>

<!-- / Modal Update Courier Online -->

<!-- Modal Update Courier Status Online -->

<?php include("modal-status/modal-update-courier-status-online.php"); ?>

<!-- / Modal Update Courier Status Online --> 

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
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 

<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Courier', 'Courier Online'],
		  <?php
		  	for($x=1;$x<=12;$x=$x+1){	
		  ?>
          ['<?php echo $meses[$x]; ?>',  <?php echo $dinero[$x] ?>, <?php echo $dineros[$x] ?>],		  
		  <?php } ?>		  
		  
        ]);

        var options = {
			
          colors: ['#23B7E5','#27C24C'],
                series: { shadowSize: 4 },
                xaxis:{ 
                  font: { color: '#ccc' },
                  position: 'bottom',
                  
                },
				title: '',
				curveType: 'function',
				legend: { position: 'bottom' }
			};

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
 </script>

<script type="text/javascript">
	$(document).ready(function() {
		var options = {
			chart: {
				renderTo: 'container',
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: '<?php echo $ESTADOENVIOENLINEA; ?>'
			},
			tooltip: {
				formatter: function() {
					return '<b>' + this.point.name + '</b>: ' + this.y+ '';
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						color: '#333333',
						connectorColor: '#333333',
						formatter: function() {
							return '<b>' + this.point.name + '</b>: ' + this.y;
						}
					},
					showInLegend: true
				}
			},
			series: []
		};

		$.getJSON("chartdata.php", function(json) {
			options.series = json;
			chart = new Highcharts.Chart(options);
		});
	});
</script>
<script type="text/javascript">
	function del_list_admin(cid) {
		if (window.confirm('<?php echo $DELETEADMIN; ?>')) {
			window.location = "deletes/delete_list_admin.php?action=del&cid="+cid; 
		}
	}
</script>
<script type="text/javascript">
	function del_list_online(cid) {
		if (window.confirm("<?php echo $DELETEONLINE; ?>")) {
			window.location = "deletes/delete_list_online.php?action=del&cid="+cid; 
		}
	}
</script>		
</body>
</html>
