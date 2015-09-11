<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title><?php echo $title ?></title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
		$(function(){
			$('h2 a').click(function(event){
				event.preventDefault();
				$('h2+div').remove();
				$(this).parent().after('<div></div>');
				$(this).parent().next().html('<img src="<?php echo base_url(); ?>imagenes/spinner.gif" />').load($(this).attr('href'));
			})
			
		})
	</script>
</head>

<body>

<?php
foreach ($filas as $fila) {
	echo '<h2>'.anchor('entradas/ajax_contenido/'.$fila->id, $fila->titulo).'</h2>';
}

?>

</body>
</html>
