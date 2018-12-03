<?php
require_once __DIR__.'/../utils.php';

class DB{
    function __construct($name, $debug = false){
        $this->debug = $debug;
        if($name == 'main'){
            $config_setup = json_decode(file_get_contents(__DIR__.'/../../../config.json'), true);
            define('DB_MAIN_HOST', $config_setup['db_mysql_db_host']);
            define('DB_MAIN_NAME', $config_setup['db_mysql_db_name']); 
            define('DB_MAIN_USERNAME', $config_setup['db_mysql_db_user']);
            define('DB_MAIN_PASSWORD', $config_setup['db_mysql_db_password']);
            $this->db = new PDO('mysql:host='.DB_MAIN_HOST.';dbname='.DB_MAIN_NAME.';charset=utf8', DB_MAIN_USERNAME, DB_MAIN_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
    }
    function force_drop_table($table_name){
        $this->db->exec("SET FOREIGN_KEY_CHECKS=0; DROP TABLE IF EXISTS `$table_name`; SET FOREIGN_KEY_CHECKS=1;");
    }
    function create_clean_table($table_name, $cols_str){
        $indexes = [];
        $foreign_keys = [];
        $sql = "CREATE TABLE `$table_name` (\n";
        $sql .= 'id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,';
        $cols = explode("\n", clean_str($cols_str));
        foreach ($cols as $i => $col) {
            $col = trim($col);
            if($col == '') continue;
            if (endsWith($col, '_id')) {
                $col .= ' INT(15)';
                $foreign_keys[] = explode('_id', $col)[0];
            } else if(endsWith($col, ' INDEX')){
                $col = explode(' INDEX', $col)[0];
                $indexes[] = explode(' ', $col)[0];
            }
            $sql .= "\n".$col.',';
        }
        foreach ($indexes as $i => $index) {
            $sql .= "\n".'INDEX('.trim($index).'),';
        }
        foreach ($foreign_keys as $i => $foreign_key){
            $sql .= "\n".'FOREIGN KEY ('.$foreign_key.'_id) REFERENCES `'.$foreign_key.'`(id) ON DELETE CASCADE,';
        }
        $sql = trim($sql, ',');
        $sql .= "\n)";
        if($this->debug) echo nl2br($sql).'<br><br>';
        $this->force_drop_table($table_name);
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
    public function query($query) {
        $sql = $this->db->prepare($query);
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) >= 1) {
            return $rows;
        } else {
            return false;
        }
    }
    public function delete($table, $col_where, $where) {
        $sql = $this->db->prepare(
            "DELETE FROM $table
            WHERE $col_where = :col_where"
        );
        $sql->bindParam(':col_where', $where);
        $sql->execute();
    }
    public function delete_where($table, $where) {
        $sql = $this->db->prepare(
            "DELETE FROM $table
            WHERE $where"
        );
        $sql->execute();
    }
    public function get_all($table, $where = '') {
        $sql = $this->db->prepare(
            "SELECT *
            FROM $table
            $where"
        );
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) >= 1) {
            return $rows;
        }
        else {
            return false;
        }
    }
    public function get_one(
        $table,
        $where_value,
        $where_col = 'id',
        $extra_where = '', 
        $extra_where_value = ''
    ) {
        $sql = $this->db->prepare(
            "SELECT *
            FROM $table
            WHERE $where_col = :col_where
            $extra_where
            LIMIT 1"
        );
        $sql->bindParam(':col_where', $where_value);
        if ($extra_where_value != '') {
            $array = explode(' ', $extra_where);
            $extra_where_col = end($array);
            $sql->bindParam($extra_where_col, $extra_where_value);
        }
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) == 1) {
            return $rows[0];
        } else {
            return false;
        }
    }
    public function count($table, $where = '') {
        $sql = $this->db->prepare(
            "SELECT COUNT(*) AS count
            FROM $table
            $where"
        );
        $sql->execute();
        return $sql->fetch()['count'];
    }
    public function check_if_increment($key, $value) {
        $value_compact = str_replace(' ', '', $value);
        return $value_compact == $key.'+1' || $value_compact == $key.'-1';
    }
    public function update($table, $data, $col_where, $where) {
        $set = '';
        foreach ($data as $key => $value) {
            if (self::check_if_increment($key, $value)) {
                $set .= $key.' = '.$value;
                continue;
            }
            $set .= $key.' = :'.$key.', ';
        }
        $set = trim($set, ', ');
        $sql = $this->db->prepare(
            "UPDATE $table
            SET $set
            WHERE $col_where = :col_where"
        );
        // & before value is necessary in this case, otherwise it repeat always the first value
        foreach ($data as $key => &$value) {
            if (self::check_if_increment($key, $value)) continue;
            $sql->bindParam(':'.$key, $value);
        }
        $sql->bindParam(':col_where', $where);
        $sql->execute();
    }
}