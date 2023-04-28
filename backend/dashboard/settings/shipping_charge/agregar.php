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

	$name_courier = $_POST['name_courier'];
	$services = $_POST['services'];
	$rate = $_POST['rate'];
	$courier = $_POST['courier'];
	$Length = $_POST['Length'];
	$Width = $_POST['Width'];
	$Height	 = $_POST['Height'];
	$Weight = $_POST['Weight'];
	$WeightType = $_POST['WeightType'];
	$imagen = $_POST['imagen'];
	$tipo_imagen = $_POST['tipo_imagen'];
	
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
    //y que el tamano del archivo no exceda los 16mb
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 500; //16mb es el limite de medium blob
	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 250){
				 
     
	//este es el archivo temporal
	$imagen_temporal  = $_FILES['imagen']['tmp_name'];  
	//este es el tipo de archivo
	$tipo = $_FILES['imagen']['type'];
	//leer el archivo temporal en binario
	$fp     = fopen($imagen_temporal, 'r+b');
	$data = fread($fp, filesize($imagen_temporal));
	fclose($fp);
	//escapar los caracteres
	$data = mysql_escape_string($data);
	
	$sql = "INSERT INTO scheduledpickup (name_courier,services, rate, Length, Width, Height, Weight, WeightType, date,imagen, tipo_imagen)
			VALUES ('$name_courier','$services', '$rate', '$Length', '$Width', '$Height', '$Weight', '$WeightType', curdate(),'$data', '$tipo')";
	dbQuery($sql);
	
	require '../../requirelanguage.php';
	
	echo "<script type=\"text/javascript\">
						alert(\"$thank\");
						window.location = \"../../shipping-charge.php\"
					</script>"; 
	} else {
        echo "<script type=\"text/javascript\">
						alert(\"$nopermitido $limite_kb Kilobytes.\");
						window.location = \"../../shipping-charge.php\"
					</script>";
    }		 

?>