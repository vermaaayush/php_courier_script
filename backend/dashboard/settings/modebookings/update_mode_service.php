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
	$servicemode = $_POST['servicemode'];
	$detail = $_POST['detail'];
	$color = $_POST['color'];

	$resultado = $con->query("UPDATE service_mode SET servicemode='$servicemode', detail='$detail', color='$color' WHERE id = '$id'");

	echo "<script type=\"text/javascript\">
						alert(\"Many thank you for your update.\");
						window.location = \"../../styles.php\"
					</script>"; 
 
	
    
    
?>