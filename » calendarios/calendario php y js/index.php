<?php
require('calendario.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mini Calendario Web</title>
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.functions.js"></script>
</head>

<body>
<form id="formulario">
	<p>
    <label for="fecha"> Selecciona la fecha 
    <input type="text" name="fecha" id="fecha"  /> <a onclick="show_calendar()" style="cursor: pointer;"><small>(calendario)</small></a>
    <div id="calendario">
    <?php calendar_html() ?>
    </div>
    </label>
    </p>
</form>
</body>
</html>
