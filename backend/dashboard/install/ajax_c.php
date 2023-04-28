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

$appurl = $_POST['appurl'];
$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];
if($appurl == '' OR $db_host == '' OR $db_user == '' OR $db_name == ''){
   echo 'Please Input all the informations and try again.';
    exit;
}

try{
    $dbh = new pdo( "mysql:host=$db_host;dbname=$db_name",
        "$db_user",
        "$db_password",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    // database connection successful

    //create config file

    $input = '<?php
$db_host	    = \'' . $db_host . '\';
$db_user        = \'' . $db_user . '\';
$db_password	= \'' . $db_password . '\';
$db_name	    = \'' . $db_name . '\';
define(\'APP_URL\', \'' . $appurl . '\');
define(\'PASS_SALT\',\'8kit={xe\');
$_app_stage = \'Live\'; // You can set this variable Live to enable DEPRIXA -  Integrated Web system Debug';

    $f_msg = 'Can\'t create config file. The folder is not writable. You will have to manually create config file. Create a <strong>config.php</strong> inside- <strong>application</strong> folder with following contents- <hr>
<textarea rows="10" class="form-control">'.$input.'</textarea>
<span class="help-block">DEPRIXA - Integrated Web system required some folders writable. It seems folders is not writable. The App may not work properly. For common troubleshooting tips, please visit- <strong></strong></span>
';

    $wConfig = "../config.php";

    if(file_exists($wConfig)){
        echo 'Config file exist. Please delete- <strong>dashboard/config.php</strong> and try again.';
        exit;
    }

    $fh = fopen($wConfig, 'w') or die($f_msg);
    fwrite($fh, $input);
    fclose($fh);

    echo '1';

}
catch(PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}



