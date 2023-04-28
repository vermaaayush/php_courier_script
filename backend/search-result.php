<?php
error_reporting(E_ERROR | E_PARSE);
require_once('deprixa/database.php');
require_once('deprixa/library.php');
require_once('pagination-search-result.php');

?>

<html>
<head>
    <title>Parcel Prices | PT. Rizky Global Persada </title>
	<meta name="description" content="Courier Deprixa V3.2.1 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
	<script src="deprixa_components/hub/js/jquery.min.js"></script>
	<script src="deprixa_components/hub/scripts/bootstrap.min.js"></script> 
	<script src="deprixa_components/hub/scripts/jquery-validate.min.js"></script>
	<script src="deprixa_components/hub/scripts/jquery-validate-unobtrusive.min.js"></script>	

	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
	
	<link rel="stylesheet" href="deprixa_components/hub/css/about-us.css" />	
	<link rel="stylesheet" href="deprixa_components/hub/css/royal-mail-comparison.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/services.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/bootstrap-mpd.css" />	
	<link rel="stylesheet" href="deprixa_components/hub/css/global.css" />
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/> 
    <link href="deprixa_components/styles/track-order.css" rel="stylesheet" />


</head>
   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->
	
<div class="slide">   
</div>
<main class="slide">
<div class="fw royalMail main-promo">

</div>

<div class="fw ">
	<section class="cheaper-royal-mail">
		<div class="col-lg-6 col-md-7">
			<header>
				<h2><font color="Orange">Scheduled Pickup</font></h2>
			</header>
			<p><?php
			require_once('deprixa/database.php');
			//Get values
			$scountry = $_POST['scountry'];
			$sstate = $_POST['sstate'];
			$dcountry = $_POST['dcountry'];
			$dstate = $_POST['dstate'];
			$height = $_POST['height'];
			$length = $_POST['length'];
			$width = $_POST['width'];

			// Using google distance matrix API to calculate distance between selected counrty
			$url = 'http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$sstate.'|'.$scountry.'&destinations='.$dstate.'|'.$dcountry.'&sensor=false';


			//replace empy spaces
			$target=str_replace(" ","",$url);
			$json = file_get_contents($target); 
			// get the data from Google Maps API
			$result = json_decode($json, true); 

			//Get Rate values from database
			$result = mysql_query("SELECT * FROM shipping_charge WHERE id ='1'");
			$row = mysql_fetch_array($result);


			//Send back in JSON Formate

			$output='<font size=4 color="Black" face="arial,verdana">SHIPPING FROM:</font> <font size=3 color="Green" face="arial,verdana">'.$_POST['sstate'].'&nbsp;-&nbsp;'.$_POST['scountry'].'</font><br><font size=4 color="Black" face="arial,verdana">SHIPPING TO</font>: &nbsp;&nbsp;&nbsp;&nbsp;<font size=3 color="Green" face="arial,verdana">'.$_POST['dstate'].'&nbsp;-&nbsp;'.$_POST['dcountry'].'</font> <br><br><font size=2 color="Black" face="arial,verdana">HEIGHT:</font> <font size=2 color="Green">'.$_POST['height'].'</font>&nbsp;|&nbsp;
			<font size=2 color="Black" face="arial,verdana">LENGTH:</font> <font size=2 color="Green" face="arial,verdana">'.$_POST['length'].'</font> &nbsp;|&nbsp; <font size=2 color="Black" face="arial,verdana">WIDTH:</font> <font size=2 color="Green" face="arial,verdana">'.$_POST['width'].'</font> ';

			echo $output;

			?></p>
		</div>
		<div class="col-lg-6 col-md-5"><img src="deprixa_components/images/parcelboy.png" alt=""></div>
	</section>
</div>

 
<div class="fw grey-bg">
	<section class="comparison-tables"><header>

	</header>
		<div class="table-container">

			<table class="responsive-table">
				<thead>
				<tr><th scope="col" class="firstCol">Courier</th><th scope="col" class="secondCol">More Info</th><th scope="col">Services</th><th class="noBorderRight" scope="col">Weight</th><th colspan="2" scope="col">Your Rate</th></tr>
				</thead>
				<?php
					$records = getPageData();
					if(count($records) > 0){
					$i = 0;
					foreach($records as $record){
					extract($record);	// extract array
					$i++; 				// increment i
					$even = $i%2; 		// getting MOD
				?>
				<?php 
				require_once('deprixa/database.php');

				$consulta=mysql_query("select * from scheduledpickup WHERE cid='$cid'");
				while($filas=mysql_fetch_array($consulta)){
					$ruta=$filas['courier'];


				?>
				<tbody>
				<tr><th scope="row"><img src="imagen-shipping-calculator/<?php echo $courier; ?>" width="80" height="35"></th>
				<?php }?>
				<td data-title="Weight" data-type="currency">
				<a href="#" style="cursor:pointer; padding:5px; color:#666;">
				<i class="epi-print" style="font-size:28px;" data-toggle="tooltip" data-placement="top" title="Printer Required"><img src="deprixa_components/images/printer.png" border="0" height="26" width="30"></i></a>
				<a style="cursor:pointer; padding:5px; color:#666;">
				<i href="#" class="epi-lock-open-alt-1" style="font-size:28px;" data-toggle="tooltip" data-placement="top" title="Basic Cover Up To RM100"><img src="deprixa_components/images/look.png" border="0" height="26" width="30"></i></a>
				<a style="cursor:pointer; padding:5px; color:#666;">
				<i href="#" class="epi-truck" style="font-size:28px;" data-toggle="tooltip" data-placement="top" title="Estimated 1 working day(s)"><img src="deprixa_components/images/truck.png" border="0" height="26" width="30"></i></a>
				<a style="cursor:pointer; padding:5px; color:#666;">
				<div class="content" style="display:none" title="Service Information"><ul>
				<li>
				Next-day pick up: For orders made before 12.00am
				 </p>
				<p>
				Next working day delivery within PosLaju coverage areas. For outskirt areas, 2-3 standard delivery days may apply. 
				 </li>
				<li>
				All rates quoted are nett rate inclusive of all surcharges. All shipments come with basic insurance of RM100 (below or equal to 2kg) and RM300 (above 2kg).
				 </li>
				<li>
				Parcel weight will be determined by either actual or volumetric weight (VW) or whichever is higher. VM also applies if either one dimension is above 30cm.
				<br/>
				VW formula =(height x width x length)cm / 6000
				</li></ul></div> </i></a>
				</td>
				<td data-title="Royal Mail" data-type="currency">
				</a><?php echo $services; ?></td>
				<td data-title="Weight" data-type="currency">Kg&nbsp;<?php echo $Weight; ?></td>
				<td data-title="What You Save" data-type="currency"><span class="mpdGreen">$&nbsp;<?php echo $rate; ?></span></td>
				<td><a href="login.php"><span><input  type="button" class="btn btn-primary btn-md" value="Book Now"  tabindex="-1" /></span></a></td>
				</tr>
				</tbody>
				<?php
					}//foreach
						}//if
					else {
						echo "<p><strong>Records Not Available.</strong></p>";
					}
				?>
			</table>
		</div>
	</section>
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

    <div class="footer-block col-md-3 col-sm-3 cf">
      <div class="mpd-logo-text"><img src="logo.png" height="45" width="241" /></div>  
    </div>

    <div class="footer-block col-md-3 col-sm-3 sm">
        <header>Who Are We?</header>
        <ul class="hidden-xs">
            <li><a href="about-us.php" tabindex="-1">About us</a></li>
            <li><a href="contact-us.php" tabindex="-1">Contact us</a></li>
            <li><a href="awards.php" tabindex="-1">Awards</a></li>
        </ul>
    </div>

    <div class="footer-block col-md-3 col-sm-3">
        <header>Tools</header>
        <ul class="hidden-xs">
            <!--<li><a href="">Ebay Tools</a></li>-->
            <li><a href="login.php" tabindex="-1">My Account</a></li>
            <li><a href="tracking.php" tabindex="-1">Track your shipment</a></li>
            <li><a rel="nofollow" href="index.php" tabindex="-1">Get A Quote</a></li>
        </ul>
    </div>

    <div class="footer-block col-md-3 col-sm-3">
        <header>Features</header>
        <ul class="hidden-xs">
            <li><a href="signup.php" tabindex="-1">Business Account</a></li>        
            
        </ul>
    </div>

</section>

<div class="fw footer-dark">
    <section class="footer footer-baseline">
        <p class="footer-text mob-me">&copy; Copyright 2019 PT. Rizky Global Persada</p>
        <ul class="footer-links">
            <li><a href="privacy-policy.php" tabindex="-1">Privacy Policy</a></li>
            <li><a href="cookie-policy.php" tabindex="-1">Cookie Policy</a></li>
            <li><a href="terms-and-conditions.php" tabindex="-1">Terms And Conditions</a></li>
            <li><a href="refund-policy.php" tabindex="-1">Refund Policy</a></li>
        </ul>
    </section>
   <a href="#" id="back-top"></a>
</div>
</footer>
</div>

	<script src="deprixa_components/hub/scripts/services/services.js"></script>
	<script src="deprixa_components/hub/scripts/placeholder-shim.js"></script>
	<script src="deprixa_components/hub/scripts/PostcodeValidation.js"></script>		
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	 <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- Google Analytics -->
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-70616092-1', 'auto');
ga('send', 'pageview');
</script>		
</body>
</html>
