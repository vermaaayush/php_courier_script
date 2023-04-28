function reportepaymentPDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_pdf/all_shipments.php?desde='+desde+'&hasta='+hasta);
}

function reportepaymentEXCEL(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_excel/all_shipments.php?desde='+desde+'&hasta='+hasta);
}