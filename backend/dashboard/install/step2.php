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


require ('application_installer_config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $app_name; ?> Installer</title>
    <link rel="shortcut icon" type="image/x-icon" href="../storage/icon/favicon.ico">
    <link href="ui/theme/deprixa/css/bootstrap.min.css" rel="stylesheet">
    <link href="ui/theme/deprixa/lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="ui/theme/deprixa/lib/icheck/skins/all.css" rel="stylesheet">
    <link href="ui/lib/css/animate.css" rel="stylesheet">
    <link href="ui/lib/toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="ui/theme/deprixa/css/style.css?ver=2.0.1" rel="stylesheet">
    <link href="ui/theme/deprixa/css/component.css?ver=2.0.1" rel="stylesheet">
    <link href="ui/theme/deprixa/css/custom.css" rel="stylesheet">
    <link href="ui/lib/icons/css/deprixa_icons.css" rel="stylesheet">
    <link href="ui/theme/deprixa/css/material.css" rel="stylesheet">
    <link type='text/css' href='style.css' rel='stylesheet'/>

</head>
<body style='background-color: #FBFBFB;'>
<div id='main-container'>
    <div class='header'>
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
          <a href class="navbar-brand block"><span><img src="../img/logo-deprixa.png" height="59" width="310"></span></a>
		  
        <!-- / brand -->
      </div>
      <!-- / navbar header -->

    </div>
	</br></br>
    <!--  contents area start  -->
    <div class="col-md-12">
       <hr>
        <?php
        $passed = '';
        $ltext = '';
        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
            $ltext .= 'To Run <strong>'.$app_name.'</strong> </br></br> 
			<ul>
				<li>You need at least PHP version 5.4.0,</li>
				<li>Your PHP Version is: ' . PHP_VERSION . " Tested <strong>---PASSED---</strong><br/></li>
			</ul>"; 			
            $passed .= '1';

        } else {
            $ltext .= 'To Run <strong>'.$app_name.'</strong> </br></br>
			<ul>
				<li>You need at least PHP version 5.4.0,</li>
				<li>Your PHP Version is: ' . PHP_VERSION . " Tested <strong>---PASSED---</strong><br/></li>
			</ul>"; 			
            $passed .= '0';

        }

        if (extension_loaded('PDO')) {
            $ltext .= '
			<ul>
				<li>PDO is installed on your server: ' . "Tested <strong>---PASSED---</strong><br/></li>
			</ul>
			";
            $passed .= '1';
        } else {
            $ltext = '
			<ul>
				<li>PDO is installed on your server: ' . "Tested <strong>---FAILED---</strong><br/><li>
			</ul>
			";
            $passed .= '0';

        }

        if (extension_loaded('pdo_mysql')) {
            $ltext .= '
			<ul>
				<li>PDO MySQL driver is enabled on your server: ' . "Tested <strong>---PASSED---</strong><br/></li>
			</ul>
			";
            $passed .= '1';
        } else {
            $ltext .= '
			<ul>
				<li>PDO MySQL driver is not enabled on your server: ' . "Tested <strong>---FAILED---</strong><br/></li>
			</ul>
			";
            $passed .= '0';

        }
        if ($passed == '111') {
            echo("<br/> $ltext <br/> Great! System Test Completed. You can run  <strong>$app_name</strong> on your server. Click Continue For Next Step.
			 </br></br></br>
			 <a href=\"step3.php\" class=\"btn btn-info\">Continue</a> 
			 ");
					} else {
						echo("<br/> $ltext <br/> Sorry. The requirements of <strong>$app_name</strong> is not available on your server.
			 Please contact with this page- $support_url with this code- $passed Or contact with your server administrator
			  <br><br>
			 <a href=\"#\" class=\"btn btn-danger disabled\">Correct The Problem To Continue</a> 
			 ");
        }


        ?>
    </div>


    <!--  contents area end  -->
</div>
</br></br>
<center>Copyrights © 2017 Deprixa 3.2.3. All Rights Reserved</center>
<script src="ui/theme/deprixa/js/jquery-1.10.2.js"></script>
<script src="ui/theme/deprixa/js/bootstrap.min.js"></script>
<script src="ui/lib/blockui.js"></script>


</body>
</html>

