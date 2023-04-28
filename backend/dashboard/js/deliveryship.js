function reportedeliveryEXCEL(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_excel/Delivered_shipments.php?desde='+desde+'&hasta='+hasta);
}