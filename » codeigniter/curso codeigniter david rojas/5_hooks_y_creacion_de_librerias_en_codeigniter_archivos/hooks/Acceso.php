<?php
/**
* 
*/
class Acceso
{
	
	function identificado(){
		$this->CI =&get_instance();
		$controllersprivados = array('user', 'home');
		
		if($this->CI->session->userdata('logged_in')==true && $this->CI->router->method == 'login') redirect('home');
		
		if($this->CI->session->userdata('logged_in')!=true && $this->CI->router->method!='login' && in_array($this->CI->router->class, $controllersprivados)) redirect('user/login');
	}
}

?>