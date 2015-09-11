<?php
$db = 'vical';
$nombre_backup = date("d-m-Y") . "-" . $db . ".sql";

// CABECERAS PARA DESCARGAR EL ARCHIVO
header( "Content-type: application/savingfile" );
header( "Content-Disposition: attachment; filename=$nombre_backup" );
header( "Content-Description: Document." );

// CONEXION A LA DB
$conexion = mysql_connect("localhost", "root", ""); 

// RECUPERO LAS TABLAS
$tablas = mysql_list_tables($db);
if (!$tablas) {
    echo "Error en la base de datos: no se pueden listar las tablas \n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

// RECORRO TODAS LAS TABLAS
while ($tabla = mysql_fetch_row($tablas)) {
	
    // RECUPERO LA INFORMACION DE CREACION DE LA TABLA
    $creacion = mysql_fetch_array(mysql_query("SHOW CREATE TABLE $tabla[0]"));
    echo "-- Informacion de creacion de la tabla $tabla[0]\n\n";
    echo $creacion['Create Table']."\n\n";
	
    // VUELCO LOS REGISTROS DE LA TABLA
    echo "-- Volcado de registros en la tabla $tabla[0]\n\n";
	
    // RECUPERO LOS NOMBRES DE LOS CAMPOS
    $columnas_txt = "";
    $columnas = mysql_query("SHOW COLUMNS FROM $tabla[0]");
    $cantidad_columnas = mysql_num_rows($columnas);
    if (mysql_num_rows($columnas) > 0) {
        while ($columna = mysql_fetch_assoc($columnas)) {
            $columnas_txt .= $columna['Field'] . ", ";
        }
    }
    $columnas = substr($columnas_txt, 0, -2);
    echo "INSERT INTO $tabla[0] ($columnas) VALUES\n";
	
    $registros_txt = "";
    $registros = mysql_query("SELECT * FROM $tabla[0]");
    while ($registro = mysql_fetch_array($registros)) {
        $i = 0;
        $registro_txt = "";
        while ($i < $cantidad_columnas) {
            $registro_txt .= "'$registro[$i]', ";
            $i++;
        }
        $registros_txt .= "(".substr($registro_txt, 0, -2)."),\n";
    }
    echo substr($registros_txt, 0, -2).";\n\n\n";
} 
?>