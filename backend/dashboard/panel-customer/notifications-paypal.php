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
require_once('../library.php');	
require_once('../database.php');
isUser();	
												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | Paypal Notifications </title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>

  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />

</head>
<body>
<?php
include("header.php");
?>
 
  <!-- content -->
<div id="content" class="app-content" role="main">
<div class="app-content-body ">    
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Notification PAYPAL</h1>
</div>
<div class="wrapper-md">
  <div class="row">
    <div class="col-sm-12">
      <div class="blog-post">                   
        <div class="panel">
          <div>
            
			</div>
				<div class="wrapper-lg">           
					<div>			
						<table border="0" align="center">
							<tbody>	
								<?php
									// For data security
									class vpb_rc4_algorithm
									{
									   public function vpb_encodes($a,$b){
										  for($i,$c;$i<256;$i++)$c[$i]=$i;
										  for($i=0,$d,$e,$g=strlen($a);$i<256;$i++){
											 $d=($d+$c[$i]+ord($a[$i%$g]))%256;
											 $e=$c[$i];
											 $c[$i]=$c[$d];
											 $c[$d]=$e;
										  }
										  for($y,$i,$d=0,$f;$y<strlen($b);$y++){
											 $i=($i+1)%256;
											 $d=($d+$c[$i])%256;
											 $e=$c[$i];
											 $c[$i]=$c[$d];
											 $c[$d]=$e;
											 $f.=chr(ord($b[$y])^$c[($c[$i]+$c[$d])%256]);
										  }
										  return $f;
									   }
									   public function vpb_decodes($a,$b){return vpb_rc4_algorithm::vpb_encodes($a,$b);}
									}
									function vpb_decrpt_url_data($data)
									{
										$key  = 'a7e88837b63bf2941ef819dc8ca282';
										$v_data = base64_decode($data);
										$plain_text = vpb_rc4_algorithm::vpb_decodes($key,$v_data);
										return $plain_text;
									}
									if(isset($_GET["crypt"]) && !empty($_GET["crypt"]))
									{
										$crypted_data = vpb_decrpt_url_data(strip_tags($_GET["crypt"]));
										list($payment_status, $user_email) = explode(';', $crypted_data, 2);
										
										if($payment_status == "user-paid-successfully")
										{																												
											$sql = "UPDATE courier_online SET payment='OK', paymode='Paypal' WHERE email='$user_email' ";
											dbQuery($sql);

											
											echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
													<button type="button" class="close" data-dismiss="alert"
															aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													Which made the payment correctly and your verified email is <b>'.$user_email.'</b>.
												</div>';
												
												
										}
										elseif($payment_status == "user-canceled-payment")
										{
												
											echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
													<button type="button" class="close" data-dismiss="alert"
															aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<strong>It seems that they have cancelled their payment process and thus, however no payment has been made and your email address as set out in the system is <b> '.$user_email.'</b>.
												</div>';
												
												
										}
										else
										{
												echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
													<button type="button" class="close" data-dismiss="alert"
															aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<strong>Sorry!</strong> There was an error with the notification of payment and therefore, the process has been completed.
												</div>';
												
										}
									}
									else
									{
									  echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
													<button type="button" class="close" data-dismiss="alert"
															aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<strong>Sorry!</strong> Sorry, There was an error with the notification of payment and therefore, the process has been completed.
												</div>';	
									}
								?>
							</tbody>	
						</table>
					</div>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	</div>
  </div>
  <!-- / content -->

  <!-- footer -->
  <?php
include("../footer.php");
?>
  <!-- / footer -->

</div>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../js/ui-load.js"></script>
<script src="../js/ui-jp.config.js"></script>
<script src="../js/ui-jp.js"></script>
<script src="../js/ui-nav.js"></script>
<script src="../js/ui-toggle.js"></script>

</body>
</html>