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
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $paytransferbank; ?></title>
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
	    <div class="wrapper hidden-sm hidden-xs" id="email-menu">
	      <ul class="nav nav-pills nav-stacked nav-sm">
	        <li><a href="online-bookings.php"><?php echo $PENDIENTES; ?></a></li>
	        <li><a href="online-bookings_approved.php"><?php echo $APROVADO; ?></a></li>
	        <li><a href="online-bookings_cancelled.php"><?php echo $CANCELADO; ?></a></li>
			<li>&nbsp;</li>
			<li class="active"><a href="transfer-bank.php"><i class="glyphicon glyphicon-usd icon text-black-lter"></i>&nbsp;&nbsp;<?php echo $TRANSFERBANCK; ?></a></li>	
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
				  <?php echo $notificationtransferbank; ?>
				</div>
				<div class="table-responsive">
					<table ui-jq="dataTable"  class="table table-striped b-t b-b">
					<thead>
					  <tr>
						  <th><?php echo $numbertracking; ?></th>
						  <th><?php echo $namefile; ?></th>
						  <th><?php echo $paybank; ?></th>
						  <th><?php echo $filetype; ?></th>
						  <th><?php echo $username; ?></th>
						  <th><?php echo $paydate; ?></th>
					  </tr>
					</thead>

					<tbody>
					
						<?php  					
							$result3 = mysql_query("SELECT * FROM upload_image_bank  ORDER BY cid");
							while($row = mysql_fetch_array($result3)) {					
						?> 
					  <tr>											  					  
						  <td><font color="#000"><?php echo $row['cons_no']; ?></font></td>						 
						  <td><?php echo $row['nombre_imagen']; ?></td>
						  <td align="center"><p><a href="#" class="alternar-respuesta"><img src="img/see.png" border="0" height="20" width="20"></p></a>
						  <p class="respuesta" style="display:none"><img src="logo-image/image_payment_online.php?cid=<?php echo $row['cid']; ?>"/></p></td>
						  <td><?php echo $row['tipo']; ?></td>
						   <td><?php echo $row['office']; ?></td>
						  <td><?php echo $row['date']; ?></span></td>           
					  </tr>
						<?php }?>										
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
		// jQuery
    $(document).ready(function(){ 
        $('.alternar-respuesta').on('click',function(e){
            $(this).parent().next().toggle();
            e.preventDefault();
        });
        $('#alternar-todo').on('click',function(e){
            $('.respuesta').toggle('slow');
            e.preventDefault();
        });
    });
</script>

</body>
</html>
