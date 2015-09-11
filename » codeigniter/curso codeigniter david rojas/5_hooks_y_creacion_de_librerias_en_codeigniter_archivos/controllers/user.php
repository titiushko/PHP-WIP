<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	
	function login(){
		$data = array();
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim');
		$this->form_validation->set_rules('password', 'Contraseña', 'required|trim');
		
			if($this->form_validation->run()==FALSE){
				$this->load->view('login_view', $data);
			}else{
				$respuesta = $this->basicauth->login($this->input->post('usuario'), $this->input->post('password'));
				if(!isset($respuesta['error'])){
					redirect('home');
				}else{
					$data['error'] = $respuesta['error'];
					$this->load->view('login_view', $data);
				}
			}
		
	}
	
	function logout(){
		$this->basicauth->logout();
		redirect('user/login');
	}

}