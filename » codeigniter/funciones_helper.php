<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('acentos')){
	/* function acentos($cadena){
		$buscar = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã*,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ*,ÃÃ³,ÃÃº,ÃÃ±,Ã",Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,ü");
		$reemplazar = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,&uuml;");
		$cadena = str_replace($buscar, $reemplazar, $cadena);
		return $cadena;
	} */
	
	/* function acentos($string){	//OK
		$string = trim($string);
		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);
		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);
		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);
		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);
		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);
		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);
		// Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("\\", "¨", "º", "-", "~",
			"#", "@", "|", "!", "\"",
			"·", "$", "%", "&", "/",
			"(", ")", "?", "'", "¡",
			"¿", "[", "^", "`", "]",
			"+", "}", "{", "¨", "´",
			">", "< ", ";", ",", ":",
			"."),	// , " "
			'',
			$string
		);
		return $string;
	} */
	
	/* function acentos($cadena){
		$no_permitidas = array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã"","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas = array ("a","e","i","o","u","A","E","I","O","U","&ntilde;","&Ntilde;","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		$texto = str_replace($no_permitidas, $permitidas ,$cadena);
		return $texto;
	} */
	
	/* function acentos($cadena){
		$cade = utf8_decode($cadena);
		$no_permitidas = array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹","Ñ","à","è","ì","ò","ù");
		$permitidas = array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","N","a","e","i","o","u");
		$texto = str_replace($no_permitidas, $permitidas ,$cade);
		return $texto;
	} */
	
	/* function acentos($cadena){	//OK
		$cadena = trim($cadena);
		$cadena = str_replace(
				array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$cadena
		);
		$cadena = str_replace(
				array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$cadena
		);
		$cadena = str_replace(
				array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$cadena
		);
		$cadena = str_replace(
				array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$cadena
		);
		$cadena = str_replace(
				array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$cadena
		);
		$cadena = str_replace(
				array('ñ', 'Ñ', 'ç', 'Ç'),
				array('n', 'N', 'c', 'C'),
				$cadena
		);
		// $cadena = str_replace(' ', '_', $cadena);
		$cadena = str_replace('&', 'y', $cadena);
		$cadena = str_replace(
				array("\\", "¨", "º", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ":"),
				'',
				$cadena
		);
		return $cadena;
	} */
	
	/* function acentos($incoming_string){
		$tofind = "ÀÁÂÄÅàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
		$replac = "AAAAAaaaaOOOOooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
		return utf8_encode(strtr(utf8_decode($incoming_string), utf8_decode($tofind),$replac));
	} */
	
	/* function acentos($String){
		$String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
		$String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
		$String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
		$String = str_replace(array('í','ì','î','ï'),"i",$String);
		$String = str_replace(array('é','è','ê','ë'),"e",$String);
		$String = str_replace(array('É','È','Ê','Ë'),"E",$String);
		$String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
		$String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
		$String = str_replace(array('ú','ù','û','ü'),"u",$String);
		$String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
		$String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
		$String = str_replace("ç","c",$String);
		$String = str_replace("Ç","C",$String);
		$String = str_replace("ñ","n",$String);
		$String = str_replace("Ñ","N",$String);
		$String = str_replace("Ý","Y",$String);
		$String = str_replace("ý","y",$String);
		$String = str_replace("&aacute;","a",$String);
		$String = str_replace("&Aacute;","A",$String);
		$String = str_replace("&eacute;","e",$String);
		$String = str_replace("&Eacute;","E",$String);
		$String = str_replace("&iacute;","i",$String);
		$String = str_replace("&Iacute;","I",$String);
		$String = str_replace("&oacute;","o",$String);
		$String = str_replace("&Oacute;","O",$String);
		$String = str_replace("&uacute;","u",$String);
		$String = str_replace("&Uacute;","U",$String);
		return $String;
	} */
	
	/* function acentos($cadena){
		$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
		$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
		$cadena = utf8_decode($cadena);
		$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
		$cadena = strtolower($cadena);
		return utf8_encode($cadena);
	} */
	
	/* function acentos($Cadena){
		$Cadena = str_replace('á','&aacute;',$Cadena);
		$Cadena = str_replace('é','&eacute;',$Cadena);
		$Cadena = str_replace('í','&iacute;',$Cadena);
		$Cadena = str_replace('ó','&oacute;',$Cadena);
		$Cadena = str_replace('ú','&uacute;',$Cadena);
		$Cadena = str_replace('Á','&Aacute;',$Cadena);
		$Cadena = str_replace('É','&Eacute;',$Cadena);
		$Cadena = str_replace('Í','&Iacute;',$Cadena);
		$Cadena = str_replace('Ó','&Oacute;',$Cadena);
		$Cadena = str_replace('Ú','&Uacute;',$Cadena);
		$Cadena = str_replace('ñ','&ntilde;',$Cadena);
		$Cadena = str_replace('Ñ','&Ntilde;',$Cadena);
		$Cadena = str_replace('ä','&auml;',$Cadena);
		$Cadena = str_replace('ë','&euml;',$Cadena);
		$Cadena = str_replace('ï','&iuml;',$Cadena);
		$Cadena = str_replace('ö','&ouml;',$Cadena);
		$Cadena = str_replace('ü','&uuml;',$Cadena);
		$Cadena = str_replace('Ä','&Auml;',$Cadena);
		$Cadena = str_replace('Ë','&Euml;',$Cadena);
		$Cadena = str_replace('Ï','&Iuml;',$Cadena);
		$Cadena = str_replace('Ö','&Ouml;',$Cadena);
		$Cadena = str_replace('Ü','&Uuml;',$Cadena);
		$Cadena = str_replace('²','&sup2;',$Cadena);
		$Cadena = str_replace('ñ','&ntilde;',$Cadena);
		$Cadena = str_replace('Ñ','&Ntilde;',$Cadena);
		return $Cadena;
	} */
	
	function acentos($String){
		$String = str_replace("[äáàâãª]","a",$String);
		$String = str_replace("[ÁÀÂÃÄ]","A",$String);
		$String = str_replace("[ÍÌÎÏ]","I",$String);
		$String = str_replace("[íìîï]","i",$String);
		$String = str_replace("[éèêë]","e",$String);
		$String = str_replace("[ÉÈÊË]","E",$String);
		$String = str_replace("[óòôõöº]","o",$String);
		$String = str_replace("[ÓÒÔÕÖ]","O",$String);
		$String = str_replace("[úùûü]","u",$String);
		$String = str_replace("[ÚÙÛÜ]","U",$String);
		$String = str_replace("[^´`¨~]","",$String);
		$String = str_replace("ç","c",$String);
		$String = str_replace("Ç","C",$String);
		$String = str_replace("ñ","n",$String);
		$String = str_replace("Ñ","N",$String);
		$String = str_replace("Ý","Y",$String);
		$String = str_replace("ý","y",$String);
		return $String;
		return $String;
	}
}

/* End of file acentos_helper.php */
/* Location: ./application/helpers/acentos_helper.php */