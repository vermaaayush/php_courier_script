function reporttopayPDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_pdf/Shipping_payment_credit_card.php?desde='+desde+'&hasta='+hasta);
}