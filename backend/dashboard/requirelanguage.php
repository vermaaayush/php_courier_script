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
session_start();

require_once('database-settings.php');
$db = conexion();

	$sql="SELECT * FROM company";
	$query=$db->query($sql); 
	if($query->num_rows>0){ 
		while($row=$query->fetch_array()){
		$languages  = $row["lang"];
			if (empty($_SESSION["language"])) {

				$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
				$_SESSION["language"]=$lang;
				if ($lang!="es")
				{
				 $_SESSION["language"]="en";   
				}
			}
			if (isset($_SESSION["language"]))
				
			{
			$lang=$_SESSION["language"]; 
			}
			switch ($lang){
				case "fr":
					//echo "PAGE FR";
					include("language/$languages.php");//include check session FR
					break;
				case "hindi":
					//echo "PAGE IT";
					include("language/$languages.php");
					break;
				case "es":
					//echo "PAGE ES";
					include("language/$languages.php");
					break;
				case "en":
					//echo "PAGE EN";
					include("language/$languages.php");
					break;        
				default:
					//echo "PAGE EN - Setting Default";
					include("language/$languages.php");//include EN in all other cases of different lang detection
					break;
			}

		}
	
	
		$sql2="SELECT * FROM tbl_clients WHERE email='".$_SESSION["user_name"]."'";
		$query=$db->query($sql2); 
		if($query->num_rows>0){ 
			while($row=$query->fetch_array()){
			$languages_customer  = $row["lang"];
				if (empty($_SESSION["language"])) {

					$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
					$_SESSION["language"]=$lang;
					if ($lang!="es_customer")
					{
					 $_SESSION["language"]="en_customer";   
					}
				}
				if (isset($_SESSION["language"]))
					
				{
				$lang=$_SESSION["language"]; 
				}
				switch ($lang){
					case "fr_customer":
						//echo "PAGE FR";
						include("language/$languages_customer.php");//include check session FR
						break;
					case "hindi_customer":
						//echo "PAGE IT";
						include("language/$languages_customer.php");
						break;
					case "es_customer":
						//echo "PAGE ES";
						include("language/$languages_customer.php");
						break;
					case "en_customer":
						//echo "PAGE EN";
						include("language/$languages_customer.php");
						break;        
					default:
						//echo "PAGE EN - Setting Default";
						include("language/$languages_customer.php");//include EN in all other cases of different lang detection
						break;
				}

			}
		}
	}
?>