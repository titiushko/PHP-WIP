<?php
     if ($conex = mysql_connect ("localhost","root","")){

        if ($abro = mysql_select_db ("Foro")){

        $insertar = "INSERT INTO TEMAS (autor,tema,hijos,email,fecha,mensaje) VALUES ('$autor','$tema','1','$correo','$fecha','$mensaje')";
        }else{
            print ("no se pudo abrir la base de datos foro");
            exit;
        }

            if  ($result = mysql_query ($insertar)) {
                $padre=mysql_insert_id();
                $modificar = "UPDATE TEMAS SET padre=$padre WHERE id=$padre";
                $resultado=mysql_query ($modificar);
                     header("location: index.php");
            }else{
                    print ("no se pudo grabar los datos");
                    exit;
                    }

        } else {

        print ("No se puede conectar. Intente nuevamente");
        }

?>
