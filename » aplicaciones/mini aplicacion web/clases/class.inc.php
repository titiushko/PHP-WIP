<?php
//Libreria De Clases de php para manejo de operaciones Basicas
//Autor : Erik Blanco Bates
//Clases System
define("Altas","Registro Agregado");
define("Bajas","Registro Borrado");
define("Actualzacion","Registro Actualizado");
define("Listar","Registros Actuales");
define("Error Base","No se Pudo Conectar a La base de Datos");
class System
{
var $cadena_conexion;//cadena de conexion
var $Servidor;//maquina donde se encuentra la base de datos
var $usuario_bd;//usuario de mysql
var $password_bd;//password de mysql
var $BaseDatos;  //Base De Datos 
var $mensaje;   //Mensajes
var $recordset;
var $Driver;
var $result;
var $Error;
var $Errorn;
var $Borrado;
var $Alta;
var $Actualizar;
var $Valor;  //Para verificar si se ingreso el registro , se elimino, se encontro el registro.
//creo el constructor
function System($bd = "",$host = "",$user = "", $pass = "")
{
	$this->BaseDatos = $bd;
	$this->Servidor = $host;
	$this->usuario_bd = $user;
	$this->password_bd= $pass;
}
//se crea la conexion asia la base de datos
function conexion($bd,$host,$user,$pass)
{
	if($bd   != "") $this->BaseDatos = $bd;
	if($host != "") $this->Servidor = $host;
	if($user != "") $this->usuario_bd = $user;
	if($pass != "") $this->password_bd = $pass;
	
	$this->cadena_conexion = mysql_connect($this->Servidor,$this->usuario_bd,$this->password_bd);
	if(!$this->cadena_conexion)
	{
		$this->Error="Error en la Conexion";
		return 0;
	}
	
	
	if(!@mysql_select_db($this->BaseDatos,$this->cadena_conexion))
	{
	   $this->Errorn = "Error al Conectarse a la base de Datos".$this->BaseDatos;
	   return 0;
	}
	
	return $this->cadena_conexion;
	
}


//Consulta de la Base Datos
function Consulta($sql = "")
{
	if($sql == "")
	{
		$this->Error = "No se ha Realizado Ninguna Consulta";
		return 0;
	}
	
	
	$this->result = @mysql_query($sql,$this->cadena_conexion);
	if(!$this->result)
	{
		$this->Errorn = mysql_errno();
		$this->Error = mysql_error();
	}
	
	
	return $this->result;
	
	
}

//Numeros de Campos
function numcampos()
{
	return mysql_num_fields($_pagi_result);
}
//Numero de Filas
function numregistros()
{
    return mysql_num_rows($this->result);
}
//Nombre de los Campos
function nombrecampo($numcampo)
{
   return mysql_field_name($this->result,$numcampo);
}


//Mostrar la Consulta
//Sin Paginar
function verconsulta($centrado,$title,$border,$centrar,$bordertabla,$bordertabla1)
{   
    echo "<$centrado>";
	echo "$title";
	echo "<table border=$border align=$centrar cellpadding=bordertabla cellspacing=bordetabla1>\n";
	
	// mostramos los nombres de los campos
	
	for ($i = 0; $i < $this->numcampos(); $i++){
	
	echo "<td><b>".$this->nombrecampo($i)."</b></td>\n";
	
	}
	
	echo "</tr>\n";
	
	// mostrarmos los registros
	
	while ($row = mysql_fetch_row($this->result)) {
	
	echo "<tr> \n";
	
	for ($i = 0; $i < $this->numcampos(); $i++){
	
	echo "<td>".$row[$i]."</td>\n";
	
	}
	
	echo "</tr>\n";
	
	}
	echo "</$centrado>";
	
}

//Funcion Borrado De Un Registro
function borrado($tabla="",$campo,$dato)
{
//	echo $tabla," ",$campo," ",$dato;
 if($tabla == "")
 {
        $this->Error = "No se Elegio La Tabla";
        return 0;
 }
 if($dato == "")
 {
	 	$this->Error = "No se ha Encontrado el Registro";
		return 0;
 }
 
 
 
 $this->Borrado = "DELETE FROM $tabla WHERE $campo = $dato";
 //echo $this->Borrado;
 $this->result = @mysql_query($this->Borrado,$this->cadena_conexion);
  if($this->result == 1 )
 {
 echo " ";
 }
 else
 {
 echo "Register No Delete";
 }
  

 
 return $this->result; 
 


}

//Funcion Agregar Nuevo Registro 
function alta($tabla ="",$campos="",$valores="")
{

  //echo $tabla," ",$campos," ",$valores;
  if($tabla == "")
  {
        $this->Error = "No se Elegio La Tabla";
        return 0;
  }
  
  $this->Alta= "INSERT INTO $tabla($campos) VALUES($valores)";
   $this->result = @mysql_query($this->Alta,$this->cadena_conexion);
// echo $this->result;
 //$this->Valor = @mysql_num_rows($this->result);
  //echo $this->Valor;
  if($this->result == 1 )
  {
   echo " ";
  }else
  {

   echo "<center>Register No Add</center>";
  }
  
 
 return $this->result; 
  
	
}

//Funcion Actualizar Registro
function Modificar($tabla ="", $campos ="",$campoidTabla="",$campoIdActualizar="")
{
	
//  echo $tabla," ",$campos," ",$campoidTabla," ",$campoIdActualizar;	
  if($tabla == "")
  {
	    $this->Error = "No se Elegio La Tabla";
	    return 0;
  }
  
  $this->Actualizar = "UPDATE $tabla set $campos Where $campoidTabla = $campoIdActualizar";
  $this->result = @mysql_query($this->Actualizar,$this->cadena_conexion);
 if($this->result == 1 )
  {
   echo " ";
  }else
  {

   echo "Register No Update";
  }
   return $this->result; 
  
}


}

//creo el objeto system
$obj = new System ;
//armo la conexion
$obj->conexion("empleados","127.0.0.1","root","");



?>
