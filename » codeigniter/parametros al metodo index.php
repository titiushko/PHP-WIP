Article uno de piera Codeigniter Pasar parámetros al index con _remap
Pasar parámetros al index con _remap

La función _remap en codeigniter nos ayuda a remapear nuestros controladores como nosotros le digamos, para casi todos los casos las rutas pueden ser suficiente, pero podemos tener otros casos como el siguiente. 

Digamos que queremos crear una aplicación la cuál obtiene los datos del usuario por un segmento de la url como lo hace twitter, simplemente podemos pasar un parámetro a la función index de la siguiente forma: 

http://localhost/remap/home/unodepiera

El problema es que ésto así tal cuál no funcionará ya que codeigniter lo que hará será buscar un método llamado unodepiera, y si no existe dará error, realmente podemos crear una ruta, pero no funcionaria, nuestra ruta podría ser: 

$route['([a-zA-Z0-9]+)'] = 'home/$1/$2';

Ésto haría que al visitar la url http://localhost/remap/home/index/unodepiera nos mostrará el parámetro, pero no es demasiado limpio que digamos, para nuestro caso sería perfecto remapear la función index y decirle a codeigniter que a esta funcion va a tener uno o más parámetros, así que nuestro controlador podría lucir tal que así. 

<?php
defined("BASEPATH") OR die("El acceso directo al script no está permitido!!!!");
 
class Home extends CI_Controller {
  public function __construct() {
    parent::__construct();
  }
 
  public function index($first_param, $params) {
    echo "Hola $first_param tu edad es $params[0] y vives en $params[1]";
  }
 
  public function test($nombre = "", $otro = "", $mas = "") {
    echo "Hola test, tu nombre es $nombre y $otro y $mas";
  }
 
  //le pasamos un array como segundo argumento, estos son los parámetros
  public function _remap($method, $params = array()) {
    //comprobamos si existe el método, no queremos que al llamar a un método codeigniter crea que es un parámetro del index
    if(!method_exists($this, $method)) {
       $this->index($method, $params);
    }else{
      return call_user_func_array(array($this, $method), $params);
    }
  }
}

Si ahora visitamos la url http://localhost/remap/home/unodepiera veremos como nos dice: 

Hola unodepiera. 

Si visitamos http://localhost/remap/home/unodepiera/32/piera dirá: 

Hola unodepiera tu edad es 32 y vives en piera. 

De la misma forma podemos hacer con el método test: 

La ruta http://localhost/remap/home/test/unodepiera/hola/pepe nos dirá: 

Hola test, tu nombre es unodepiera y hola y pepe 

Si finalmente lo que necesitamos es crear una url como twitter, ejemplo http://proyecto/unodepiera, hasta donde yo sé, la única forma es creando todas las rutas que necesitemos en el archivo config/routes.php, siendo la última de todas una que acepte como parámetro cualquier dato, veamos un ejemplo. 

Las rutas: 
//aquí deberiamos escribir todas las rutas
$route['main/test'] = 'main/test'; 
$route['main/saludo'] = 'main/saludo'; 
//finalmente la ruta que nos ayuda a crear http://proyecto/unodepiera
$route['(:any)'] = 'main/index/$1'; 
//otra forma
$route['main/(:any)'] = 'main/index/$1';

Y así podría quedar el controlador main para estas rutas. 

<?php
defined("BASEPATH") OR die("El acceso directo al script no está permitido!!!!");
class Main extends CI_Controller {
  public function index($param) {
    echo "Hola $param";
  }
 
  public function test() {
    echo "Hola test, esta es la función test.";
  }
 
  public function saludo() {
    echo "Hola saludo, esta es la función saludo.";
  }
}

Y eso es todo, ya puedes hacer tus pruebas, seguro que encuentras lo que necesitas. Si te ha sido útil el post puedes utilizar los botones de las redes sociales para ayudarme con mi trabajo :D.

=======================================================================================================================================================================================

CodeIgniter – Como enviar parámetros a la función Index utilizando únicamente el nombre del controlador

Recientemente me encontré con el problema o necesidad de enviar parámetros de paginación a la función index, estas variables eran la página y la cantidad de ítems por pagina. El entorno de desarrollo es únicamente la utilización del nombre del controlador en la URL, por ejemplo estoy trabajando en el modulo usuarios y mi objetivo es no enviar y mostrar los parámetros de la siguiente manera:

http://example.com/usuario/index/50/1

Aquí utilizo la función index para enviar los parámetros ítems/pagina, pero mi objetivo es el siguiente:

http://example.com/usuario/50/1

Se puede observar que se esconde al usuario final alguna señal de la utilización de CodeIgniter, entonces para solucionar este problema se utiliza el siguiente método:

private $pagination = array();
public function _remap($method, $params = array()){
	if($method!="index" && is_numeric($method)){
		$this->pagination[0] = $method;
		$i=1;
		foreach ($params as $param){
			$this->pagination[$i] = $param;
			$i++;
		}
		return call_user_func_array(array($this, "index"), $params);
	}else{
		return call_user_func_array(array($this, $method), $params);
	}
}

Este método es el primero en ser llamado antes de la ejecución de la función indicada, en su defecto será la función index o cualquier otra, entonces si el método llamado es index simplemente se hace la llamada a la función y se envían los parámetros, si no – y si el nombre del método es numérico significa que estamos enviando los parámetros de paginación que necesitamos, ahora creamos una variable global de lista de números y asignamos el método (que es un numero) junto a todos los demás parámetros. Pareciera que el arreglo de números es innecesario por que únicamente nos interesaría el primer número (que es el método) pero mi implementación no necesariamente debe de recibir estos parámetros, entonces si entramos al modulo usuario sin enviar las variables de paginación, en el constructor del controlador o bien en la función index establezco los valores por defecto si el arreglo de parámetros esta vacio, y además se utiliza el arreglo de números – porque en otras páginas podemos enviar un tercer parámetro de paginación, por ejemplo año.

Ahora, si el lector busca la optimización de recursos, el método sugerido es el siguiente:

public function _remap($method, $params = array()){
	if(is_numeric($method)){
		array_unshift($params, $method);
		return call_user_func_array(array($this, "index"), $params);
	}else{
		return call_user_func_array(array($this, $method), $params);
	}
}

Observamos ahora solo la utilización de la instrucción IF y una línea que almacena el valor entero del método al inicio del array de parámetros, luego únicamente la instrucción que hace la llamada al método index.

El método remap se explica por sí solo, algo más que puede servir de ayuda para ocultar al usuario la utilización de CodeIgniter es no mostrar el nombre del fichero index:

http://example.com/index.php/usuario/index/50/1

Esto, lo arreglamos con el siguiente código en el archivo .htaccess:

<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteBase /
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . / index.php [L]
</IfModule>

No importa si tenemos instalado CodeIgniter en una subcarpeta, por ejemplo:

http://example.com/administrador/index.php/usuario/index/50/1

Para esto, el código seria el siguiente:

<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteBase /administrador/
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . /administrador/index.php [L]
</IfModule>

Esto dará como resultado una URL como la siguiente:

http://example.com/administrador/usuario/index/50/1
