<h1><b>Mis Contactos</b></h1>

<br/>

<?php if (empty($listado)){ ?>
		<b>No tienes Contactos</b>
<?php 	}else{ ?>
		Usted Tiene <?php echo count($listado) ?> Contacto(s)<br/><br/>
		
		<?php foreach ($listado as $contacto){ ?>
			<?php echo $contacto->con_nombre ?> 
			<a href="<?php echo base_url() ?>index.php/contactos/editar/<?php echo  $contacto->con_id ?>">Editar</a>
			- <a href="<?php echo base_url() ?>index.php/contactos/eliminar/<?php echo  $contacto->con_id ?>">Eliminar</a>
			<br/>
		<?php } ?>

<?php 	} ?>
<br/>
<a href="<?php echo base_url() ?>index.php/contactos/nuevo">Nuevo Contacto</a>


