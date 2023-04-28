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
<?php 

$row_x = mysql_fetch_array(mysql_query("SELECT * FROM courier_track
WHERE cid = $cid AND cons_no = '$cons_no'
ORDER BY bk_time DESC
LIMIT 1;"));

?>
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
<style>
		.timeline-1 {
  border-left: 3px solid grey;
  border-bottom-right-radius: 4px;
  border-top-right-radius: 4px;
  background: white;
  margin: 0 auto;
  position: relative;
  padding: 50px;
  list-style: none;
  text-align: left;
  max-width: 65%;
}

@media (max-width: 767px) {
  .timeline-1 {
    max-width: 98%;
    padding: 25px;
  }
}

.timeline-1 .event {
  border-bottom: 1px dashed #000;
  padding-bottom: 25px;
  margin-bottom: 25px;
  position: relative;
}

@media (max-width: 767px) {
  .timeline-1 .event {
    padding-top: 30px;
  }
}

.timeline-1 .event:last-of-type {
  padding-bottom: 0;
  margin-bottom: 0;
  border: none;
}

.timeline-1 .event:before,
.timeline-1 .event:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline-1 .event:before {
  left: -207px;
  content: attr(data-date);
  text-align: right;
  font-weight: 100;
  font-size: 0.9em;
  min-width: 120px;
}

@media (max-width: 767px) {
  .timeline-1 .event:before {
    left: 0px;
    text-align: left;
  }
}

.timeline-1 .event:after {
  -webkit-box-shadow: 0 0 0 3px grey;
  box-shadow: 0 0 0 3px grey;
  left: -55.8px;
  background: #fff;
  border-radius: 50%;
  height: 9px;
  width: 9px;
  content: "";
  top: 5px;
}

@media (max-width: 767px) {
  .timeline-1 .event:after {
    left: -31.8px;
  }
}


.accordion{
  margin: 40px 0;
}
.accordion .item {
    border: none;
    margin-bottom: 50px;
    background: none;
}
.t-p{
  color: rgb(193 206 216);
  padding: 40px 30px 0px 30px;
}
.accordion .item .item-header h2 button.btn.btn-link {
    background: white;
    color: black;
    border:1px solid black;
    border-radius: 0px;
    font-family: 'Poppins';
    font-size: 16px;
    font-weight: 400;
    line-height: 2.5;
    text-decoration: none;
}
.accordion .item .item-header {
    border-bottom: none;
    background: transparent;
    padding: 0px;
    margin: 2px;
}

.accordion .item .item-header h2 button {
    color: black;
    font-size: 20px;
    padding: 15px;
    display: block;
    width: 100%;
    text-align: left;
}

.accordion .item .item-header h2 i {
    float: right;
    font-size: 30px;
    color: #ff0000;
    background-color: transparent;
    width: 60px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
}

button.btn.btn-link.collapsed i {
    transform: rotate(0deg);
}

button.btn.btn-link i {
    transform: rotate(180deg);
    transition: 0.5s;
}	

.stretch-card>.card {
     width: 100%;
     min-width: 100%
 }



 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 3rem
 }
 
 .card {
     box-shadow: none;
     -webkit-box-shadow: none;
     -moz-box-shadow: none;
     -ms-box-shadow: none
 }

 .card {
     position: relative;
     display: flex;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
   
     border: 1px solid #3da5f;
     border-radius: 0
 }
 
 .card .card-block {
    padding: 1.25rem;
}





.m-l-10 {
    margin-left: 10px;
}

.proj-progress-card .progress {
    height: 8px;
    overflow: visible;
    margin-bottom: 10px;
}

.proj-progress-card .progress .progress-bar {
    position: relative;
}

.progress .progress-bar {
    height: 100%;
    color: inherit;
}

.bg-c-red {
    background: #67a31d;
}

.proj-progress-card .progress .progress-bar.bg-c-red:after {
    border: 3px solid #67a31d;
}

.proj-progress-card .progress .progress-bar:after {
    content: "";
    background: #fff;
    position: absolute;
    right: -6px;
    top: -5px;
    border-radius: 50%;
    width: 18px;
    height: 18px;
}

.text-c-red {
    color: #FF5370;
}
</style>
</head>

   <!-- Menu -->
<?php include_once "menu2.php"; ?>
    <!-- /Menu -->

<div class="slide"></div>
<main class="slide">
    

<div class="container">
<!---- development by aayush -->
<div class="container" style="border: 1px solid black;width: 80%;height: auto;margin:auto;margin-top: 8%;padding:3%;border-bottom: 0px;color:black">	

     <div class="row">
         <div class="col-md-6">
             <h5>Tracking Code: <?php echo $tracking; ?></h5>
             <h5>This shipment is handled by: <strong>Oceanhog Export</strong></h5>
         </div>
         <div class="col-md-6" >
            <p style="text-align:right"> <button class="btn btn-danger btn-lg" onclick="printPage()">Print <i class="fa fa-print" aria-hidden="true"></i></button></p>
             <script>
               function printPage() {
               window.print();
               }
             </script>
         </div>     
     </div>
</div>

<div class="container" style="border: 1px solid black;width: 80%;height: auto;margin:auto;padding:3%;border-bottom: 0px;color:black">	


        <h3><strong style="color:black">Arrived at Oceanhog Export Delivery Facility <?php echo $row_x["pick_time"]; ?></strong></h3>
        <h5><?php echo $row_x["bk_time"]; ?> Local time</h5>
        <br>
     	<div style="margin-top:10px ">


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

   <p>Origin:<?php echo $pick_time; ?></p>
  <div class="card proj-progress-card">
    <div class="progress" style="background-color:#e5e5e5;">
        
      <div class="progress-bar bg-c-red" style="width:<?php echo $width ?> "></div>
    </div>
  </div>
	<p style="text-align:right">Destination: <?php echo $paisdestino; ?></p>
  </div>
</div>

<div class="container" style="border: 1px solid black;width: 80%;height: auto;margin:auto;padding:3%;border-bottom: 0px;color:black">	

     <p>Estimated Delivery Date</p>
     <h2 style="color:black"><strong><?php echo $schedule; ?> - By End of Day</strong></h2>
     <br>
     <p>To protect your privacy, more delivery details are available after validation</p>
     <br>
    
     <h5><strong>Next Step</strong></h5>
    
     <p>Please continue to monitor the progress online. If you are the consignee and would like to change your delivery preference, please visit https://oceanhogship.com.</p>
</div>

<div class="container" style="border: 1px solid black;width: 80%;height: auto;margin:auto;padding:3%;color:black">	

    <div class="container">
<div class="accordion" id="accordionExample">

  <div class="item">
     <div class="item-header" id="headingThree">
        <h2 class="mb-0">
           <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
              data-target="#collapseThree" aria-expanded="false"
              aria-controls="collapseThree">
           More Shipment Details
           <i class="fa fa-angle-down"></i>
           </button>
        </h2>
     </div>
     <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
        data-parent="#accordionExample">
        <div class="t-p" style="color:black">
           <h5><strong>Phone:</strong> <?php echo $r_phone; ?></h5>
           <h5><strong>Sender:</strong> <?php echo $ship_name; ?></h5>
           <h5><strong>Recipient:</strong> <?php echo $rev_name; ?></h5>
           <h5><strong>Pickup Date/Time:</strong> <?php echo $pick_date; ?></h5>
           <h5><strong>Weight:</strong> <?php echo $weight; ?></h5>
           <h5><strong>Description:</strong> <?php echo $comments; ?></h5>
           <h5><strong>Origin:</strong> <?php echo $pick_time; ?></h5>
           <h5><strong>Type:</strong> <?php echo $type; ?></h5>
           <h5><strong>Shipment Type:</strong> <?php echo $mode; ?></h5>
        </div>
     </div>
  </div>
  <div class="item">
     <div class="item-header" id="headingFour">
        <h2 class="mb-0">
           <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
              data-target="#collapseFour" aria-expanded="false"
              aria-controls="collapseFour">
           All Shipment Updates
           <i class="fa fa-angle-down"></i>
           </button>
        </h2>
     </div>
     <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
        data-parent="#accordionExample">
        <div class="t-p" style="color:black">
        
           <div class="container py-5" style="margin:auto">
  <div class="row">
    <div class="col-md-12">
      <div id="content">
        <ul class="timeline-1 text-black">
            <?php
					

					//EJECUTAMOS LA CONSULTA DE BUSQUEDA
					$result = mysql_query("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
					//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
				
					if(mysql_num_rows($result)>0){
						while($row = mysql_fetch_array($result)){
						
									
							echo '<li class="event" data-date="'.$row['d'].'">
            <h4 class="mb-3">'.$row['status'].'</h4>
            <p>'.$row['comments'].' - '.$row['pick_time'].'</p>
          </li>';		
						}
					}else{
						echo '<li class="event" >
           
            <p>No result found.</p>
          </li>';
					}
				
				?>
				
          
         
        </ul>
      </div>
    </div>
  </div>
</div>
        </div>
     </div>
  </div>
</div>
</div>
 

  
</div>
</div>

</div>





<!---- development by aayush -->


	<hr>


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