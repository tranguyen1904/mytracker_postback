<?php
require_once('/model/DBConnection.php');
require_once('/config/ApiConfig.php');

class APIContext {
    public function __construct()
    {
        $this->db = new DBConnection(ApiConfig::DBConfig);
    }

    public function querySQL($sql){
        return $this->db->query($sql);
    }

}