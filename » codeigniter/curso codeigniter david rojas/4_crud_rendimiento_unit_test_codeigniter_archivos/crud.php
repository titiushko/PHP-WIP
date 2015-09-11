<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class crud extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		$this->load->scaffolding('entradas');
	}

	
	function index() {
		$this->output->enable_profiler(TRUE);
		echo "Prueba";
	}
	
	function rendimiento(){
		$this->benchmark->mark('inicio_test');
		
		for($i=0;$i<1000000;$i++){
			$a = md5('test'.$i);
		}
		
		$this->benchmark->mark('fin_test');
		
		echo "Tiempo del test:". $this->benchmark->elapsed_time('inicio_test', 'fin_test');
	}
	
	function test(){
		$this->load->library('unit_test');
		
		$tests = Array(3+2, 2+3, 1+4, 2+1, 'texto');
		$res_esperado = 5;
		
		foreach($tests as $test){
			$this->unit->run($test, $res_esperado, 'Test de operaciones');
		}
		
		echo $this->unit->report();
		
	}

}