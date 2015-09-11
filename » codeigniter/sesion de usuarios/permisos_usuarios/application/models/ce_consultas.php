<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CE_consultas extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function get_estadistica_ingresos() {
        $query = $this->db->get('estadisticas');
		return $query->result();
    }
	
	public function get_description_privilegios() {
	    $this->db->select('description_privilegio');
        $query = $this->db->get_where('privilegios', array('id_privilegio' => $this->session->userdata['id_privilegio']));
		return $query->row();
    }
}
?>
