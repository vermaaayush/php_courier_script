function reportpaidEXCEL(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_excel/Shipments_cash_payment.php?desde='+desde+'&hasta='+hasta);
}