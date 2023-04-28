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
	$deliveryboy = $_POST['deliveryboy'];
	$receivedby = $_POST['receivedby'];
	$drs = $_POST['drs'];
	$cons_no = $_POST['cons_no'];
    $ship_name = $_POST['ship_name'];
	$shippercc = $_POST['shippercc'];
	$s_phone = $_POST['s_phone'];
	$s_add = $_POST['s_add'];
	$email = $_POST['email'];
	$countries = $_POST['countries'];
	$iso = $_POST['iso'];
	$ciudad = $_POST['ciudad'];
	$zipcode = $_POST['zipcode'];
	$fcity = $_POST['fcity'];
	$rev_name = $_POST['rev_name'];
	$r_phone = $_POST['r_phone'];
	$r_phone1 = $_POST['r_phone1'];	
	$r_add = $_POST['r_add'];	
	$receivercc_r = $_POST['receivercc_r'];
	$paisdestino = $_POST['paisdestino'];
	$iso1 = $_POST['iso1'];
	$city1 = $_POST['city1'];
	$zipcode1 = $_POST['zipcode1'];
	$receiveremail = $_POST['receiveremail'];
	$tcity = $_POST['tcity'];
	$office_origin = $_POST['office_origin'];
	$type = $_POST['type'];
	$bookingmode = $_POST['bookingmode'];
	$service = $_POST['service'];
	$note = $_POST['note'];		
	$Qnty = $_POST['Qnty'];
	$variable = $_POST['variable'];
	$kiloadicional = $_POST['kiloadicional'];
	$weight = $_POST['weight'];
	$declarate = $_POST['declarate'];
	$declarado = $_POST['declarado'];
	$recogida = $_POST['recogida'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$pesoreal = $_POST['pesoreal']; 
	$altura = $_POST['altura'];
	$ancho = $_POST['ancho'];	
	$longitud  = $_POST['longitud'];
	$totalpeso = $_POST['totalpeso'];
	$mode = $_POST['mode'];
	$date = $_POST['date'];	
	$deliverydate  = $_POST['deliverydate'];
	$status = $_POST['status'];
	$deliver = $_POST['deliver'];
	$user = $_POST['user'];
	
	
	 $sql = "UPDATE courier_online
	   SET cons_no='$cons_no', ship_name='$ship_name',shippercc='$shippercc',s_phone='$s_phone',s_add='$s_add',email='$email',countries='$countries',iso='$iso',ciudad='$ciudad',zipcode='$zipcode',fcity='$fcity',rev_name='$rev_name',r_phone='$r_phone',r_phone1='$r_phone1',r_add='$r_add',receivercc_r='$receivercc_r',paisdestino='$paisdestino',iso1='$iso1',city1='$city1',zipcode1='$zipcode1',receiveremail='$receiveremail',tcity='$tcity',office_origin='$office_origin',type='$type',bookingmode='$bookingmode',service='$service',note='$note',Qnty='$Qnty',variable='$variable',kiloadicional='$kiloadicional',weight='$weight',declarate='$declarate',declarado='$declarado',recogida='$recogida',shipping_subtotal='$shipping_subtotal',pesoreal='$pesoreal',altura='$altura',ancho='$ancho',longitud='$longitud',totalpeso='$totalpeso',date='$date',deliverydate='$deliverydate',status='$status',deliver='$deliver',user='$user'
	   WHERE cid = '$cid'";				   

	 dbQuery($sql);
	 
	 require '../../requirelanguage.php';
	 
	 echo "<script type=\"text/javascript\">
				alert(\"$haactualizado\");
				window.location = \"../../index.php\"
			</script>";
    
?>