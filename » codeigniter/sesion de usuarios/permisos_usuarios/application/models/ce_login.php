<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CE_login extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($user, $password) {
        $data = array();
        $pass = md5($password);
        $query = $this->db->get_where('miembros', array('username' => $user, 'password' => $pass));
        if ($query->num_rows() > 0) {
            $this->session->sess_destroy();
            $this->session->sess_create();
            $this->session->set_userdata(array('logged_in' => true, 'username' => $user, 'id_miembro' => $query->row()->id_miembro, 'id_privilegio' => $query->row()->id_privilegio, 'firstname' => $query->row()->firstname, 'lastname' => $query->row()->lastname));
        } else {
            $data['error'] = 'Usuario o contraseña incorrectos';
        }
        return $data;
    }

    /* Metodo para desloguear al usuario cuando cierra sesion y la destruye */

    public function logout() {
        $this->session->sess_destroy();
        $this->session->unset_userdata(array('logged_in' => '', 'username' => '', 'id_usuario' => '', 'id_privilegio' => ''));
		//$this->db->empty_table('ci_sessions'); 
    }

}
?>
