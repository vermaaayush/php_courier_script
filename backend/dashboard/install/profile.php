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
<h3>Setup Your Profile</h3>
<hr>

        <form class="form-horizontal" role="form" id="ib_form">

            <div class="form-group">
                <label class="control-label col-sm-3" for="name_parson">Your Full Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name_parson" id="name_parson" placeholder="Enter Full Name" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Username:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Username" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Choose Password:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="confirm_pwd">Confirm Password:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="Re Enter password" required>
                </div>
            </div>
			</br></br>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" id="ib_submit" class="btn btn-info">Submit</button>
                </div>
            </div>
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

        $.post("post_profile.php", $('#ib_form').serialize())
            .done(function( data ) {


                if ($.isNumeric(data)) {

                    window.location = '../../login.php';

                }
                else{
                    ib_box.unblock();
                    bootbox.alert(data);
                }


            });

    });

</script>

</body>
</html>

