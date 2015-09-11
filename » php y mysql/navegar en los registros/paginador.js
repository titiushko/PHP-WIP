function objetoAjax(){
	var xmlhttp = false;
	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e){
		try{
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E){
			xmlhttp = false;
  		}
	}
	if(!xmlhttp && typeof XMLHttpRequest!='undefined')	xmlhttp = new XMLHttpRequest();
	return xmlhttp;
}
function paginador(numero_pagina){
	contenido = document.getElementById('registros');
	ajax=objetoAjax();
	ajax.open("GET","registros.php?pagina="+numero_pagina);
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4){
			contenido.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}