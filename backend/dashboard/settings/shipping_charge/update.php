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
	$name = $_POST['name'];
	$packaging = $_POST['packaging'];
	$dimensions = $_POST['dimensions'];
	
		
	
	$resultado = $con->query("UPDATE type_shipments SET name='$name', packaging='$packaging', dimensions='$dimensions' WHERE id = '$id'");


	
	echo "<script type=\"text/javascript\">
						alert(\"Many thank you for your update.\");
						window.location = \"../../typeshipments.php\"
					</script>"; 
 
	
    
    
?>