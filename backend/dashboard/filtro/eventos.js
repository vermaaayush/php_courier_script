
function estado(valor){
	var url = 'ColocarNombre.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divTitulo', url, { method: 'get', parameters: pars});
}

function remi(valor){
	var url = 'ColocarRemi.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divRemi', url, { method: 'get', parameters: pars});
}

function desti(valor){
	var url = 'ColocarDesti.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divDesti', url, { method: 'get', parameters: pars});
}

function ingreso(valor){
	var url = 'ColocarVehiculo.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divVehiculo', url, { method: 'get', parameters: pars});
}

function reex(valor){
	var url = 'ColocarReex.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divReex', url, { method: 'get', parameters: pars});
}

