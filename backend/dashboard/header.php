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
require_once('library.php');
require 'requirelanguage.php';
isUser();
											 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $Paneladministracion; ?></title>
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
<div class="app app-header-fixed  ">
  
  <!-- header -->
  <header id="header" class="app-header navbar" role="menu">
          <!-- navbar header -->
      <div class="navbar-header bg-dark">
        <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
          <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="index.php" class="navbar-brand text-lt">
          <a href class="navbar-brand block"><span><img src="logo-image/image_logo.php?id=1" height="39" width="150"></span>
        </a>
        <!-- / brand -->
      </div>
      <!-- / navbar header -->

      <!-- navbar collapse -->
      <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
            <i class="fa fa-dedent fa-fw text"></i>
            <i class="fa fa-indent fa-fw text-active"></i>
          </a>
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle="show" target="#aside-user">
            <i class="icon-user fa-fw"></i>
          </a>
        </div>
        <!-- / buttons -->

        <!-- search form -->
        <form class="navbar-form navbar-form-sm navbar-left shift" ui-shift="prependTo" data-target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl">
          <div class="form-group">
            <div class="input-group">
			  			<font SIZE=3 color="#000000"><span id=tick2></span>				
						<?php 
						//Establecemos zona horaria por defecto
						date_default_timezone_set($_SESSION['ge_timezone']);
						//preguntamos la zona horaria
						$zonahoraria = date_default_timezone_get();
						echo '' . $zonahoraria;
						?></font>&nbsp;&nbsp;<font SIZE=3 color="#2DB200">
						<?php 						
						echo date("l F d - Y"); 
						?></font>

            </div>
          </div>
        </form>
        <!-- / search form -->
		<?php				
			isUser();
			if($_SESSION['user_type']=='client'){ header('Location: customer'); }
			$result0 = mysql_query("SELECT * FROM online_booking WHERE  status='Pending'");
			$nobookings = dbNumRows($result0); 
		?>
        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="online-bookings.php" data-toggle="dropdown" class="dropdown-toggle">
              <i class="icon-bell fa-fw"></i>
              <span class="visible-xs-inline"><?php echo $Notificaciones; ?></span>
              <span class="badge badge-sm up bg-danger pull-right-xs"><?php echo $nobookings; ?></span>
            </a>
          </li>
          <li class="dropdown">
			<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
			<?php  					
				$result3 = mysql_query("SELECT * FROM manager_admin WHERE name='".$_SESSION["user_name"]."' ORDER BY cid DESC");
				while($row = mysql_fetch_array($result3)) {					
			?>
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"> 
                  <img src="logo-image/imagen.php?cid=<?php echo $row['cid']; ?>">               				
                <i class="on md b-white bottom"></i>
              </span>
			  <?php } ?>			  
              <span class="hidden-sm hidden-md"><?php echo $_SESSION['user_name'] ;?></span> <b class="caret"></b>
            </a>
			<?php } ?>

			<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Employee') { ?>
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
			<?php  					
				$result3 = mysql_query("SELECT * FROM manager_user WHERE name='".$_SESSION["user_name"]."' ORDER BY cid DESC");
				while($row = mysql_fetch_array($result3)) {					
			?>
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"> 
                  <img src="logo-image/imagen-user.php?cid=<?php echo $row['cid']; ?>">               				
                <i class="on md b-white bottom"></i>
              </span>
			  <?php } ?>			  
              <span class="hidden-sm hidden-md"><?php echo $_SESSION['user_name'] ;?></span> <b class="caret"></b>
            </a>
			<?php } ?>	
			
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
              <li>
                <a href>
                  <span><?php echo $Configuracionsistema; ?></span>
                </a>
              </li>
			  <?php  					
				$result4 = mysql_query("SELECT * FROM manager_admin WHERE name='".$_SESSION["user_name"]."' ORDER BY cid DESC");
				while($row = mysql_fetch_array($result4)) {					
				?>	
              <li>
			    
                <a href="edit-profile.php?cid=<?php echo $row['cid'];?>"><i class="fa fa-users icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $perfil; ?></a>
              </li>
			  <?php 
			  } 
			  ?>	

			  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Employee') { ?>
			  <?php  					
				$result90 = mysql_query("SELECT * FROM manager_user WHERE name='".$_SESSION["user_name"]."' ORDER BY cid DESC");
				while($row = mysql_fetch_array($result90)) {					
				?>	
			  <li>
                <a href="edit-profile-user.php?cid=<?php echo $row['cid'];?>"><i class="fa fa-users icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $perfil; ?></a>
              </li>
				<?php } ?>
				<?php } ?>
			   
              <li class="divider"></li>
              <li>
                <a href="library.php?action=logOut"><i class="fa fa-sign-out icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $salir; ?></a>
              </li>
            </ul>
            <!-- / dropdown -->
          </li>
        </ul>
        <!-- / navbar right -->
      </div>
      <!-- / navbar collapse -->
  </header>
  <!-- / header -->

  <!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-dark">
          <div class="aside-wrap">
        <div class="navi-wrap">
          <!-- user -->
		  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
          <div class="clearfix hidden-xs text-center hide" id="aside-user">
            <div class="dropdown wrapper">
			  <?php  					
					$result3 = mysql_query("SELECT * FROM manager_admin WHERE name='".$_SESSION["user_name"]."' ORDER BY cid DESC");
					while($row = mysql_fetch_array($result3)) {					
				?> 
			  <a href="#">
                <span class="thumb-lg w-auto-folded avatar m-t-sm">
                  <img src="logo-image/imagen.php?cid=<?php echo $row['cid']; ?>" class="img-full" alt="...">
                </span>
              </a>
			  <?php } ?>
              <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                <span class="clear">
                  <span class="block m-t-sm">
                    <strong class="font-bold text-lt"><?php echo $bienvenido; ?></strong> 
                    <b class="caret"></b>
                  </span>
                  <span class="text-muted text-xs block"><?php echo $_SESSION['user_name'] ;?></span>
                </span>
              </a>
            </div>
            <div class="line dk hidden-folded"></div>
          </div>
			<?php } ?>

		  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Employee') { ?>
          <div class="clearfix hidden-xs text-center hide" id="aside-user">
            <div class="dropdown wrapper">
			  <?php  					
					$result3 = mysql_query("SELECT * FROM manager_user WHERE name='".$_SESSION["user_name"]."' ORDER BY cid DESC");
					while($row = mysql_fetch_array($result3)) {					
				?> 
			  <a href="#">
                <span class="thumb-lg w-auto-folded avatar m-t-sm">
                  <img src="logo-image/imagen-user.php?cid=<?php echo $row['cid']; ?>" class="img-full" alt="...">
                </span>
              </a>
			  <?php } ?>
              <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                <span class="clear">
                  <span class="block m-t-sm">
                    <strong class="font-bold text-lt"><?php echo $bienvenido; ?></strong> 
                    <b class="caret"></b>
                  </span>
                  <span class="text-muted text-xs block"><?php echo $_SESSION['user_name'] ;?></span>
                </span>
              </a>
            </div>
            <div class="line dk hidden-folded"></div>
          </div>
			<?php } ?>
          <!-- / user -->

          <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
              </li>
              <li class="active">
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="glyphicon glyphicon-stats icon text-primary-dker"></i>
                  <span class="font-bold"><?php echo $dashboard; ?></span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span><?php echo $dashboard; ?></span>
                    </a>
                  </li>
                  <li class="active">
                    <a href="index.php">
					<i class="fa fa-desktop icon text-default-lter"></i>
                      <span><?php echo $inicio; ?></span>
                    </a>
                  </li>
				  <li>
                    <a href="add-courier.php">
                      <b class="label bg-success pull-right"></b>
					  <i class="fa fa-cubes icon text-success-lter"></i>
                      <span><?php echo $enviar; ?></span>
                    </a>
                  </li>
                  <li>
                    <a href="shipments.php">
                      <b class="label  pull-right"></b>
					  <i class="fa fa-cubes icon "></i>
                      <span>Shipments</span>
                    </a>
                  </li>
				  <li>
                    <a href="consolidate.php">
                      <b class="label bg-success pull-right"></b>
					  <i class="fa fa-share-square-o icon text-danger-lter"></i>
                      <span><?php echo $consolidado; ?></span>
                    </a>
                  </li>
                </ul>
              </li>
			  <?php				
				isUser();
				if($_SESSION['user_type']=='client'){ header('Location: customer'); }
				$result0 = mysql_query("SELECT * FROM online_booking WHERE  status='Pending'");
					$nobookings = dbNumRows($result0); 
				?>
				<?php				
				isUser();
				if($_SESSION['user_type']=='client'){ header('Location: customer'); }
				$result00 = mysql_query("SELECT * FROM upload_image_bank");
					$transfer = dbNumRows($result00); 
				?>
              <li>
                <a href="online-bookings.php">
                  <b class="badge bg-info pull-right"><?php echo $nobookings; ?></b>
                  <i class="glyphicon glyphicon-envelope icon text-info-lter"></i>
                  <span class="font-bold"><?php echo $reservaonline; ?></span>
                </a>
              </li>
			  <li>
                <a href="transfer-bank.php">
                  <b class="badge bg-warning pull-right"><?php echo $transfer; ?></b>
                  <i class="glyphicon glyphicon-usd icon text-warning-lter"></i>
                  <span class="font-bold"><?php echo $transferencia; ?></span>
                </a>
              </li>
			  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
			  <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <i class="fa fa-file-text icon text-default-dker"></i>
                  <span class="font-bold"><?php echo $reportegeneral; ?></span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span><?php echo $reportes; ?></span>
                    </a>
                  </li>                 
				  <li>
                    <a href="shipping-list.php">
                      <span><?php echo $todoslosenvios; ?></span>
                    </a>
                  </li>
				  <li>
                    <a href="delivered-list.php">
                      <span><?php echo $enviosentregados; ?></span>
                    </a>
                  </li>
				  <li>
                    <a href="delivered-list-online.php">
                      <span><?php echo $enviosonline; ?></span>
                    </a>
                  </li>
				  <li>
                    <a href="list-of-shipping-paid.php">
                      <span><?php echo $enviospefectivo; ?></span>
                    </a>
                  </li>
				   <li>
                    <a href="list-of-shipping-topay.php">
                      <span><?php echo $enviospcredito; ?></span>
                    </a>
                  </li>
				   <li>
                    <a href="list-of-shipping-cash-on-delivery.php">
                      <span><?php echo $enviospdebito; ?></span>
                    </a>
                  </li>
				  <li>
                    <a href="consolidate_report.php">
                      <span><?php echo $consolidados; ?></span>
                    </a>
                  </li>
                </ul>
              </li>
			  <?php } ?>
              <li class="line dk"></li>   

              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
			  <i class="fa fa-cog fa-2x fa-fw text-warning-lter"></i>
				<span class="sr-only">Loading...</span>
                <span><?php echo $CONFIGURACIONES; ?></span>
              </li>
			  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
              <li>
                <a href="add-office.php">      
                  <span class="pull-right text-muted">
                  </span>
				  <?php 
					 require_once('database.php');					
					$sql_2 = "SELECT * FROM offices";
					$result2 = dbQuery($sql_2);
					$row2 = mysql_num_rows($result2);
					$sql_3 = "SELECT * FROM tbl_clients";
					$result3 = dbQuery($sql_3);
					$row3 = mysql_num_rows($result3);					
					$sql_5 = "SELECT * FROM manager_admin";
					$result5 = dbQuery($sql_5);
					$row5 = mysql_num_rows($result5);					
				  ?>
                  <b class="badge bg-success pull-right"><?php echo $row2; ?></b>
                  <i class="glyphicon glyphicon-map-marker"></i>
                  <span><?php echo $OFICINAS; ?></span>
                </a>
                                    
              </li>			  
              <li>
                <a href="add-new-users.php">
                  <span class="pull-right text-muted">
                  </span>
				  <b class="badge bg-primary pull-right"><?php echo $row1; ?></b>
                  <i class="fa fa-user icon text-default-lter"></i>
                  <span><?php echo $EMPLEADOS; ?></span>
                </a>                
              </li>			   
			  <li>
                <a href="add-new-users-admin.php">
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>				  
				  <i class="fa fa-user icon text-default-lter"></i>
                  <span><?php echo $ADMINISTRADOR; ?></span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a href>
                      <span><?php echo $Usuario; ?></span>
                    </a>
                  </li>                 
				  <li>
                    <a href="add-new-users-admin.php">
                      <b class="label bg-success pull-right"></b>
					  <span class="pull-right text-muted">
					  </span>
					  <b class="badge bg-danger pull-right"><?php echo $row5; ?></b>
                      <span><?php echo $Administrador; ?></span>
                    </a>
                  </li>
                </ul>
              </li>
			  <?php } ?>
			  <li>
                <a href="management-client.php">
                  <span class="pull-right text-muted">
                  </span>
				  <b class="badge bg-info pull-right"><?php echo $row3; ?></b>
				  <i class="fa fa-users icon text-default-lter"></i>
                  <span><?php echo $CLIENTES; ?></span>
                </a>                
              </li>			   
              <li>
                <a href="typeshipments.php">
                  <i class="glyphicon glyphicon-gift"></i>
                  <span><?php echo $tiposproductos; ?></span>
                </a>   
              </li>
              <li>
                <a href="modebookings.php">
                  <i class="fa fa-truck icon text-default-lter"></i>
                  <span><?php echo $tiposenvios; ?></span>
                </a>
              </li>	
			  <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator') { ?>
			  <li>
                <a href="styles.php">
                  <i class="fa fa-magic icon text-default-lter"></i>
                  <span><?php echo $STYLES; ?></span>
                </a>
              </li>	
				<li>
                <a href="shipping-charge.php">
                  <i class="fa fa-money"></i>
                  <span><?php echo $calculoenvios; ?></span>
                </a>
              </li>	

              <li class="line dk hidden-folded"></li>  
							 
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">          
                <span><?php echo $configuracionsistema; ?></span>
              </li>  
              <li>
                <a href="preferences.php">
                  <i class="icon-wrench icon text-warning-lter"></i>
                  <span><?php echo $configuracion; ?></span>
                </a>
              </li>
			  <?php }  ?>
              <li>
                <a href="library.php?action=logOut">
                  <i class="fa fa-sign-out"></i>
                  <span><?php echo $salir; ?></span>
                </a>
              </li>
            </ul>
          </nav>
          <!-- nav -->     
        </div>
      </div>
  </aside>
  <!-- / aside -->
 
  <script type="text/javascript">
	var ckeditor_ID=1;
	var timer;
	var TEMPID;
	$(document).ready(function (){
		$("form").validate();
		$("#adds_button").topicOpener("div#adds_form",200);
		$("#radio_mailing").topicOpenerSingle("div#mailing_list",100,"div.group_list");
		$("#radio_black").topicOpenerSingle("div#black_list",100,"div.group_list");
		$("#radio_tutti").topicCloser("div.group_list");
		$("label.checkbox").checkbox();
		$("label.radio").radioButton();
		$("a.phpaction").phpAction();
	});
	</script>
	<script>
		function show2(){
		if (!document.all&&!document.getElementById)
		return
		thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
		var Digital=new Date()
		var hours=Digital.getHours()
		var minutes=Digital.getMinutes()
		var seconds=Digital.getSeconds()
		var dn="PM"
		if (hours<12)
		dn="AM"
		if (hours>12)
		hours=hours-12
		if (hours==0)
		hours=12
		if (minutes<=9)
		minutes="0"+minutes
		if (seconds<=9)
		seconds="0"+seconds
		var ctime=hours+":"+minutes+":"+seconds+" "+dn
		thelement.innerHTML=ctime
		setTimeout("show2()",1000)
		}
		window.onload=show2
		//-->
</script> 
</body>
</html>