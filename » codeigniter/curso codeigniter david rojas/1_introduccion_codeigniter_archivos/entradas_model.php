<?php
/**
* 
*/
class Entradas_model extends Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function obtener_todos(){
		$query = $this->db->order_by('titulo')->get('entradas');
		
		if($query->num_rows>0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		
	}
}
