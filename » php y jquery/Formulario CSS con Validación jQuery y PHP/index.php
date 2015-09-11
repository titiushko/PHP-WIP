<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario css y xhtml con validacion php mediante ajax</title>
<link href="estilos/estilos.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="includes/js/jquery-1.2.6.js"></script>
<script language="javascript" type="text/javascript" src="includes/js/jquery.form.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('#formulario').ajaxForm({ 
		beforeSubmit: validate,
		success: hecho
	});
});

function hecho(responseText, statusText){
	$("#mensaje").html("");
	$("#mensaje").append(responseText);
	$("#mensaje").slideDown();
}

function validate(formData, jqForm, options) {
	var error = "";
    var form = jqForm[0];
    if (!form.usuario.value){
        error += "<li>Introduce el usuario</li>";
		form.usuario.focus();
	}
    if (!form.password.value){
		error += "<li>Introduce la contraseña</li>";
		if (form.usuario.value)
			form.password.focus();
	}
	
    if(error.length > 0){
		$("#mensaje").html('');
		$("#mensaje").append("<ul>" + error + "</ul>");
		$("#mensaje").slideDown();
		return false;
	}
}
</script>
</head>

<body>

<div id="bloqueLogin">
  <form id="formulario" name="formulario" method="post" action="ajax.php">
        <h1>Login de usuario</h1>
      <p>Formulario basico, validación de usuarios con php y Jquery</p>
      <div id="mensaje"></div>
    <label for="usuario">Login
            <span class="small">Introduce tu login</span>
   	</label>
        <input type="text" name="usuario" id="usuario" />
    
        <label for="password">Password
        <span class="small">Introduce tu password</span>
        </label>
      <input type="password" name="password" id="password" />
    <button type="submit">Entrar!</button>
		<input type="hidden" name="accion" id="accion" value="login"  />

	</form>
</div>

</body>
</html>
