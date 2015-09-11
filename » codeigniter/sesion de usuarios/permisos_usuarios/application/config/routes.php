<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/* Rutas para la clase cc_main*/
$route['default_controller'] = "cc_main/show_login";
$route['welcome'] = "cc_main/check_login";
$route['logout'] = "cc_main/check_logout";
$route['usuarios'] = "cc_main/usuario_management";
$route['usuarios/(:any)'] = "cc_main/usuario_management";

/* Rutas para la clase cc_administracion*/
$route['trazas'] = "cc_administracion/trazas_management";
$route['trazas/delete'] = "cc_administracion/delete_trazas";
$route['backup_db'] = "cc_administracion/backup_sql";

/* Rutas para la clase cc_sistema*/
$route['productos'] = "cc_sistema/productos_management";
$route['productos/(:any)'] = "cc_sistema/productos_management";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
