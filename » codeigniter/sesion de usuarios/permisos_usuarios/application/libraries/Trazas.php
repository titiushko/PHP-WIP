<?php

if (!defined('BASEPATH'))
    exit('No se permite acceso directo al script');

// ------------------------------------------------------------------------

/**
 * Trazas Class
 *
 * @package	CodeIgniter
 * @subpackage	Libraries
 * @category	Trazas
 * @author		Luis Ramirez Calle
 * @description    Esta clase tiene funciones para guardar las trazas de los usuarios, es v�lida cuando se usa el plugin grocery_crud
 */
class CI_Trazas {

    var $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     *  change_state
     *
     * Cambia el nombre del estado que se le pasa por par�metro a espa�ol,
     * este estado lo da el objeto $crud. Los estados pueden ser 
     * insert, update y delete
     *
     * @access	public
     * @param	string
     * @return	string
     */
    public function change_state($state) {
        switch ($state) {
            case 'insert':
                $state = 'Insertar';
                break;
            case 'update':
                $state = 'Actualizar';
                break;
            case 'delete':
                $state = 'Borrar';
                break;
        }
        return $state;
    }

    /**
     *  format_date
     *
     * Obtiene y formatea la fecha y hora al formato 07/10/12 - 6:30pm
     *
     * @access	public
     * @return	string
     */
    public function format_date() {
        $this->CI->load->helper('date');
        $datestring = "%d/%m/%Y - %h:%i%a";
        return mdate($datestring);
    }

    /**
     *  insert_trace
     *
     * Inserta una traza en la tabla trazas
     *
     * @access	public
     * @param	objeto
     */
    public function insert_trace($crud) {
        $this->CI->load->database();
        $data_traza = array(
            'fecha_hora' => $this->format_date(),
            'tabla' => $crud->get_basic_db_table(),
            'operacion' => $this->change_state($crud->getState()),
            'nomenclador' => $crud->getSubject(),
            'usuario' => $this->CI->session->userdata('username'),
            'fullname' => $this->CI->session->userdata('firstname') . " " . $this->CI->session->userdata('lastname'),
            'ip_usuario' => $this->CI->session->userdata('ip_address')
        );
        $this->CI->db->insert('trazas', $data_traza);
    }

    /**
     *  create_tabla_trazas
     *
     * Crea la tabla trazas en la base de datos
     *
     * @access	public
     */
    public function create_tabla_trazas() {
        $this->CI->db->query(
                'CREATE TABLE `trazas` (
           `id_traza` smallint(6) NOT NULL AUTO_INCREMENT,
           `fecha_hora` varchar(20) NOT NULL,
           `tabla` varchar(30) NOT NULL,
           `operacion` varchar(20) NOT NULL,
           `nomenclador` varchar(50) NOT NULL,
           `usuario` varchar(30) NOT NULL,
           `fullname` varchar(50) NOT NULL,
           `ip_usuario` varchar(25) NOT NULL,
           PRIMARY KEY (`id_traza`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }

    /**
     *  start_trace
     *
     * Comienza la ejecuci�n de una traza, si la tabla existe crea la traza y la guarda en la base de datos
     * sino la tabla no existe, crea la tabla y despues guarda la traza en la base de datos
     *
     * @access	public
     * @param	objeto
     */
    public function start_trace($crud) {
        if (!$this->CI->db->table_exists('trazas')) {
            $this->create_tabla_trazas();
        }
        if (($crud->getState() == 'insert') || ($crud->getState() == 'update') || ($crud->getState() == 'delete')) {
            $this->insert_trace($crud);
        }
    }

}

?>