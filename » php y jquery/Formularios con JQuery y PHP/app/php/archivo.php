<?php
//El script lo que hara es verificar que los campos del formulario tengan datos
if($_POST["cjDato1"] != "" && $_POST["cjDato2"] != ""){ //Si los campos tienen valores
   echo "1"; //Enviamos el valor
}else if($_POST["cjDato1"] == "" && $_POST["cjDato2"] == ""){
   echo "2"; //Enviamos el valor 
}
?>
