<?php 
// Actualizamos en funcion del id que recibimos 

include("database-settings.php");
$db = conexion();
require 'requirelanguage.php';	
					
$sql = "DELETE FROM consolidado_tmp "; 
$db->query($sql);

echo "<script type=\"text/javascript\">
			alert(\"$borretabla\");
			window.location = \"consolidate_report.php\"
		</script>";
?> 