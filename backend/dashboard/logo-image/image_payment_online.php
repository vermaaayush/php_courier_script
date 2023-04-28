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
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('../database.php');



if ($_GET['cid'] > 0)
{

    // Consulta de búsqueda de la imagen.
    $consulta = "SELECT imagen, tipo FROM upload_image_bank WHERE cid={$_GET['cid']}";
    $resultado = @mysql_query($consulta);
    $row = mysql_fetch_assoc($resultado);

    $imagen = $row['imagen']; // row binarios de la imagen.
    $tipo = $row['tipo'];  // Mime Type de la imagen.
    // Mandamos las cabeceras al navegador indicando el tipo de row que vamos a enviar.
    header("Content-type: $tipo");
    // A continuación enviamos el contenido binario de la imagen.
    echo $imagen;
}
?>