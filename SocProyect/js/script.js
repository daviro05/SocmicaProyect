function alerta(){

	confirm('Estás seguro de eliminar completamente tu cuenta de Socmica?');
}

function terminos() {

    $("#dialog").dialog({ show: "blind",
			  hide: "blind",
			  width: 500
		  });
		}


function confirmar()
{
	if(confirm("Seguro?"))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function redirigir()
{
	setTimeout ("redirection()", 300);
}

function redirection(){

	//window.location = "http://localhost/eclipse/Socmica/index.php";
	window.location = "http://socmica.hostzi.com/index.php";
} 





