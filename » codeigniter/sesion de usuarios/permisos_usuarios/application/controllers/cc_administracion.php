<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cc_main
 *
 * @author Luckys
 */
class CC_administracion extends CI_Controller {

    public function __construct() {
        parent::__construct();

        /* Standard Libraries */
        $this->load->database();
        $this->load->library('form_validation');
        /* ------------------ */
        $this->load->library('grocery_CRUD');
    }

    public function _main_output($output = null) {
        $this->load->view('ci_head');
        $this->load->view('ci_header_banner');
        if (!isset($this->session->userdata['logged_in'])) {
            $this->load->view('ci_login');
        } else {
            $this->load->view('ci_content', $output);
        }
        $this->load->view('ci_footer');
		
    }

    public function index() {
        $this->_main_output((object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    public function trazas_management() {
        try {
            /* This is only for the autocompletion */
            $crud = new grocery_CRUD();
            if (!$this->db->table_exists('trazas')) {
                $this->trazas->create_tabla_trazas();
            }
            $crud->set_table('trazas');
            $crud->set_subject('Trazas');
            $crud->display_as('fecha_hora', 'Fecha y Hora')
                    ->display_as('operacion', 'Operación Hecha')
                    ->display_as('fullname', 'Nombre y Apellidos')
                    ->display_as('nomenclador', 'Objeto');
            $crud->columns('fecha_hora', 'operacion', 'nomenclador', 'usuario', 'fullname', 'ip_usuario');
            $crud->order_by('fecha_hora');
            $crud->unset_operations();
			
            $output = $crud->render();
            $this->_main_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function delete_trazas() {
        $this->db->empty_table('trazas');
        redirect('trazas');
    }
	
	public function backup_sql() {
        $this->load->view('ci_head');
        $this->load->view('ci_header_banner');
        if (!isset($this->session->userdata['logged_in'])) {
            $this->load->view('ci_login');
        } else {
            // Cargar la clase de utilidades de BD
            $this->load->dbutil();
            $prefs = array('format' => 'txt');
            // Hacer copia de respaldo para la BD entera y asignarla a una variable
            $backup = & $this->dbutil->backup($prefs);
			if(!is_null($backup)){
			  // Cargar el helper file y escribir el archivo en el servidor
            $this->load->helper('file');
			$this->load->helper('date');
			$this->load->helper('download');
			$datestring = "%Y-%m-%d";
            $time = time();
			$fecha = mdate($datestring, $time);
			$name_db = "backup_correo"."_".$fecha.".sql";
            write_file("assets/trash/".$name_db."", $backup);
			$data = file_get_contents("assets/trash/".$name_db.""); // Lee el contenido del archivo
	        force_download($name_db, $data);
			$data['message']= 'La Base de Datos se salvó satisfactoriamente';
			}else{
			$data['message']= 'Ocurrió un error al salvar la Base de Datos';
			}
            $this->load->view('nodos/ci_backup', $data);
        }
        $this->load->view('ci_footer');
    }

}

?>
