Las fechas son uno de esos t�picos asuntos que pueden hacer que nos rompamos la cabeza a la hora de programar una p�gina. Raz�n de ello es que tienen distintos formatos dependiendo del pa�s, del lenguaje de programaci�n o de la base de datos que estemos utilizando.
Cuando utilizamos la tecnolog�a PHP solemos trabajar con la base de datos MySQL. En estos dos sistemas los formatos de fechas cambian sensiblemente, as� que ser� muy interesante conocer una manera r�pida de pasar de un formato de fecha a otro, dependiendo de d�nde vamos a utilizar esa fecha. Pues, si trabajamos con MySQL deberemos expresar la fecha de una manera distinta a la que lo har�amos a la hora de mostrarla en la p�gina para que la entienda f�cilmente un lector hispano.
En muchos casos, debemos v�rnoslas entre dos tipos de formatos distintos, aunque podr�a ser peor. Por ejemplo, si la p�gina estuviese en varios idiomas, ser�a importante escribir correctamente las fechas en cada uno de los idiomas.
Dejando temas relacionados con el idioma aparte -concentr�ndonos tan s�lo en el Espa�ol-, en nuestras p�ginas programadas en PHP y con base de datos MySQL, tendremos que trabajar con dos formatos. Por un lado tenemos las fechas en castellano, que tienen el formato dd/mm/aaaa y por otro lado tenemos el formato de MySQL, que tiene la sintaxis aaaa-mm-dd.
Lo m�s c�modo, tal como vemos nosotros este problema, es crear un par de funciones que conviertan las fechas de un formato a otro. Habr� una funci�n que convertir� la fecha de MySQL a Castellano y otra que lo convierta de Castellano a MySQL.
<?php
////////////////////////////////////////////////////
//Convierte fecha de mysql a normal
////////////////////////////////////////////////////
function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
}

////////////////////////////////////////////////////
//Convierte fecha de normal a mysql
////////////////////////////////////////////////////

function cambiaf_ a_mysql($fecha){
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha;
}
?>
Las funciones utilizan expresiones regulares que no hemos visto todav�a, as� que no vamos a tratar de explicar c�mo funcionan, sino que explicaremos c�mo utilizarlas.
Mostrar en la p�gina una fecha en castellano
Si tenemos una fecha en formato MySQL y deseamos colocarla en una p�gina haremos algo como sigue.
Suponemos que la fecha est� extray�ndose a trav�s de una consulta a la base de datos y la tenemos en una variable llamada $fila->fecha. Adem�s, colocamos la fecha en un campo de formulario.
<input type="text" name="fecha" value="<?echo cambiaf_a_normal($fila->fecha);?>">
Colocar en la base de datos una fecha en formato MySQL
Cuando el usuario nos manda una fecha, por ejemplo, a trav�s de un formulario con un campo como el que acabamos de ver, l�gicamente, escribir� la fecha en castellano. Pero nosotros deseamos guardarla en una base de datos en un formato distinto, as� que habremos de convertirla.
Suponemos que tenemos la fecha en una variable llamada $fecha y que est� en formato castellano. Adem�s, queremos colocarla en una sentencia SQL que deseamos ejecutar en la base de datos para insertar un registro que contiene, entre otros datos, la fecha que el usuario ha escrito.
mysql_query ("insert into documento (titulo_documento, fecha_documento, cuerpo_documento) values ('$titulo_documento', '" . cambiaf_a_mysql($fecha) . "', '$cuerpo_documento')"); 