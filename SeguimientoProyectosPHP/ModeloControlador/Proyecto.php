<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Conexion/AbrirConexion.php";
	
	function consultarProyecto(){
		$instruccion_select = "SELECT codigo_proyecto, responsable_proyecto, nombre_proyecto, descripcion_proyecto, inicio_proyecto, fin_proyecto FROM tm_proyecto ORDER BY codigo_proyecto";
		$consulta_tm_proyecto = oci_parse(abrirConexion(), $instruccion_select) or die ('<b>Fallo en consulta_tm_proyecto!!</b>'.oci_error());
		oci_execute($consulta_tm_proyecto);
		
		$cantidad_proyectos = 1;
		while($registros_tm_proyecto = oci_fetch_array($consulta_tm_proyecto)){
			$tm_proyecto[$cantidad_proyectos]['codigo_proyecto'] 		= $registros_tm_proyecto[0];
			$tm_proyecto[$cantidad_proyectos]['responsable_proyecto'] 	= $registros_tm_proyecto[1];
			$tm_proyecto[$cantidad_proyectos]['nombre_proyecto'] 		= $registros_tm_proyecto[2];
			$tm_proyecto[$cantidad_proyectos]['descripcion_proyecto'] 	= $registros_tm_proyecto[3];
			$tm_proyecto[$cantidad_proyectos]['inicio_proyecto'] 		= $registros_tm_proyecto[4];
			$tm_proyecto[$cantidad_proyectos]['fin_proyecto'] 			= $registros_tm_proyecto[5];
			$cantidad_proyectos++;
		}
		return $tm_proyecto;
	}
	
	function buscarProyecto($codigo){
		$instruccion_select = "SELECT responsable_proyecto, nombre_proyecto, descripcion_proyecto, inicio_proyecto, fin_proyecto FROM tm_proyecto WHERE codigo_proyecto = '$codigo'";
		$consulta_tm_proyecto = oci_parse(abrirConexion(), $instruccion_select) or die ('<b>Fallo en consulta_tm_proyecto!!</b>'.oci_error());
		oci_execute($consulta_tm_proyecto);
		
		$registros_tm_proyecto = oci_fetch_array($consulta_tm_proyecto);
		$tm_proyecto['responsable_proyecto'] 	= $registros_tm_proyecto[0];
		$tm_proyecto['nombre_proyecto'] 		= $registros_tm_proyecto[1];
		$tm_proyecto['descripcion_proyecto'] 	= $registros_tm_proyecto[2];
		$tm_proyecto['inicio_proyecto'] 		= $registros_tm_proyecto[3];
		$tm_proyecto['fin_proyecto'] 			= $registros_tm_proyecto[4];
		return $tm_proyecto;
	}
	
	function modificarProyecto($codigo, $responsable, $nombre, $descripcion, $inicio, $fin){
		$instruccion_update = "UPDATE tm_proyecto SET responsable_proyecto = '$responsable', nombre_proyecto = '$nombre', descripcion_proyecto = '$descripcion', inicio_proyecto = '$inicio', fin_proyecto = '$fin' WHERE codigo_proyecto = '$codigo'";
		$modifica_tm_proyecto = oci_parse(abrirConexion(), $instruccion_update) or die ('<b>Fallo en modifica_tm_proyecto!!</b>'.oci_error());
		oci_execute($modifica_tm_proyecto);
		oci_commit(abrirConexion());
	}
	
	function eliminarProyecto($codigo){
		$elimina_tm_proyecto = oci_parse(abrirConexion(), "DELETE FROM tm_proyecto WHERE codigo_proyecto = '$codigo'") or die ('<b>Fallo en elimina_tm_proyecto!!</b>'.oci_error());
		oci_execute($elimina_tm_proyecto);
		oci_commit(abrirConexion());
	}
	
	function agregarProyecto($responsable, $nombre, $descripcion, $inicio, $fin){
		$instruccion_insert = "INSERT INTO tm_proyecto(responsable_proyecto, nombre_proyecto, descripcion_proyecto, inicio_proyecto, fin_proyecto) VALUES('$responsable', '$nombre', '$descripcion', TO_DATE('$inicio','dd/mm/rr'), TO_DATE('$fin','dd/mm/rr'))";
		$agregar_tm_proyecto = oci_parse(abrirConexion(), $instruccion_insert) or die ('<b>Fallo en agregar_tm_proyecto!!</b>'.oci_error());
		oci_execute($agregar_tm_proyecto);
		oci_commit(abrirConexion());
	}
	
	function listaUsuarios(){
		$instruccion_select = "SELECT codigo_usuario FROM tm_usuario ORDER BY codigo_usuario";
		$consulta_tm_usuario = oci_parse(abrirConexion(), $instruccion_select) or die ('<b>Fallo en consulta_tm_usuario!!</b>'.oci_error());
		oci_execute($consulta_tm_usuario);
		
		$cantidad_usuarios = 1;
		while($registros_tm_usuario = oci_fetch_array($consulta_tm_usuario)){
			$tm_usuario[$cantidad_usuarios] = $registros_tm_usuario[0];
			$cantidad_usuarios++;
		}
		return $tm_usuario;
	}
	
	function consultarProyectoXUsuarios($responsable){
		if($responsable == "todos"){$busqueda = "ORDER BY codigo_proyecto";}
		else{$busqueda = "WHERE responsable_proyecto = '$responsable' ORDER BY codigo_proyecto";}
		$instruccion_select = "SELECT codigo_proyecto, nombre_proyecto, descripcion_proyecto, inicio_proyecto, fin_proyecto, responsable_proyecto FROM tm_proyecto $busqueda";		
		$consulta_tm_proyecto = oci_parse(abrirConexion(), $instruccion_select) or die ('<b>Fallo en consulta_tm_proyecto!!</b>'.oci_error());
		oci_execute($consulta_tm_proyecto);
		$numero_registros = oci_fetch_all($consulta_tm_proyecto, $resultado);
		
		//imprimir arrays var_dump, foreach
		$cantidad_proyectos = 1;
		if($numero_registros > 0){
			$consulta_tm_proyecto = oci_parse(abrirConexion(), $instruccion_select) or die ('<b>Fallo en consulta_tm_proyecto!!</b>'.oci_error());
			oci_execute($consulta_tm_proyecto);
			while($registros_tm_proyecto = oci_fetch_array($consulta_tm_proyecto)){
				$tm_proyecto[$cantidad_proyectos]['codigo_proyecto'] 		= $registros_tm_proyecto[0];
				$tm_proyecto[$cantidad_proyectos]['nombre_proyecto'] 		= $registros_tm_proyecto[1];
				$tm_proyecto[$cantidad_proyectos]['descripcion_proyecto'] 	= $registros_tm_proyecto[2];
				$tm_proyecto[$cantidad_proyectos]['inicio_proyecto'] 		= $registros_tm_proyecto[3];
				$tm_proyecto[$cantidad_proyectos]['fin_proyecto'] 			= $registros_tm_proyecto[4];
				$tm_proyecto[$cantidad_proyectos]['responsable_proyecto'] 	= $registros_tm_proyecto[5];
				$cantidad_proyectos++;
			}
		}
		else{
			$tm_proyecto[$cantidad_proyectos]['codigo_proyecto'] 		= "&nbsp;";
			$tm_proyecto[$cantidad_proyectos]['nombre_proyecto'] 		= "&nbsp;";
			$tm_proyecto[$cantidad_proyectos]['descripcion_proyecto'] 	= "&nbsp;";
			$tm_proyecto[$cantidad_proyectos]['inicio_proyecto'] 		= "&nbsp;";
			$tm_proyecto[$cantidad_proyectos]['fin_proyecto'] 			= "&nbsp;";
			$tm_proyecto[$cantidad_proyectos]['responsable_proyecto'] 	= "&nbsp;";
		}
		return $tm_proyecto;
	}
	
	include "../../../ModeloControlador/Conexion/CerrarConexion.php";
?>