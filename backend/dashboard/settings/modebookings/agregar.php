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


	$name = $_POST['name'];
	$services = $_POST['services'];
	$deliverytime = $_POST['deliverytime'];
	$observations = $_POST['observations'];
	$estado = $_POST['estado'];
	
	// verificamos si esta marcado el check box activo
	if(isset($_POST['estado']))
	$estado = $_POST['estado'];
	else
	$estado = 0;


	$sql1="INSERT INTO mode_bookings (name,services,deliverytime,observations,estado) VALUES('$name','$services','$deliverytime','$observations','$estado')";	
			
	dbQuery($sql1);
	
	echo "<script type=\"text/javascript\">
						alert(\"Thank you for your registration.\");
						window.location = \"../../modebookings.php\"
					</script>"; 

?>