<?php
include "../ayudadores/abrir_conexion.php";
include "../ayudadores/utilidades.php";

// Select all the rows in the markers table
$result = $conexion->query("SELECT * FROM markers WHERE 1") or die ("Fallo la consulta!!".$conexion->error);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = $result->fetch_object()){
    // Add to XML document node
    echo '<marker ';
    echo 'name = "' . parseToXML($row->name) . '" ';
    echo 'address = "' . parseToXML($row->address) . '" ';
    echo 'lat = "' . $row->lat . '" ';
    echo 'lng = "' . $row->lng . '" ';
    echo 'type = "' . $row->type . '" ';
    echo '/>';
}

// End XML file
echo '</markers>';

include "../ayudadores/cerrar_conexion.php";
?>
