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

//*******MAIN FUNCTION FOR CONNECTING TO DATABASE MySQL*********//


//Variables uso general
$dblink='';
/**********************************************************************************************/
//funcion Error php
function error($dblink){ die ('Error de Conexión a la base de Datos. '.mysqli_error($dblink)); }
/**********************************************************************************************/
//Funcion para coneccion 
function conexion(){
    include('config.php');
        $dblink = mysqli_connect($db_host, $db_user, $db_password);
        $selected = mysqli_select_db($dblink,$db_name);
        if (!$selected) { error($dblink); }
        $dblink->query("SET NAMES 'utf8'");
    return $dblink;
}


?>