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
        <?php
        if (isset($_GET['_error']) && ($_GET['_error']) == '1') {
            echo '<hr><h4 style="color: red;"> Unable to Connect Database, Please make sure database info is correct and try again ! </h4><hr>';
        }
        elseif (isset($_GET['_error']) && ($_GET['_error']) == '2') {
            echo '<hr><h4 style="color: red;"> Config File Already Exist, Application is already installed. If Not delete config.php in application folder. And try installing again. </h4><hr>';
        }

        elseif (isset($_GET['_error']) && ($_GET['_error']) == '3') {
            echo '<hr><h4 style="color: red;"> Please provide database info correctly and try again. </h4><hr>';
        }

        else{
           // echo '<h4 style="color: red;"> An Error Occuered </h4>';
        }
        ?>
        <?php
        $http = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $cururl = $http . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $appurl = str_replace('/install/step3.php', '', $cururl);
        $appurl = str_replace('?_error=1', '', $appurl);
        $appurl = str_replace('?_error=2', '', $appurl);
        $appurl = str_replace('?_error=3', '', $appurl);
        $appurl = str_replace('/application', '', $appurl);
        ?>
        <form action="step4.php" method="post" id="ib_form">
            <fieldset>
                <legend>Database Connection &amp Site config</legend>

                <div class="form-group">
                    <label for="appurl">Application URL</label>
                    <input type="text" class="form-control" id="appurl" name="appurl" value="<?php echo $appurl; ?>">
                    <span class='help-block'>Application url without trailing slash at the end of url <strong>( http://example.com/dashboard/install )</strong>. Please keep default, if you are unsure.</span>
                </div>
                <hr>
                <p>Before getting started, we need some information on the database. You will need to know the following items, input those and Click Submit to Continue.</p>
                <hr>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="dbhost">Database Host</label>
						<input type="text" class="form-control" id="dbhost" name="dbhost" value="localhost">
						<span class="help-block">You should be able to get this info from your web host, if <strong>localhost</strong> doesn’t work.</span>
					</div>
					<div class="col-sm-6 form-group">
						<label for="dbuser">Database Username</label>
						<input type="text" class="form-control" id="dbuser" name="dbuser" placeholder="Database user name">
						<span class="help-block">Your database username.</span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="dbpass">Database Password</label>
						<input type="password" class="form-control" id="dbpass" name="dbpass" placeholder="Database Password">
						<span class="help-block">Your database password.</span>
					</div>

					<div class="col-sm-6 form-group">
						<label for="dbname">Database Name</label>
						<input type="text" class="form-control" id="dbname" name="dbname" placeholder="Database Name">
						<span class="help-block">The name of the database.</span>
					</div>
				</div>
				</br></br>
                <button type="submit" id="ib_submit" class="btn btn-info">Submit</button>
            </fieldset>
        </form>
    </div>
</div>

</br></br>
<center>Copyrights © 2017 Deprixa 3.2.3. All Rights Reserved</center>


<script src="ui/theme/deprixa/js/jquery-1.10.2.js"></script>
<script src="ui/theme/deprixa/js/bootstrap.min.js"></script>
<script src="ui/lib/blockui.js"></script>
<script src="ui/theme/deprixa/lib/bootbox.min.js"></script>

<script type="text/javascript">

    var block_msg = '<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="32" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div>';

    var ib_submit = $("#ib_submit");
    var ib_box = $("#main-container");

    ib_submit.on('click', function(e) {

        e.preventDefault();
        ib_box.block({message: block_msg});

        $.post("ajax_c.php", $('#ib_form').serialize())
            .done(function( data ) {

                if ($.isNumeric(data)) {

//                    ib_box.unblock();

                    ib_box.block({message: '<h3 style="color: #fff">Config file created. Importing database....</h3>'});

                 //   window.location = 'profile.php';

                    $.get( "db_import.php", function( data ) {

                        if ($.isNumeric(data)) {

                            ib_box.block({message: '<h3 style="color: #fff">Database Imported. Redirecting.....</h3>'});

                            window.location = 'profile.php';

                        }
                        else{
                            window.location = '../../login.php';
                        }

                    });


                }

                else {
                    ib_box.unblock();
                    bootbox.alert(data);
                }

            });

    });

</script>

</body>
</html>

