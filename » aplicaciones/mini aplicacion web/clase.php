<?php
//Manejo de Catalogos Con Ajax,PHP,CSS
//Autor : Erik Blanco Bates
//Fecha : 13 Junio Del 2007
//incluyo el archivo de Clases para el manejo de Operaciones Basicas
require "clases/class.inc.php";
//Recibo los Valores

$nom=$_POST['nombres'];
$dep=$_POST['departamento'];
$suel=$_POST['sueldo'];
$opcion=$_POST['opcion'];
//si veo que no llegan las variables pos prueba cual no llega y cual no
//echo $nom," ",$dep," ",$suel," ",$opcion;
//recupero las opcion tanto de borrado como modificado para ver que opcion entrara en el case
$opci = $_GET['opcion'];
$idemp=$_GET['idempleado'];
//echo $idemp;
if($opcion == "")
{
  $opcion = $opci;
}
//Armo el Switch para ver en que caso entra el formulario y pueda realizar la operacion alta,bajas,modificaciones.
switch($opcion)
{
//Si es Caso 1 Guarda el Nuevo Empleado 
case 1:
$obj->alta("empleados","nombres, departamento, sueldo","'$nom','$dep',$suel");
break;
//En Caso 2 Borra el Nuevo Empleado
case 2:
$obj->borrado("empleados","idempleado",$idemp);
break;
//En Caso 3 Actualizamos Registro
case 3:
$idemp=$_POST['idempleado'];
$nom=$_POST['nombres'];
$dep=$_POST['departamento'];
$suel=$_POST['sueldo'];
$obj->Modificar("empleados","nombres='$nom',departamento='$dep',sueldo=$suel","idempleado",$idemp);
break;
}

//Si Todo Sale Bien Incluimos el Listado De Paginacion
include('catalogue_empleados.php');

?>