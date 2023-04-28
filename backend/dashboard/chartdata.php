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

#Pie Chart
error_reporting(E_ERROR | E_PARSE);
require_once('database.php');

$result = mysql_query("SELECT cid, status AS TAHUN, COUNT( * ) AS JUMLAH FROM courier_online GROUP BY TAHUN");
#$result = mysql_query("SELECT name, val FROM web_marketing");

//$rows = array();
$rows['type'] = 'pie';
$rows['name'] = 'Pelawat';
//$rows['innerSize'] = '50%';
while ($r = mysql_fetch_array($result)) {
    $rows['data'][] = array(''.$r['TAHUN'].'"', $r['JUMLAH']);    
}
$rslt = array();
array_push($rslt,$rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($dbConn);

?>