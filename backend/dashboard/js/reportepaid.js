function reportpaidPDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_pdf/Shipments_cash_payment.php?desde='+desde+'&hasta='+hasta);
}