<?php
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	//Inserta los Comentarios a la base de datos 
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	include("opciones.php");
	$opciones=new opciones();
	if($_GET['usuario']!="" && $_GET['correo']!="" && $_GET['comentario']!=""){
	$fecha=date('l jS \of F Y');
	$md=md5($fecha);
	$opciones->insertar("INSERT INTO comentar(md5,usuario,correo,comentario,fecha) VALUES('{$md}','{$_GET['usuario']}','{$_GET['correo']}','{$_GET['comentario']}','{$fecha}')");
	echo "Se inserto un nuevo comentario: <br>";
	
	//Obtenemos el ultimo comentario insertado
	$respuesta=$opciones->buscar("SELECT * FROM comentar order by id desc");
	if ($mostrar=mysql_fetch_array($respuesta)){ 
	echo $mostrar['usuario']." dijo:<br>".$mostrar['comentario']; 
	}
	}
	else {
	echo "Lo sentimos pero la informaci&oacute;n fue incompleta corriguela.";
	}
?>