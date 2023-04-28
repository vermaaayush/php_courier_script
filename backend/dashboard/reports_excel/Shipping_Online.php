<?php

	// *************************************************************************
	// *                                                                       *
	// * DEPRIXA -  Integrated Web System		                               *
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
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Shipping_Online.xls");

	
	if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Employee');
	if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator');	
	
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	require_once('../database.php');	
	require_once ('../requirelanguage.php');
	$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $company['cname']; ?> | <?php echo $enviosonline; ?></title>
<style type="text/css"> 
	<!-- 
	.estilo1 { 
	font-family: Arial, sans-serif;  
	font-size: 12px; 
	color: #ffffff; 
	font-weight: bold; 
	} 
	.estilo2 { 
	font-family: Arial, sans-serif;  
	font-size: 14px; 
	color: #001028; 
	font-weight: bold; 
	} 
	.estilo4 { 
	font-family: Arial, sans-serif;  
	color: #242726; 
	font-weight: bold; 
	} 
	.estilo3 {font-family: Arial, sans-serif;  font-size: 11px; color: #5D6975; } 
	--> 
</style> 
</head>
	<body>
		<header>
		  <div class="estilo2">
			<div><span><?php echo $companys; ?>:</span><?php echo $company['cname']; ?></div>
			<div><span><?php echo $empleado; ?>:</span><?php echo  $_SESSION['user_name']; ?></div>
			<div><span><?php echo $direccion1; ?>:</span><?php echo $company['caddress']; ?></div>
			<div><span><?php echo $email1; ?>:</span> <a href="mailto:<?php echo $company['cemail']; ?>"> <?php echo $company['cemail']; ?></a></div>
			<div><span><?php echo $fecha; ?>:</span><?php echo date('d-m-Y'); ?></div>
		  </div>
		</header>
		</br></br>
		<main>
			<table width="50%" border="1">
				  <tr>
					<td colspan="7" class="estilo4"><CENTER><strong> <h1><?php echo $enviosonline; ?></h1></strong></CENTER></td>
				  </tr>
				  <tr bgcolor="black" border="1"  cellspacing="0" cellpadding="0">
					<th class="estilo1"><?php echo $TRACK; ?></th>
					<th class="estilo1"><?php echo $DESTINO; ?></th>
					<th class="estilo1"><?php echo $FECHA; ?></th>
					<th class="estilo1"><?php echo $REMITE; ?></th>
					<th class="estilo1"><?php echo $DESTINA; ?></th>
					<th class="estilo1"><?php echo $TELEFONO; ?></th>
					<th class="estilo1"><?php echo $ESTADO; ?></th>
				  </tr>
				  </thead>
				<tbody>	
  
				<?php
					if(strlen($_GET['desde'])>0 and strlen($_GET['hasta'])>0){
						$desde = $_GET['desde'];
						$hasta = $_GET['hasta'];

						$verDesde = date('d/m/Y', strtotime($desde));
						$verHasta = date('d/m/Y', strtotime($hasta));
					}else{
						$desde = '1111-01-01';
						$hasta = '9999-12-30';

						$verDesde = '__/__/____';
						$verHasta = '__/__/____';
						
					}
						
					$sql=mysql_query("select cid,cons_no,paisdestino,date,ship_name,rev_name,r_phone,status FROM courier_online WHERE  date   BETWEEN '$desde' AND '$hasta'");
					while($express=mysql_fetch_array($sql)){		

						$track=$express['cons_no'];
						$destination=$express['paisdestino'];
						$dates=$express['date'];
						$name=$express['ship_name'];
						$rname=$express['rev_name'];
						$phone=$express['r_phone'];
						$staties=$express['status'];						

				?>  
				 <tr>
					<td class="estilo3"><center><?php echo $track; ?></center></td>
					<td class="estilo3"><center><?php echo $destination; ?></center></td>
					<td class="estilo3"><center><?php echo $dates; ?></center></td>
					<td class="estilo3"><center><?php echo $name; ?></center></td>
					<td class="estilo3"><center><?php echo $rname; ?></center></td>
					<td class="estilo3"><center><?php echo $phone; ?></center></td>
					<td class="estilo3"><center><?php echo $staties; ?></center></td>                     
				 </tr> 
				  <?php
				}
				  ?>
			
		
				</tbody>
		  </table>
		</main>
	</body>
</html>