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
	require_once('../../database-settings.php');
	require_once('../../database.php');
	
	$cid = (int)$_POST['cid'];
	$deliveryboy = $_POST['deliveryboy'];
	$receivedby = $_POST['receivedby'];
	$drs = $_POST['drs'];
	$cons_no = $_POST['cons_no'];
    $ship_name = $_POST['ship_name'];
	$shippercc = $_POST['shippercc'];
	$s_phone = $_POST['s_phone'];
	$s_add = $_POST['s_add'];
	$email = $_POST['email'];
	$countries = $_POST['countries'];
	$iso = $_POST['iso'];
	$ciudad = $_POST['ciudad'];
	$zipcode = $_POST['zipcode'];
	$rev_name = $_POST['rev_name'];
	$r_phone = $_POST['r_phone'];
	$r_phone1 = $_POST['r_phone1'];
	$r_add = $_POST['r_add'];
	$receivercc_r = $_POST['receivercc_r'];
	$paisdestino = $_POST['paisdestino'];
	$iso1 = $_POST['iso1'];
	$city1 = $_POST['city1'];
	$zipcode1 = $_POST['zipcode1'];
	$receiveremail = $_POST['receiveremail'];
	$office_origin = $_POST['office_origin'];
	$type = $_POST['type'];
	$bookingmode = $_POST['bookingmode'];
	$service = $_POST['service'];
	$note = $_POST['note'];
	$Qnty = $_POST['Qnty'];
	$variable = $_POST['variable'];
	$kiloadicional = $_POST['kiloadicional'];
	$weight = $_POST['weight'];
	$declarate = $_POST['declarate'];
	$declarado = $_POST['declarado'];
	$recogida = $_POST['recogida'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$pesoreal = $_POST['pesoreal'];
	$altura = $_POST['altura'];
	$ancho = $_POST['ancho'];
	$longitud  = $_POST['longitud'];
	$totalpeso = $_POST['totalpeso'];
	$mode = $_POST['mode'];
	$date = $_POST['date'];
	$deliverydate  = $_POST['deliverydate'];
	$status = $_POST['status'];
	$payment = $_POST['payment'];
	$paymode = $_POST['paymode'];
	$deliver = $_POST['deliver'];
	$deliveruser = $_POST['deliveruser'];
	$office = $_POST['office'];
	$comments = $_POST['comments'];
	$user = $_POST['user'];

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

	$sql = "INSERT INTO courier_online (cons_no,deliveryboy,receivedby,drs,ship_name,shippercc,s_phone,s_add,email,countries,iso,ciudad,zipcode,rev_name,r_phone,r_phone1,r_add,receivercc_r,paisdestino,iso1,city1,zipcode1,receiveremail,office_origin,type,bookingmode,service,note,Qnty,variable,kiloadicional,weight,declarate,declarado,recogida,shipping_subtotal,pesoreal,altura,ancho,longitud,totalpeso,mode,date,deliverydate,status,payment,paymode,deliver,deliveruser,comments,office,user)
	
	VALUES('$pre-$cons_no', '$deliveryboy', '$receivedby', '$drs', '$ship_name','$shippercc','$s_phone','$s_add','$email','$countries','$iso','$ciudad','$zipcode','$rev_name','$r_phone','$r_phone1','$r_add','$receivercc_r','$paisdestino','$iso1','$city1','$zipcode1','$receiveremail','$office_origin','$type','$bookingmode','$service','$note','$Qnty','$variable','$kiloadicional','$weight','$declarate','$declarado','$recogida','$shipping_subtotal','$pesoreal','$altura','$ancho','$longitud','$totalpeso','$mode','$date','$deliverydate','$status','Pending','$paymode','$deliver','$deliveruser','$comments','$office', '$user')";
	dbQuery($sql);

	$sql_1 = "UPDATE  online_booking SET status='Approved', tracking='AWBS-$cons_no' WHERE id = '$cid'";
	dbQuery($sql_1);
	
	$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {

	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompanie  = $row["cname"];
	$footer  = $row["footer_website"];
	$web  = $row["website"];
	$url = APP_URL."/img/logo-email.png";

    // subject

    $subject = ''.$approvede.' | '.$row["cname"].'';
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
																		<td align='left' valign='middle' style='padding:0;margin:0;font-size:0;line-height:0'><a href='$web' target='_blank'><img src='http://www.fastcourierplus.com/dashboard/img/logo.png'></a></td>
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
																			<p style='color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0'>$hola <strong>$ship_name</strong></p><br>
																			<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																			$sureserva</p><br>
																			<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																			$parainiciar <strong>$no</strong></p>
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
																	<td colspan='4' align='center'><h2 style='font-size:24px'>$approvede</h2></td>
																</tr>
																<tr>
																	<td colspan='4'>&nbsp;</td>
																</tr>
																<tr>
																	<td width='120' align='right' valign='top'><img src='http://deprixapro.jaom.info/icon-approved.png' alt='tool' width='107' height='130'></td>
																	<td width='30'></td>
																	<td align='left' valign='middle'>
																		<h3 style='color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0'>$estadodelenvio</h3>
																		<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$_Tracking:</strong> <strong>$pre-$cons_no</strong></div>
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$estado:</strong> <strong>$status</strong></div>
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
																						<td align='center' style='margin:0;text-align:center'><a href='$web' style='font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block' target='_blank'>$ingresecli!</a></td>
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
																		<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>$hola $sname $estaes <br /><br /> <strong> $address $porfavor</div>
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
	mail($email, $subject, $message, $headers); //This method sends the mail.
   
   echo "<script type=\"text/javascript\">
			alert(\"$envioapproved\");
			window.location = \"../../online-bookings.php\"
		</script>";								
?>