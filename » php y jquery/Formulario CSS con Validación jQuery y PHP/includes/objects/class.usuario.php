<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `usuario` (
	`usuarioid` int(11) NOT NULL auto_increment,
	`login` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL, PRIMARY KEY  (`usuarioid`)) ENGINE=MyISAM;
*/

/**
* <b>usuario</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0d / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=usuario&attributeList=array+%28%0A++0+%3D%3E+%27login%27%2C%0A++1+%3D%3E+%27password%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class usuario extends POG_Base
{
	var $usuarioId = '';

	/**
	 * @var VARCHAR(255)
	 */
	var $login;
	
	/**
	 * @var VARCHAR(255)
	 */
	var $password;
	
	var $pog_attribute_type = array(
		"usuarioId" => array('db_attributes' => array("NUMERIC", "INT")),
		"login" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"password" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		);
	var $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	function __get($attribute, &$value)
	{
		@eval('$result = $this->_'.$attribute.';');
		if ($result == null)
		{
			$value = false;
		}
		$value = $result;
		return true;
	}
	
	function usuario($login='', $password='')
	{
		$this->login = $login;
		$this->password = $password;
	}
	
	
	/**
	* Gets object from database
	* @param integer $usuarioId 
	* @return object $usuario
	*/
	function Get($usuarioId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `usuario` where `usuarioid`='".intval($usuarioId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->usuarioId = $row["usuarioid"];
			$this->login = $this->Unescape($row["login"]);
			$this->password = $this->Unescape($row["password"]);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ..} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $usuarioList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `usuario` ";
		$usuarioList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query  = $this->pog_query . " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query  = $this->pog_query . " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query  = $this->pog_query . " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query  = $this->pog_query . "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query  = $this->pog_query . "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query  = $this->pog_query . "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "usuarioid";
		}
		$this->pog_query  = $this->pog_query . " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$usuario = new $thisObjectName();
			$usuario->usuarioId = $row['usuarioid'];
			$usuario->login = $this->Unescape($row['login']);
			$usuario->password = $this->Unescape($row['password']);
			$usuarioList[] = $usuario;
		}
		return $usuarioList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $usuarioId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `usuarioid` from `usuario` where `usuarioid`='".$this->usuarioId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `usuario` set 
			`login`='".$this->Escape($this->login)."', 
			`password`='".$this->Escape($this->password)."' where `usuarioid`='".$this->usuarioId."'";
		}
		else
		{
			$this->pog_query = "insert into `usuario` (`login`, `password` ) values (
			'".$this->Escape($this->login)."', 
			'".$this->Escape($this->password)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->usuarioId == "")
		{
			$this->usuarioId = $insertId;
		}
		return $this->usuarioId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $usuarioId
	*/
	function SaveNew()
	{
		$this->usuarioId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `usuario` where `usuarioid`='".$this->usuarioId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ..} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `usuario` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query  = $pog_query . " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query  = $pog_query . " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query  = $pog_query . "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query  = $pog_query . "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}overload('usuario');
?>