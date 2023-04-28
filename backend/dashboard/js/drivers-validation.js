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


 //**customer registration**//

	$(document).ready(function() {
		$("#userForm").validate({
			rules: {
				fname: "required",
				lname: {
					required: true,
					lname: true
				},
				cc: {
					required: true,
					cc: true
				},
				email: {
					required: true,
					email: true
				},
				company: {
					required: true,
					company: true
				},				
				address: {
					required: true,
					address: true
				},
				phone: {
					required: true,
					phone: true
				},
				telefono: {
					required: true,
					telefono: true
				},
				country1: {
					required: true,
					country1: true
				},
				city1: {
					required: true,
					city1: true
				},
				zipcode: {
					required: true,
					zipcode: true
				},
			},
			messages: {
				fname: "Please enter your name",
				lname: "Please enter your last name",				
				cc: "Please enter your identification card or company nit",
				email:"Please enter your email address",
				company:"Please enter the name of your company",
				address:"Please enter your address",
				phone:"Please enter your phone 1",
				telefono:"Please enter your phone 2",
				ciudad:"Please enter city",
				country1:"Please enter the name of your country",				
				city1: "Please enter the name of the city",				
				zipcode:"Please enter the zip of his country",							
			}
		});
	});
	
	//**Password validation**//
	
	function validar_clave() {
		var caract_invalido = " ";
		var caract_longitud = 6;
		var cla1 = document.mi_formulario.password.value;
		var cla2 = document.mi_formulario.password2.value;
		if (cla1 == '' || cla2 == '') {
		alert('You must enter your password in the two fieldss.');
		return false;
		}
		if (document.mi_formulario.password.value.length < caract_longitud) {
		alert('Your password should consist of ' + caract_longitud + ' characters.');
		return false;
		}
		if (document.mi_formulario.password.value.indexOf(caract_invalido) > -1) {
		alert("Keys cannot contain spaces");
		return false;
		}
		else {
		if (cla1 != cla2) {
		alert ("Introduced keys are not the same");
		return false;
		}
		else {
		alert('Correct password');
		return true;
			  }
		   }
		}
	
	//**Validation of country and code**//
	
	$(document).ready(function(){
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'dashboard/ajaxpais1.php',
					data:'country_id='+countryID,
					success:function(html){
						$('#state1').html(html);
						$('#city1').html('<option value="">Ciudad</option>'); 
					}
				}); 
			}else{
				$('#state1').html('<option value="">Capital</option>');
				$('#city1').html('<option value="">Ciudad</option>'); 
			}
		});
		
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'dashboard/ajaxpais1.php',
					data:'iso='+countryID,
					success:function(html){
						$('#iso1').html(html);
					}
				}); 
			}
		});
		
		$('#state1').on('change',function(){
			var stateID = $(this).val();
			if(stateID){
				$.ajax({
					type:'POST',
					url:'dashboard/ajaxpais1.php',
					data:'state_id='+stateID,
					success:function(html){
						$('#city1').html(html);
					}
				}); 
			}else{
				$('#city1').html('<option value="">Ciudad</option>'); 
			}
		});
	});	