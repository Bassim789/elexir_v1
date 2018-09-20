<?php
require_once('db_config.php');

class DB{
	function __construct($name){
		if($name == 'main'){
			$this->db = new PDO('mysql:host='.DB_MAIN_HOST.';dbname='.DB_MAIN_NAME.';charset=utf8', 
								DB_MAIN_USERNAME, DB_MAIN_PASSWORD);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
	}
	function create_clean_table($table_name, $cols_str){
		$this->db->exec("DROP TABLE IF EXISTS $table_name");
    	$sql = "CREATE TABLE $table_name (";
    	$sql .= 'id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,';
    	$sql .= trim($cols_str).')';
    	$this->db->exec($sql);
	}
	function insert($table, $data) {
		$cols = '';
		$values = '';
		foreach ($data as $key => $value) {
			$cols .= $key.', ';
			$values .= ':'.$key.', ';
		}
		$cols = trim($cols, ', ');
		$values = trim($values, ', ');
		$sql = $this->db->prepare(
			"INSERT INTO $table
			($cols)
			VALUES
			($values)"
		);
		// & before value is necessary in this case, otherwise it repeat always the first value
		foreach ($data as $key => &$value) {
			$sql->bindParam(':'.$key, $value);
		}
		$sql->execute();
		return $this->db->lastInsertId();
	}
}