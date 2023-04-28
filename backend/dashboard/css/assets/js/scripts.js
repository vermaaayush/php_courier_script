/*******************************************************************************
* Simplified PHP Invoice System                                                *
*                                                                              *
* Version: 1.1.1	                                                               *
* Author:  James Brandon                                    				   *
*******************************************************************************/

$(document).ready(function() {

    // add new product row on invoice
    var cloned = $('#invoice_table tr:last').clone();
    $(".add-row").click(function(e) {
        e.preventDefault();
        cloned.clone().appendTo('#invoice_table'); 
    });
    
    calculateTotal();
    
    $('#invoice_table').on('input', '.calculate', function () {
	    updateTotals(this);
	    calculateTotal();
	});

	$('#invoice_totals').on('input', '.calculate', function () {
	    calculateTotal();
	});

	$('#invoice_product').on('input', '.calculate', function () {
	    calculateTotal();
	});

	$('.remove_vat').on('change', function() {
        calculateTotal();
    });

	function updateTotals(elem) {

        var tr = $(elem).closest('tr'),
            quantity = $('[name="invoice_product_Qnty[]"]', tr).val(),
	        price = $('[name="invoice_product_Totalfreight[]"]', tr).val(),
			itbm = $('[name="invoice_product_variable[]"]', tr).val(),
			carga = $('[name="invoice_product_Weight[]"]', tr).val(),
	        subtotal = parseInt(quantity) * parseFloat(price);

        if(percent && $.isNumeric(percent) && percent !== 0) {
            if(isPercent){
                subtotal = subtotal - ((parseFloat(percent) / 100) * subtotal);
            } else {
                subtotal = subtotal - parseFloat(percent);
            }
        } else {
            $('[name="invoice_product_discount[]"]', tr).val('');
        }

	    $('.calculate-sub', tr).val(subtotal.toFixed(2));
	}

	function calculateTotal() {
	    
	    var grandTotal = 0,
	    	disc = 0,
			disci = 0,
			discc = 0,
			discis = 0,
			cargosadi = 0,
	    	c_ship = parseInt($('.calculate.shipping').val()) || 0;

	    $('#invoice_table tbody tr').each(function() {
            var c_sbt = $('.calculate-sub', this).val(),
                quantity = $('[name="invoice_product_Qnty[]"]', this).val(),
	            price = $('[name="invoice_product_Totalfreight[]"]', this).val() || 0,
                subtotal = parseInt(quantity) * parseFloat(price);
            
            grandTotal += parseFloat(c_sbt);
            disc += subtotal - parseFloat(c_sbt);
	    });
		
		
		$('#invoice_table tbody tr').each(function() {
            var c_sbt = $('.calculate-sub', this).val(),
                peso = $('[name="invoice_product_Weight[]"]', this).val(),
	            hacer = $('[name="invoice_product_variable[]"]', this).val() || 0,
                carga = parseInt(peso) * parseFloat(hacer);
           
            grandTotal = parseFloat(c_sbt);
            disc = carga;
	    });	

		$('#invoice_table tbody tr').each(function() {
            var c_sbt = $('.calculate-sub', this).val(),
                peso = $('[name="invoice_product_Weight[]"]', this).val(),
	            hacer = $('[name="invoice_product_variable[]"]', this).val() || 0,
                carga = parseInt(peso) * parseFloat(hacer);
           
            disci = carga*0.07;
	    });	

		

        // VAT, DISCOUNT, SHIPPING, TOTAL, SUBTOTAL: 
	    var subT = parseFloat(grandTotal),
	    	finalTotal = parseFloat(grandTotal),
	    	vat = parseInt($('.invoice-vat').attr('data-vat-rate'));

	    $('.invoice-sub-total').text(subT.toFixed(2));
	    $('#invoice_subtotal').val(subT.toFixed(2));
        $('.invoice-discount').text(disc.toFixed(2));
        $('#invoice_discount').val(disc.toFixed(2));
		$('.invoice-discounti').text(disci.toFixed(2));
        $('#invoice_discounti').val(disci.toFixed(2));

        if($('.invoice-vat').attr('data-enable-vat') === '1') {

	        if($('.invoice-vat').attr('data-vat-method') === '1') {
		        $('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
		        $('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
	            $('.invoice-total').text((finalTotal).toFixed(2));
	            $('#invoice_total').val((finalTotal).toFixed(2));
	        } else {
	            $('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
	            $('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
		        $('.invoice-total').text((finalTotal + ((0) * finalTotal)).toFixed(2));
		        $('#invoice_total').val((finalTotal + ((0) * finalTotal)).toFixed(2));
	        }
		} else {
			$('.invoice-total').text((finalTotal).toFixed(2));
			$('#invoice_total').val((finalTotal).toFixed(2));
		}
		
	

   	function validateForm() {
	    // error handling
	    var errorCounter = 0;

	    $(".required").each(function(i, obj) {

	        if($(this).val() === ''){
	            $(this).parent().addClass("has-error");
	            errorCounter++;
	        } else{ 
	            $(this).parent().removeClass("has-error"); 
	        }


	    });

	    return errorCounter;
	}
}
});