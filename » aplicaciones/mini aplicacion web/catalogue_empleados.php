<?php
//Paginacion de Resultado Catalogo Empleados.
require('conexion.php');
$RegistrosAMostrar=9;

//estos valores los recibo por GET
if(isset($_POST['pag'])){
	$RegistrosAEmpezar=($_POST['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_POST['pag'];
	//caso contrario los iniciamos
}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
}
?>
<LINK href="style/stilo.css" type=text/css rel=StyleSheet>
<div id="barra1">
	<div class="c_catalogo" >
		Catalogo Empleados
	</div>
</div>
<div id="agregar" style="background:url(images/nav2_bg.gif);color:#000000">
	<div>
		<a style=\"text-decoration:underline;cursor:pointer;\" onclick="pedirDatos1()">
			<font color="#000000">
				<strong>
					Agregar Empleado
				</strong>
			</font>
		</a>
	</div>
</div>
<div id="barra" style="color:#FFFFFF;background-color:#2ea3d0;font-size:10px; font-family:Arial">
	<div class="c_nombre" style="color:#FFFFFF">
		<div align="center">
			Nombre
		</div>
	</div>
	<div class="c_departamento" style="color:#FFFFFF">
		<div align="center">
			Departamento
		</div>
	</div>
	<div class="c_sueldo" style="color:#FFFFFF">
		<div align="center">
			Sueldo
		</div>
	</div>
	<div class="c_opciones" style="color:#FFFFFF">
		<div align="center">
			Opciones
		</div>
	</div>
</div>
<div id="barra">	
	<?php
	$Resultado=mysql_query("SELECT idempleado,nombres,departamento,sueldo FROM empleados ORDER BY nombres LIMIT $RegistrosAEmpezar, $RegistrosAMostrar",$con);
	while($rs = mysql_fetch_array($Resultado))
	{
	?>
	<div class="c_nombre" >
		<div align="center" style="background:url(images/nav2_bg.gif);">
			<?php echo $rs["nombres"];?>
		</div>
	</div>
	<div class="c_departamento" style="background:url(images/nav2_bg.gif);">
		<div align="center">
			<?php echo $rs["departamento"];?>
		</div>
	</div>
	<div class="c_sueldo" style="background:url(images/nav2_bg.gif);">
		<div align="center">
			<?php echo $rs["sueldo"];?>
		</div>
	</div>
	<div class="c_opciones" style="background:url(images/nav2_bg.gif);">
		<div align="center">
			<a style="text-decoration:underline;cursor:pointer;" onclick="pedirDatos('<?php echo $rs["idempleado"]; ?>')">
				<img src='modificar.gif' alt='Modificar Empleados' width='19' height='20' hspace='0' vspace='0' border='0'>
			</a> | 
			<a style="text-decoration:underline;cursor:pointer;" onclick="eliminarDato('<?php echo $rs["idempleado"]; ?>')">
				<img src='eliminar.gif' alt='Eliminar Empleados' width='19' height='20' hspace='0' vspace='0' border='0'>
			</a>
		</div>
	</div>
	<?php 
	}
	?>
	<div id="barra"  style="background:url(images/nav2_bg.gif);">
		<div align="center"><?php 
			$NroRegistros=mysql_num_rows(mysql_query("SELECT idempleado,nombres,departamento,sueldo FROM empleados",$con));

			$PagAnt=$PagAct-1;
			$PagSig=$PagAct+1;
			$PagUlt=$NroRegistros/$RegistrosAMostrar;

			//verificamos residuo para ver si llevará decimales
			$Res=$NroRegistros%$RegistrosAMostrar;
			// si hay residuo usamos funcion floor para que me
			// devuelva la parte entera, SIN REDONDEAR, y le sumamos
			// una unidad para obtener la ultima pagina
			if($Res>0) $PagUlt=floor($PagUlt)+1;

			//desplazamiento
			echo "<a onclick=\"Pagina('1')\">Primero</a> ";
			if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\">Anterior</a> ";
				echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
			if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\">Siguiente</a> ";
				echo "<a onclick=\"Pagina('$PagUlt')\">Ultimo</a>";
			?>
		</div>
	</div>
</div>