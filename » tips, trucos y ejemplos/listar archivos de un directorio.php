<?php
echo "<h1>Primera Forma</h1>";
$dir = "c:\\wamp\\www\\SCyCPVES\\instalador\\";
$directorio=opendir($dir); 
//$directorio=opendir($dir); 
echo "<b>Directorio actual:</b><br>$dir<br>"; 
echo "<b>Archivos:</b><br>"; 
while ($archivo = readdir($directorio))
  echo "$archivo<br>"; 
closedir($directorio); 
////////////////////////////////////////////////////////////////
echo "<h1>Segunda Forma</h1>";
$dir = "c:\\wamp\\www\\SCyCPVES\\instalador\\";
//$dir = (isset($_GET['dir']))?$_GET['dir']:"/";
$directorio=opendir($dir); 
echo "<b>Directorio actual:</b><br>$dir<br>"; 
echo "<b>Archivos:</b><br>"; 
while ($archivo = readdir($directorio)) { 
  if($archivo == '.')
    echo "<a href=\"?dir=.\">$archivo</a><br>"; 
  elseif($archivo == '..'){ 
    if($dir != '.'){
      $carpetas = split("/",$dir); 
      array_pop($carpetas); 
      $dir2 = join("/",$carpetas); 
      echo "<a href=\"?dir=$dir2\">$archivo</a><br>"; 
    } 
  }
  elseif(is_dir("$dir/$archivo"))
    echo "<a href=\"?dir=$dir/$archivo\">$archivo</a><br>"; 
  else echo "$archivo<br>"; 
} 
closedir($directorio);
////////////////////////////////////////////////////////////////
echo "<h1>Tercera Forma</h1>";
$dir = "c:\\wamp\\www\\SCyCPVES\\instalador\\";
$directorio=opendir($dir); 
//$directorio=opendir($dir); 
echo "<b>Directorio actual:</b><br>$dir<br>"; 
echo "<b>Archivos:</b><br>";
date_default_timezone_set('America/El_Salvador');
$i = 1;
while ($archivo = readdir($directorio)){
	if($archivo != '.' && $archivo != '..' ){
		echo "$archivo<br>";
		$archivos[$i] = $archivo;
		$i++;
	}	
}
closedir($directorio); 
////////////////////////////////////////////////////////////////
echo "<h1>Mostrar Vector con la Lista de Archivos</h1>";
for($j=1;$j<$i;$j++){
	echo "$archivos[$j] - ".date("d/m/Y G:i:s",filemtime($dir.$archivos[$j]))."<br>";
}
?>