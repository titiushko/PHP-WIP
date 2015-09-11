<?php

     if ($conex = mysql_connect ("localhost","root","123456")){

        if ($abro = mysql_select_db ("Foro")){
        $modificar = "UPDATE TEMAS SET Hijos=Hijos+1 WHERE ID=$padre";
        $insertar = "INSERT INTO TEMAS (Autor,Email,Fecha,Mensaje,Padre) VALUES ('$autor','$correo','$fecha','$mensaje','$padre')";
        }else{
            print ("no se pudo abrir la base de datos foro");
            exit;
        }
            $resultado= mysql_query($modificar);
            if  ($result = mysql_query ($insertar)) {
                      header("location: index.php");
            }else{
                    print ("no se pudo grabar los datos");
                    exit;
                    }

        } else {

        print ("No se puede conectar. Intente nuevamente");
        }

?>

