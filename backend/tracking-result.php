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

$styling = mysql_fetch_array(mysql_query("SELECT * FROM styles"));
$tracking = $_POST['refno'];
$sql = "SELECT * FROM courier WHERE tracking = '$tracking'";
$result = dbQuery($sql);
$no = dbNumRows($result);


if ($no == 1) {

  while ($data = dbFetchAssoc($result)) {
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
      <meta name="description" content="" />
      <meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
      <meta name="author" content="Jaomweb">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

      <link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png" />

      <!-- Font Awesome CSS -->
      <link rel="stylesheet" href="deprixa/asset1/css/font-awesome.min.css" type="text/css" media="screen">

      <!-- style -->
      <link href="deprixa_components/content/cssefe4.css" rel="stylesheet" />
      <link rel="stylesheet" href="deprixa/css/tracking.css" type="text/css" />
      <link href="deprixa_components/styles/track-order.css" rel="stylesheet" />
      <link href="deprixa/css/style.css" rel="stylesheet" media="all">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


      <!--<link rel="stylesheet" href="/backend/assets/css/style-custom.css">-->
      <!-- Style Status -->
      <style>
        <?= $styling['style']; ?>
      </style>
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Comme&display=swap');

        * {
          font-family: 'Comme', sans-serif;
        }

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


        .accordion {
          margin: 40px 0;
        }

        .accordion .item {
          border: none;
          margin-bottom: 50px;
          background: none;
        }

        .t-p {
          color: rgb(193 206 216);
          padding: 40px 30px 0px 30px;
        }

        .accordion .item .item-header h2 button.btn.btn-link {
          background: white;
          color: black;
          border: 1px solid black;
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
          border-radius: 0;
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





      <style>
        @font-face {
          font-family: dhlicons;
          font-style: normal;
          font-weight: 400;
          src: url(/backend/assets/fonts/iconfont-f2a1844613e842cf9c18.woff) format("woff")
        }

        .has-icon::after,
        .has-icon::before,

        [class*=" icon-"]::before,
        [class^="icon-"]::before {
          speak: none;
          -webkit-font-feature-settings: normal;
          font-feature-settings: normal;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          font-family: dhlicons;
          font-style: normal;
          font-variant: normal;
          font-weight: 400;
          line-height: 1;
          font-size: 2.5rem;
          left: -1.4rem;
        }


        .has-icon {
          border-left: 3px solid grey;
          position: relative;
          padding: 150px;
        }

        .datetime .date {
          display: block;
          /* font-size: 1.8rem; */
          margin-bottom: .7rem;
        }

     
        .has-icon:nth-of-type(1)::before {
          color: #67a31d !important;
        }


        .has-icon::before {
          
          background-color: white;
          transform: rotate(180deg);
          color: grey;
          content: "\e613";
          line-height: 1;
          position: absolute;
          top: 6.3rem;
          z-index: 1;
        }

        .has-icon::after {
          background-color: white;
          transform: rotate(180deg);
          color: grey;
          content: "\e613";
          line-height: 1;
          position: absolute;
          top: 3rem;
          z-index: 1;
        }

        @media (min-width: 767px) {
        
          .has-icon-start{padding: 0 0px 50px 0 }
          .has-icon-start::after,
          .has-icon-start::before {
            content: none !important;
          }

          .left {
            padding-left: 0px !important;
          }
        }

        @media (max-width: 767px) {
          .has-icon {
            padding: 190px;
          }
        }

        .pl-4 {
          padding-left: 2rem;
        }

        .border-bottom-1 {
          border-bottom: 1px solid grey !important;
          padding: 20px 0px;

        }
        .border-bottom-1:last-of-type {
          border-bottom:none !important;
        }
        .mt-5 {
          margin-top: 4rem;
          
        }
        .mt-2{
          margin-top: 2rem;
        }
        .d-flex{display:flex !important} 
        .justify-content-center{display:flex;justify-content: center;}
        .justify-content-between{justify-content: space-between;display: flex;}
        .form-group {	margin-bottom: 0px;	width: 100%;}
        .track{
        background-color: #d40511;
        color:#fff;
        border: .1rem solid #d40511;
        font-weight:bold;
        border-radius: 0 .4rem .4rem 0;
        transition: background-color .2s,border .2s;}

        .track:active, .track:hover {
          background-color: #eb131e;
          border-color: #eb131e;
        }
        .color-red.collapsed{
          color:black !important;
        }
        .accordion .item .item-header h2 button.btn.btn-link.color-red{
         color:#d40511;
        }
        .color-red:hover{
         color:#d40511 !important
        }
        .color-green{
          color:#67a31d
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

          <div class="row d-flex justify-content-center mt-5 ">   
            <div class="col-sm-8">  
          <h2 style="text-align: center;">TRACK: EXPRESS</h2>
          <form class="d-flex justify-content-between" method="post" name="wpcargo-track-form" action="/backend/tracking-result.php">
              <div class="form-group">
                  <input placeholder="Enter tracking number here..." type="text" name="refno" id="refno" class="form-control" value="<?= $tracking;?>" style="height: 50px;border-radius: 0px !important;font-size: 25px;" required />
              </div>

              <button class="btn btn-sm border-radius-30 margin-tb-20px text-white background-main-color box-shadow padding-lr-20px d-block track" id="submit_wpcargo" type="submit"   name="Track" value="TrackParcel" onClick="MM_validateForm('Consignment','','R');return document.MM_returnValue">Track Package

              </button>

          </form>

          </div>
          </div>

        <div class="container" style="border: 1px solid black;width: 80%;height: auto;margin:auto;margin-top: 8%;padding:3%;border-bottom: 0px;color:black">
          <div class="row d-flex">
            <div class="col-sm-8">
              <h5>Tracking Code: <?= $tracking; ?></h5>
              <h5>This shipment is handled by: <strong>Oceanhog Export</strong></h5>
            </div>
            <div class="col-sm-4">
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


          <h3><strong> 
            <span class="color-green">Arrived at Oceanhog Export Delivery Facility </span> 
           
            <p class="mt-2"> <?= $row_x["pick_time"]; ?></p>
         </strong>
        </h3>
        <h5><?= $row_x["bk_time"]; ?> Local time</h5>
          <br>
          <div style="margin-top:10px ">



            <p>Origin:<?= $pick_time; ?></p>
            <div class="card proj-progress-card">
              <div class="progress" style="background-color:#e5e5e5;">

                <div class="progress-bar bg-c-red" style="width:<?= $progress_width ?>% "></div>
              </div>
            </div>
            <p style="text-align:right">Destination: <span class="color-green"><?= $paisdestino; ?></span></p>
          </div>
        </div>

        <div class="container" style="border: 1px solid black;width: 80%;height: auto;margin:auto;padding:3%;border-bottom: 0px;color:black">

          <p class="color-green">Estimated Delivery Date</p>
          <h2 style="color:black"><strong><?= $schedule; ?> - By End of Day</strong></h2>
          <br>
          <p>To protect your privacy, more delivery details are available after validation</p>
          <br>

          <h5 class="color-green"><strong>Next Step</strong></h5>

          <p>Please continue to monitor the progress online. If you are the consignee and would like to change your delivery preference, please visit https://oceanhogship.com.</p>
        </div>

        <div class="container" style="border: 1px solid black;width: 80%;height: auto;margin:auto;padding:3%;color:black">

          <div class="container">
            <div class="accordion" id="accordionExample">

              <div class="item">
                <div class="item-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed color-red" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      More Shipment Details
                      <i class="fa fa-angle-down"></i>
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="t-p" style="color:black">
                    <h5><strong>Phone:</strong> <?= $r_phone; ?></h5>
                    <h5><strong>Sender:</strong> <?= $ship_name; ?></h5>
                    <h5><strong>Recipient:</strong> <?= $rev_name; ?></h5>
                    <h5><strong>Pickup Date/Time:</strong> <?= $pick_date; ?></h5>
                    <h5><strong>Weight:</strong> <?= $weight; ?></h5>
                    <h5><strong>Description:</strong> <?= $comments; ?></h5>
                    <h5><strong>Origin:</strong> <?= $pick_time; ?></h5>
                    <h5><strong>Type:</strong> <?= $type; ?></h5>
                    <h5><strong>Shipment Type:</strong> <?= $mode; ?></h5>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="item-header" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed color-red" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      All Shipment Updates
                      <i class="fa fa-angle-down"></i>
                    </button>
                  </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">


                  <div class="col-md-12 timeline text-black mt-5 ">
                    <?php
                    //EJECUTAMOS LA CONSULTA DE BUSQUEDA
                    $result = mysql_query("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
                    //CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX


                    if (mysql_num_rows($result) > 0) :  $start = 0; ?>

                      <?php while ($row = mysql_fetch_array($result)) : ?>

                        <div class="row border-bottom-1">
                          <div class="col-sm-3  pl-4  left">
                            <span class="datetime">
                              <p class="day"><?= $row['d'] == "0000-00-00" ? "00": date("l", strtotime($row['d'])) ?></p>
                              <h4 class="date"><?= $row['d'] == "0000-00-00" ? "0000-00-00": date("M, d Y", strtotime($row['d'])) ?></h4>
                              <p class="time"><?=  $row['t'] == "00:00:00" ? "00:00:00": date("H:i", strtotime($row['t'])) ?> </p>
                            </span>
                          </div>
                          <span class="has-icon <?= ($start == 0) ? 'has-icon-start' : '' ?>"></span>

                          <div class="col-sm-9 right pl-4">
                            <h4 class="mb-3"><?= $row['status'] ?></h4>
                            <p><?= $row['comments'] . ' - ' . $row['pick_time'] ?></p>

                          </div>

                        </div>


                      <?php $start++;
                      endwhile; ?>

                    <?php else : ?>
                      <div class="row text-center mt-5">
                        <p>No result found.</p>
                      </div>

                    <?php endif; ?>


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
      window.onload = load;
      window.onunload = GUnload;
    </script>
  <?php

  } //while

} //if
else {
  echo '';
  ?>

  <!doctype html>
  <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
  <!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
  <html>

  <head>
    <meta charset="utf-8" />
    <title>Track My Parcel | DEPRIXA</title>
    <meta name="description" content="Courier Deprixa V3.2 " />
    <meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
    <meta name="author" content="Jaomweb">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png" />

    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet" />
    <link rel="stylesheet" href="deprixa/css/tracking.css" type="text/css" />
    <link href="deprixa/css/style.css" rel="stylesheet" media="all">

  </head>

  <!-- Menu -->
  <?php include_once "menu2.php"; ?>
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
          <p>
            <font color="#FF0000"><?= $cons; ?></font> check the number or Contact Us.
          </p>
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
} //else
?>
