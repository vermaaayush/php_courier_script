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
require_once('../../database.php');
require_once('../../database-settings.php');
require_once('../../funciones.php');

	$name = $_POST['name'];
	$shipname_cc = $_POST['shipname_cc'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address=$_POST['address'];
	$country = $_POST['country'];	
	$state = $_POST['state'];
	$iso = $_POST['iso'];
	$zipcode = $_POST['zipcode'];
	$note = $_POST['note'];	
	$name_delivery = $_POST['name_delivery'];
	$Receivercc = $_POST['Receivercc'];
	$email_delivery = $_POST['email_delivery'];
	$phone_delivery = $_POST['phone_delivery'];
	$phone_delivery2 = $_POST['phone_delivery2'];
	$address_delivery = $_POST['address_delivery'];
	$company_delivery = $_POST['company_delivery'];
	$scountry = countries($_POST['scountry']);
	$sstates = department($_POST['sstates']);
	$iso1 = $_POST['iso1'];
	$sstate = city($_POST['sstate']);
	$zipcode1 = $_POST['zipcode1'];
	$type = $_POST['type'];
	$service = $_POST['service'];
	$Qnty = $_POST['Qnty'];
	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$width = $_POST['width'];
	$length = $_POST['length'];
	$courier_name = $_POST['courier_name'];
	$freight = $_POST['freight'];
	$collection_date = $_POST['collection_date'];
	$reasons = $_POST['reasons'];
	$delivery = $_POST['delivery'];
	$tracking = $_POST['tracking'];
	$officename = $_POST['officename'];
	

	//$OfficeName = $_POST['OfficeName'];	

	$sql = "INSERT INTO online_booking (name,shipname_cc,status,email,phone,address,country,state,iso,zipcode,note,name_delivery,Receivercc,email_delivery,company_delivery,address_delivery,phone_delivery,phone_delivery2,scountry,iso1,sstate,zipcode1,type,service,courier_name,freight, Qnty,width,height,weight,length,collection_date,reasons,delivery,tracking,booking_date,officename)

			VALUES ('$name','$shipname_cc','Pending','$email','$phone','$address','$country','$state','$iso','$zipcode','$note','$name_delivery','$Receivercc','$email_delivery','$company_delivery','$address_delivery','$phone_delivery','$phone_delivery2','$scountry','$iso1','$sstates | $sstate','$zipcode1','$type','$service','$courier_name','$freight','$Qnty','$width','$height','$weight','$length','$collection_date','$reasons','$delivery','$tracking',NOW(),'$officename')";						

	dbQuery($sql);
	
	
	$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {
	
	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompanie  = $row["cname"];
	$footer  = $row["footer_website"];
	$web  = $row["website"];
	$url = APP_URL."/img/logo-email.png";

    // subject

    $subject = ''.$NOTYONLINE.' | '.$row["cname"].'';
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
																	<td align='left' valign='middle' style='padding:0;margin:0;font-size:0;line-height:0'><a href='$web' target='_blank'><img src='$url' height='59' width='310'></a></td>
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
																		<p style='color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0'>Hello <strong>$name</strong></p><br>
																		<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																		$CUANDOAPPROVE:</p><br>
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
																<td colspan='4' align='center'><h2 style='font-size:24px'>$NOTYONLINE</h2></td>
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
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$de:</strong> $scountry | $sstate</div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$a:</strong> $dcountry | $dstate</strong></div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$DELIVERYTYPE:</strong> <strong>$type</strong></div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$NAMESERVICE:</strong> <strong>$service</strong></div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$deliverystatus:</strong> $status</div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>$cantidad: <strong> $Qnty</strong>&nbsp;&nbsp;Peso: <strong> $weight</strong></div>
																	<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$DetallesdelEnvio:</strong> <strong>$note</strong></div>
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
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>$hola $name $estaes <br /><br /> <strong> $address $porfavor</div>
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
			alert(\"'$_POST[name]' $L_APROVAL\");
			window.location = \"../../panel-customer/add-courier-customer.php\"
		</script>";	 
   
   ?>