function reportedeliveryPDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_pdf/Delivered_shipments.php?desde='+desde+'&hasta='+hasta);
}