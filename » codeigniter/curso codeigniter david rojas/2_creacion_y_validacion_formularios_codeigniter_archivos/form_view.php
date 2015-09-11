<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>form_view</title>
	<style type="text/css" media="screen">
		label,input{
			display:block;
			padding:5px;
		}
		div.error{
			background-color:#FF8F8F;
			border: 1px solid #FF1111;
			margin-bottom:5px;
			padding:5px;
			width:400px;
		}
	</style>
</head>

<body>
<?php echo validation_errors('<div class="error">','</div>') ?>
<?php echo form_open('formulario') ?>
<?php echo form_label('Nombre: ', 'nombre') ?>
<?php echo form_input(array('name' => 'nombre', 'id' => 'nombre', 'size' => '50', 'value' => set_value('nombre'))) ?>
<?php echo form_label('Email:', 'email'); ?>
<?php echo form_input(array('name' => 'email', 'id' => 'email', 'size' => '50', 'value' => set_value('email'))); ?>
<?php echo form_label('Contraseña:', 'password'); ?>
<?php echo form_password(array('name' => 'password', 'id' => 'password', 'size' => '50')); ?>
<?php echo form_label('Reescribe la contraseña:', 'repassword'); ?>
<?php echo form_password(array('name' => 'repassword', 'id' => 'repassword', 'size' => '50')); ?>
<?php echo form_submit('enviar', 'Enviar') ?>
<?php echo form_close() ?>
</body>
</html>
