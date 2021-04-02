<?php
namespace API\dbaccess;

use PDO, Exception;

class DBConnection
{

    public function __construct(array $config){
        echo "<br> DBConnection";
        $this->dsn = $this->getDsn($config);
        $this->userName = $this->getUserName($config);
        $this->password = $this->getPassword($config);
        $this->options = $this->getOptions($config);
        try {
            $this->pdo = new PDO($this->dsn, $this->userName, $this->password, $this->options);
            if (isset($config['database'])) {
                $this->pdo->exec("use ".$config['database']);
            }
            return $this->pdo;
        } catch (Exception $e) {
            echo $e;
        }
        return null;
    }

    protected function getDsn(array $params){
        $dsn = 'mysql:';
        if (isset($params['host']) && $params['host'] !== '') {
            $dsn .= 'host=' . $params['host'] . ';';
        }

        if (isset($params['port'])) {
            $dsn .= 'port=' . $params['port'] . ';';
        }

        if (isset($params['dbname'])) {
            $dsn .= 'dbname=' . $params['dbname'] . ';';
        }

        if (isset($params['unix_socket'])) {
            $dsn .= 'unix_socket=' . $params['unix_socket'] . ';';
        }

        if (isset($params['charset'])) {
            $dsn .= 'charset=' . $params['charset'] . ';';
        }

        return $dsn;
    }

    protected function getUserName(array $config){
        return ($config['username'] ?? null);
    }

    protected function getPassword(array $config){
        return ($config['password'] ?? null);
    }

    protected function getOptions(array $config){
        return ($config['options'] ?? null);
    }

    public function query($sql){;
        return $this->pdo->query($sql);
    }
}