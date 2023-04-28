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
require_once ('validaciones.php');
require_once ('../../funciones.php');
require '../../requirelanguage.php';
require '../../css/GUMP/gump.class.php';
			

	## Validos los valores que llegan del formulario
	$validator = new GUMP();

	// sanitizo la variable POST
	$_POST = $validator->sanitize($_POST);

	// defino reglas y filtros
	$validator->filter_rules( array(
		'fname'       	=> 'trim|sanitize_string',
		'lname'       	=> 'trim|sanitize_string',
		'password'    	=> 'trim',
		'cc'          	=> 'trim|sanitize_numbers',
		'email'       	=> 'trim|sanitize_email',
		'company'     	=> 'trim|sanitize_string',
		'phone'       	=> 'trim|sanitize_string',
		'telefono'	  	=> 'trim|sanitize_string',
		'address'     	=> 'trim|sanitize_string',
		'country'     	=> 'trim|sanitize_numbers',
		'department'    => 'trim|sanitize_string',
		'state'       	=> 'trim|sanitize_string',
		'iso'       	=> 'trim|sanitize_string',
		'zipcode'     	=> 'trim|sanitize_numbers',
		'lang'			=> 'trim|sanitize_string' ));

	$validator->validation_rules( array(
		'fname'       	=> 'required|valid_name|min_len,3',
		'lname'       	=> 'required|valid_name|min_len,3',
		'password'    	=> 'required|min_len,6',
		'cc'          	=> 'required|integer',
		'email'       	=> 'required|valid_email',
		'company'     	=> 'required',
		'phone'       	=> 'required',
		'address'     	=> 'required',
		'country'     	=> 'required|integer|max_len,4',
		'department'    => 'required',
		'state'       	=> 'required',
		'iso'       	=> 'required',
		'zipcode'		=> 'required',
		'lang'			=> 'required|alpha_dash'));

	// se realiza las validaciones
	$validated_data = $validator->run($_POST);

	# si hubo errores lo informamos
	if($validated_data === false) {
		header ( "Location: ../../../signup.php?tipo=danger&mensaje=".$validator->get_readable_errors(true));
	} else {
		#
		## Obtengo los datos del formulario y los sanitizo medianamente
		$name           = $_POST['fname']." ".$_POST['lname'];
		$cc             = $_POST['cc'];
		$company        = $_POST['company'];
		$email          = $_POST['email'];
		$phone          = $_POST['phone'];
		$telefono       = $_POST['telefono'];
		$address		= $_POST['address'];
		$country        = countries($_POST['country']);
		$department     = department($_POST['department']);
		$state          = city($_POST['state']);
		$iso            = $_POST['iso'];
		$zipcode        = $_POST['zipcode'];
		$pass			= $_POST['password'];
		$pwdmd5			= md5(PASS_SALT.$_POST['password']); #pass with salt
		$lang 			= $_POST['lang'];

		#
		## Cargo la imagen por defecto
		$tipo_imagen = "image/png";
		$url = APP_URL."/img/user_image.png";

		$imagen = imagecreatefromstring(file_get_contents($url));
		imagealphablending($imagen, true);
		imagesavealpha($imagen, true);

		ob_start();
		imagepng($imagen);
		$string = ob_get_contents();
		ob_end_clean();
		
		
		$sql1 =mysql_query("SELECT email FROM tbl_clients WHERE email='$email'");
			if($row=mysql_fetch_array($sql1)){							
				 echo "<script type=\"text/javascript\">
						alert(\"$email $yaestaemail.\");
						window.location = \"../../../signup.php\"
					</script>"; 							
			}else{
				
				$sql1="INSERT INTO tbl_clients (name,cc,email,phone,telefono,address,password,country,department,state,iso,zipcode,lang,estado,company,date,imagen,tipo_imagen) VALUES 	
				('$name','$cc','$email','$phone','$telefono','$address','$pwdmd5','$country','$department','$state','$iso','$zipcode','$lang',1,'$company',curdate(), '".mysql_real_escape_string($string)."', '$tipo_imagen')";
			}
		dbQuery($sql1);
		
		$result1 =  mysql_query("SELECT * FROM company");
		while($row = mysql_fetch_array($result1)) {
		$to  = $row["bemail"];
		$address  = $row["caddress"];
		$namecompanie  = $row["cname"];
		$footer  = $row["footer_website"];
		$web  = $row["website"];
		$url = APP_URL."/img/logo-email.png";
		// subject
		
		$subject = ''.$welcometo.' '.$row["cname"].'';
		$from = $row["bemail"]; 

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
																	<td align='left' valign='middle' style='padding:0;margin:0;font-size:0;line-height:0'><a href='$web' target='_blank'><img src='http://www.fastcourierplus.com//dashboard/img/logo.png' alt='' ></a></td>
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
																		<p style='color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0'>$hola <strong>$name</strong></p><br>
																		<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																		$calidawelcome</p>
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
																<td colspan='4' align='center'><h2 style='font-size:24px'>$infoclientee</h2></td>
															</tr>
															<tr>
																<td colspan='4'>&nbsp;</td>
															</tr>
															<tr>
																<td width='120' align='right' valign='top'><img src='http://deprixapro.jaom.info/customer.png' alt='tool' width='59' height='108'></td>
																<td width='30'></td>
																<td align='left' valign='middle'>
																	<h3 style='color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0'>$namecustomers:</h3>
																	<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$name</strong></div>
																	<div style='line-height:10px;padding:0;margin:0'>&nbsp;</div>
																</td>
																<td width='30'></td>
															</tr>
															<tr>
																<td colspan='5' height='40' style='padding:0;margin:0;font-size:0;line-height:0'></td>
															</tr>
															<tr>
																<td width='120' align='right' valign='top'><img src='http://deprixapro.jaom.info/username.png' alt='no fees' width='46' height='45'></td>
																<td width='30'></td>
																<td align='left' valign='middle'>
																	<h3 style='color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0'>$placeuser:</h3>
																	<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$email</strong></div>
																	<div style='line-height:10px;padding:0;margin:0'>&nbsp;</div>
																</td>
																<td width='30'></td>
															</tr>
															<tr>
																<td colspan='5' height='40' style='padding:0;margin:0;font-size:0;line-height:0'></td>
															</tr>
															<tr>
																<td width='120' align='right' valign='top'><img src='http://deprixapro.jaom.info/password.png' alt='creditibility' width='46' height='45' class='CToWUd'></td>
																<td width='30'></td>
																<td align='left' valign='middle'>
																	<h3 style='color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0'>$password:</h3>
																	<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																	<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$pass</strong></div>
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
																<tr>
																	<td align='center'>
																		<div style='text-align:center;width:100%;padding:40px 0'>
																			<table align='center' cellpadding='0' cellspacing='0' style='margin:0 auto;padding:0'>
																			<tbody>
																				<tr>
																					<td align='center' style='margin:0;text-align:center'><a href='$web' style='font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block' target='_blank'>Client entry!</a></td>
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

				// To send HTML mail, the Content-type header must be set

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			   // Additional headers
				$headers .= 'From: '.$from."\r\n";
				// this line checks that we have a valid email address
				mail($email, $subject, $message, $headers); //This method sends the mail.
				mail($to, $subject, $message, $headers); //This method sends the mail.
				
				echo "<script type=\"text/javascript\">
					alert(\"$graciasregistro.\");
					window.location = \"../../../login.php\"
				</script>"; 
			}
		   
	} 
    

   ?>