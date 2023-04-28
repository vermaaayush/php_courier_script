function reportonlinePDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_pdf/Shipping_Online.php?desde='+desde+'&hasta='+hasta);
}