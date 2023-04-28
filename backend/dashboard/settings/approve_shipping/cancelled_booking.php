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


	$name = $_POST['name'];
	$cid = (int)$_POST['cid'];
	$reasons = $_POST['reasons'];
	$email = $_POST['email'];
	
	$sql_1 = "UPDATE online_booking SET status='Cancelled', reasons='$reasons' WHERE id='$cid'";
    dbQuery($sql_1);
	
	
	$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {
	
	$to  = $row["bemail"];
	$address  = $row["caddress"];
	$namecompanie  = $row["cname"];
	$footer  = $row["footer_website"];
	$web  = $row["website"];
	$phone  = $row["cphone"];
	$url = APP_URL."/img/logo-email.png";
    // subject

    $subject = ''.$enviocalcel.' | '.$row["cname"].'';
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
																				<h1 style='font-family:HelveticaNeue-Light,arial,sans-serif;font-size:40px;color:#404040;line-height:40px;font-weight:bold;margin:0;padding:0'>$welcome $namecompanie</h1>
																			</td>
																			<td width='25'></td>
																		</tr>
																		<tr>
																			<td colspan='3' height='40'></td></tr><tr><td colspan='5' align='center'>
																				<p style='color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0'>$hola <strong>$name</strong></p><br>
																				<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																				$sureservacancel <strong>$reasons</strong></p><br>
																				<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																				$llamar <strong> $phone</strong> $parainfo</p>
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
															<td>
																<table width='570' align='center' border='0' cellspacing='0' cellpadding='0'>
																<tbody>
																	<tr>
																		<td colspan='4' align='center'>&nbsp;</td>
																	</tr>
																	<tr>
																		<td colspan='4' align='center'><h2 style='font-size:24px'>$enviocalcel</h2></td>
																	</tr>
																	<tr>
																		<td colspan='4'>&nbsp;</td>
																	</tr>
																	<tr>
																		<td width='120' align='right' valign='top'><img src='http://deprixapro.jaom.info/cancelled-icon.png' alt='tool' width='139' height='112'></td>
																		<td width='30'></td>
																		<td align='left' valign='middle'>
																			<h3 style='color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0'>$estadodelenvio</h3>
																			<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$estado</strong> <strong>$cancel</strong></div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$razones</strong> <strong>$reasons</strong></div>
																			<div style='line-height:10px;padding:0;margin:0'>&nbsp;</div>
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

    $headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
   // Additional headers
    $headers .= 'From: '.$from."\r\n";	
    // this line checks that we have a valid email address
	mail($to, $subject, $message, $headers); //This method sends the mail.
	mail($email, $subject, $message, $headers); //This method sends the mail.	
   
   echo "<script type=\"text/javascript\">
			alert(\"'$_POST[name]' $enviocalcel\");
			window.location = \"../../online-bookings.php\"
		</script>";				
					

?>