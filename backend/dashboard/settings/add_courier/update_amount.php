<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
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
	require_once('../../database.php');
	require_once('../../database-settings.php');
	require_once('../sms/sms.php');
	
	$cid = (int)$_POST['cid'];
	$total_price = $_POST['t_price'];
	$advance_price = $_POST['a_price'];
	$pending_price = $_POST['p_price'];
	$payment_mode = $_POST['payment_mode'];


	
	
	
	#
	## Obtengo datos de la empresa

	
	$sql_1 = "UPDATE courier SET shipping_subtotal='$total_price', 
	advance_price='$advance_price', pending_price='$pending_price', payment_mode='$payment_mode' WHERE cid = $cid";
	dbQuery($sql_1);

    // To send HTML mail, the Content-type header must be set

       echo "<script type=\"text/javascript\">
		alert(\"$actualizalinea ".$status."\");
		window.location = \"../../shipments.php\"
	</script>";
    // this line checks that we have a valid email address

?>