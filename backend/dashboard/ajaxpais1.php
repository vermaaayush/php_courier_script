<?php
//Include database configuration file
include('database-settings.php');

$db = conexion();

if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
    //Get all state data
    $querys = $db->query("SELECT * FROM states WHERE country_id = ".$_POST['country_id']." AND status = 1 ORDER BY state_name ASC");
    
    //Count total number of rows
    $rowCount = $querys->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = $querys->fetch_assoc()){ 
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["iso"]) && !empty($_POST["iso"])){
    //Get all state data
    $querys = $db->query("SELECT * FROM countries WHERE country_id = ".$_POST['iso']." AND status = 1 ORDER BY iso ASC");
    
    //Count total number of rows
    $rowCount = $querys->num_rows;
    
    //Display states list
    if($rowCount > 0){

        while($row = $querys->fetch_assoc()){ 
            echo '<option value="'.$row['iso'].'">'.$row['iso'].'</option>';
        }
    }else{
        echo '<option value="">Code not available</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
    $querys = $db->query("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");
    
    //Count total number of rows
    $rowCount = $querys->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $querys->fetch_assoc()){ 
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>