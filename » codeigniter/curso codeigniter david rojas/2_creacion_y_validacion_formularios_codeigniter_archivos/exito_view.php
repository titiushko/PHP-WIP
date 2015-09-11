<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>exito_view</title>
	<style type="text/css" media="screen">
		div.exito{
			background-color:#C2FFAF;
			border:1px solid #2A7F0F;
			padding:5px;
			margin-bottom:15px;
			width:400px;
		}
	</style>
</head>

<body>
<div class="exito">
	El formulario se ha enviado correctamente<br />
	El nombre es: <?php echo $nombre ?><br />
	La contraseña en md5 es: <?php echo $password ?>
</div>
<?php echo anchor('formulario', 'Volver al formulario') ?>
</body>
</html>
