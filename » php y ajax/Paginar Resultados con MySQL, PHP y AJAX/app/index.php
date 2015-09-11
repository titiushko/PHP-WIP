<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Paginar Resultados</title>
<script type="text/javascript" src="ajax.js"></script>
<style>
td{
	width:200px;
}
a{
	text-decoration:underline;
	cursor:pointer;
}
</style>
</head>

<body>
<div style="margin:auto;width:500px;text-align:center;">
<table border="1px">
<tr>
 <td>Nombres</td>
 <td>Departamento</td>
 <td>Sueldo</td>
</tr>
</table>
<div id="contenido">
<?php include('paginador.php')?>
</div>
</div>
</body>
</html>
