<?php
//recibimos el valor enviado mediante el método Post y lo guardamos en la variable $opcion2

$opcion2=$_POST['opcion_2'];
echo '<option value="0">[ Elige color ]</option>';

//hacemos un switch donde cada case corresponde al valor de cada input del select2.
switch($opcion2)

{

case "audi":

{

echo '<option value="rojo">Rojo</option>

<option value="verde">Verde</option>';

break;

}

case "chevrolet":

{

echo '<option value="azul">Azul</option>

<option value="rosa">Rosa</option>';

break;

}

case "zuzuki":

{

echo '<option value="azul">Plata</option>

<option value="rosa">Negro</option>';

break;

}

case "yamaha":

{

echo '<option value="azul">Azul</option>

<option value="rosa">Plata</option>';

break;

}
}
?>