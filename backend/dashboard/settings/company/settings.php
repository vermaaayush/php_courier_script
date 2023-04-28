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
	
	$cname = $_POST['cname'];
	$nit = $_POST['nit'];
	$cemail = $_POST['cemail'];
	$cphone = $_POST['cphone'];
	$caddress = $_POST['caddress'];
	$country = $_POST['country'];
	$city = $_POST['city'];
	$website = $_POST['website'];
	$footer_website = $_POST['footer_website'];	
	$currency = $_POST['currency'];
	$prefijo = $_POST['prefijo'];
	$lang = $_POST['lang'];	
	$bemail = $_POST['bemail'];
	$date = $_POST['date'];
	$timezone = $_POST['timezone'];
	$description = $_POST['description'];
	$keywords = $_POST['keywords'];
	$smtp = $_POST['smtp'];
	$smtphost = $_POST['smtphost'];
	$smtpuser = $_POST['smtpuser'];

	$sql = "UPDATE company SET cname='$cname',nit='$nit',cemail='$cemail',cphone='$cphone',caddress='$caddress',country='$country',prefijo='$prefijo',city='$city', website='$website',  
	 footer_website='$footer_website',currency='$currency',lang='$lang',bemail='$bemail',date='$date',timezone='$timezone',description='$description',keywords='$keywords',smtp='$smtp', smtphost='$smtphost',smtpuser='$smtpuser'";
	dbQuery($sql);
	
	require '../../requirelanguage.php';
	
	echo "<script type=\"text/javascript\">
			alert(\"$changeexits\");
			window.location = \"../../preferences.php\"
		</script>";	
 
	
    
    
?>