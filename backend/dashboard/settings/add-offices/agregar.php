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


	$off_name = $_POST['off_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$ph_no = $_POST['ph_no'];
	$office_time = $_POST['office_time'];
	$contact_person = $_POST['contact_person'];
	$estado = $_POST['estado'];

	
	// verificamos si esta marcado el check box activo
	if(isset($_POST['estado']))
	$estado = $_POST['estado'];
	else
	$estado = 0;


	$sql1="INSERT INTO offices (off_name,address,city,ph_no,office_time,contact_person,estado) VALUES 	
				('$off_name','$address','$city','$ph_no','$office_time','$contact_person','$estado')";
			
	dbQuery($sql1);
	
	echo "<script type=\"text/javascript\">
						alert(\"Thank you for your registration.\");
						window.location = \"../../add-office.php\"
					</script>"; 
	
    
?>