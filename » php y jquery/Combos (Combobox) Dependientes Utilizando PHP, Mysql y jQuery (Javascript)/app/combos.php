<?
include("mysql_inc.php");
$mysql = new MySql_Class;
$mysql->user="root";
$mysql->password="root";
$mysql->db="poblaciones";
$mysql->server="localhost";
$mysql->conection();
$idcombo = $_POST["id"];
$action =$_POST["combo"];
switch($action){
	case "pais":{
		$query =$mysql->query("SELECT idestado,estado FROM estado WHERE pais = $idcombo order by estado ASC");
		foreach($query["data"] as $rs)
			echo '<option value="'.$rs["idestado"].'">'.htmlentities($rs["estado"]).'</option>';
	break;
	}
	case "estado":{
		$query =$mysql->query("SELECT idciudad,ciudad FROM ciudad WHERE estado= $idcombo order by ciudad ASC");
		foreach($query["data"] as $rs)
			echo '<option value="'.$rs["idciudad"].'">'.htmlentities($rs["ciudad"]).'</option>';
	break;
	}
}
?>