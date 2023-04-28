<?php
//Include database configuration file
include('database-settings.php');

$db = conexion();

if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
    //Get all state data
    $query = $db->query("SELECT * FROM states WHERE country_id = ".$_POST['country_id']." AND status = 1 ORDER BY state_name ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display states list
    if($rowCount > 0){
        echo '<option value="">Capital</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
        }
    }else{
        echo '<option value="">Capital no disponible</option>';
    }
}

if(isset($_POST["iso"]) && !empty($_POST["iso"])){
    //Get all state data
    $query = $db->query("SELECT * FROM countries WHERE country_id = ".$_POST['iso']." AND status = 1 ORDER BY iso ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display states list
    if($rowCount > 0){

        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['iso'].'">'.$row['iso'].'</option>';
        }
    }else{
        echo '<option value="">Codigo no disponible</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
    $query = $db->query("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Ciudad</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="">Ciudad no disponible</option>';
    }
}

if(isset($_POST["customer_id"]) && !empty($_POST["customer_id"])) {
  # obtengo los datos del cliente
  $query = $db->query("SELECT *
                         FROM tbl_clients 
                        WHERE id = ".$_POST['customer_id']);

  # numero de registros
  $rowCount = $query->num_rows;

  //Display customer list
  if($rowCount > 0) {
    while($customer = $query->fetch_assoc()) {
		$nombre=utf8_encode($customer['name']);
		$telephone=$customer['phone'];
		$telefono=$customer['telefono'];
		$addresses=utf8_encode($customer['address']);
		$identification=$customer['cc'];
		$countries=$customer['country'];
		$state1=utf8_encode($customer['department']);
		$isos=$customer['iso'];
		$city=utf8_encode($customer['state']);		
		$zip=utf8_encode($customer['zipcode']);
		$mail = utf8_encode($customer['email']);
		$mail = ((!isset($mail) && empty($mail))?"":$mail);

		if(!isset($nombre) && empty($nombre)) {
			$nombre="";
		}
		if(!isset($telephone) && empty($telephone)){
			$telephone="";
		}
		if(!isset($telefono) && empty($telefono)){
			$telefono="";
		}
		if(!isset($addresses) && empty($addresses)){
			$addresses="";
		}
		if(!isset($identification) && empty($identification)){
			$identification="";
		}
		if(!isset($countries) && empty($countries)){
			$countries="";
		}
		if(!isset($state1) && empty($state1)){
			$state1="";
		}
		if(!isset($isos) && empty($isos)){
			$isos="";
		}
		if(!isset($city) && empty($city)){
			$city="";
		}
		if(!isset($zip) && empty($zip)){
			$zip="";
		}


		  $customerInfo = array('nombre' => $nombre,
                            'addresses' => $addresses,
                            'telephone' => $telephone,
                            'phone2' => $telefono,
                            'identification' => $identification,
                            'isos' => $isos,
                            'countries' => $countries,
							'state1' => $state1,
                            'city' => $city,
                            'zip' => $zip,
                            'email' => $mail);

			echo json_encode($customerInfo, JSON_UNESCAPED_UNICODE);
			break;
		}

    }else{
        echo '';
    }
}
?>


