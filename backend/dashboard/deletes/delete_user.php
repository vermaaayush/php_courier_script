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
require_once('../database-settings.php');
$con = conexion();

	$cid=$_GET['cid'];
	
	$resultado = $con->query("DELETE FROM manager_admin WHERE cid='$cid'");	
	
	if($resultado>0){
				
	echo "<script type=\"text/javascript\">
						alert(\"Usuario borrado Correctamente.\");
						window.location = \"../add-new-users-admin.php\"
					</script>"; 
	}else {
        echo "<script type=\"text/javascript\">
						alert(\"Error al borrar el usuario.\");
						window.location = \"../add-new-users-admin.php\"
					</script>";
    }
				
	
?>