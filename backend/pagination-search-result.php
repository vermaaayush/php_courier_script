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
require_once("deprixa/database.php");

function generatePagination(){
	$per_page = 10000000;
	//Calculating no of pages
	$sql = "SELECT * FROM scheduledpickup";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	$pages = ceil($count/$per_page);
	$pageno = "<ul id=\"pagination\">";
	for($i=1; $i<=$pages; $i++)	{
		$pageno .= "<a class=\"pageno\" title=\"Page #. $i\" href=\"?page=$i\"><li id=\".$i.\">".$i."</li></a> ";
	}
	$pageno .= 	"</ul>";
	return $pageno;
}

function getPageData(){
	$per_page = 10000000;
	if($_GET) { $page=$_GET['page'];}
	else {$page = 1;}
	$start = ($page-1)*$per_page;
	$cons= $_POST['Consignment'];
	$sql = "SELECT * FROM scheduledpickup WHERE Weight='$cons' ORDER BY cid DESC LIMIT $start, $per_page";
	$result = mysql_query($sql);
	$records = array();
	while($row = mysql_fetch_array($result)){
	
	
		extract($row);
		$records[] = array("cid" => $cid,
			"Weight" => $Weight,
			"courier" => $courier,
			"services" => $services,
			"Length" => $Length,
			"Width" => $Width,
			"Height" => $Height,
			"rate" => $rate);

	}//while
	return $records;
}



?>