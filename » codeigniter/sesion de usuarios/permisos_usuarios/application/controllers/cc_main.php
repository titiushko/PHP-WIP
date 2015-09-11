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
class CC_main extends CI_Controller {

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

    public function show_welcome() {
        $this->load->view('ci_head');
        $this->load->view('ci_header_banner');
        if (!isset($this->session->userdata['logged_in'])) {
            $this->load->view('ci_login');
        } else {
		    $this->load->model('ce_consultas');
			$data = $this->ce_consultas->get_description_privilegios();
            $this->load->view('nodos/ci_welcome', $data);
        }
        $this->load->view('ci_footer');
		
    }
	
    public function show_login($error = null) {
        $this->load->view('ci_head');
        $this->load->view('ci_header_banner');
        if (!isset($this->session->userdata['logged_in'])) {
            $this->load->view('ci_login', $error);
        }
        $this->load->view('ci_footer');
    }

    public function index() {
        $this->_main_output((object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    public function usuario_management() {
        try {
            /* This is only for the autocompletion */
            $crud = new grocery_CRUD();
            $crud->set_table('miembros');
            $crud->set_subject('Usuario');
            $crud->display_as('username', 'Nombre de Usuario')
                    ->display_as('firstname', 'Nombre')
                    ->display_as('lastname', 'Apellidos')
                    ->display_as('password', 'Contraseña')
                    ->display_as('id_privilegio', 'Privilegio');
            $crud->required_fields('firstname', 'lastname', 'username', 'password', 'id_privilegio');
            $crud->change_field_type('password', 'password');
            $crud->set_relation('id_privilegio', 'privilegios', 'name_privilegio');
            if (isset($this->session->userdata['logged_in']) && ($this->session->userdata['id_privilegio'] != 1)) {
                $crud->unset_add();
                $crud->unset_delete();
                $crud->fields('username', 'password');
                $crud->where('id_miembro', $this->session->userdata['id_miembro']);
            }
            if (!isset($this->session->userdata['logged_in'])) {
                $crud->unset_operations();
                $this->show_login($error=null);
            }
			$this->trazas->start_trace($crud);
            $crud->order_by('firstname, lastname');
			
            $output = $crud->render();
            $this->_main_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function check_login() {
        $this->load->model('ce_login');
        $respuesta = $this->ce_login->login($this->input->post('username'), $this->input->post('password'));
        if (empty($respuesta)) {
            $this->show_welcome();
        } else {
            $this->show_login($respuesta);
        }
    }

    public function check_logout() {
        $this->load->model('ce_login');
        $this->ce_login->logout();
		$this->load->helper('file');
		delete_files('./assets/trash/');
        $this->show_login($error=null);
    }
}

?>
