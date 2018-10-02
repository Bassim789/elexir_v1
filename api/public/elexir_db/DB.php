<?php
require_once 'utils.php';

class DB{
	function __construct($name, $debug = false){
		$this->debug = $debug;
		if($name == 'main'){
			$config_setup = json_decode(file_get_contents("../../../config.json"), true);
			define('DB_MAIN_HOST', $config_setup['db_mysql_db_host']);
			define('DB_MAIN_NAME', $config_setup['db_mysql_db_name']); 
			define('DB_MAIN_USERNAME', $config_setup['db_mysql_db_user']);
			define('DB_MAIN_PASSWORD', $config_setup['db_mysql_db_password']);
			$this->db = new PDO('mysql:host='.DB_MAIN_HOST.';dbname='.DB_MAIN_NAME.';charset=utf8', 
								DB_MAIN_USERNAME, DB_MAIN_PASSWORD);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
	}
	function create_clean_table($table_name, $cols_str){
		$indexes = [];
    	$sql = "CREATE TABLE `$table_name` (\n";
    	$sql .= 'id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,';
    	$cols = explode("\n", clean_str($cols_str));
    	foreach ($cols as $i => $col) {
    		$col = trim($col);
    		if($col == '') continue;
    		if (endsWith($col, '_id')) {
    			$col .= ' INT(15) INDEX';
    		}
    		if(endsWith($col, ' INDEX')){
    			$col = explode(' INDEX', $col)[0];
    			$indexes[] = explode(' ', $col)[0];
    		}
    		$sql .= "\n".$col.',';
    	}
    	foreach ($indexes as $i => $index) {
    		$sql .= "\n".'INDEX('.trim($index).'),';
    	}
    	$sql = trim($sql, ',');
    	$sql .= "\n)";
    	if($this->debug) echo nl2br($sql).'<br><br>';
    	$this->db->exec("DROP TABLE IF EXISTS `$table_name`");
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
		$query = "INSERT INTO `$table` 
			($cols) 
			VALUES 
			($values)";
		if($this->debug) echo nl2br($query).'<br><br>';
		$sql = $this->db->prepare($query);
		// & before value is necessary in this case, otherwise it repeat always the first value
		foreach ($data as $key => &$value) {
			$sql->bindParam(':'.$key, $value);
		}
		$sql->execute();
		return $this->db->lastInsertId();
	}
}