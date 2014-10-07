<?php 
/**
* Database abstraction class
*/
class DB
{
	private $_mysqli = null;
	private static $_instance;

	private $_results = array();
	
	private function __construct()
	{
		$mysqli = new mysqli(Config::get('mysql/host'),Config::get('mysql/user'),Config::get('mysql/password'),Config::get('mysql/database'));
		if ($mysqli->connect_error) {
		    die('Connect Error: ' . $mysqli->connect_error);
		}else{
			$this->_mysqli = $mysqli;
			return self::$_instance = $this;
		}
	}

	public static function getInstance(){
		if (isset(self::$_instance)) {
			return self::$_instance;
		}else{
			return new DB();
		}
	}

	public function query($sql, $params = array()){
		$db = $this->_mysqli;
		$this->_results = array();
 
		if ($result = $db->query($sql)) {
			if ($result->num_rows) {
				while ($record = $result->fetch_assoc()) {
					$this->_results[] = $record;
				}
			}
		}
		return $this;
	}

	public function get($table){
		return $this->query("SELECT * FROM $table")->_results;
	}

	public function results(){
		return $this->_results;
	}

	public function first(){
		return $this->_results[0];
	}

	public function length(){
		return count($this->_results);
	}
}
?>