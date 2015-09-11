<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
    }
    
	public function index()
	{
		//$this->load->view('welcome_message');
        $this->layout->view('index');
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */