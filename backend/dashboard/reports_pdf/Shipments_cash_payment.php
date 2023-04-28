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
	
	if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Employee');
	if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Administrator');	
	
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	require_once("dompdf/dompdf_config.inc.php");
	require_once('../database.php');	
	require_once ('../requirelanguage.php');
	$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));

	$codigoHTML='
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>'.$company['cname'].' | '.$enviospagoefectivo.'</title>
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
		<header class="estilo2">
		  <div id="project">
			<div><span>'.$companys.':</span>  '.$company['cname'].'</div>
			<div><span>'.$empleado.':</span>  '.$_SESSION['user_name'].'</div>
			<div><span>'.$direccion1.':</span> '.$company['caddress'].'</div>
			<div><span>'.$email1.':</span> <a href="mailto:'.$company['cemail'].'">  '.$company['cemail'].'</a></div>
			<div><span>'.$fecha.':</span> '.date('d-m-Y').'</div>
		  </div>
		</header>
		</br></br>
		<main>
			  <table width="100%">
				  <tr>
					<td colspan="7" class="estilo4"><CENTER><strong> <h1>'.$enviospagoefectivo.'</h1></strong></CENTER></td>
				  </tr>
				  <tr bgcolor="black" border="1" solid  #5D6975 cellspacing="0" cellpadding="0">
					<th class="estilo1">'.$TRACK.'</th>
					<th class="estilo1">'.$DESTINO.'</th>
					<th class="estilo1">'.$FECHA.'</th>
					<th class="estilo1">'.$REMITE.'</th>
					<th class="estilo1">'.$DESTINA.'</th>
					<th class="estilo1">'.$TELEFONO.'</th>
					<th class="estilo1">'.$ESTADO.'</th>
				  </tr>
				  </thead>
				<tbody>';



				$sql=mysql_query("SELECT * FROM courier WHERE book_mode = 'Effective'  AND officename='".$_SESSION["user_type"]."' AND book_date   BETWEEN '$desde' AND '$hasta'");
				while($express=mysql_fetch_array($sql)){
				$codigoHTML.='	
					<tr>
						<td class="estilo3">'.$express['tracking'].'</td>
						<td class="estilo3">'.$express['pick_time'].'</td>
						<td class="estilo3">'.$express['book_date'].'</td>
						<td class="estilo3">'.$express['ship_name'].'</td>
						<td class="estilo3">'.$express['rev_name'].'</td>
						<td class="estilo3">'.$express['r_phone'].'</td>
						<td class="estilo3">'.$express['status'].'</td>										
					</tr>';
					
				}
		$codigoHTML.='
				</tbody>
			  </table>
			</body>
			</html>';
	$codigoHTML=utf8_encode($codigoHTML);
	$dompdf=new DOMPDF();
	$dompdf->load_html($codigoHTML);
	ini_set("memory_limit","128M");
	$dompdf->render();;
	$dompdf->stream("Shipments_cash_payment.pdf");
?>			  