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
require_once('deprixa/database.php');

$result1 =  mysql_query("SELECT * FROM company");
	while($row = mysql_fetch_array($result1)) {
		$to = $row["cemail"];
 if(!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['subject'])){


$headers = "Content-Type: text/html; charset=iso-8859-1\n"; 
$headers .= "From:".$_POST['name']."\r\n";			
$tema="Contact Site Deprixa";
$subject    = "Hello Deprixa";
$comment="
<table border='0' cellspacing='2' cellpadding='2'>
  <tr>
    <td width='20%' align='center' bgcolor='#f1f1f1'><strong>Name:</strong></td>
    <td width='80%' align='left'>$_POST[name]</td>
  </tr>
  <tr>
    <td align='center' bgcolor='#f1f1f1'><strong>E-mail:</strong></td>
    <td align='left'>$_POST[email]</td>
  </tr>
   <tr>
    <td width='20%' align='center' bgcolor='#f1f1f1'><strong>Message Subject:</strong></td>
    <td width='80%' align='left'>$_POST[subject]</td>
  </tr>
  <tr>
    <td align='center' bgcolor='#f1f1f1'><strong>Comment:</strong></td>
    <td align='left'>$_POST[comment]</td>
  </tr>
  <br>
  <br>
  <p><img src='".$row["website"]."/deprixa/img/logo-login-preference.png'></p>
</table>
";
mail($to,$tema,$comment,$headers,$subject); 
echo "<script type=\"text/javascript\">

						alert(\"'$_POST[name]' his message was correctly sent, Thanks.\");

						window.location = \"index.php\"

					</script>";	
} else {
	echo "<script type=\"text/javascript\">

						alert(\"'$_POST[name]' your message was not sent, try again.\");

						window.location = \"index.php\"

					</script>";	
}
 }
?>
