<?php
include("mysql_inc.php");
$mysql = new MySql_Class;
$mysql->user="root";
$mysql->password="root";
$mysql->db="poblaciones";
$mysql->server="localhost";
$mysql->conection();
?>
<script src="js/jquery.js"></script>
<script>
$(document).ready(function(){
	$("select").change(function(){
		// Vector para saber cuál es el siguiente combo a llenar
		var combos = new Array();
		combos['pais'] = "estado";
		combos['estado'] = "ciudad";
		// Tomo el nombre del combo al que se le a dado el clic por ejemplo: país
		posicion = $(this).attr("name");
		// Tomo el valor de la opción seleccionada
		valor = $(this).val()
		// Evaluó  que si es país y el valor es 0, vacié los combos de estado y ciudad
		if(posicion == 'pais' && valor==0){
			$("#estado").html('	<option value="0" selected="selected">----------------</option>')
			$("#ciudad").html('	<option value="0" selected="selected">----------------</option>')
		}else{
		/* En caso contrario agregado el letreo de cargando a el combo siguiente
		Ejemplo: Si seleccione país voy a tener que el siguiente según mi vector combos es: estado  por qué  combos [país] = estado
			*/
			$("#"+combos[posicion]).html('<option selected="selected" value="0">Cargando...</option>')
			/* Verificamos si el valor seleccionado es diferente de 0 y si el combo es diferente de ciudad, esto porque no tendría caso hacer la consulta a ciudad porque no existe un combo dependiente de este */
			if(valor!="0" || posicion !='ciudad'){
			// Llamamos a pagina de combos.php donde ejecuto las consultas para llenar los combos
				$.post("combos.php",{
									combo:$(this).attr("name"), // Nombre del combo
									id:$(this).val() // Valor seleccionado
									},function(data){
													$("#"+combos[posicion]).html(data);	//Tomo el resultado de pagina e inserto los datos en el combo indicado
													})
			}
		}
	})
})
</script>
<form id="form1" name="form1">
<div>
<select name="pais" id="pais">
	<option selected="selected" value="0">---------</option>
<?
$query = $mysql->query("SELECT * FROM pais");
if($query["amount"]>0){
	foreach($query["data"] as $rs){
	?>
		<option value="<?=$rs["idpais"]?>"><?=$rs["pais"]?></option>
	<?
	}
}
?>
						</select>
</div>
<div>
<select id="estado" name="estado">
	<option value="0" selected="selected">----------------</option>
</select>
</div>
<div>
<select id="ciudad" name="ciudad">
	<option value="0" selected="selected">-------------------</option>
</select>
</div>
</form>