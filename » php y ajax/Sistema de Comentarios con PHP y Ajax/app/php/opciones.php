<?php
	////////////////////////////////////////////////////////////////////////////////////
	//Esta clase realiza todas las operaciones para MYSQL borra-actualiza-inserta y busca un dato
	////////////////////////////////////////////////////////////////////////////////////
	include("conexion.php");
	class opciones{

	
	/*Se conecta a la base de datos para realizar conultas */
	var $datos;
	var $resultado;
	public function conectar(){
		$datos=new conexion();
		//Habilitar para una conexion local
	    $datos->conectar("localhost","root","byg","comentarios");

		
		}
	/*Cierra la conexion*/	
	public function cerrar(){
		$this->$datos->cerrar();
		
		}
	/*Busca datos en MySql*/
	public function buscar($sql){
		$this->conectar();
		$resultado=mysql_query($sql);
		return $resultado;
		$this->cerrar();
		
		}
	/*Borra datos en MySql*/
	public function eliminar($sql){
		$this->conectar();
		$resultado=mysql_query($sql);
		return $resultado;
		$this->cerrar();
		
		}
	
	
	/*Actualiza datos en MySql*/	
	public function actualizar($sql){
		$this->conectar();
		$resultado=mysql_query($sql);
		return $resultado;
		$this->cerrar();
		
		}
		
	/*Inserta datos en MySql*/	
	public function insertar($sql){
		$this->conectar();
		$resultado=mysql_query($sql);
		return $resultado;
		$this->cerrar();
		
		}
		
		
	
	
	
	
	}//Termina la clase



?>