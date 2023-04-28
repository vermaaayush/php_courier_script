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

require '../config.php';

$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);

$c_mysqli = false;
$c_pdo  = false;

if (!$link) {
    try{
        $dbh = new pdo( "mysql:host=$db_host;dbname=$db_name",
            "$db_user",
            "$db_password",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $c_pdo  = true;
    }
    catch(PDOException $ex){

    }
}

else{

    $c_mysqli = true;

}

$sql = file_get_contents('primary.sql');

if($c_mysqli){

    mysqli_multi_query($link,$sql);

}

elseif($c_pdo){

    $qr = $dbh->exec($sql);

}

else{

    echo 'Failed';
    exit;

}

echo '1';
