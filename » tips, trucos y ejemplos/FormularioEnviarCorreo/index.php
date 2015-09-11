<?php
    require('conexion.php'); 
 
    if(isset($_POST['boton'])){
        if($_POST['nombre'] == ''){
            $error1 = '<span class="error">Ingrese su nombre</span>';
        }else if($_POST['email'] == '' or !preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$_POST['email'])){
            $error2 = '<span class="error">Ingrese un email correcto</span>';
        }else if($_POST['asunto'] == ''){
            $error3 = '<span class="error">Ingrese un asunto</span>';
        }else if($_POST['mensaje'] == ''){
            $error4 = '<span class="error">Ingrese un mensaje</span>';
        }else{
            $dest = "tu@email.com"; //Email de destino
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $asunto = $_POST['asunto']; //Asunto
            $cuerpo = $_POST['mensaje']; //Cuerpo del mensaje
            //Cabeceras del correo
            $headers = "From: $nombre <$email>\r\n"; //Quien envia?
            $headers .= "X-Mailer: PHP5\n";
            $headers .= 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //
 
            if(mail($dest,$asunto,$cuerpo,$headers)){
 
                foreach($_POST AS $key => $value) {
                    $_POST[$key] = mysql_real_escape_string($value);
                } 
 
                $sql = "INSERT INTO `cf` (`nombre`,`email`,`asunto`,`mensaje`) VALUES ('{$_POST['nombre']}','{$_POST['email']}','{$_POST['asunto']}','{$_POST['mensaje']}')";
                mysql_query($sql) or die(mysql_error()); 
 
                $result = '<div class="result_ok">Email enviado correctamente <img src="http://web.tursos.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> </div>';
                // si el envio fue exitoso reseteamos lo que el usuario escribio:
                $_POST['nombre'] = '';
                $_POST['email'] = '';
                $_POST['asunto'] = '';
                $_POST['mensaje'] = '';
 
            }else{
                $result = '<div class="result_fail">Hubo un error al enviar el mensaje <img src="http://web.tursos.com/wp-includes/images/smilies/icon_sad.gif" alt=":(" class="wp-smiley"> </div>';
            }
        }
    }
?>
<html>
    <head>
        <title>Contacto</title>
        <link rel='stylesheet' href='estilos.css'>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'></script>
        <script src='funciones.js'></script>
    </head>
    <body>
        <form class='contacto' method='POST' action=''>
            <div><label>Tu Nombre:</label><input type='text' class='nombre' name='nombre' value='<?php if(isset($_POST['nombre'])){ echo $_POST['nombre']; } ?>'><?php if(isset($errors)){ echo $errors[1]; } ?></div>
            <div><label>Tu Email:</label><input type='text' class='email' name='email' value='<?php if(isset($_POST['email'])){ $_POST['email']; } ?>'><?php if(isset($errors)){ echo $errors[2]; } ?></div>
            <div><label>Asunto:</label><input type='text' class='asunto' name='asunto' value='<?php if(isset($_POST['asunto'])){ $_POST['asunto']; } ?>'><?php if(isset($errors)){ echo $errors[3]; } ?></div>
            <div><label>Mensaje:</label><textarea rows='6' class='mensaje' name='mensaje'><?php if(isset($_POST['mensaje'])){ $_POST['mensaje']; } ?></textarea><?php if(isset($errors)){ echo $errors[4]; } ?></div>
            <div><input type='submit' value='Envia Mensaje' class='boton' name='boton'></div>
            <?php if(isset($result)) { echo $result; } ?>
        </form>
    </body>
</html>