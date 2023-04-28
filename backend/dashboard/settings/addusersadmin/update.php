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
		
	$cid=$_POST['cid'];
	$name_parson = $_POST['name_parson'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$office = $_POST['office'];
	$password = $_POST['pwd'];
	$pwdmd5 = md5(PASS_SALT.$password);
	$imagen = $_POST['imagen'];
	$tipo_imagen = $_POST['tipo_imagen'];
	
	// verificamos si esta marcado el check box activo
	if(isset($_POST['estado']))
	$estado = $_POST['estado'];
	else
	$estado = 0;

	if(isset($_POST['type']))
	$type = $_POST['type'];
	else
	$type = 0;
	
	
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
    //y que el tamano del archivo no exceda los 16mb
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 16000; //16mb es el limite de medium blob
	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 16000){
		
		 
     
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
		
	
	$resultado = $con->query("UPDATE manager_admin SET name_parson = '$name_parson', name='$name', email='$email', phone='$phone', office='$office',
			      pwd='$pwdmd5', imagen='$data', tipo_imagen='$tipo' WHERE cid = '$cid'");
	} else {
	  $resultado = $con->query("UPDATE manager_admin SET name_parson = '$name_parson', name='$name', email='$email', phone='$phone', office='$office',
		   pwd='$pwdmd5' WHERE cid = '$cid'");

	}

	echo "<script type=\"text/javascript\">
						alert(\"Many thank you for your update.\");
						window.location = \"../../add-new-users-admin.php\"
					</script>";
    
?>