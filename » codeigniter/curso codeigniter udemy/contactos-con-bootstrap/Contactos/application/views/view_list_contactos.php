<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
<h1><b>Mis Contactos</b></h1>

<br/>

<?php if (empty($listado)){ ?>
		<b>No tienes Contactos</b>
<?php 	}else{ ?>
		Usted Tiene <?php echo count($listado) ?> Contacto(s)<br/><br/>
		
		<table class="table table-bordered ">
			<tr>
				<td>Nombre del Contacto</td>
				<td>Opciones</td>
			</tr>
		<?php foreach ($listado as $contacto){ ?>
		
			<tr>
				<td><?php echo $contacto->con_nombre ?> </td>
				<td>
				<a href="<?php echo base_url() ?>index.php/contactos/editar/<?php echo  $contacto->con_id ?>" class="btn btn-warning">Editar</a>
				<a href="<?php echo base_url() ?>index.php/contactos/eliminar/<?php echo  $contacto->con_id ?>" class="btn btn-danger">Eliminar</a>
				</td>
			</tr>
		<?php } ?>
		</table>

<?php 	} ?>
<br/>
<a href="<?php echo base_url() ?>index.php/contactos/nuevo" class="btn btn-info">Nuevo Contacto</a>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
  </body>
</html>


