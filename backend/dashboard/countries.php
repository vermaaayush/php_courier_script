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
require_once('../deprixa/database.php');

$query="SELECT id,nombre FROM paises ORDER BY nombre";
$result = mysql_query($query)
        or die("Ocurrio un error en la consulta SQL");
mysql_close();
echo '<option value="0">Seleccionar</option>';
while (($fila = mysql_fetch_array($result)) != NULL) {
    echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
}
// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($dbConn);

?>
