<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
 <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<title>Mapa de El salvador</title>
<!-- <script src="http://maps.google.com/maps?file=api&amp;v=2&oe=ISO-8859-1;&amp;key=ABQIAAAAqpbXw-BK0W2Npc5wcV1G3BTfLb1qvdVMORKk0L140J8mMNUmrRTnnYBI 7U0NhgzjIMqoOUBL7e624A"
type="text/javascript"></script> 

<script type="text/javascript">
  function load() {
  if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
		map.addControl(new GOverviewMapControl());
		map.addControl(new GScaleControl());
        map.setCenter(new GLatLng(14,-89), 9);
      } 
	  	  
  }//fin de la funcion initialize
</script>
<script src="http://countrypoints.googlecode.com/files/countrypoints.js" type="text/javascript"></script>-->
</head>
<body onload="load()" onunload="GUnload()">
	<div id="contenedor" style="width:100%; height:100%;">
	<div id="cabecera" style="background-color: #ffcc99; font-weight:bold; font-size: 110%; height: 23px; padding: 3px; margin-bottom:10px;">SISTEMA GEOGRAFICO DE EL SALVADOR DE LUGARES TURISTICOS</div>
	<div id="lateral" style="float:right; width:200px; height:100%; background-color:#E4E3E9;">
		<div id="menu" style="padding: 5px 10px 0 0px;">
			<ul>
			<li><a href="../googlemaps/index.html">Inicio</a></li>
			<li><a href="../googlemaps/sis_GeograMontana.html">Montaña</a></li>
			<li><a href="../googlemaps/sis_GeograLago.html">Lago</a></li>
			<li><a href="../googlemaps/sis_playas.html">Playas</a></li>
			<li><a href="../googlemaps/sis_GeograBalnea.html">Balnearios</a></li>
			<li><a href="../googlemaps/mantenimientoprincipal.html">Mantenimiento</a></li>
			</ul>
		</div>
	</div>
<?php
	if(isset($_POST['buscar'])){
		$tipo_buscar=$_POST['tipo_buscar'];
	}
	else{
		$tipo_buscar="";
	}
	
	require("habre_conexion.php");
//conexion
$connection=mysql_connect ($hostname, $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());} 

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
} 
////////////////////////


	?>
	<div id="formulario" style="height: 100%; margin-right:205px; background-image:url(fondotabla.png)">
    
    <form action="modificardestino.php" method="post" name="modificardestino" >
    <table width="200" border="2" cellspacing="3" cellpadding="2" align="center">
  <caption>
    DESTINOS TURISTICOS
  </caption>
  <tr>
    <th scope="col" width="150">SELECCIONA EL TIPO DE DESTINO</th>
  </tr>
   <tr>
    <td><select name="tipo_buscar">
    <option> Balneario</option>
    <option> Lago</option>
    <option selected="selected"> Montana</option>
    <option> Playas</option>
    </select></td>
  </tr>
  <tr>
  <td>
  <input name="buscar" type="submit" value="BUSCAR" />
  </td>
  </tr>
</table>

    </form>
    <br />
<?php
	$consulta_destinos = mysql_query("SELECT id,name,address,lat,lng,type FROM markers where type='$tipo_buscar'", $connection) or die ("<SPAN CLASS='error'>Fallo en consulta_destino x tipo!!</SPAN>".mysql_error());
	?>
    
<table width="553" border="2" cellspacing="3" cellpadding="2" align="center">
  <tr>
    <th width="317" scope="col">Nombre</th>
    <th width="417" scope="col">Direccion</th>
    <th width="70" scope="col">Latitud</th>
    <th width="70" scope="col">Longitud</th>
    <th width="70" scope="col">Tipo</th>
    <th width="59" scope="col">Accion1</th>
    <th width="59" scope="col">Accion2</th>
  </tr>
  <?php
  while($row2 =mysql_fetch_row($consulta_destinos)){
  ?>
  <form action="modificar_destino.php?id=<?php echo $row2[0]?>" method="post" name="form_modificar<?php echo $row2[0];?>">
  <tr>
    <td><label>
      <input  name="nombre<?php echo $row2[0];?>" type="text" id="direccion" size="30" maxlength="30" value=<?php echo $row2[1]?> />
      </label>
      </td>
    <td><label>
      <input  name="direccion<?php echo $row2[0];?>" type="text" id="direccion" size="50" maxlength="50" value=<?php echo $row2[2]?> />
      </label>
    </td>
    <td><label>
      <input  name="latitud<?php echo $row2[0];?>" type="text" id="latitud" size="10" maxlength="10" value=<?php echo $row2[3]?> />
      </label>
    </td>
    <td><label>
      <input  name="longitud<?php echo $row2[0];?>" type="text" id="longitud" size="10" maxlength="10" value=<?php echo $row2[4]?> />
      </label>
    </td>
    <td><label>
        <select name="tipo<?php echo $row2[0];?>" id="tipo">
          <option selected="selected"><?php echo $row2[5]?></option>
          <option>Balneario</option>
          <option>Lago</option>
          <option>Montana</option>
          <option>Playas</option>
</select>
      </label></td>
    <td><input name="modificar" type="submit" value="Modificar" /></td>
    <td><a href="./eliminar_destino.php?id=<?php echo $row2[0]?>"><input name="eliminar" type="button" value="Eliminar" /></a></td>
  </tr>
  </form>
  <?php
  }
  ?>
</table>



    </div>
</div>
</body>
</html>
