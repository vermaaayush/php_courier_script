<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
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

//load the database configuration file
require_once('../database-settings.php');;
$db = conexion();	

if(isset($_POST['importSubmit'])) {
	   
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
	if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)) {
		
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {
			           
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first line
            fgetcsv($csvFile);
			
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
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE) {
				
                //check whether member already exists in database with same email
                $prevQuery = "SELECT id FROM tbl_clients WHERE email = '".$line[3]."'";
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0) {
                    //update member data
                    $db->query("UPDATE tbl_clients SET 	name = '".$line[0]."',
														cc = '".$line[1]."',
														address = '".$line[2]."',
														email = '".$line[3]."',
														phone = '".$line[4]."', 
														telefono = '".$line[5]."',
														password = '".md5(PASS_SALT.$line[6])."',
														company = '".$line[7]."',
														country = '".$line[8]."',
														department = '".$line[9]."',
														state = '".$line[10]."',
														iso = '".$line[11]."',
														zipcode = '".$line[12]."',
														lang = '".$line[13]."',
														estado = '".$line[14]."',
														date = '".$line[15]."'
								WHERE email = '".$line[3]."'");
								
                } else {
                    //insert member data into database
                    $db->query("INSERT INTO tbl_clients (name,cc,address,email,phone,telefono,password,company,
														country,department,state,iso,zipcode,lang,estado,date,imagen,tipo_imagen)
									 VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."','".md5(PASS_SALT.$line[6])."','".$line[7]."',
											'".$line[8]."','".$line[9]."','".$line[10]."','".$line[11]."','".$line[12]."','".$line[13]."','".$line[14]."','".$line[15]."','".mysql_real_escape_string($string)."', '$tipo_imagen')");
											
                }
            }
            
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: ../management-client.php".$qstring);