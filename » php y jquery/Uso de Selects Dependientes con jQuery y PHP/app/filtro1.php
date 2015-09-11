<?php
$opcion1=$_POST['opcion_1'];

//Si lo que necesitas es realizar una consulta a tu base de datos, funciona de la misma manera, solo imprmirias el resultado de tu consulta: <option value="AQUI">AQUI</option>.
echo '<option value="0">[ Elige marca ]</option>';

//hacemos un switch donde cada case corresponde al valor de cada input del select1.
switch($opcion1)

{

case "auto":

{

echo '<option value="audi">Audi</option>

<option value="chevrolet">Chevrolet</option>';

break;

}

case "moto":

{

echo '<option value="zuzuki">Zusuki</option>

<option value="yamaha">Yamaha</option>';

break;

}

}
?>