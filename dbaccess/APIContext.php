<?php


class APIContext {
    public function __construct()
    {
        $this->db = new DBConnection(ApiConfig::DBConfig);
        // echo "<br>APIContext<br>";
    }

    public function querySQL($sql){
        return $this->db->query($sql);
    }

}