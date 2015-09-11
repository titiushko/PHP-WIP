<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("content-disposition: attachment;filename=Reportes.xls");
?>
<html>
<title>::. Exportar datos.::</title>
<head></head>
<body>
<?php
include("../Script/Conexion.php");
$conectar = new Conexion();
$conectar->SeleccionarBase("eclinico"); 
$consulta=$conectar->Consulta("SELECT * FROM `paciente` WHERE DUI = '00093724-8'");
$result=mysql_result($consulta,0,'NOMBRE1_PACIENTE');
echo '
<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<tr>
<td>paciente</td>
<td>'.$result.'</td>
</tr>'

/*while($row = mysql_fetch_array($result)) {
printf("<tr>
<td>&nbsp;%s</td>
</tr>",
$row["NOMBRE1_PACIENTE"]);
}
mysql_free_result($result);*/
?>
</table>
</body>
</html>