</div>

	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="js/ui-load.js"></script>
	<script src="js/ui-jp.js"></script>
	<script src="js/ui-nav.js"></script>
	<script src="js/ui-toggle.js"></script>
	<script src="js/delivery.js"></script>

    <script src="js/plugins/moment/moment.js"></script>
    <script src="js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="js/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="js/plugins/clockpicker/bootstrap-clockpicker.js"></script>
    <script src="js/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="js/jquery.form-pickers.init.js"></script>

    <!-- App js -->
    <script src="js/jquery.core.js"></script>
    <script src="js/jquery.app.js"></script>
	
	<script type="text/javascript">
	$(function alertaBox()
	{
		$("div.alertaCaja").slideDown("fast");
		setTimeout(function(){
			window.history.replaceState( {} , '', document.URL.split('?')[0] );
			$("div.alertaCaja").slideUp("fast");
		}, 18000);
	});
	</script>

	<script type="text/javascript">

		function validateMail(idMail)
		{
			//We create an object or
			object=document.getElementById(idMail);
			valueForm=object.value;

			// Pattern for the mail
			var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
			if(valueForm.search(patron)==0)
			{
				//Mail correct
				object.style.color="#36D900";
				return;
			}
			//Mail incorrect
			object.style.color="#FF4000";
		}
		//-->
		document.getElementById('id_mail').addEventListener('input', function() {
			campo = event.target;
			valido = document.getElementById('emailOK');

			emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
			//Se muestra un texto a modo de ejemplo, luego va a ser un icono
			if (emailRegex.test(campo.value)) {
			 valido.innerText = "<?php echo $emailtext; ?>";
			} else {
			  valido.innerText = "<?php echo $emailtextx; ?>";
			}
		});
		
		function validateeMail(idMail)
		{
			//We create an object or
			object=document.getElementById(idMail);
			valueForm=object.value;

			// Pattern for the mail
			var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
			if(valueForm.search(patron)==0)
			{
				//Mail correct
				object.style.color="#36D900";
				return;
			}
			//Mail incorrect
			object.style.color="#FF4000";
		}
		//-->
		document.getElementById('idemail').addEventListener('input', function() {
			campo = event.target;
			valido = document.getElementById('mailOK');

			emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
			//Se muestra un texto a modo de ejemplo, luego va a ser un icono
			if (emailRegex.test(campo.value)) {
			 valido.innerText = "<?php echo $emailtext; ?>";
			} else {
			  valido.innerText = "<?php echo $emailtextx; ?>";
			}
		});

		function suma(){

			var num2 = "5.56789";
			var sum1 = document.getElementById("sum1");
			var sum2 = document.getElementById("sum2");
			var sum3 = document.getElementById("sum3");
			var sum4 = document.getElementById("sum4");
			var sum5 = document.getElementById("sum5");
			var sum6 = document.getElementById("sum6");
			var input = document.getElementById("resultado");
			resultado = parseFloat(Math.round(sum1.value) + parseFloat(sum2.value * sum5.value/100)  + parseFloat(sum3.value) +  parseFloat(sum4.value * sum6.value - sum6.value)).toFixed(2);
			input.value= resultado;
		}

		function volumetrico(){

			var num2 = "1.341";
			var volume1 = document.getElementById("volume1");
			var volume2 = document.getElementById("volume2");
			var volume3 = document.getElementById("volume3");
			var input = document.getElementById("totalpeso");
			totalpeso = parseFloat(Math.round(volume1.value * volume2.value * volume3.value) /6000 ).toFixed(2);
			input.value= totalpeso;

		}
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#country').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'ajaxpais.php',
					data:'country_id='+countryID,
					success:function(html){
						$('#state').html(html);
						$('#city').html('<option value="">City</option>');
					}
				});
			}else{
				$('#state').html('<option value="">Capital</option>');
				$('#city').html('<option value="">City</option>');
			}
		});

		$('#country').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'ajaxpais.php',
					data:'iso='+countryID,
					success:function(html){
						$('#iso').html(html);
					}
				});
			}
		});

		$('#state').on('change',function(){
			var stateID = $(this).val();
			if(stateID){
				$.ajax({
					type:'POST',
					url:'ajaxpais.php',
					data:'state_id='+stateID,
					success:function(html){
						$('#city').html(html);
					}
				});
			}else{
				$('#city').html('<option value="">City</option>');
			}

		});
		$('#Shippername').on('blur',function(){
			var customer_id = getListValue($(this)[0]);
			if(customer_id){
				$.ajax({
					type:'POST',
					url:'ajaxpais.php',
					data:'customer_id='+customer_id,
					success:function(json){
						obj = JSON.parse(json);
						document.getElementById('Shipperaddress').setAttribute('value',obj.addresses);
						document.getElementById('idemail').setAttribute('value',obj.email);
						document.getElementById('Shippercc').setAttribute('value',obj.identification);
						document.getElementById('Shipperphone').setAttribute('value',obj.telephone);
						document.getElementById('Shipperzipcode').setAttribute('value',obj.zip);
						document.getElementById('Shippercountry').setAttribute('value',obj.country);
						document.getElementById('Shipperstate').setAttribute('value',obj.state1);
						document.getElementById('Shipperciudad').setAttribute('value',obj.city);
						document.getElementById('Shipperiso').setAttribute('value',obj.isos);
						
					}
				});
			}else{
				///$('#city').html('<option value="">Ciudad</option>');
			}
		});


		function getListValue(input) {
			//var input = e.target,
				var list = input.getAttribute('list'),
				options = $('#' + list + ' option'),
				hiddenInput = $(input.id + '-hidden'),
				inputValue = input.value;

			hiddenInput.value = inputValue;

			for(var i = 0; i < options.length; i++) {
				var option = options[i];

				if(option.innerText === inputValue) {
					return hiddenInput.value = option.getAttribute('data-value');
					break;
				}
			}
		}

		//numero dos


		$('#Receivername').on('blur',function(){
			var customer_ida = getListValue($(this)[0]);
			if(customer_ida){
				$.ajax({
					type:'POST',
					url:'ajaxpais.php',
					data:'customer_id='+customer_ida,
					success:function(json){
						obj = JSON.parse(json);
						document.getElementById('Receiveraddress').setAttribute('value',obj.addresses);
						document.getElementById('id_mail').setAttribute('value',obj.email);
						document.getElementById('Receivercc_r').setAttribute('value',obj.identification);
						document.getElementById('Receiverphone').setAttribute('value',obj.telephone);						
						document.getElementById('Receivertelefono1').setAttribute('value',obj.phone2);
						document.getElementById('Receiverzipcode1').setAttribute('value',obj.zip);						
						document.getElementById('Receivercountry1').setAttribute('value',obj.country);
						document.getElementById('Receiverstate1').setAttribute('value',obj.state1);
						document.getElementById('Receivercity1').setAttribute('value',obj.city);
						document.getElementById('Receiveriso1').setAttribute('value',obj.isos);

					}

				});
			}
		});

	});
	</script>	
</body>
</html>