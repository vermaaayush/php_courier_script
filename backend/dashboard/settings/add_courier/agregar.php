<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
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
require_once('../sms/sms.php');
require_once('../../database.php');
require_once('../../database-settings.php');

	$Shippername = $_POST['Shippername'];
	$Shipperphone = $_POST['Shipperphone'];
	$Shipperaddress = $_POST['Shipperaddress'];
	$Shippercc = $_POST['Shippercc'];	
	$Receivername = $_POST['Receivername'];
	$Receiverphone = $_POST['Receiverphone'];
	$telefono1 = $_POST['telefono1'];
	$Receiveraddress = $_POST['Receiveraddress'];
	$Receivercc_r = $_POST['Receivercc_r'];
	$Receiveremail = $_POST['Receiveremail'];
	$tracking = $_POST['tracking'];
	$ConsignmentNo = $_POST['ConsignmentNo'];
	$letra = $_POST['letra'];
	$Shiptype = $_POST['Shiptype'];
	$Weight = $_POST['Weight'];
	$kiloadicional = $_POST['kiloadicional'];
	$variable = $_POST['variable'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$pesoreal = $_POST['pesoreal'];
	$Invoiceno = $_POST['Invoiceno'];
	$Qnty = $_POST['Qnty'];	
	$altura = $_POST['altura'];
	$ancho = $_POST['ancho'];
	$longitud = $_POST['longitud'];
	$totalpeso = $_POST['totalpeso'];
	$bookingmode = $_POST['bookingmode'];
	$Totalfreight = $_POST['Totalfreight'];
	$Totaldeclarate = $_POST['Totaldeclarate'];
	$Totaldeclarado = $_POST['Totaldeclarado'];
	$Mode = $_POST['Mode'];
	$Packupdate = $_POST['Packupdate'];
	$Schedule = $_POST['Schedule'];
	$Pickuptime = $_POST['Pickuptime'];
	$iso = $_POST['iso'];
	$ciudad = $_POST['ciudad'];
	$estado = $_POST['estado'];
	$zipcode = $_POST['zipcode'];
	$paisdestino = $_POST['paisdestino'];
	$city2 = $_POST['city2'];
	$iso1 = $_POST['iso1'];
	$city1 = $_POST['city1'];
	$zipcode1 = $_POST['zipcode1'];	
	$status = $_POST['status'];
	$Comments = $_POST['Comments'];
	$officename = $_POST['officename'];
	$user = $_POST['user'];	
	$status_delivered = $_POST['status_delivered'];
	
	#
	## Obtengo datos de la empresa
	$qryEmpresa =  mysql_query("SELECT * FROM company");

	while($row = mysql_fetch_array($qryEmpresa)) {

		$pre  = $row["prefijo"];
	}
	mysql_free_result($qryEmpresa);
	
	$pa=mysql_query("SELECT MAX(cons_no)as maximo FROM courier");				
        if($row=mysql_fetch_array($pa)){
			if($row['maximo']==NULL){
				$cons_no='100000001';
			}else{
				$cons_no=$row['maximo']+1;
			}
		}

	$sql = "INSERT INTO courier (tracking,cons_no, letra,ship_name, phone, s_add, cc, rev_name, r_phone, telefono1, r_add, cc_r, email, type, weight, variable, kiloadicional, shipping_subtotal, altura, ancho, longitud, totalpeso, invice_no, qty, book_mode, freight, declarate, declarado, mode, pick_date, schedule, pick_time, iso,  ciudad, zipcode, paisdestino, iso1,  city1, zipcode1, status, comments, officename, status_delivered, user, book_date, pesoreal)
			VALUES('$pre-$cons_no','$cons_no', '$pre', '$Shippername','$Shipperphone', '$Shipperaddress', '$Shippercc', '$Receivername','$Receiverphone', '$telefono1', '$Receiveraddress', '$Receivercc_r', '$Receiveremail', '$Shiptype',$Weight , '$variable', '$kiloadicional', '$shipping_subtotal', '$altura', '$ancho', '$longitud', '$totalpeso', '$Invoiceno', '$Qnty', '$bookingmode', '$Totalfreight',  '$Totaldeclarate', '$Totaldeclarado', '$Mode', '$Packupdate', '$Schedule', '$Pickuptime', '$iso',  '$estado | $ciudad', '$zipcode', '$paisdestino', '$iso1', '$city2 | $city1', '$zipcode1', '$status', '$Comments', '$officename', '$status_delivered', '$user', curdate(), '$pesoreal')";	
	//	echo $sql;
	dbQuery($sql);
					
					
	$result131 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result131)) {
	
	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompanie  = $row["cname"];
	$footer  = $row["footer_website"];
	$web  = $row["website"];
	$url = APP_URL."/img/logo-email.png";
    // subject

    $subject = ''.$envioasudestino.' | '.$row["cname"].'';
	$from = $row["bemail"];
    // message			   	
	
	// HTML email starts here
	require '../../requirelanguage.php';
	
	$message  = "<html><body>";	
	$message .= "<div style='font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee'>
							<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
							<tbody>
								<tr>
									<td>
										<table align='center' width='750px' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee' style='width:750px!important'>
										<tbody>
											<tr>
												<td>
													<table width='690' align='center' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
													<tbody>
														<tr>
															<td colspan='3' height='80' align='center' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee' style='padding:0;margin:0;font-size:0;line-height:0'>
																<table width='690' align='center' border='0' cellspacing='0' cellpadding='0'>
																<tbody>
																	<tr>
																		<td width='30'></td>
    																		<td align='left' valign='middle' style='padding:0;margin:0;font-size:0;line-height:0'><a href='$web' target='_blank'><img src='http://royalperthmints.com/logo.png'></a></td>
																		<td width='30'></td>
																	</tr>
																</tbody>
																</table>
															</td>
														</tr>
														<tr>
															<td colspan='3' align='center'>
																<table width='630' align='center' border='0' cellspacing='0' cellpadding='0'>
																<tbody>
																	<tr>
																		<td colspan='3' height='60'></td></tr><tr><td width='25'></td>
																		<td align='center'>
																			<h1 style='font-family:HelveticaNeue-Light,arial,sans-serif;font-size:40px;color:#404040;line-height:40px;font-weight:bold;margin:0;padding:0'>$welcometo $namecompanie</h1>
																		</td>
																		<td width='25'></td>
																	</tr>
																	<tr>
																		<td colspan='3' height='40'></td></tr><tr><td colspan='5' align='center'>
																			<p style='color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0'>$hola  <strong>$Receivername</strong></p><br>
																			<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																			<strong><strong>$Shippername</strong>, $tehaenviado</p><br>
																		</td>
																	</tr>
																	<tr>
																</tr>
																<tr><td colspan='3' height='30'></td></tr>
															</tbody>
															</table>
														</td>
													</tr>
													
													<tr bgcolor='#ffffff'>
														<td width='30' bgcolor='#eeeeee'></td>
															<table width='570' align='center' border='0' cellspacing='0' cellpadding='0'>
														<td>
															<tbody>
																<tr>
																	<td colspan='4' align='center'>&nbsp;</td>
																</tr>
																<tr>
																	<td colspan='4' align='center'><h2 style='font-size:24px'>$envioasudestino</h2></td>
																</tr>
																<tr>
																	<td colspan='4'>&nbsp;</td>
																</tr>
																<tr>
																	<td width='120' align='right' valign='top'><img src='http://deprixapro.jaom.info/icon-destination.png' alt='tool' width='150' height='138'></td>
																	<td width='30'></td>
																	<td align='left' valign='middle'>
																		<h3 style='color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0'>$estadodelenvio</h3>
																		<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$_Tracking:</strong> <strong>$pre-$cons_no</strong></div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$estado:</strong> <strong>$status</strong></div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$email1:</strong> <strong>$Receiveremail</strong></div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$destinoe:</strong> <strong>$paisdestino</strong></div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$direccion:</strong> <strong>$Receiveraddress</strong></div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$fechadelenvio:</strong> <strong>$Schedule</strong></div>
																		<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$DetallesdelEnvio:</strong> <strong>$Comments</strong></div>
																	</td>
																	<td width='30'></td>
																</tr>
																<tr>
																	<td colspan='4'>&nbsp;</td>
																</tr>
															</tbody>
															</table>
															<table width='570' align='center' border='0' cellspacing='0' cellpadding='0'>
																<tbody>
																	<tr>
																		<td align='center'>
																			<div style='text-align:center;width:100%;padding:40px 0'>
																				<table align='center' cellpadding='0' cellspacing='0' style='margin:0 auto;padding:0'>
																				<tbody>
																					<tr>
																						<td align='center' style='margin:0;text-align:center'><a href='$web' style='font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block' target='_blank'>$tracking!</a></td>
																					</tr>
																				</tbody>
																				</table>
																			</div>
																		</td>
																  </tr>
																  <tr><td>&nbsp;</td>
																  </tr>
																  <tr>
																	<td>
																		<h2 style='color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0'>&nbsp;</h2>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>$hola $rev_name $estaes <br /><br /> <strong> $address $porfavor</div>
																	</td>
																</tr>
																<tr><td>&nbsp;</td>
																</tbody>
															</table>
														</td>
														<td width='30' bgcolor='#eeeeee'></td>
													</tr>
													</tbody>
													</table>
													<table align='center' width='750px' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee' style='width:750px!important'>
													<tbody>
														<tr>
															<td>
																<table width='630' align='center' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
																<tbody>
																	<tr><td colspan='2' height='30'></td></tr>
																	<tr>
																		<td width='360' valign='top'>
																			<div style='color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0'>$footer</div>
																			<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																			<div style='color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0'>$namecompany</div>
																		</td>
																		<td align='right' valign='top'>
																			<span style='line-height:20px;font-size:10px'><a href='' target='_blank'><img src='http://i.imgbox.com/BggPYqAh.png' alt='fb'></a>&nbsp;</span>
																			<span style='line-height:20px;font-size:10px'><a href='' target='_blank'><img src='http://i.imgbox.com/j3NsGLak.png' alt='twit'></a>&nbsp;</span>
																			<span style='line-height:20px;font-size:10px'><a href='' target='_blank'><img src='http://i.imgbox.com/wFyxXQyf.png' alt='g'></a>&nbsp;</span>
																		</td>
																	</tr>
																	<tr><td colspan='2' height='5'></td></tr>
																   
																</tbody>
																</table>
															</td>
														</tr>
													</tbody>
													</table>
												</td>
											</tr>
										</tbody>
										</table>
									</td>
								</tr>
							</tbody>
							</table>
						</div>";	
	$message .= "</body></html>";

	}
    // To send HTML mail, the Content-type header must be set

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
   // Additional headers
    $headers .= 'From: '.$from."\r\n";	
    // this line checks that we have a valid email address
	mail($to, $subject, $message, $headers); //This method sends the mail.
	mail($Receiveremail, $subject, $message, $headers); //This method sends the
	
	$sms_text = "Dear $Receivername, Shipment has  been processed on your behalf with tracking number  $pre-$cons_no . Click here to find out when it will arrive http://royalperthmints.com/";
	//$Receiverphone ="+923447073363";
	msg_content($Receiverphone,$sms_text);
   
   echo "<script type=\"text/javascript\">
			alert(\"$envioclienteok\");
			window.location = \"../../add-courier.php\"
		</script>";																			
	
	//echo $Ship;

?>