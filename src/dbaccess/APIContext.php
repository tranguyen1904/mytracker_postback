<?php
// namespace API\dbaccess;

// use API\config\ApiConfig;

class APIContext {
    public function __construct($controller='')
    {
        $this->db = new DBConnection(ApiConfig::DBConfig);
    }

    public function querySQL($sql){
        return $this->db->query($sql);
    }

}