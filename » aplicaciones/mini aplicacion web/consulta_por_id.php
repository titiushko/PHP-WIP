<?php

//Configuracion de la conexion a base de datos
//En este apartado Muestro el Formulario con los datos del empleado sin usar tablas

require "conexion.php"; 


//consulta los datos del empleado por su id
$idemp=$_POST['idemp'];

$sql=mysql_query("SELECT * FROM empleados WHERE idempleado=$idemp",$con);

$row = mysql_fetch_array($sql);

//valores de las consultas
$nom=$row['nombres'];
$dep=$row['departamento'];
$suel=$row['sueldo'];

//muestra los datos consultados en los campos del formulario
?>

<html>
<head>
<title>Registro con AJAX</title>
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style106_right.css" />
   <link rel="stylesheet" type="text/css" href="style/colour2.css" />
   <LINK href="style/style.css" type=text/css rel=StyleSheet>
   <LINK href="style/style1.css" type=text/css rel=StyleSheet>
    <LINK href="style/stilo.css" type=text/css rel=StyleSheet>

</head>
<body>


<form name="frmempleado" action="" onsubmit="enviarDatosEmpleado(); return false" class="cmxform">
	<input name="idempleado" type="hidden" value="<?php echo $idemp; ?>" />
	<input name="opcion" type="hidden" value="3" />
	<fieldset class="boxcontent" style="text-align:center;">  
    <legend style="text-align:center;">Actualizacion De Empleado</legend>
	<br>
    <div class="fm-req">  
    <label for="nombres">Nombres:</label>  
 	<input name="nombres" id="nombres" type="text" value="<?php echo $nom; ?>" />  
 	</div>  
    <div class="fm-opt">  
	<label for="departamento">Departamento:</label>  
			<select id="departamento" name="departamento">
	        <option selected value="<?php echo $dep; ?>"><?php echo $dep; ?></option>
			<option value="--">Eliga un Departamento</option>
            <option value="Informatica">Informatica</option>
            <option value="Contabilidad">Contabilidad</option>
            <option value="Administracion">Administracion</option>
            <option value="Logistica">Logistica</option>
            </select>
	</div>  
    <div class="fm-req">  
    <label for="sueldo">Sueldo:</label>  
    <input name="sueldo" id="sueldo" type="text" value="<?php echo $suel; ?>" />  
    </div>  
	</fieldset>  
	<div >  
    <input type="submit" value="Actualizar" /> | <input name="cancelar" value="Cancelar" type="button" onClick="Cancelar()" />
    </div>  
  <fieldset>  
</div>
    <br />  
  </form>  


</body>
</html>