<?php

/**
* 
*/
class Formulario extends Controller
{
	
	function __construct()
	{
		parent::Controller();
		$this->load->helper(array('url', 'form'));
		$this->load->library('form_validation');
	}
	
	function index(){
		$this->form_validation->set_rules('nombre', 'nombre', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('email', 'correo electrónico', 'required|valid_email|trim');
		$this->form_validation->set_rules('password', 'contraseña', 'required|trim|md5');
		$this->form_validation->set_rules('repassword', 'reescribir contraseña', 'required|matches[password]|trim|md5');
		
		$this->form_validation->set_message('required', 'Debe introducir el campo %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');
		$this->form_validation->set_message('valid_email', 'Debe escribir una dirección de email correcta');
		$this->form_validation->set_message('matches', 'Los campos %s y %s no coinciden');
		
		if($this->form_validation->run()==FALSE){
			$this->load->view('form_view');	
		}else{
			$data['nombre'] = $this->input->post('nombre');
			$data['password'] = $this->input->post('password');
			$this->load->view('exito_view', $data);
			
		}
		
	}
}

?>