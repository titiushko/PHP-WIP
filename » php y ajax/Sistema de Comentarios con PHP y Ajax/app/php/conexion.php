	<?php

	////////////////////////////////////////////////////////////////////////////////////
	//Esta clase es requerida para realizar la conexion a MYSQL
	////////////////////////////////////////////////////////////////////////////////////
	class conexion{
	/*Datos para la conexion a MySql en esta funcion se abre la conexion a MySql*/
	private $conexion;
	public function conectar($servidor,$usuario,$contraseña,$base_datos){
		$conexion= mysql_connect($servidor,$usuario,$contraseña);
		mysql_select_db($base_datos);
	}
	
	
	/*Cerramos la conexion que se a habierto de MySql*/
	public function cerrar(){
		mysql_close($conexion);
		
	}
	
	
	}
	
	?>