function reportonlineEXCEL(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reports_excel/Shipping_Online.php?desde='+desde+'&hasta='+hasta);
}