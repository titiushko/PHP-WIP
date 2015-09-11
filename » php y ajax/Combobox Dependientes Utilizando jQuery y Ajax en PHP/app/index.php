<?php
$conexion = mysql_connect("localhost","root","") or die ("No se puede conectar con el servidor!!".mysql_error());
$abrebase = mysql_select_db("combobox_dependientes",$conexion) or die ("No se puede seleccionar la base de datos!!".mysql_error());
set_time_limit(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<title>Combobox Dependientes Utilizando jQuery y Ajax en PHP</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script src="jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript"> 
		$(document).ready(function(){
			$('#loader').hide();
			$('#show_heading').hide();
			$('#search_category_id').change(function(){
				$('#show_sub_categories').fadeOut();
				$('#loader').show();
				$.post("get_chid_categories.php", {
					parent_id: $('#search_category_id').val(),
				}, function(response){
					setTimeout("finishAjax('show_sub_categories', '"+escape(response)+"')", 400);
				});
				return false;
			});
		});
		function finishAjax(id, response){
			$('#loader').hide();
			$('#show_heading').show();
			$('#'+id).html(unescape(response));
			$('#'+id).fadeIn();
		} 
		function alert_id(){
			if($('#sub_category_id').val() == '')
			alert('Please select a sub category.');
			else
			alert($('#sub_category_id').val());
			return false;
		}
		</script>		
	</head>
	<body>
		<div class="both">
			<h4>Select Category</h4>
			<select name="search_category"  id="search_category_id">
				<option value="" selected="selected"></option>
				<?php
				$query = "select * from ajax_categories where pid = '1'";
				$results = mysql_query( $query);
				while ($rows = mysql_fetch_assoc($results)){
					echo "<option value='".$rows['id']."'>".$rows['category']."</option>";
				}
				echo "</select>	";
				?>		
		</div>
		<div class="both">
			<h4 id="show_heading">Select Sub Category</h4>
			<div id="show_sub_categories" align="center">
				<img src="loader.gif" style="margin-top:8px; float:left" id="loader" alt="" />
			</div>
		</div>
	</body>
</html>
<? mysql_close($conexion); ?>