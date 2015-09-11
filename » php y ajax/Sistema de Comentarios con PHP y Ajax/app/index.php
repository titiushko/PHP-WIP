<html>
<head>
<title>Ejemplo sencillo de Ajax</title>
<link rel="stylesheet" href="css/estilo.css" media="all" type="text/css"/>

	<script language="javascript " type="text/javascript">
					
					/////////////////////////////////////////////////////////////////////////////////////////////////////
					//Se crea el objeto xmlhttp
					/////////////////////////////////////////////////////////////////////////////////////////////////////
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

					
					/////////////////////////////////////////////////////////////////////////////////////////////////////
					//Manejamos la insercion de comentarios con AJAX
					/////////////////////////////////////////////////////////////////////////////////////////////////////
					function MostrarConsulta(datos){
					if(document.datos.comentario.value.length>1000){
					alert("Tu comentario es demasiado grande solo puedes introducir 1000 caracteres.");
					}
					else{
					
					
					
					divResultado = document.getElementById('comentarios');
					ajax=objetoAjax();
	
					
					datos+="?";
					datos+="usuario="+ document.datos.usuario.value;
					datos+="&correo="+ document.datos.correo.value;
					datos+="&comentario="+ document.datos.comentario.value;
	
	
					//Limpiamos los datos para uno nuevo
					limpiar();
	
					ajax.open("get", datos);
					ajax.onreadystatechange=function() {
					if (ajax.readyState==4) {
					divResultado.innerHTML = ajax.responseText;
			
			
					}
					}
					ajax.send(null)
					}
					}
					
					//limpia los campos de texto en la web
					function limpiar(){
					document.datos.usuario.value="";
					document.datos.correo.value="";
					document.datos.comentario.value="";
					document.datos.usuario.focus();
					
					}


	</script>











</head>
<body>
<h1>TUTORIAL DE AJAX</h1>
	<div id="contenedor">
	
	<!-- FORMULARIO PARA AJAX -->
	<form name="datos" method="" onsubmit="MostrarConsulta('php/insertar_comentarios.php'); return false">
	<label>Nombre:</label>
	<input type="text" class="nombre" name="usuario"/>
	<label>Correo:</label>
	<input type="text" class="correo" name="correo"/>
	<label>Mensaje:</label>
	<textarea class="mensaje" name="comentario"></textarea>
	<label><br>
	<input type="submit" class="comentar" value="" />
	</form>
	
	</div>
	<div id="comentarios">
	AQUI SE MOSTRAR EL ULTIMO COMENTARIO INSERTADO.
	</div>
</body>
</html>