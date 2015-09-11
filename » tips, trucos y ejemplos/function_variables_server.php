<?php
function variables_server(){
	$indices_servidor = array('PHP_SELF', 'argv', 'argc', 'GATEWAY_INTERFACE', 'SERVER_ADDR', 'SERVER_NAME', 'SERVER_SOFTWARE', 'SERVER_PROTOCOL', 'REQUEST_METHOD', 'REQUEST_TIME', 'REQUEST_TIME_FLOAT', 'QUERY_STRING', 'DOCUMENT_ROOT', 'HTTP_ACCEPT', 'HTTP_ACCEPT_CHARSET', 'HTTP_ACCEPT_ENCODING', 'HTTP_ACCEPT_LANGUAGE', 'HTTP_CONNECTION', 'HTTP_HOST', 'HTTP_REFERER', 'HTTP_USER_AGENT', 'HTTPS', 'REMOTE_ADDR', 'REMOTE_HOST', 'REMOTE_PORT', 'REMOTE_USER', 'REDIRECT_REMOTE_USER', 'SCRIPT_FILENAME', 'SERVER_ADMIN', 'SERVER_PORT', 'SERVER_SIGNATURE', 'PATH_TRANSLATED', 'SCRIPT_NAME', 'REQUEST_URI', 'PHP_AUTH_DIGEST', 'PHP_AUTH_USER', 'PHP_AUTH_PW', 'AUTH_TYPE', 'PATH_INFO', 'ORIG_PATH_INFO');
	$color = 'bgcolor="white"'; $bandera = TRUE;
	$salida = '<table border="1" style="border-collapse: collapse;">';
	$salida .= '<tr><th>\'VARIABLE\'</th><th>$_SERVER[\'VARIABLE\']</th></tr>';
	foreach($indices_servidor as $indice){
		if(isset($_SERVER[$indice])){$salida .= '<tr '.$color.'><td>'.$indice.'</td><td>'.$_SERVER[$indice].'</td></tr>';}
		else{$salida .= '<tr'.$color.'><td>'.$indice.'</td><td>-</td></tr>';}
		if($bandera){$color = 'bgcolor="gray"'; $bandera = FALSE;} else{$color = 'bgcolor="white"'; $bandera = TRUE;}
	}
	$salida .= '</table>';
	return $salida;
}
?>