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
class CC_sistema extends CI_Controller {

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

    public function productos_management() {
        try {
            /* This is only for the autocompletion */
            $crud = new grocery_CRUD();
            $crud->set_table('productos');
            $crud->set_subject('Producto');
            $crud->display_as('codigo_producto', 'Código del Producto')
                    ->display_as('nombre_producto', 'Nombre')
                    ->display_as('precio_producto', 'Precio');
            $crud->required_fields('codigo_producto', 'nombre_producto', 'precio_producto');
            $crud->callback_column('precio_producto', array($this, 'valueToPeso'));
            if (!isset($this->session->userdata['logged_in'])) {
                redirect(base_url());
            }
            if ($this->session->userdata['id_privilegio'] != 1) {
                $crud->unset_operations();
            }
            $this->trazas->start_trace($crud);
            $crud->order_by('codigo_producto');

            $output = $crud->render();
            $this->_main_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function valueToPeso($value, $row) {
        return ' &dollar;' . $value;
    }
}

?>
