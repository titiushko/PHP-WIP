<?php
//Desarrollado por Jesus Li��n
//ribosomatic.com
//Puedes hacer lo que quieras con el c�digo
//pero visita la web cuando te acuerdes

//Configuracion de la conexion a base de datos
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "ribosomatic"; 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 

//consulta todos los empleado

$sql=mysql_query("SELECT * FROM empleado",$con);

//muestra los datos consultados
//haremos uso de tabla para tabular los resultados
?>
<table style="border:1px solid #FF0000; color:#000099;width:400px;">
<tr style="background:#99CCCC;">
	<td>Codigo</td>
	<td>Nombres</td>
	<td>Departamento</td>
	<td>Sueldo</td>
</tr>

<?php
while($row = mysql_fetch_array($sql)){
	echo "	<tr>";
	//mediante el evento onclick llamaremos a la funcion PedirDatos(), la cual tiene como parametro
	//de entrada el ID del empleado
	echo " 		<td><a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"pedirDatos('".$row['idempleado']."')\">".$row['idempleado']."</a></td>";
	echo " 		<td>".$row['nombres']."</td>";
	echo " 		<td>".$row['departamento']."</td>";
	echo " 		<td>".$row['sueldo']."</td>";
	echo "	</tr>";
}
?>
</table>