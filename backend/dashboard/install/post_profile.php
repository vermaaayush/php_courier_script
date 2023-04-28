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
require_once('../database-settings.php');
require_once('../database.php');

$name_parson = $_POST['name_parson'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$confirm_pwd = $_POST['confirm_pwd'];


if($name_parson == '' || $email == '' || $pwd == '' ){

    exit('All fields are required');

}

if($pwd != $confirm_pwd ){

    exit('pwd does not match');

}

$pass = $_POST['pwd'];
$pwdmd5 = md5(PASS_SALT.$pass);

require '../config.php';

$dbh = new pdo( "mysql:host=$db_host;dbname=$db_name",
    "$db_user",
    "$db_password",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$sql = "UPDATE manager_admin SET name_parson='$name_parson', name='$email', pwd='$pwdmd5' WHERE cid=6";

$stmt = $dbh->prepare($sql);

$stmt->execute();



echo '1';