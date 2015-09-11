<?php	
  define("_PATH_TMP_","./tmp");
  define("_DIR_SUBIDA_", "./upload/" );
  define("_MAX_ARCHIVO_", 500000); //Deb coincidir con la variable $MAX_ARCHIVO del archivo perl (upload.cgi)
  
  if($_POST["id"]!="")
  {
    if($_POST["op"]=="info")
    {
        echo getInfo($_POST["id"]);
    }elseif($_POST["op"]=="status")
    {
      echo getStatus($_POST["id"]);
    } 
  }
  if($_GET["op"]=="copy")
  {
        if($_GET["id"]!="")
        { 
            setFile($_GET["id"]);
        }
  }
  if($_GET["op"]=="download")
  {
        if($_GET["file"]!="")
        { 
            downloadFile($_GET["file"]);        
        }
  }
  function getInfo($id)
  {
     $archivo = _PATH_TMP_."/".$id;
     $gestor = file($archivo);

	// Podemos mostrar / trabajar con todas las líneas:
	foreach ($gestor as $line)
	{
		return $line;
	}
	  return "error";
  }
  function setFile($id)
  {
    	$info = getInfo($id);
    	$arr_info = split("###",$info);
    	$name_file = $arr_info[2];
    	$path_tmp = $arr_info[0];   
      
      $na_archivo = _DIR_SUBIDA_.$name_file;
      
      $n_line = count(file($na_archivo));

      if($gestor = file($path_tmp))
      {
        $i=0;
        //Abrimos el archivo
        if($f=fopen($na_archivo,"w"))
        { 
            foreach ($gestor as $linea) //Miramos linea por linea
            {
              if($i>3)
              {
                fputs($f,$linea); 
              }
              $i++;//Recorre el número de lineas
            }
        }
      }
      echo "<a href='proceso.php?op=download&file=".$name_file."'>Descargar archivo : $name_file</a>";
  }
  function filterFile($id)
  {
    	$info = getInfo($id);
    	$arr_info = split("###",$info);
    	$name_file = $arr_info[2];
    	$path_tmp = $arr_info[0];   
      
      $na_archivo = _DIR_SUBIDA_.$name_file;
      
      $n_line = count(file($na_archivo));

      if($gestor = file($path_tmp))
      {
        $i=0;
        //Abrimos el archivo
        if($f=fopen($na_archivo,"w"))
        { 
            foreach ($gestor as $linea) //Miramos linea por linea
            {
              if($i>3)
              {
                fputs($f,$linea); 
              }
              $i++;//Recorre el número de lineas
            }
        }
      }  
  }
  function downloadFile($file)
  {
    $name =str_replace(" ","%20",$file);
    $file=str_replace(" ","%20",_DIR_SUBIDA_.$file);
    
    if(file_exists($file))
    { 
      $f_hand = $file;
      $file = file($file);
      $file2 = implode("", $file);
      if($file_handle = fopen($f_hand, "r"))
      {
          header("Content-Type: application/octet-stream");
          header("Content-Disposition: attachment; filename=".$name."\r\n\r\n");
          header("Content-Length: ".strlen($file2)."\n\n");
          while (!feof($file_handle)) {
             $line = fgets($file_handle);
                echo $line;
          }
          fclose($file_handle);
      }else{
          echo "El archivo no se abre";
      }
    }else{
      die("El archivo no existe");
    
    }
  }
  function format_size($size, $round = 0) 
  {
			//Size must be bytes!
			$sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
			
      for ($i=0; $size > 1024 && $i < count($sizes) - 1; $i++) $size /= 1024;
			return round($size,$round).$sizes[$i];
	} 
  function getStatus($id)
  {
    	$info = getInfo($id);
    	$arr_info = split("###",$info);
    	
    	$path_tmp = $arr_info[0];
    	$tam_file = $arr_info[1];
    	$name_file = $arr_info[2];
    	
      
    	$total = $tam_file;
		//Pintamos posibles errores
    	if($total > _MAX_ARCHIVO_) return format_size(_MAX_ARCHIVO_,2)."###ERROR###".format_size($total,2);
    	if($total == 0) return format_size(_MAX_ARCHIVO_,2)."###ERROR2###".format_size($total,2);
    	//Calculamos el tamaño que hay escrito
    	$cargado = filesize ($path_tmp);
    	//Sacamos el procentaje
    	$porcentaje = round($cargado / $total * 100);
    	
    	if($porcentaje==100)
    	{
          //Copiamos el archivo
          copy($path_tmp, "upload/".$name_file);
          filterFile($id);
          return $porcentaje."###".format_size($cargado,2)."###".format_size($total,2);
      	}else{
        	//Pintamos el porcentaje
        	return $porcentaje."###".format_size($cargado,2)."###".format_size($total,2);
    	}
  } 
?>
