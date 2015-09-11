<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Home extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	
	function index() {
		$this->load->view('home_view');
	}

}