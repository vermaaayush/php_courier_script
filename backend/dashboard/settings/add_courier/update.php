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
	$Shippername = $_POST['Shippername'];
	$Shipperphone = $_POST['Shipperphone'];
	$Shipperaddress = $_POST['Shipperaddress'];
	$Shippercc = $_POST['Shippercc'];
	
	$Receivername = $_POST['Receivername'];
	$Receiverphone = $_POST['Receiverphone'];
	$Receiveraddress = $_POST['Receiveraddress'];
	$Receivercc_r = $_POST['Receivercc_r'];
	$Receiveremail = $_POST['Receiveremail'];
	
	$Shiptype = $_POST['Shiptype'];
	$Weight = $_POST['Weight'];
	$kiloadicional = $_POST['kiloadicional'];
	$variable = $_POST['variable'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$Invoiceno = $_POST['Invoiceno'];
	$Qnty = $_POST['Qnty'];
	
	$altura = $_POST['altura'];
	$ancho = $_POST['ancho'];
	$longitud = $_POST['longitud'];
	$totalpeso = $_POST['totalpeso'];
	$pesoreal = $_POST['pesoreal'];
	
	$Bookingmode = $_POST['Bookingmode'];
	$Totalfreight = $_POST['Totalfreight'];
	$Totaldeclarate = $_POST['Totaldeclarate'];
	$Totaldeclarado = $_POST['Totaldeclarado'];
	$Mode = $_POST['Mode'];
	
	$Packupdate = $_POST['Packupdate'];
	$Schedule = $_POST['Schedule'];
	$Pickuptime = $_POST['Pickuptime'];
	$iso = $_POST['iso'];
	$ciudad = $_POST['ciudad'];
	
	$paisdestino = $_POST['paisdestino'];
	$iso1 = $_POST['iso1'];
	$city1 = $_POST['city1'];
	$status = $_POST['status'];
	$Comments = $_POST['Comments'];
	$officename = $_POST['officename'];
	$user = $_POST['user'];	

	$sql = "UPDATE courier
   SET ship_name='$Shippername',phone='$Shipperphone',s_add='$Shipperaddress', cc='$Shippercc', rev_name='$Receivername',r_phone='$Receiverphone',r_add='$Receiveraddress', cc_r='$Receivercc_r', email='$Receiveremail', type='$Shiptype', weight='$Weight', variable='$variable', kiloadicional='$kiloadicional', invice_no='$Invoiceno',declarate='$Totaldeclarate', declarado='$Totaldeclarado', mode ='$Mode', pick_date='$Packupdate' , schedule='$Schedule',pick_time='$Pickuptime',iso='$iso',ciudad='$ciudad',paisdestino='$paisdestino',iso1='$iso1',city1='$city1',book_mode='$Bookingmode',freight='$Totalfreight',qty='$Qnty', shipping_subtotal='$shipping_subtotal', altura='$altura', ancho='$ancho', longitud='$longitud', totalpeso='$totalpeso', status='$status', comments='$Comments', officename='$officename', user='$user' , pesoreal='$pesoreal'
   WHERE cid = '$cid'";	
		//echo $sql;
	dbQuery($sql);	
	
    require '../../requirelanguage.php';
	
	echo "<script type=\"text/javascript\">
			alert(\"$updateexit\");
			window.location = \"../../index.php\"
		</script>";

	//echo $Ship;
    
?>