<?php


	if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }

	if (version_compare(phpversion(), '5.0.0', '>=') !== true) {
		exit('Sorry, but you have to run this script with PHP5... You currently have the version <b>' . phpversion() . '</b>.');
	}

	if (!function_exists('imagecreate')) {
		exit('Sorry, make sure you have the GD extension installed before running this script.');
	}

	include_once('function.php');

	// FileName & Extension
	$system_temp_array = explode('/', $_SERVER['PHP_SELF']);
	$filename = $system_temp_array[count($system_temp_array) - 1];
	$system_temp_array2 = explode('.', $filename);
	$availableBarcodes = listBarcodes();
	$barcodeName = findValueFromKey($availableBarcodes, $filename);
	$code = $system_temp_array2[0];

	// Check if the code is valid
	if (file_exists('config' . DIRECTORY_SEPARATOR . $code . '.php')) {
		include_once('config' . DIRECTORY_SEPARATOR . $code . '.php');
	}

	$huyu=$_GET['tracking'];
	$default_value = array();
	$default_value['filetype'] = 'PNG';
	$default_value['dpi'] = 72;
	$default_value['scale'] = isset($defaultScale) ? $defaultScale : 1;
	$default_value['ncode'] = isset($defaultScale1) ? $defaultScale1 : 1;
	$default_value['rotation'] = 0;
	$default_value['font_family'] = 'Arial.ttf';
	$default_value['font_size'] = 10;
	$default_value['text'] = $huyu;
	$default_value['a1'] = '';
	$default_value['a2'] = '';
	$default_value['a3'] = '';

	$filetype = isset($_POST['filetype']) ? $_POST['filetype'] : $default_value['filetype'];
	$dpi = isset($_POST['dpi']) ? $_POST['dpi'] : $default_value['dpi'];
	$scale = intval(isset($_POST['scale']) ? $_POST['scale'] : $default_value['scale']);
	$ncode = intval(isset($_POST['ncode']) ? $_POST['ncode'] : $default_value['ncode']);
	$rotation = intval(isset($_POST['rotation']) ? $_POST['rotation'] : $default_value['rotation']);
	$font_family = isset($_POST['font_family']) ? $_POST['font_family'] : $default_value['font_family'];
	$font_size = intval(isset($_POST['font_size']) ? $_POST['font_size'] : $default_value['font_size']);
	$text = isset($_POST['text']) ? $_POST['text'] : $default_value['text'];

	registerImageKey('filetype', $filetype);
	registerImageKey('dpi', $dpi);
	registerImageKey('scale', $scale);
	registerImageKey('rotation', $rotation);
	registerImageKey('font_family', $font_family);
	registerImageKey('font_size', $font_size);
	registerImageKey('text', $text);
	
	
	registerImageKey('code', 'BCGcode39');
	
	require_once('../../../database.php');
	require '../../../requirelanguage.php';
	$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $company['cname']; ?> | <?php echo $barcodegenerator; ?></title>
  <meta name="description" content="<?php echo $company['description']; ?>"/>
  <meta name="keywords" content="<?php echo $company['keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
	<!-- App Favicon -->
	<link rel="shortcut icon" type="image/png" href="../../../img/favicon.png"/>

	<!-- App CSS -->
	<link href="../../../css/assets/css/style.css" rel="stylesheet" name="text/css" />
  

</head>
<body>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
<div class="container">

		<div class="row">
			<div class="col-sm-12">
				<div class="card-box table-responsive">
	
		  
					<div class="col-md-2">				
							<div>								
								  <img src="../../../logo-image/image_logo.php?id=1" height="39" width="150"></span>								
							</div>
						</div>
						<div class="col-md-2">
							
						</div>	
						<table border="0" align="center" width="100%">
						<form action="<?php echo $_SERVER['REQUEST_URI']; ?>?id" method="post">
									<h2 style="display: none;"><?php echo $barcodeName; ?></h2>	
									<section>
									<tr>
										<td class="TrackTitle" valign="top"><div  align="left"><h4 class="classic-title"><span><strong></strong></span></h4>
									</tr>
									 <table border="0" align="center">
											<tr>
												<td>			
												<td><strong> </strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td><font color="#00B200">&nbsp;=></font><?php echo $cantidadbarcode; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getInputTextHtml('ncode', $ncode, array('type' => 'number', 'min' => 1, 'max' => 100, 'required' => 'required')); ?></td>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#00B200">&nbsp;=></font><?php echo $trackbarcode; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td>&nbsp;&nbsp;<?php echo getInputTextHtml('text', $text, array('type' => 'text', 'required' => 'required')); ?></td>
												
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info" name="Submit" type="submit"><?php echo $generar; ?></button> </td>
											</tr>
										</table>
										   
									</section>
									<br>
									<div class="output">
										<h3><a href="javascript:Clickheretoprint()" style="color: #000000; text-decoration: none;"><img src="../../../img/printer-icon.png" border="0" height="50" width="50">&nbsp;&nbsp;<?php echo $imprimirbarcode; ?></a></h3>
											<section class="output">
											<tr>
											  <td class="TrackTitle" valign="top"><div  align="center"><h3 class="classic-title"><span><strong><?php echo $outbarcode; ?></strong></span></h3>
											</tr>
											<br>
											<div class="output" align="left">
												<section class="output">    
													<?php
														$finalRequest = '';
														foreach (getImageKeys() as $key => $value) {
															$finalRequest .= '&' . $key . '=' . urlencode($value);
														}
														if (strlen($finalRequest) > 0) {
															$finalRequest[0] = '?';
														}
													?>
													<div id="imageOutput">
														<?php
														$N=$ncode;
														for($i=0; $i < $N; $i++)
														{
														?>
														<?php if ($imageKeys['text'] !== '') { ?><img style="margin: 0 20px 20px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }
														else { ?>Fill the form to generate a barcode.<?php } }?>
													</div>
												</section>
											</div>
										</div>
									</div>
								</div>
							</form>
						 </div>
					</div>
					<!-- end row -->
		

		  <!-- footer -->
		  <footer id="footer" class="app-footer" role="footer">
				<div class="wrapper b-t bg-light">
					<?php echo $company['footer_website']; ?>
			</div>
		  </footer>

		<!-- End Footer -->

         </div> <!-- container -->
        </div> <!-- End wrapper -->
 
		<script type='text/javascript' src="../../../../css/plugins/DataTables/js/jquery.dataTables.js"></script>
		<script type='text/javascript' src="../../../../css/plugins/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script type='text/javascript' src="../../../../css/plugins/bootstrap-notify/bootstrap-notify.min.js"></script> 
		<script type='text/javascript' src="../../../../css/plugins/sweetalert/js/sweetalert.min.js"></script>  

		
		<!-- App js -->
        <script src="../../../../css/assets/js/jquery.core.js"></script>
        <script src="../../../../css/assets/js/jquery.app.js"></script>
		
		<script src="barcode.js"></script>
		<script language="javascript">
		 function Clickheretoprint()
			{ 
				  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
					  disp_setting+="scrollbars=yes,width=700, height=700, left=100, top=25"; 
				  var content_vlue = document.getElementById("imageOutput").innerHTML; 
				  
				  var docprint=window.open("","",disp_setting); 
				   docprint.document.open(); 
				   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
				   docprint.document.write(content_vlue); 
				   docprint.document.close(); 
				   docprint.focus(); 
			}
		</script>

  </body>
</html> 
