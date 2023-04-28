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
require_once('../database.php');
require_once('../library.php');
require '../requirelanguage.php';
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
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />

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
        <a href="customer.php" class="navbar-brand text-lt">
          <a href class="navbar-brand block"><span><img src="../logo-image/image_logo.php?id=1" height="39" width="150"></span>
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
        </div>
        <!-- / buttons -->

        <!-- search form -->
        <form class="navbar-form navbar-form-sm navbar-left shift" ui-shift="prependTo" data-target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl">
          <div class="form-group">
            <div class="input-group">
				<font SIZE=3 color="#000000"><span id=tick2></span>				
				<?php 
				//Establecemos zona horaria por defecto
				date_default_timezone_set($company['timezone']);
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
			 require_once('../database.php');
			$sql_1 = "SELECT *  FROM courier_online WHERE office='".$_SESSION["user_name"]."' AND status != 'delivered'";
			$result1 = dbQuery($sql_1);
			$row1 = mysql_num_rows($result1);	 
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
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
				<?php  					
					$result3 = mysql_query("SELECT * FROM tbl_clients WHERE email='".$_SESSION["user_name"]."' ORDER BY id DESC");
					while($row = mysql_fetch_array($result3)) {					
				?>
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"> 
                  <img src="../logo-image/imagen-customer.php?id=<?php echo $row['id']; ?>">               				
                <i class="on md b-white bottom"></i>
              </span>
			  <?php } ?>			  
              <span class="hidden-sm hidden-md"><?php echo $_SESSION['user_name'] ;?></span> <b class="caret"></b>
            </a>
			
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
              <li>
                <a href>
                  <span><?php echo $Configuracionsistema; ?></span>
                </a>
              </li>
			  <?php  					
					$result4 = mysql_query("SELECT * FROM tbl_clients WHERE email='".$_SESSION["user_name"]."' ORDER BY id DESC");
					while($row = mysql_fetch_array($result4)) {					
				?>	
              <li>			    
                <a href="update_profile.php?id=<?php echo $row['id'];?>"><i class="fa fa-users icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $perfil; ?></a>
              </li>
			  <?php } ?>
              <li class="divider"></li>
              <li>
                <a href="../library.php?action=logOut"><i class="fa fa-sign-out icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $salir; ?></a>
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
          <div class="clearfix hidden-xs text-center hide" id="aside-user">
            <div class="dropdown wrapper">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                <span class="clear">
                  <span class="block m-t-sm">
                    <strong class="font-bold text-lt"><?php echo $_SESSION['user_name'] ;?></strong> 
                    <b class="caret"></b>
                  </span>
                  <span class="text-muted text-xs block"><?php echo $cliente; ?></span>
                </span>
              </a>

            </div>
            <div class="line dk hidden-folded"></div>
          </div>
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
                    <a href="customer.php">
					<i class="fa fa-desktop icon text-default-lter"></i>
                      <span><?php echo $inicio; ?></span>
                    </a>
                  </li>
				  <li>
                    <a href="add-courier-customer.php">
                      <b class="label bg-success pull-right"></b>
					  <i class="fa fa-cubes icon text-success-lter"></i>
                      <span><?php echo $enviar; ?></span>
                    </a>
                  </li>
					<?php 
					 require_once('../database.php');
						$sql_1 = "SELECT *  FROM courier_online WHERE office='".$_SESSION["user_name"]."' AND status != 'delivered'";
						$result1 = dbQuery($sql_1);
						$row1 = mysql_num_rows($result1);										
				  ?>
                  <li>
                    <a href="paybill.php">
                      <b class="label bg-success pull-right"></b>
					  <span class="pull-right text-muted">
					  </span>
					  <b class="badge bg-danger pull-right"><?php echo $row1; ?></b>
					  <i class="fa fa-credit-card icon text-default-lter"></i>
                      <span><?php echo $PAGAR; ?></span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
			  <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span><?php echo $configuracion; ?></span>
              </li>			 
              <li>
			    <?php  					
					$result4 = mysql_query("SELECT * FROM tbl_clients WHERE email='".$_SESSION["user_name"]."' ORDER BY id DESC");
					while($row = mysql_fetch_array($result4)) {					
				?>	
                <a href="update_profile.php?id=<?php echo $row['id'];?>"">
                  <i class="fa fa-gears (alias) icon text-default-dker"></i>
                  <span class="font-bold"><?php echo $PERFIL; ?></span>
                </a>
				<?php } ?>
              </li>
              
              <li class="line dk hidden-folded"></li>

            </ul>
          </nav>
          <!-- nav -->
        </div>
      </div>
  </aside>
  <!-- / aside -->
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
