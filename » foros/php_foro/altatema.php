<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Ejercicio Nro. 26</title>
<meta http-equiv="" content="text/html; charset=iso-8859-1">
<meta http-equiv="" content="text/html; charset=iso-8859-1"></head>

<body bgcolor= "#999999">
<?include("cabeza.htm");?>
<font color="#000000" face="Courier New, Courier, mono"><h2 align="center"><strong>Agregar Nuevo Tema</strong></h2></font>
<form action="procesatema.php" method="post">
<table width="100%" border="0">
  <tr>
    <td  width="40%"align= "right"><em>Nombre :</em></td>
	<td  ><input name="autor" type="text" size="30" maxlength="30"></td>
  </tr>
  <tr>
     <td align="right"><em>E-Mail :</em></td>
	 <td><input name="correo" type="text" size="30" maxlength="30"></td>
  </tr>
  <tr>
     <td align="right"><em>Tema :</em></td>
	 <td><input name="tema" type="text" size="30" maxlength="30"></td>
  </tr>
  <tr>
     <td align="right"><em>Mensaje :</em></td>
	 <td><textarea  name="mensaje" cols="40" rows="10"></textarea></td>
  </tr>
  <tr>
     <td><input    TYPE= "hidden" NAME="fecha"  value=<?echo date("y"),"/",date("m"),"/",date("d");?>
  </td>
  <tr>
     <td ><input  type="submit" value="Grabar"></td>
  </tr>
</table>
<hr>
 <table align='center' border='0' bordercolor="#FFffff" >
<tr bgcolor='#666666'><td>
<p align="center"><a href="index.php"><img src="BACKGLOW.GIF" width="60" height="30" border="0"></a></p>
 </td></tr>

</form>.
</html>
