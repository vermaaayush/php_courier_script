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
require_once('../database.php');
require_once('../library.php');
require_once('../funciones.php');
require '../requirelanguage.php';
date_default_timezone_set($company['timezone']); 
$user=$_SESSION['cod_name'];
$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
$fecha_recibido=date('Y-m-d'); 
$hora_recibido=date('g:ia');
	
	header("Content-Disposition: attachment; filename=Reporte-Consolidados.xls"); 
	header("Pragma: no-cache");	

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    
    <title><?php echo $reportecons; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
</br></br>
	<a href="$web" class="navbar-brand text-lt">
          <span><img src="<?php echo $company['	website']; ?>/deprixa/img/logo-email.png' height='59' width='310'"></span>
        </a>
	<table width="100%" border="1">
	    <center><strong><?php echo $company['cname']; ?></strong></center>
		<center><strong><?php echo $caddress; ?></strong></center>
		<center><?php echo $telefono; ?>: <?php echo $company['cphone']; ?></center>
		</br></br>
       <center><strong><?php echo $FECHA; ?>: <?php echo $fecha_recibido; ?> / <?php echo $HORA; ?>: <?php echo $hora_recibido; ?></strong></center>
		<tr>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong>#</strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $CONTENEDOR; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $SELLO; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $GUIA; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $PESO; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $NOMBRE; ?></strong></center></font></td>
		 	<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $DIRECCION; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $CIUDAD; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $ESTADO; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $TELEFONO; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $TELEFONO2; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $CEDULA; ?></strong></center></font></td>
			<td  bgcolor= "#0059B2"><font color="white"><center><strong><?php echo $CONTENIDO; ?></strong></center></font></td>
			<td bgcolor= "#0059B2"><font color="white"><div align="right"><strong><?php echo $PESO; ?></strong></div></font></td>
		  </tr>
        <?php 
            $neto=0;
			$neto1=0;
			$n=0;
			$sql=mysql_query("SELECT * FROM consolidado_tmp	");
            while($row=mysql_fetch_array($sql)){
                $neto=$neto+$row['netoi'];
				$neto1=$neto1+$row['totali'];				
			$n++;	
        ?>
        <tr>
			<td><center><strong><?php echo $n; ?></strong></center></td>
			<td><center><?php echo $row['tracki']; ?></center></td>
			<td><center><?php echo $row['masteri']; ?></center></td>
			<td><center><?php echo $row['trackingi']; ?></center></td>
            <td><center><?php echo $row['totali']; ?></center></td>
			<td><center><?php echo $row['destinai']; ?></center></td>
			<td><center><?php echo $row['dirdestii']; ?></center></td>
			<td><center><?php echo $row['code1i']; ?></center></td>
			<td><center><?php echo $row['ciudadi']; ?></center></td>
			<td><center><?php echo $row['telefonoi']; ?></center></td>
			<td><center><?php echo $row['teledesi']; ?></center></td>
			<td><center><?php echo $row['cc_di']; ?></center></td>
			<td><center><?php echo $row['comentarioi']; ?></center></td>
            <td><div align="right">$ <?php echo number_format($row['netoi'],0, ',','.'); ?></div></td>
        </tr>
		
        <?php } ?>
        <tr>
			 <td colspan="4"><div align="center"><strong><?php echo $tpeso; ?></strong></div></td>
            <td><div align="right"><strong><?php echo $neto1; ?></strong></div></td>
            <td colspan="8"><div align="right"><strong><?php echo $tacumulado; ?></strong></div></td>
            <td><div align="right"><strong><?php echo $company['currency']; ?>&nbsp;<?php echo number_format($neto,0, ',','.'); ?></strong></div></td>
        </tr>
    </table>
<table width="100%" border="0">
  <tr>
  <tr>
  <tr>
  <tr>
    <td colspan="5">
    <p><strong><?php echo $quienr; ?>________________________________________</strong></p>
    </td>
  </tr>
 </table>
</body>
</html>