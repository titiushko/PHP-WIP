<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactos extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('M_contactos');
    }
	
	
	public function index()
	{

		$data['listado'] = $this->M_contactos->get_todos();
		$this->load->view('view_list_contactos',$data);
	}
	
	function mis_reglas(){
			$this->form_validation->set_rules('con_email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('con_nombre','Nombre','trim|required|min_length[6]');
			$this->form_validation->set_rules('con_edad','Edad','trim|required|integer');
			
			$this->form_validation->set_rules('con_telefono','Telefono','trim');
			$this->form_validation->set_rules('con_status','Status','trim');
			
			$this->form_validation->set_message('required','El Campo: %s, Es Obligatorio');
			$this->form_validation->set_message('valid_email','El Campo: %s, Debe Ser un Email Valido');
			$this->form_validation->set_message('min_length','El Campo: %s, Debe tener al Menos %s Caracteres');
			$this->form_validation->set_message('integer','El Campo: %s, Debe ser un Numero Entero');
	}
	
	public function nuevo(){
		
		if ($this->input->post()) {
				
				$this->mis_reglas();

			if ($this->form_validation->run() == TRUE){
				$datos_insert = $this->input->post();
				unset($datos_insert['btn_guardar']);
				
				$id_insertado = $this->M_contactos->add($datos_insert);
				echo "El ID Insertado Fue: ".$id_insertado;
			}else{
				$this->load->view('view_form_contacto');
			}
			
			
		}else{
			$this->load->view('view_form_contacto');
		}
		
	}
	
	public function editar($id = NULL){
		
		if ($id == NULL OR !is_numeric($id)){
			echo 'NO SELECCIONO ID o NO ES NUMERICO';
			return;
		}
		
		
		if ($this->input->post()) {
			
			$this->mis_reglas();
				
			if ($this->form_validation->run() == TRUE){
				$datos_update = $this->input->post();
				unset($datos_update['btn_guardar']);
				
				$id_insertado = $this->M_contactos->edit($datos_update,$id);
				redirect('contactos');
			}else{
				$this->load->view('view_form_contacto');
			}
			
		}else{
			$data['datos_contacto'] = $this->M_contactos->get_por_id($id);
			if (empty($data['datos_contacto'])){
				echo 'ID Invalido';
			}else{
				$this->load->view('view_form_contacto',$data);
			}
		}
		
	}
	
	public function eliminar($id = NULL){
		
		if ($id == NULL OR !is_numeric($id)){
			echo 'NO SELECCIONO ID o NO ES NUMERICO';
			return;
		}
		
	
		if ($this->input->post()){
			$id_eliminar = $this->input->post('con_id');
			$this->M_contactos->elim($id_eliminar);
			redirect('contactos');
		}else{
			$data['datos_contacto'] = $this->M_contactos->get_por_id($id);
			if (empty($data['datos_contacto'])){
				echo 'ID Invalido';
			}else{
				$this->load->view('view_elim_contacto',$data);
			}
		}
		

		
	}
	
}

/* Fin de Archivo: Controlador Contactos */
