function reporttopayEXCEL(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_excel/Shipping_payment_credit_card.php?desde='+desde+'&hasta='+hasta);
}