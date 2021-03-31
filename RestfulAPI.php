<?php

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
            echo $this->responseData;
        }
    }

    private function _input(){
        echo "Input";
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");

        $this->params   = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        if(count($this->params) > 0 && $this->params[0]=='postback.php'){
            array_shift($this->params);
        }   
        $this->endpoint = array_shift($this->params);
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

        print_r($this->params);
    }

    private function _process_api(){
        $controllerMap = ApiConfig::controllerMap;        
        $keyMap = $this->method."|".$this->endpoint;
        if (isset($controllerMap[$keyMap])) {

            $class = $controllerMap[$keyMap]['class'];
            $functionName = $controllerMap[$keyMap]['function_name'];
            
            $object = new $class();
            // var_dump(gettype(($object)));
            $returnArray = $object->$functionName($this->params);
            // var_dump($returnArray);
        } else {
            $returnArray = APIResponse::getResponse('405');
        }
        return $returnArray;
    }

    private function _validateRequest(){
        return true;
    }

    public function response(){
        header("Content-Type: application/json");
        echo json_encode($this->responseData, JSON_PRETTY_PRINT);
        die();
    }
}