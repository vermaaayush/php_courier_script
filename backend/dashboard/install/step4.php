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
//error_reporting (0);

@ini_set('memory_limit', '512M');
@ini_set('max_execution_time', 0);
@set_time_limit(0);
require ('application_installer_config.php');
$appurl = $_POST['appurl'];
$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];
    if($appurl == '' OR $db_host == '' OR $db_user == '' OR $db_name == ''){
        header("location: step3.php?_error=3");
        exit;
    }
$cn = '0';
$wConfig = "../config.php";
if(file_exists($wConfig)){
    header("location: step3.php?_error=2");
    exit;
}
try{
    $dbh = new pdo( "mysql:host=$db_host;dbname=$db_name",
        "$db_user",
        "$db_password",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
   $cn = '1';
}
catch(PDOException $ex){
    header("location: step3.php?_error=1");
    exit;
}

if ($cn == '1') {
    $input = '<?php
$db_host	    = \'' . $db_host . '\';
$db_user        = \'' . $db_user . '\';
$db_password	= \'' . $db_password . '\';
$db_name	    = \'' . $db_name . '\';
define(\'APP_URL\', \'' . $appurl . '\');
define(\'PASS_SALT\',\'8kit={xe\');
$_app_stage = \'Live\'; // You can set this variable Live to Dev to enable DEPRIXA - Integrated Web system Debug';

    $fh = fopen($wConfig, 'w') or die("Can't create config file, your server does not support 'fopen' function, or file does not have write permission. Please check the documentation for Manual Installation.
  <br/>
 $input
 ");
    fwrite($fh, $input);
    fclose($fh);

    $sql = file_get_contents('primary.sql');

    $qr = $dbh->exec($sql);
    //

} else {
    header("location: step3.php?_error=$cn");
    exit;
}

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
        <h4> <?php echo $app_name; ?> Installer </h4>
        <?php
        if ($cn == '1') {

            ?>
            <p>
                <strong>Config File Created and Database Imported.</strong><br>
            </p>
            <form action="step5.php" method="post">
                <fieldset>
                    <legend>Click Continue</legend>

                    <button type='submit' class='btn btn-primary'>Continue</button>
                </fieldset>
            </form>
        <?php
        } elseif ($cn == '2') {
            ?>
            <p> MySQL Connection was successfull. An error occured while adding data on MySQL. Unsuccessfull
                Installation. Please refer manual installation in the Documentation or Contact osorio2380@yahoo.es for
                helping on installation</p>
        <?php
        } else {
            ?>

            <p> MySQL Connection Failed. </p>
        <?php

        }
        ?>
    </div>
</div>
<!--  contents area end  -->
</div>
</br></br>
<center>Copyrights © 2017 Deprixa 3.2.3. All Rights Reserved</center>
</body>
</html>

