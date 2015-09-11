<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Conexion/AbrirConexion.php";
	
	function consultarUsuario(){
		$instruccion_select = "SELECT codigo_usuario, nombres_usuario, apellidos_usuario, nacimiento_usuario, password_usuario FROM tm_usuario ORDER BY codigo_usuario";
		$consulta_tm_usuario = oci_parse(abrirConexion(), $instruccion_select) or die ('<b>Fallo en consulta_tm_usuario!!</b>'.oci_error());
		oci_execute($consulta_tm_usuario);
		
		$cantidad_usuarios = 1;
		while($registros_tm_usuario = oci_fetch_array($consulta_tm_usuario)){
			$tm_usuario[$cantidad_usuarios]['codigo_usuario'] 		= $registros_tm_usuario[0];
			$tm_usuario[$cantidad_usuarios]['nombres_usuario'] 		= $registros_tm_usuario[1];
			$tm_usuario[$cantidad_usuarios]['apellidos_usuario'] 	= $registros_tm_usuario[2];
			$tm_usuario[$cantidad_usuarios]['nacimiento_usuario'] 	= $registros_tm_usuario[3];
			$tm_usuario[$cantidad_usuarios]['password_usuario'] 	= $registros_tm_usuario[4];
			$cantidad_usuarios++;
		}
		return $tm_usuario;
	}
	
	function buscarUsuario($codigo){
		$instruccion_select = "SELECT nombres_usuario, apellidos_usuario, nacimiento_usuario, password_usuario FROM tm_usuario WHERE codigo_usuario = '$codigo'";
		$consulta_tm_usuario = oci_parse(abrirConexion(), $instruccion_select) or die ('<b>Fallo en consulta_tm_usuario!!</b>'.oci_error());
		oci_execute($consulta_tm_usuario);
		
		$registros_tm_usuario = oci_fetch_array($consulta_tm_usuario);
		$tm_usuario['nombres_usuario'] 		= $registros_tm_usuario[0];
		$tm_usuario['apellidos_usuario'] 	= $registros_tm_usuario[1];
		$tm_usuario['nacimiento_usuario'] 	= $registros_tm_usuario[2];
		$tm_usuario['password_usuario'] 	= $registros_tm_usuario[3];
		return $tm_usuario;
	}
	
	function modificarUsuario($codigo, $identificador, $nombres, $apellidos, $nacimiento, $password){
		$instruccion_update = "UPDATE tm_usuario SET codigo_usuario = '$identificador', nombres_usuario = '$nombres', apellidos_usuario = '$apellidos', nacimiento_usuario = '$nacimiento', password_usuario = '$password' WHERE codigo_usuario = '$codigo'";
		$modifica_tm_usuario = oci_parse(abrirConexion(), $instruccion_update) or die ('<b>Fallo en modifica_tm_usuario!!</b>'.oci_error());
		oci_execute($modifica_tm_usuario);
		oci_commit(abrirConexion());
	}
	
	function eliminarUsuario($codigo){
		$elimina_tm_proyecto = oci_parse(abrirConexion(), "DELETE FROM tm_proyecto WHERE responsable_proyecto = '$codigo'") or die ('<b>Fallo en elimina_tm_proyecto!!</b>'.oci_error());
		oci_execute($elimina_tm_proyecto);
		oci_commit(abrirConexion());
		
		$elimina_tm_usuario = oci_parse(abrirConexion(), "DELETE FROM tm_usuario WHERE codigo_usuario = '$codigo'") or die ('<b>Fallo en elimina_tm_usuario!!</b>'.oci_error());
		oci_execute($elimina_tm_usuario);
		oci_commit(abrirConexion());
	}
	
	function agregarUsuario($codigo, $nombres, $apellidos, $nacimiento, $password){
		$instruccion_insert = "INSERT INTO tm_usuario(codigo_usuario, nombres_usuario, apellidos_usuario, nacimiento_usuario, password_usuario) VALUES('$codigo', '$nombres', '$apellidos', TO_DATE('$nacimiento','dd/mm/rr'), '$password')";
		$agregar_tm_usuario = oci_parse(abrirConexion(), $instruccion_insert) or die ('<b>Fallo en agregar_tm_usuario!!</b>'.oci_error());
		oci_execute($agregar_tm_usuario);
		oci_commit(abrirConexion());
	}
	
	include "../../../ModeloControlador/Conexion/CerrarConexion.php";
?>