<?php
$base="Foro";
//include ("../web/contras.php");
if ($conexion=mysql_connect ("localhost","root","")){
        echo "<h2> Conexi�n establecida con el servidor</h2><br>";
            if(mysql_create_db ("Foro")){
                echo "<h2> Base de datos $base creada con EXITO </h2><br>";
                }else{
                echo "<h2> No ha sido posible crear la base de datos</h2><br>";
                };
        if(mysql_close($conexion)){
         #   echo "<h2> Conexi�n cerrada con exito</h2><br>";
            echo "El identificador de conexion es:",$conexion;
                 }else{
            echo "<h2> No se ha cerrado la conexi�n</h2>";
             };
    }else{
        echo "<h2> NO HA SIDO POSIBLE ESTABLECER LA CONEXI�N</h2>";
}
?>
<?php
# definimos una variable con el NOMBRE DE LA BASE DE DATOS
# en la que deseamos CREAR LA TABLA

$base="Foro";

#definimos otra variable con el NOMBRE QUE QUEREMOS DAR A LA TABLA

$tabla="Mensajes";

# establecemos la conexi�n con el servidor

$conexion=mysql_connect ("localhost","root","");


#Seleccionamos la BASE DE DATOS en la que PRETENDEMOS CREAR LA TABLA

mysql_select_db ($base, $conexion);

# por pura comodidad asignamos a una variable el contenido
# de la sentencia MySQL y vamos a�adiendo cosas con la opcion ".="
# Observa que SOLO HAY COMAS, -NO LAS OLVIDES- separando los distintos CAMPOS
# pero NO cuando se trata de separar los FLAGS de un mismo campo.
#
# F�jate como se asignan los valores a los campos ENUM y SET
# observa Que los distintos valores van ENTRE COMILLAS Y SEPARADOS POR COMAS
# Fijate que en esos supuestos HE PUESTO COMILLAS SIMPLES '
# debe hacerse as� porque ESTOY UTILIZANDO " para delimitar las cadenas

# Un AVISO IMPORTANTE
# Las definiciones de los distintos campos VAN SEPARADAS POR COMAS
# pero SI PONES COMA DESPU�S DEL �LTIMO (ANTES DE CERRAR EL PARENTESIS)
# te dar� error y no te crear� LA TABLA ��Cuidadooooo...!!


$crear="CREATE TABLE MENSAJES (ID TINYINT NOT NULL AUTO_INCREMENT,
             Autor VARCHAR(30) NOT NULL,
             Mensaje TEXT,
             Padre TINYINT,
             Fecha Date,
             Primary key(ID))";

#Creamos la cadena, comprobamos si esa instrucci�n devuelve
# VERDADERO o FALSO
# y dependiendo de ellos insertamos el mensaje de exito o fracaso

if(mysql_db_query ($base,$crear ,$conexion)) {
echo "<h2> Tabla $tabla creada con EXITO </h2><br>";
    }else{
echo "<h2> La tabla $tabla NO HA PODIDO CREARSE</h2><br>";
};

# cerramos la conexi�n... y listo...
      mysql_close($conexion)
?>

<?php

# definimos una variable con el NOMBRE DE LA BASE DE DATOS
# en la que deseamos CREAR LA TABLA

$base="Foro";

#definimos otra variable con el NOMBRE QUE QUEREMOS DAR A LA TABLA

$tabla="Temas";

# establecemos la conexi�n con el servidor

$conexion=mysql_connect ("localhost","root","");


#Seleccionamos la BASE DE DATOS en la que PRETENDEMOS CREAR LA TABLA

mysql_select_db ($base, $conexion);

# por pura comodidad asignamos a una variable el contenido
# de la sentencia MySQL y vamos a�adiendo cosas con la opcion ".="
# Observa que SOLO HAY COMAS, -NO LAS OLVIDES- separando los distintos CAMPOS
# pero NO cuando se trata de separar los FLAGS de un mismo campo.
#
# F�jate como se asignan los valores a los campos ENUM y SET
# observa Que los distintos valores van ENTRE COMILLAS Y SEPARADOS POR COMAS
# Fijate que en esos supuestos HE PUESTO COMILLAS SIMPLES '
# debe hacerse as� porque ESTOY UTILIZANDO " para delimitar las cadenas

# Un AVISO IMPORTANTE
# Las definiciones de los distintos campos VAN SEPARADAS POR COMAS
# pero SI PONES COMA DESPU�S DEL �LTIMO (ANTES DE CERRAR EL PARENTESIS)
# te dar� error y no te crear� LA TABLA ��Cuidadooooo...!!


$crear="CREATE TABLE TEMAS (ID INT NOT NULL AUTO_INCREMENT,
             Autor VARCHAR(30) NOT NULL,
             Tema VARCHAR(30) NOT NULL,
             Hijos INT,
             Email VARCHAR(30),
             Fecha DATE,
             Mensaje TEXT,
             Padre INT,
             Primary key(ID))";

#Creamos la cadena, comprobamos si esa instrucci�n devuelve
# VERDADERO o FALSO
# y dependiendo de ellos insertamos el mensaje de exito o fracaso

if(mysql_db_query ($base,$crear ,$conexion)) {
echo "<h2> Tabla $tabla creada con EXITO </h2><br>";
    }else{
echo "<h2> La tabla $tabla NO HA PODIDO CREARSE</h2><br>";
};

# cerramos la conexi�n... y listo...
if(mysql_close($conexion)){
    echo "<h2> Conexi�n cerrada con exito</h2><br>";
}
?>