<?php
/**
* 
*/
class Entradas extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('entradas_model');
		$this->load->helper('url');
	}
	
	function index(){
		$data['filas'] = $this->entradas_model->obtener_todos();
		$data['title'] = 'Listado de entradas';
		
		$this->load->view('entradas_view', $data);
	}
	
	function ajax_contenido($id){
		sleep(1);
		$data['contenido'] = $this->entradas_model->get_contenido($id);
		$this->load->view('ajax_contenido', $data);
		
	}
	
}
