<!DOCTYPE HTML>
<html>
	<head>
		<title>Control.Tabs</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		<link rel="stylesheet" 			 href="tabs.css" type="text/css"></link>
		<script type="text/javascript" 	 src="tabs.js"></script>
		<script>
			document.observe('dom:loaded',function(){
				new Control.Tabs('criterios');
			});
		</script>
		</head>
		<body>
			<div id="main">
				<ul id="criterios" class="subsection_tabs">
					<li class="tab"><a class="" href="#periodo">Por Periodo</a></li>
					<li class="tab"><a class="active" href="#tipo">Por Tipo de Vidrio</a></li>
					<li class="tab"><a class="active" href="#proveedor">Por Proveedor</a></li>
				</ul>
				<div style="display: none;" id="periodo">
					<span class="titulo1">Mes:</span>
					<select name="seleccionar_mes" size="1">
						<option selected>-----opciones-----</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
					<span class="titulo1">&nbsp;&nbsp;A&ntilde;o:</span>
					<select name="seleccionar_ano" size="1">
						<option selected>-----opciones-----</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</div>
				<div style="display: none;" id="tipo">
					<span class="titulo1">Tipo Vidrio:</span>
					<select name="seleccionar_tipo" size="1">
						<option selected>-----opciones-----</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</div>
				<div style="display: none;" id="proveedor">
					<span class="titulo1">Proveedor:</span>
					<select name="seleccionar_proveedor" size="1">
						<option selected>--------------proveedores--------------</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</div>
			</div>
	</body>
</html>