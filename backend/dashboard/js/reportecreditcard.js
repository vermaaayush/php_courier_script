function reportecreditcardEXCEL(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_excel/Debit_payment_card_shipments.php?desde='+desde+'&hasta='+hasta);
}