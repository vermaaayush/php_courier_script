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
	
    $cid = (int)$_POST['cid'];
	$dboy = $_POST['deliveryboy'];
	$rby = $_POST['receivedby'];
	$drs = $_POST['drs'];
	$deliveruser = $_POST['deliveruser'];
	
	$sql = "UPDATE courier_online SET status = 'Delivered', deliveryboy='$dboy', receivedby='$rby', drs='$drs', deliveruser='$deliveruser' WHERE cid= '$cid'";
	dbQuery($sql);
	
	require '../../requirelanguage.php';
	
	echo "<script type=\"text/javascript\">
		alert(\"$entregadoexit\");
		window.location = \"../../index.php\"
	</script>"; 
    
?>