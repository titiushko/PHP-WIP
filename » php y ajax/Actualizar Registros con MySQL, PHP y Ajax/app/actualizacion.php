<?php
//Desarrollado por Jesus Liραn
//webmaster@ribosomatic.com
//ribosomatic.com
//Puedes hacer lo que quieras con el cσdigo
//pero visita la web cuando te acuerdes

//Configuracion de la conexion a base de datos
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "ribosomatic"; 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 

//variables POST
$idemp=$_POST['idempleado'];
$nom=$_POST['nombres'];
$dep=$_POST['departamento'];
$suel=$_POST['sueldo'];

//actualiza los datos del empleado
$sql="UPDATE empleado SET nombres='$nom', departamento='$dep', sueldo='$suel' WHERE idempleado=$idemp";

mysql_query($sql,$con);

include('consulta.php');
?>