Las fechas son uno de esos típicos asuntos que pueden hacer que nos rompamos la cabeza a la hora de programar una página. Razón de ello es que tienen distintos formatos dependiendo del país, del lenguaje de programación o de la base de datos que estemos utilizando.
Cuando utilizamos la tecnología PHP solemos trabajar con la base de datos MySQL. En estos dos sistemas los formatos de fechas cambian sensiblemente, así que será muy interesante conocer una manera rápida de pasar de un formato de fecha a otro, dependiendo de dónde vamos a utilizar esa fecha. Pues, si trabajamos con MySQL deberemos expresar la fecha de una manera distinta a la que lo haríamos a la hora de mostrarla en la página para que la entienda fácilmente un lector hispano.
En muchos casos, debemos vérnoslas entre dos tipos de formatos distintos, aunque podría ser peor. Por ejemplo, si la página estuviese en varios idiomas, sería importante escribir correctamente las fechas en cada uno de los idiomas.
Dejando temas relacionados con el idioma aparte -concentrándonos tan sólo en el Español-, en nuestras páginas programadas en PHP y con base de datos MySQL, tendremos que trabajar con dos formatos. Por un lado tenemos las fechas en castellano, que tienen el formato dd/mm/aaaa y por otro lado tenemos el formato de MySQL, que tiene la sintaxis aaaa-mm-dd.
Lo más cómodo, tal como vemos nosotros este problema, es crear un par de funciones que conviertan las fechas de un formato a otro. Habrá una función que convertirá la fecha de MySQL a Castellano y otra que lo convierta de Castellano a MySQL.
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
Las funciones utilizan expresiones regulares que no hemos visto todavía, así que no vamos a tratar de explicar cómo funcionan, sino que explicaremos cómo utilizarlas.
Mostrar en la página una fecha en castellano
Si tenemos una fecha en formato MySQL y deseamos colocarla en una página haremos algo como sigue.
Suponemos que la fecha está extrayéndose a través de una consulta a la base de datos y la tenemos en una variable llamada $fila->fecha. Además, colocamos la fecha en un campo de formulario.
<input type="text" name="fecha" value="<?echo cambiaf_a_normal($fila->fecha);?>">
Colocar en la base de datos una fecha en formato MySQL
Cuando el usuario nos manda una fecha, por ejemplo, a través de un formulario con un campo como el que acabamos de ver, lógicamente, escribirá la fecha en castellano. Pero nosotros deseamos guardarla en una base de datos en un formato distinto, así que habremos de convertirla.
Suponemos que tenemos la fecha en una variable llamada $fecha y que está en formato castellano. Además, queremos colocarla en una sentencia SQL que deseamos ejecutar en la base de datos para insertar un registro que contiene, entre otros datos, la fecha que el usuario ha escrito.
mysql_query ("insert into documento (titulo_documento, fecha_documento, cuerpo_documento) values ('$titulo_documento', '" . cambiaf_a_mysql($fecha) . "', '$cuerpo_documento')"); 