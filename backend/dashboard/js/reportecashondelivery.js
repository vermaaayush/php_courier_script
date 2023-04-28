function reportepaymentcashPDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_pdf/Debit_payment_card_shipments.php?desde='+desde+'&hasta='+hasta);
}