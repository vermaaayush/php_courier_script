<!DOCTYPE html>

<html>


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title>Comparison | PT. Rizky Global Persada </title>
	<meta name="description" content="Courier Deprixa V3.2.1 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
	
	<link rel="stylesheet" href="deprixa_components/css/awards.css" />
	<script src="deprixa_components/js/jquery.min.js"></script>
    <link href="deprixa_components/content/csse1bf.css" rel="stylesheet"/>


</head>
   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->

<main class="slide">

<div class="fw grey-bg">
	<section class="awards">
		<header>
			<h1>Awards</h1>
					<p>Below are some of the awards that our company has won over the years and we strive harder to win more awards in the nearest future.</p>
		</header>
		<div class="container js-masonry">
			<div class="item"><img alt="Innovation, Excellence in Services 2016" src="deprixa_components/images/award1.jpg" />
				<h2>International &amp; Seafarer's Welfare Award </h2>
					<p>Our company won the ISWAN's International Seafarers' Welfare Awards in 2016 at a high-profile ceremony held in Manila, the Philippines.</p>
			</div>
			<div class="item"><img alt="BUSINESS OF THE YEAR AWARD 2016" src="deprixa_components/images/award2.jpg" />
				<h2>BUSINESS OF THE YEAR AWARD 2016</h2>
					<p> PT. Rizky Global Persada is proud to win external awards for our cargo delivery and Customer Service - a testament to our customer-centric focus at the heart of every shipment we deliver worldwide.</p>
			</div>
			<div class="item"><img alt="Entrepreneur Award 2016" src="deprixa_components/images/award3.jpg" />
				<h2>Entrepreneur Award 2016</h2>
					<p> PT. Rizky Global Persada is proud to win entrepreneur awards for our corporate responsiblity - a testament to our environmental consideration at the heart of every shipment we deliver.</p>
			</div>
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


   

	<script src="deprixa_components/scripts/Awards/imagesLoaded.js"></script>
    <script src="deprixa_components/scripts/Awards/pkgd.min.js"></script>	
	<script>
		// options
		$(document).ready(function(){
			var $container = $('.container');
				$container.imagesLoaded( function(){
				  $container.masonry({
					gutter: 25,
					itemSelector : '.item'
				});
			});
		});
	</script>

</body>

</html>