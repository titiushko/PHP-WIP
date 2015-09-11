<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>login_view</title>
	<style type="text/css" media="screen">
		label, input{
			float:left;
			clear:both;
			margin:5px;
		}
		form{
			background-color:#5F79BF;
			border:1px solid #1F3B7F;
			color:#FFFFFF;
			margin:5px auto;
			overflow:auto;
			padding:15px;
			width:170px;
			-webkit-border-radius: 8px;
			-webkit-box-shadow: 2px 2px 3px #AAA;
		}
		
		.error{
			width: 170px;
			padding: 15px;
			-webkit-border-radius: 8px;
			-webkit-box-shadow: 2px 2px 3px #AAA;
			border:1px solid red;
			margin:15px auto;
			color:red;
			
		}
		
	</style>
	
</head>

<body>
	<form id="login" action="<?php echo base_url(); ?>user/login" method="post" accept-charset="utf-8">
		<label for="usuario">Usuario</label><input type="text" name="usuario" id="usuario" value="<?php echo set_value('usuario'); ?>" />
		<label for="password">Contraseña</label><input type="password" name="password" id="password" />
		<input type="submit" name="entrar" value="ENTRAR" id="entrar" />
	</form>
	<?php echo validation_errors('<div class="error">','</div>') ?>
	<?php if(isset($error)) echo "<div class=\"error\">$error</div>"; ?>

</body>
</html>
