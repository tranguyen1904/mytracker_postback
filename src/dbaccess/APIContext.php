<?php
namespace PostbackAPI\dbaccess;

use PostbackAPI\config\ApiConfig;

class APIContext {

    public function __construct($controller='')
    {
        $this->db = new DBConnection(ApiConfig::DBConfig);
    }

    public function querySQL($sql){
        return $this->db->query($sql);
    }

    public function insert($data, $tableName){
        $listItem = "`".implode("`,`", array_keys($data))."`";
        $listValue = "'".implode("','", array_values($data))."'";
        $sql = "insert into ".$tableName."(".$listItem.") values (".$listValue.")";
        return $this->querySQL($sql);
    }

    public function select(){

    }

    public function update(){

    }

    public function delete(){

    }

}