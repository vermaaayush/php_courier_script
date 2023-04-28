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
require_once('dashboard/database.php');
require_once('dashboard/library.php');
require_once('dashboard/funciones.php');
$styling=mysql_fetch_array(mysql_query("SELECT * FROM styles"));
$tracking= $_POST['refno'];
$sql = "SELECT * FROM courier WHERE tracking = '$tracking'";

$result = dbQuery($sql);
$no = dbNumRows($result);
if($no == 1){	
				
while($data = dbFetchAssoc($result)) {
extract($data);


?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />	    
    <title>Track</title>
	<meta name="description" content=""/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>

	<!-- Font Awesome CSS -->
    <link rel="stylesheet" href="deprixa/asset1/css/font-awesome.min.css" type="text/css" media="screen">  
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link rel="stylesheet" href="deprixa/css/tracking.css" type="text/css" />   
    <link href="deprixa_components/styles/track-order.css" rel="stylesheet" />
	<link href="deprixa/css/style.css" rel="stylesheet" media="all">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	
		<!-- Style Status -->
	<style><?php echo $styling['style']; ?></style>
	
</head>

   <!-- Menu -->
<?php include_once "menu2.php"; ?>
    <!-- /Menu -->

<div class="slide"></div>
<main class="slide">
    

<div class="container">
<!---- development by aayush -->
<div style="border: 1px solid gray;width: 93%;height: auto;margin:auto;margin-top: 8%;
border-radius: 10px 10px 10px 10px;box-shadow: 10px 10px 10px 10px gray;padding: 15px">	

	<div style="margin-top: ">


		<?php 
		if ($status=='Approved') {
			$width='20%';
	
		}
		elseif ($status=='In Transit'|| $status=='On route' ) {
			$width='72%';
		}
		elseif ($status=='Available'|| $status=='Available for pickup') {
			$width='45%';
		}
		elseif ($status=='Delivered') {
			$width='100%';
			
		}
		else
			$width='20%';

		 ?>

   	<span ><img src="shopping-cart.png" height="40" width="40" style="margin-left: 15%"></span>
           	<span><img src="parcel.png" height="40" width="40" style="margin-left: 20%"></span>
           	<span><img src="airplane.png" height="40" width="40"style="margin-left: 20%"></span>
           	<span><img src="to-do-list.png" height="40" width="40"style="margin-left: 20%"></span>
    
           <div class="w3-light-grey w3-round">
           
    <div class="w3-container w3-red w3-round" style="height:8px;width:<?php echo $width ?> "></div>
    
  </div>
	
  </div>
    <!------------------>
     <div class="row" style="padding: 10px;margin-top: 5%;background-color: #ebe9e6">
     	<div class="col-md-4" style="border-radius: 6px 6px 6px 6px;box-shadow: 2px 2px 3px 3px gray;background-color: white"  >
     		<h5 style="background-color: red;color: white" class="text-center"> Shipment Details</h5>
     		<strong>Tracking ID:</strong> <?php echo $tracking; ?><br><br>
     		<strong>Origin:</strong> <?php echo $pick_time; ?> <br><br>
     		<strong>Destination:</strong> <?php echo $paisdestino; ?><br><br>
     		<strong>Current status:</strong><span style="color:green"> <?php echo $status; ?></span><br><br>
     		<strong>Type:</strong> <?php echo $type; ?><br><br>
     		<strong>Shipment Type:</strong> <?php echo $mode; ?><br><br>
     		
     	</div>	
     	<div class="col-md-4" >
     		<div style="border-radius: 6px 6px 6px 6px;box-shadow: 2px 2px 3px 3px gray;width: 80%;margin:auto;margin-top: 20px;background-color: white">
     		<img src="icon-02 (1).webp" style="margin-left: 21%;margin-top:10%" />
     		<strong style="margin-left:13px">Estimated Delivery Date:</strong><br>
     		<span style="margin-left:26%"><?php echo $schedule; ?></span>
     		</div>
     	</div>
     	<div class="col-md-4"  style="border-radius: 6px 6px 6px 6px;box-shadow: 2px 2px 3px 3px gray;background-color: white">
     		<h5 style="background-color: red;color: white" class="text-center">Delivery Details</h5>
     		<strong>Phone:</strong> <?php echo $r_phone; ?><br><br>
     		<strong>Sender:</strong> <?php echo $ship_name; ?><br><br>
     		<strong>Recipient:</strong> <?php echo $rev_name; ?><br><br>
     		<strong>Pickup Date/Time:</strong> <?php echo $pick_date; ?><br><br>
     		<strong>Weight:</strong> <?php echo $weight; ?><br><br>
     		<strong>Description:</strong> <?php echo $comments; ?><br><br>

     	</div>
     </div>


</div>





<!---- development by aayush -->


	<hr>
<h3 class="text-center">Tracking History</h3>
<div class="row" style="width: 80%;margin:auto;">
     	<?php
					require_once('dashboard/database.php');

					//EJECUTAMOS LA CONSULTA DE BUSQUEDA
					$result = mysql_query("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
					//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
					echo ' <table class="table table-bordered table-striped table-hover" >
								<tr class="car_bold col_dark_bold" align="center">
									<td style="background-color:red;"><font color="white" face="arial,verdana"><strong>Tracking No</strong></font></td>
									<td style="background-color:red;"><font color="white" face="arial,verdana"><strong>Location</strong></font></td>
									<td style="background-color:red;"><font color="white" face="arial,verdana"><strong>Status</strong></font></td>
									<td style="background-color:red;"><font color="white" face="arial,verdana"><strong>Date / Time</strong></font></td>
									<td style="background-color:red;"><font color="white" face="arial,verdana"><strong>Remarks</strong></font></td>																							
								</tr>';
					if(mysql_num_rows($result)>0){
						while($row = mysql_fetch_array($result)){
							echo '<tr align="center">
									<td>'.$row['cons_no'].'</td>
									<td>'.$row['pick_time'].'</td>
									<td>'.$row['status'].'</td>
									<td>'.$row['d'].' '.$row['t'].'</td>				
									<td>'.$row['comments'].'</td>
									</tr>';
						}
					}else{
						echo '<tr>
									<td colspan="5" >No results found</td>
								</tr>';
					}
					echo '</table>';
				?>
	   
	
 </div><!-- .container -->
</div>
 <!-- End Deprixa Section -->	
</div> 
</div>

 </main>

    <footer class="slide">
<section class="footer">
    <div class="mobEmail">
        <form class="email-signup" name="email-signup">
            <p>Top offers and updates delivered direct to your inbox.</p>
            <input type="email" class="form-control" placeholder="Email Newsletter" id="email-signup-address" tabindex="-1" />
            <input type="button" class="btn btn-primary btn-md" value="Sign up" id="email-signup-btn" tabindex="-1" />
        </form><!--email-signup-->
    </div>
    <div class="mpd-social">
        <a href="#" class="fb" target="_blank" tabindex="-1"></a>
        <a href="#" class="twit" target="_blank" tabindex="-1"></a>
        <a href="#" class="linked" target="_blank" tabindex="-1"></a>
        <a href="#" class="gplus" target="_blank" tabindex="-1"></a>
    </div><!--social-->

    <div class="footer-divide cf"></div>

    

    
    </div>

</section>

<div class="fw footer-dark">
    <section class="footer footer-baseline">
        <p class="footer-text mob-me">&copy; Copyright 2019 the on sit group</p>
        
    </section>
   <a href="#" id="back-top"></a>
</div>
</footer>
</div>


    <script src="deprixa_components/bundles/jquery"></script>
    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/Scripts/tracking.js"></script>

</body>
</html>
<script>
   window.onload=load;
   window.onunload=GUnload;
</script>
<?php 

}//while

}//if
else {
echo '';
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8" />	    
    <title>Track My Parcel  | DEPRIXA</title>
	<meta name="description" content="Courier Deprixa V3.2 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link rel="stylesheet" href="deprixa/css/tracking.css" type="text/css" />   
	<link href="deprixa/css/style.css" rel="stylesheet" media="all">

</head>

   <!-- Menu -->
<?php  include_once "menu2.php"; ?>
    <!-- /Menu -->
	
<div class="slide">    

    </div>
        <main class="slide">
        <div class="fw">
            <section class="title">
                <header>
                    <h1><img src="dashboard/img/tracking-search.png" />Shipment Tracking</h1>					                   
                </header>
				<div class="media-left">
                    
                    </div>
            </section>
        </div>  
		<div class="container">
				<div class="page-content">					
					
					<div class="text-center">
						<h1><img src="dashboard/img/no_courier.png" /></h1>
						<h3>Tracking number not found,</h3>
						<p><font color="#FF0000"><?php echo $cons; ?></font> check the number or Contact Us.</p>
						<div class="text-center"><a href="https://oceanhogship.com/">Back To Home</a></div>
					</div>					
				</div>
		</div>
		</div>
		<!-- End Content -->

   <footer class="slide">
<section class="footer">
    <div class="mobEmail">
        <form class="email-signup" name="email-signup">
            <p>Top offers and updates delivered direct to your inbox.</p>
            <input type="email" class="form-control" placeholder="Email Newsletter" id="email-signup-address" tabindex="-1" />
            <input type="button" class="btn btn-primary btn-md" value="Sign up" id="email-signup-btn" tabindex="-1" />
        </form><!--email-signup-->
    </div>
    <div class="mpd-social">
        <a href="#" class="fb" target="_blank" tabindex="-1"></a>
        <a href="#" class="twit" target="_blank" tabindex="-1"></a>
        <a href="#" class="linked" target="_blank" tabindex="-1"></a>
        <a href="#" class="gplus" target="_blank" tabindex="-1"></a>
    </div><!--social-->

    <div class="footer-divide cf"></div>

    

    
    </div>

</section>

<div class="fw footer-dark">
    <section class="footer footer-baseline">
        <p class="footer-text mob-me">&copy; </p>
        
    </section>
   <a href="#" id="back-top"></a>
</div>
</footer>
</div>


    <script src="deprixa_components/bundles/jquery"></script>
    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/bundles/modernizr"></script>
    <script src="deprixa_components/scripts/tracking.js"></script>
	 <script>
	function myFunction() {
		window.print();
	}
	</script>
</body>
</html>
<?php 
}//else
?>