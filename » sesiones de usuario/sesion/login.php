<?
session_start();
if(isset($SESSION)){
header("location:user.php"); /* Si ha iniciado la sesion, vamos a user.php */
} else { 
/* Cerramos la parte de codigo PHP porque vamos a escribir bastante HTML y nos ser� mas c�modo as� que metiendo echo's */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Identificaci&oacute;n </title>
</head>
<body>
<h1>SectorWeb.net</h1>
  <h2>Identificaci&oacute;n </h2>
<form action="comprueba.php" method="POST" class="miform">
Login: <input type="text" name="login"><br>
Password: <input type="password" name="pass"><br><br>
<input type="submit" value="Entrar" class="boton">
</form>
</body></html>
<?
} /* Y cerramos el else */ 
?>
