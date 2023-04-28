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
require_once('../../database-settings.php');
$con = conexion();	
	$id=$_POST['id'];	
	$off_name = $_POST['off_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$ph_no = $_POST['ph_no'];
	$office_time = $_POST['office_time'];
	$contact_person = $_POST['contact_person'];
	
		
	
	$resultado = $con->query("UPDATE offices SET off_name='$off_name', address='$address', city='$city', ph_no='$ph_no', office_time='$office_time', contact_person='$contact_person' WHERE id = '$id'");


	
	echo "<script type=\"text/javascript\">
						alert(\"Thank you very much for your update.\");
						window.location = \"../../add-office.php\"
					</script>"; 
 
	
    
    
?>