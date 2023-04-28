<!DOCTYPE html>


<html>
<head>
	<meta charset="utf-8" />
	<title>Track My Parcel  |PT. Rizky Global Persada</title>
	<meta name="description" content="Courier Deprixa V3.2.1 "/>
	<meta name="keywords" content="Fast Courier Plus-Worldwide" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
	
	<!-- style -->
	<link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link href="deprixa_components/styles/track-order.css" rel="stylesheet" />	
	<script src="deprixa_components/hub/scripts/bootstrap.min.js"></script>
	<script src="deprixa_components/hub/scripts/jquery-validate.min.js"></script>
	<script src="deprixa_components/hub/scripts/jquery-validate-unobtrusive.min.js"></script>
	<script type="text/javascript" src="process/countries.js"></script> 		
	<link rel="stylesheet" href="deprixa_components/hub/css/global.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/services.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/dSwiper.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/bootstrap-mpd.css" />				
	
   <!-- style -->  
	<link href="deprixa_components/styles/home1d2d.css" rel="stylesheet"/>
	<link rel="stylesheet" href="deprixa_components/styles/default.css" />
	
	<!-- Cloud Slider Style Sheet -->
	<link rel="stylesheet" href="cloudslider/css/cloudslider.css" type="text/css">

	<!-- Importing Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

	<!-- Importing jQuery -->
	<script src="cloudslider/js/jquery.js" type="text/javascript"></script>

	<!-- Cloud Slider Library -->
	<script src="cloudslider/js/cloudslider.jquery.min.js" type="text/javascript"></script>
	
	<style type="text/css">
	#wrapper {
	position: relative;
	}

	#wrapper .text {
		position: absolute;
		visibility: hidden;
		width: 300%;
		bottom: 15px;
		left: -95px;
	}

	#wrapper:hover .text {
	visibility:visible;
	}
	.table {
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	}

	.comp-table {
		text-align:center;
		width:100%;
		border-spacing: 2px 0px;
		border-collapse: separate;
	}
	.comp-table tr th{
		text-align:center;
		color:#fff;
		height:45px;
		-moz-border-radius: 10px 10px 0px 0px;
		-webkit-border-radius: 10px 10px 0px 0px;
		border-radius: 10px 10px 0px 0px; /* future proofing */
		-khtml-border-radius: 10px 10px 0px 0px; /* for old Konqueror browsers */
	}

	.comp-table tr th a{
		color:#fff;
		font-weight: noDollaral;
		text-decoration: underline;
	}

	.comp-table tr th:nth-child(1){ background-color:#4C0066; box-shadow: inset 0px -5px 10px #47195A;}
	.comp-table tr th:nth-child(2){ background-color:#8500B2; box-shadow: inset 0px -5px 10px #5F1252;}
	.comp-table tr th:nth-child(3){ background-color:#a21856; box-shadow: inset 0px -5px 10px #6B1139;}
	.comp-table tr th:nth-child(4){ background-color:#be1522; box-shadow: inset 0px -5px 10px #94121C;}
	.comp-table tr th:nth-child(5){ background-color:#e94e1b; box-shadow: inset 0px -5px 10px #AF3C16;}
	.comp-table tr th:nth-child(6){ background-color:#e61873; box-shadow: inset 0px -5px 10px #AB1155;}
	.comp-table tr th:nth-child(7){ background-color:#2b2e83; }

	.comp-table tr td{
		width:13%;
		height:50px;
		border-bottom: solid 2px #FFFFFF;
		border-top: solid 2px #FFFFFF;
		padding: 10px 0px;
	}

	.comp-table tr:nth-child(even) td{
		background-color:#ececec;
	}
	.comp-table tr:nth-child(odd) td{
		background-color:#f6f6f6;
	}

	.comp-table .featured td{
		font-size: 14px !important;
		background-color: #AAA !important;
		color: #fff;
	}

	.comp-table .featured td:last-child{
	}

	.topuplistingtable tr td{ 
		border-right: 1px solid #ddd;
		text-align: center;
	}
	.topuplistingtable tr td a{ 
		color:#fff;
	}

	.tulbFeatured{border :1px solid #black;}
	.topuplistingtable{ margin-bottom:5px !important;}
	.topuplistingtable tr:nth-child(1) td:nth-child(1){ background-color:#00B200; color:white;}
	.topuplistingtable tr:nth-child(2) td:nth-child(1){ background-color:#951b81; color:white;}
	.topuplistingtable tr:nth-child(3) td:nth-child(1){ background-color:#a21856; color:white;}
	.topuplistingtable tr:nth-child(4) td:nth-child(1){ background-color:#be1522; color:white;}
	.topuplistingtable tr:nth-child(5) td:nth-child(1){ background-color:#e94e1b; color:white;}
	.topuplistingtable tr:nth-child(6) td:nth-child(1){ background-color:#e61873; color:white;}

	span.packages {
		color: #00B200;
		font-weight: bold;
		font-size: 14px !important;
	}
	span.prices {
		font-size: 16px !important;
	}
	.btn-primary {background-color: #EF6224; border-color: #EF6224;}
	.comp-table .last td {border-bottom: 5px solid #00B200;}
	.comp-table .featured td:last-child .btn-primary {font-size: 18px;}
	.comp-table th.topup-packages {background-color: #00B200 !important;box-shadow : inset 0px -5px 10px #008C00 !important;}
	.comp-table th.topup-packages p {font-size: 24px !important; margin-bottom: 0px;}
	.comp-table td.blank {background-color: #fff !important;; border: 0px;}

	</style>
		
</head>

<!-- Menu -->
<?php include_once "menu.php"; ?>
<!-- /Menu -->
		

<main class="slide">
 <!--SLIDER -->	
 <div class="slide">	
	<div id="cloudslider" style="margin:0 auto;">
		<div class="kr-sky" data-duration="5000" data-transition="all" data-ken="scalefrom:0.0; positionfrom:left_top; scaleto:0.0; positionto:right_center; easing:linear; duration:10000;">
			<img class="sky-background" src="deprixa_components/images/slider/1.png">
		</div>
		
		<div class="kr-sky" data-duration="6000" data-transition="all" data-ken="scalefrom:0.0; positionfrom:left_top; scaleto:0.0; positionto:right_center; easing:linear; duration:10000;">
			<img class="sky-background" src="deprixa_components/images/slider/2.png">
		</div>

	</div>
</div>	  
	<div class="fw dark-grey-bg">
		<section class="h-form">
			<h2>Shipping Cost Calculator</h2>
			
			<p class="subTitle">Just pop your parcel details below and get a quote to check out all the services we have on offer from PT. Rizky Global Persada.</p>

			<div id="booking-pod-container" class="col-md-12">
				<form action="search-result.php" method="post" autocomplete="off" id="podForm">
					<div class="form-horizontal">
						<div id="pod-alert" class="alert alert-danger" style="display:none;">
							<p class="alert-message"></p>
						</div>
						<div class="col-sm-6">
							<div class="form-group fl form-from">
								<label for="From">From</label>
								<input type="hidden" id="FromCountryRegex" />
								<span id="inter_origin" style="display: block;">   
									<select onchange="print_state('state1', this.selectedIndex);" id="country1" required  name ="scountry" class="fa-glass booking_form_dropdown form-control"></select>
								</span>               
							</div>
							<div class="form-group fl form-from-postcode">
								<label for="FromPostcode">Select state</label>
									<span id="domestic_origin" >
										<select  name ="sstate" required  id ="state1" class="fa-glass booking_form_dropdown form-control"><option value="">Select state</option></select>    
									</span>
								<script language="javascript">print_country("country1");</script>
							</div>
							<div class="form-group cf fl form-to">
								<label for="To">To</label>
								<input type="hidden" id="ToCountryRegex" />
								<span id="inter_dest" style="display: block;">
									<select onchange="print_state('state2', this.selectedIndex);" id="country2" name ="dcountry" required class="fa-glass booking_form_dropdown form-control"></select>
								</span>                 
							</div>
							<div class="form-group fl form-to-postcode">
								<label for="ToPostcode">Select state</label>
									<span id="domestic_dest">
										<select  name ="dstate" required  id ="state2" class="fa-glass booking_form_dropdown form-control"><option value="">Select state</option></select>
									</span>
								<script language="javascript">print_country("country2");</script>
							</div>
						</div>	
						<div class="col-sm-6">		
							<div class="form-group fl form-dimensions cf">
								<label for="How_big_is_it_"><div id="wrapper"><span class="hover" style="position: relative;">How big is it?<img src="deprixa_components/images/question-mark.png" style="margin-top: -10px;width: 12px;"><img src="deprixa_components/images/box.jpg" class="text"></span></label>								
								<div class="form-dim-input cf">
									<input class="col-md-2 form-control" id="parcel_girth_1" value="" onkeyup="checkMaximumValueForBookingFirstStep(this.value,'girth',1)" onclick="clear_girth()" name="length" placeholder="Length" tabindex="5" type="number" value="" min="0" required /> 
									<span class="error" id="LengthError"></span>
									<input class="col-md-2 form-control" id="parcel_width_1" value="" onkeyup="checkMaximumValueForBookingFirstStep(this.value,'width',1)" onclick="clear_width()" name="width" placeholder="Width" tabindex="6" type="number" value="" min="0" required /> 
									<span class="error" id="WidthError"></span>
									<input class="col-md-2 form-control" id="parcel_height_1" value="" onclick="clear_height()" onkeyup="checkMaximumValueForBookingFirstStep(this.value,'height',1)" name="height" placeholder="Height" tabindex="7" type="number" value="" min="0" required />
									<input name="parcel_contents_1" id="parcel_contents_1" type="hidden">
									<span class="error" id="HeightError"></span>
									<select class="form-control" id="DimensionType" name="DimensionType">
										<option>cm</option>
										<option>in</option>
									</select>
								</div>
							</div>
							<div class="form-group fl form-weight cf">
								<label for="How_heavy_">How heavy?</label>
								<input class="form-control cf text-box single-line" id="Weight" name="Consignment" placeholder="Weight" tabindex="8" type="text" value=""  required  />
								<span class="error" id="WeightError"></span>
								<select class="form-control" id="WeightType" name="WeightType">
									<option>Kg</option>
									<option>Lbs</option>
								</select>
								<input name="Submit" type="submit" value="Get quotes" class="btn btn-primary fr ga-trackevent" tabindex="9" id="submitPod" data-gacat="BookingPodCustom" data-gaact="Submit" data-galab="Generic" />	
							</div>
						</div>		
					</div>        
				</form>
			</div>

		</section>
	</div>
	<div class="fw grey-bg">
		<section class="trackorder-boxes">
			<div class="col-sm-6">
				<div class="pod">
					<div class="media-body">
						<span class="track-icon-close40 mpdLightBlue"></span>
						<h3>FREE SHIPPING</h3>
						<p><img src="deprixa_components/images/freeshipping.png" alt="Free Shipping" /></p>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="pod">
					<div class="media-body">
						<span class="track-icon-back3 mpdRed"></span>
						<h3>HOW IT WORKS</h3>
						<p><img src="deprixa_components/images/dropshipping.png" alt="DPD" /></p>
						<a href="contact-us.php" class="btn btn-primary">Contact us</a>
					</div>
				</div>
			</div>
		</section>		
	</div>

	<div class="mpd-stats">
		<section class="mpd-goods">
			<header><h2>Delivering the Goods</h2></header>
			<div class="box col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div>
					<img src="deprixa_components/images/promotion.jpg" alt="Promotions" />
					<div class="mpd-goods-rightCol">
						<h3>Promotions</h3>
						<p>PT. Rizky Global Persada delivers award-winning service on time every time all over the world. take advantage of our promo offers</p>
						<a href="comparison.php" class="primaryButtonSmall ga-trackevent" data-gacat="HomePage" data-galab="HelpMe">Tell me more</a>
					</div>
				</div>
			</div>
			<div class="box col-xs-12 col-sm-6 col-md-6 col-lg-6 news-blog mobHide">
				<div>
					<img src="deprixa_components/images/box-prohibited.png" alt="Prohibited Box" />
					<div class="newsBlogRightCol">
						<h3>PROHIBITED & RESTRICTED ITEMS LIST</h3>
						<p>The following are percieved as unwanted and prohibited items which are not permitted in the use of our service</p>
						<a href="prohibited-restricted.php" class="primaryButtonSmall ga-trackevent" data-gacat="HomePage" data-galab="Win">Read more</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<?php include_once "footer.php"; ?>

</div>

    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/bundles/modernizr"></script>
    <script src="deprixa_components/scripts/CookieManager.js"></script>
    <script src="deprixa_components/scripts/MPD/Common/ga-events.js"></script>   
    <script src="deprixa_components/bundles/jqueryval"></script>
    <script src="deprixa_components/scripts/trimFields.js"></script>
	<script>

		$("#cloudslider").cloudSlider({
			width: 1920,
			height: 550,
			onHoverPause: false
		});

	</script>

</body>
</html>
