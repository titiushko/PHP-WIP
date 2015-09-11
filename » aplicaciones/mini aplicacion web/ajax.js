//Funciones de AJAX
//AUTOR: ERIK BLANCO BATES
//JUNIO 15 del 2007
//creo el objeto ajax
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


//Funcion Para Paginar Resultados de una Consulta
function Pagina(nropagina){
	//donde se mostrará los registros
	divContenido = document.getElementById('contenido');
	
	ajax=objetoAjax();
	//uso del medoto GET
	//indicamos el archivo que realizará el proceso de paginar
	//junto con un valor que representa el nro de pagina
	ajax.open("POST", "catalogue_empleados.php");
	//divContenido.innerHTML= '<img src="anim.gif">';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divContenido.innerHTML = ajax.responseText
			divContenido.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("pag="+nropagina)
}

//funcion que recupero los datos del formulario y los envio al archivo clase lo cual realizara tal operacion depende de la opcion que tenga en este caso actualizacion
function enviarDatosEmpleado(){
	//donde se mostrará lo resultados
	divResultado = document.getElementById('contenido');
	divFormulario = document.getElementById('formulario');
	//valores de los inputs
	id=document.frmempleado.idempleado.value;
	nom=document.frmempleado.nombres.value;
	dep=document.frmempleado.departamento.value;
	suel=document.frmempleado.sueldo.value;
	opcion=document.frmempleado.opcion.value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usando del medoto POST
	//archivo que realizará la operacion
	//actualizacion.php
	ajax.open("POST", "clase.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar los nuevos registros en esta capa
			divResultado.innerHTML = ajax.responseText
			//mostrar un mensaje de actualizacion correcta
			divFormulario.innerHTML = "La actualizaci&oacute;n se realiz&oacute; correctamente";
		}
	}
	//muy importante este encabezado ya que hacemos uso de un formulario
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores paso el parametro opcion para que realize la operacion indicada en el switch de php
	ajax.send("idempleado="+id+"&nombres="+nom+"&departamento="+dep+"&sueldo="+suel+"&opcion="+opcion)
}


//Muestro los datos actuales en el formulario 
function pedirDatos(idempleado){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('formulario');
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();

//	ajax.open("POST", "consulta_por_id.php?idemp="+idempleado);
	ajax.open("POST", "consulta_por_id.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	
	ajax.send("idemp="+idempleado)
}


//funcion que va a mandar los datos a php para que elimine el registro aqui le pongo por default la opcion 2 que siempre  y se cumpla la condicion del confirm elimine el registro 
function eliminarDato(idempleado){
	//donde se mostrará el resultado de la eliminacion
	divContenido = document.getElementById('contenido');
	divFormulario = document.getElementById('formulario');
	
	
	//usaremos un cuadro de confirmacion	
	var eliminar = confirm("De verdad desea eliminar este dato?")
	if ( eliminar ) {
	var opcion = 2;
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		//indicamos el archivo que realizará el proceso de eliminación
		//junto con un valor que representa el id del empleado
	        ajax.open("GET", "clase.php?idempleado="+idempleado+"&opcion="+opcion);

		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				//mostrar resultados en esta capa
			divContenido.innerHTML = ajax.responseText
			//mostrar un mensaje de actualizacion correcta
			divFormulario.innerHTML = "Registro Borrado correctamente";

			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null)
	}
}


//repito la funcion de pedir datos pero ahora vacio para poder ingresar registro nuevos 
//aqui mucho cuidado si de manera local se utiliza get si lo usas en un Servidor Dedicado se utiliza POST
//para llamar al formulario
function pedirDatos1(){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('formulario');
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET Manera Local GEt
	//Manera Servidor POST , True
	ajax.open("GET","empleados_registro.htm");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
		divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.style.display="block";
			
				}
	}
	//como hacemos uso del metodo GET
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
	ajax.send(null)
}
//Funcion Valido Empleado aqui hago la validacion simple del empleado si no introdujo nada en la cajitas le mando mensaje que ponga algo
function valida_empleado(){
	//donde se mostrará lo resultados
	divResultado = document.getElementById('contenido');
	//valores de los inputs
	nom=document.nuevo_empleado.nombres.value;
	dep=document.nuevo_empleado.departamento.value;
	suel=document.nuevo_empleado.sueldo.value;
	opci=document.nuevo_empleado.opcion.value;
	if(nom == "")
	{
	alert('Error no Escribio Nombre del Empleado')
	document.nuevo_empleado.nombres.focus();
	}
	else if(dep == "--")
	{
	alert("Error No Eligio Ningun Departamento")

	}
	else if(suel == "")
	{
	alert("Error no Escribio Ningun sueldo")
	document.nuevo_empleado.sueldo.focus();
	}
	else
	{

//en caso de que todo este bien  mando a llamar enviarDatosempleados pasandole la opcion lo cual va hacer 1 
	enviarDatosEmpleado1(nom,dep,suel,opci)
	}
	
}
//enviar datos del empleado le paso los parametros para que estos parametro lo mande a la pagina de php y pueda realizar la operacion de altas
function enviarDatosEmpleado1(nombre,departamento,sueldo,opci){
 
	//donde se mostrará lo resultados
	divResultado = document.getElementById('contenido');
	nom = nombre;
	dep = departamento;
	suel= sueldo;
	opcion = opci;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	//archivo que realizará la operacion
	//registro.php
	ajax.open("POST","clase.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
				divResultado.innerHTML = ajax.responseText
			//mostrar un mensaje de actualizacion correcta
			
			divFormulario.innerHTML = "Se Agrego el Registro Correctamente<br>";
			//LimpiarCampos();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("nombres="+nom+"&departamento="+dep+"&sueldo="+suel+"&opcion="+opcion)
}
//limpiamos cajitas
function LimpiarCampos(){
	document.nuevo_empleado.nombres.value="";
	document.nuevo_empleado.departamento.value="";
	document.nuevo_empleado.sueldo.value="";
	document.nuevo_empleado.nombres.focus();
}

//Para Finalizar la opcion de Cancelar solo nos borrara el formulario y nos mostrara el listado actual normal
function Cancelar(){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('formulario');
		//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST", "cancelar.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.innerHTML = "No se Realizo Ninguna Operacion<br>";
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(null)
}


