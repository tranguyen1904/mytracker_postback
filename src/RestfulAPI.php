<?php
namespace API;
use API\config\ApiConfig;

class RestfulAPI {

    protected $method = '';

    protected $endpoint = '';

    protected $params = array();

    protected $responseData = null;

    public function __construct(){
        echo "Init RestfulAPI <br>";
        $this->_input();

        if(!$this->_validateRequest()){
            $this->responseData = APIResponse::getResponse("403");
        }
        else {
            $this->responseData = $this->_process_api();
        }
    }

    private function _input(){
        echo "Input";
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");

        $path = $this->getPathInfo();
        print_r($path);
        $path = trim($path, '/');
        print_r($path);

        $this->endpoint = $path;
        $method         = $_SERVER['REQUEST_METHOD'];
        $allow_method   = array('GET', 'POST', 'PUT', 'DELETE');

        if (in_array($method, $allow_method)){
            $this->method = $method;
        }

        switch ($this->method) {
            case 'POST':
                $this->params = $_POST;
            break;

            case 'GET':
                $this->params = $_GET;
            break;

            case 'PUT':
            break;

            case 'DELETE':
            break;

            default:
                $this->response(500, "Invalid Method");
            break;
        }
    }

    private function _process_api(){
        $controllerMapping = ApiConfig::controllerMap;
        if (isset($controllerMapping[$this->endpoint])){
            $controller = new $controllerMapping[$this->endpoint]();
            $method = self::methodMapping[$this->method];
            return $controller->$method($this->params);
        } else {
            return APIResponse::getResponse('405');
        }
    }

    private function _validateRequest(){
        return true;
    }

    public function response(){
        header("Content-Type: application/json");
        echo json_encode($this->responseData, JSON_PRETTY_PRINT);
        die();
    }

    private function getPathInfo(){
        if (array_key_exists('PATH_INFO', $_SERVER) === true)
            return $_SERVER['PATH_INFO'];
        
        $path = substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], '.php') + strlen(4));
        $path = trim($path, '/');
        return trim($path, '/');
    }

    const methodMapping = [
        "POST" => "create",
        "GET" => "get",
        "PUT" => 'update',
        "DELETE" => 'delete'
    ];
}