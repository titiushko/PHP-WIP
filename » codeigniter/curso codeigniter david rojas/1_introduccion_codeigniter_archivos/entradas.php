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
	}
	
	function index(){
		$data['filas'] = $this->entradas_model->obtener_todos();
		$data['title'] = 'Listado de entradas';
		
		$this->load->view('entradas_view', $data);
	}
	
}
