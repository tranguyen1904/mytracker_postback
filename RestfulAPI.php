<?php

class RestfulAPI {

    protected $method = '';

    protected $endpoint = '';

    protected $params = array();

    protected $file = null;

    public function __construct(){
        echo "Init RestfulAPI";
        $this->_input();
        $this->_process_api();
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

        print_r("<br>");
        print_r($this->params);
    }

    private function _process_api(){
        $controllerMap = ApiConfig::controllerMap;        
        $keyMap = $this->method."|".$this->endpoint;
        if (isset($controllerMap[$keyMap])) {

            $class = $controllerMap[$keyMap]['class'];
            $functionName = $controllerMap[$keyMap]['function_name'];
            // $returnArray = AppResponse::getResponse('200');
            var_dump($functionName);

            $cObjectClass = new $class();
            var_dump($cObjectClass->create());
            $returnArray = $cObjectClass->$functionName($this->params);
            var_dump($returnArray);
        } else {
            $returnArray = AppResponse::getResponse('405');
        }
        $this->response($returnArray);
        var_dump($returnArray);
        return $returnArray;
    }

    /**
     * Trả dữ liệu về client
     * @param: $status_code: mã http trả về
     * @param: $data: dữ liệu trả về
     */
    protected function response($data = NULL){
        header("Content-Type: application/json");
        echo json_encode($data);
        die();
    }

    /**
     * Tạo chuỗi http header
     * @param: $status_code: mã http
     * @return: Chuỗi http header, ví dụ: HTTP/1.1 404 Not Found
     */
    private function _build_http_header_string($status_code){
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return "HTTP/1.1 " . $status_code . " " . $status[$status_code];
    }
}