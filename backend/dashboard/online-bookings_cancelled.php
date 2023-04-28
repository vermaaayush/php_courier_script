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
require 'requirelanguage.php';

date_default_timezone_set($_SESSION['ge_timezone']);
$styling=mysql_fetch_array(mysql_query("SELECT * FROM styles"));
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $onlinebookingcancelled; ?></title>
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
  
  <!-- Style Status -->
  <style><?php echo $styling['style']; ?></style>

</head>
<body>
<?php
include("header.php");
?>
  <br>
 <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

	<div class="hbox hbox-auto-xs hbox-auto-sm" ng-controller="MailCtrl">
	  <div class="col w-md bg-light dk b-r bg-auto">
	    <div class="wrapper b-b bg">
	      <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" ui-toggle="show" target="#email-menu"><i class="fa fa-bars"></i></button>
	      <a class="btn btn btn-danger"><?php echo $orderonline; ?></a>
	    </div>
		<?php 
			require_once('database.php');

			$sql_3 = "SELECT * FROM  online_booking WHERE  status='Cancelled'";
			$result3 = dbQuery($sql_3);
			$row3 = mysql_num_rows($result3);						
		?>
	    <div class="wrapper hidden-sm hidden-xs" id="email-menu">
	      <ul class="nav nav-pills nav-stacked nav-sm">
	        <li><a href="online-bookings.php"><?php echo $PENDIENTES; ?></a></li>
	        <li><a href="online-bookings_approved.php"><?php echo $APROVADO; ?></a></li>
	        <li class="active"><a href="online-bookings_cancelled.php"><?php echo $CANCELADO; ?><b class="badge bg-success pull-right"><?php echo $row3; ?></b></a></li>
			<li>&nbsp;</li>
			<li><a href="transfer-bank.php"><i class="glyphicon glyphicon-usd icon text-black-lter"></i>&nbsp;&nbsp;<?php echo $TRANSFERBANCK; ?></a></li>	
	      </ul>
	    </div>
	  </div>
	  <div class="col">
	    
	    <div>
	      <!-- header -->
	      <div class="wrapper bg-light lter b-b">
	        <div class="btn-toolbar">
	          <div class="btn-group dropdown">
	            <button class="btn btn-default btn-sm btn-bg dropdown-toggle" data-toggle="dropdown">
	              <span class="dropdown-label"><?php echo $filter; ?></span>                    
	              <span class="caret"></span>
	            </button>
	            <ul class="dropdown-menu text-left text-sm">
	              <li><a href="online-bookings.php"><?php echo $PENDIENTES; ?></a></li>
	              <li><a href="online-bookings_approved.php"><?php echo $APROVADO; ?></a></li>
				  <li><a href="online-bookings_cancelled.php"><?php echo $CANCELADO; ?></a></li>
				  <li>&nbsp;</li>
			      <li><a href="transfer-bank.php"><i class="glyphicon glyphicon-usd icon text-black-lter"></i>&nbsp;&nbsp;<?php echo $TRANSFERBANCK; ?></a></li>
	            </ul>
	          </div>
	          <div class="btn-group">
	            <button class="btn btn-sm btn-bg btn-default" onclick="myFunction()" data-toggle="tooltip" data-placement="bottom" data-title="Refresh" data-original-title="" title=""><i class="fa fa-refresh"></i></button>
	          </div>
	        </div>
	      </div>
	      <!-- / header -->

	      <!-- list -->
			<div class="wrapper-md">
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <?php echo $reservedcancelled; ?>
				</div>
				<div class="table-responsive">
				  <table ui-jq="dataTable"  class="table table-striped b-t b-b">
					<thead align="center">
							<tr>
								<th><?php echo $numbertracking; ?></th>
								<th><?php echo $fechareserva; ?></th>
								<th><?php echo $DE; ?></th>
								<th><?php echo $A; ?></th>
								<th><?php echo $cliente; ?></th>
								<th><?php echo $email1; ?></th>
								<th><?php echo $estadoreserva; ?></th>
								<th><?php echo $acciones; ?></th>
							</tr>
						</thead>
					<tbody>
						<?php  					
							$consulta_mysql="SELECT o.id,o.tracking,o.booking_date,o.state,o.country,o.sstate,o.scountry,o.name,o.email,o.status,s.color,s.servicemode
							FROM online_booking o 
							inner join service_mode s on o.status=s.servicemode 
							WHERE o.status='Cancelled' ORDER BY id DESC";
							$resultado_consulta_mysql=mysql_query($consulta_mysql);	
							while($row=mysql_fetch_array($resultado_consulta_mysql)){					
						?>
							<tr>
							 <td><?php echo $row ["tracking"]; ?></td>
							  <td><?php echo $row ["booking_date"]; ?></td>
							  <td><?php echo $row ["state"]; ?>,<?php echo $row ["country"]; ?></td>
							  <td><?php echo $row ["sstate"]; ?>,<?php echo pais($row ["scountry"]); ?></td>
							  <td><?php echo $row ["name"]; ?></td>
							  <td><?php echo $row ["email"]; ?></td>
							  <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span>
							  </br> <?php echo $row ["reasons"]; ?></td>								  
							  <td align="center">
							  <?php if($row ["status"] !='Cancelled'){?>
							  <a href="approve.php?id=<?php echo $row ["id"]; ?>">
							  <img src="img/update.png" border="0" height="20" width="20"></a>
							  <?php } ?>
							  
								<?php
									if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') {
								?>
							  &nbsp;&nbsp;  
							   <a href="#" onclick="del_list_online(<?php echo $row['id']; ?>);">
							   <img src="img/delete.png" border="0" height="20" width="18"></a>	
								<?php } ?>															  																  
							  </td>
							</tr>
						<?php } ?>	
						</tbody>
				  </table>
				</div>
			  </div>
			</div>
	      <!-- / list -->
	    </div>

	  </div>
	</div>


	</div>
  </div>
  <!-- /content -->

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

<script type="text/javascript">
	function del_list_online(id) {
		if (window.confirm("<?php echo $DELETEADMIN; ?>")) {
			window.location = "deletes/delete-online-bookings.php?action=del&id="+id;  
		}
	}
</script>

<script>
function myFunction() {
    location.reload();
}
</script>

</body>
</html>
