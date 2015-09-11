<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_contactos extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	function get_todos(){
		
		$query = $this->db->get('contactos');
		return $query->result();
		
	}
	
	function get_por_id($id){

		$query = $this->db->where('con_id',$id);
		$query = $this->db->get('contactos');
		return $query->result();
		
	}
	
	function add($data){

		$this->db->insert('contactos', $data); 
		return $this->db->insert_id();
		
	}
	
	function edit($data,$id){

		$this->db->where('con_id',$id);
		$this->db->update('contactos',$data);
		
	}
	
	function elim($id){

		$this->db->where('con_id',$id);
		$this->db->delete('contactos');
		
	}
	
	
}

/* Fin del Modelo: m_contactos */