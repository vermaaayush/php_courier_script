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

require_once('../../database.php');


	$name = $_POST['name'];
	$cc = $_POST['cc'];
	$company = $_POST['company'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$telefono = $_POST['telefono'];
	$address=$_POST['address'];
	$country = $_POST['country'];
	$department = $_POST['department'];
	$state = $_POST['state'];
	$iso = $_POST['iso'];
	$zipcode = $_POST['zipcode'];
	$lang = $_POST['lang'];
	$pass = $_POST['password'];
	$pwdmd5 = md5($pass);
	$imagen = $_POST['imagen'];
	$tipo_imagen = $_POST['tipo_imagen'];

	
	// verificamos si esta marcado el check box activo
	if(isset($_POST['estado']))
	$estado = $_POST['estado'];
	else
	$estado = 0;

	#
	## Cargo la imagen por defecto
	$tipo_imagen = "image/png";
	$url = APP_URL."/img/user_image.png";

	$imagen = imagecreatefromstring(file_get_contents($url));
	imagealphablending($imagen, true);
	imagesavealpha($imagen, true);

	ob_start();
	imagepng($imagen);
	$string = ob_get_contents();
	ob_end_clean();

	$sql1 =mysql_query("SELECT email FROM tbl_clients WHERE email='$email' AND name='$name'");
			if($row=mysql_fetch_array($sql1)){							
				 echo "<script type=\"text/javascript\">
						alert(\"Email $email are already registered in the database, please enter different data, thank you.\");
						window.location = \"../../management-client.php\"
					</script>"; 							
			}else{
				
				$sql1="INSERT INTO tbl_clients (name,cc,address,email, phone, telefono, password, company, country, department, state, iso, zipcode,lang, estado,date,imagen,tipo_imagen) VALUES 	
				('$name','$cc','$address', '$email', '$phone', '$telefono', '$pwdmd5', '$company', '$country', '$department', '$state', '$iso', '$zipcode', '$lang', '$estado',curdate(), '".mysql_real_escape_string($string)."', '$tipo_imagen')";
			}
	dbQuery($sql1);
	
	echo "<script type=\"text/javascript\">
						alert(\"Thank you very much for registering.\");
						window.location = \"../../management-client.php\"
					</script>"; 


?>