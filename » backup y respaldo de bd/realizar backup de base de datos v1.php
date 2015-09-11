<?php
/**/
header("pragma: no-cache");
header("expires: 0");
header("content-transfer-encoding: binary");
header("content-type: application/force-download");
header("content-disposition: attachment; filename=respaldo_bd_vical.sql");
/**/
//c:\\wamp\\bin\\mysql\\mysql5.5.16\\bin\\mysql.exe -uroot --password= vical < c:\\wamp\\www\\respaldo\\respaldo_bd_vical.sql
//$ejecutar_comando = "c:\\wamp\\bin\\mysql\\mysql5.5.16\\bin\\mysqldump.exe -uroot --password= --opt vical > c:\\wamp\\www\\respaldo\\respaldo_bd_vical.sql";
$ejecutar_comando = "c:\\wamp\\bin\\mysql\\mysql5.5.16\\bin\\mysqldump.exe -uroot --password= --opt vical";
system($ejecutar_comando, $resultado);
if($resultado){echo "<h1>error ejecutando comando: $ejecutar_comando</h1>";}
else{echo "<h1>se genero el respaldo sin errores</h1>";}
?>