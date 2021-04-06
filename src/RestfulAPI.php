<?php
namespace PostbackAPI;
use PostbackAPI\config\ApiConfig;
use PostbackAPI\controller\PostbackController;

class RestfulAPI {

    protected $method = '';

    protected $endpoint = '';

    protected $params = array();

    protected $responseData = null;

    public function __construct(){
        echo "RestfulAPI contructor";
        $this->_input();

        if(!$this->_validateRequest()){
            $this->responseData = APIResponse::getResponse("403");
        }
        else {
            $this->responseData = $this->_process_api();
        }
    }

    private function _input(){
        echo nl2br("RestfulAPI input\n");
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");

        $this->endpoint = $this->getPathInfo();
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
        echo nl2br("RestfulAPI Process\n");
        $controllerMapping = ApiConfig::controllerMap;
        if (isset($controllerMapping[$this->endpoint])){
            echo nl2br($controllerMapping[$this->endpoint]."\n");
            
            $controller = new $controllerMapping[$this->endpoint]();
            $method = self::methodMapping[$this->method];
            return $controller->$method($this->params);
        } else {
            return APIResponse::getResponse('405');
        }
    }

    private function _validateRequest(){
        echo nl2br("RestfulAPI validate Request\n");
        return true;
    }

    public function response(){
        // $this->setHTTPStatus(intval($this->responseData['statusCode']));
        http_response_code(intval($this->responseData['statusCode']));
        header("Content-Type: application/json");
        echo json_encode($this->responseData, JSON_PRETTY_PRINT);
        die();
    }

    private function getPathInfo(){
        if (array_key_exists('PATH_INFO', $_SERVER) === true)
            $path = $_SERVER['PATH_INFO'];
        else
            $path = substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], '.php') + strlen(4));
        return trim($path, '/');
    }

    const methodMapping = [
        "POST" => "create",
        "GET" => "get",
        "PUT" => 'update',
        "DELETE" => 'delete'
    ];

    function setHTTPStatus($num) {
        echo $num;
        $http = array(
            100 => 'HTTP/1.1 100 Continue',
            101 => 'HTTP/1.1 101 Switching Protocols',
            200 => 'HTTP/1.1 200 OK',
            201 => 'HTTP/1.1 201 Created',
            202 => 'HTTP/1.1 202 Accepted',
            203 => 'HTTP/1.1 203 Non-Authoritative Information',
            204 => 'HTTP/1.1 204 No Content',
            205 => 'HTTP/1.1 205 Reset Content',
            206 => 'HTTP/1.1 206 Partial Content',
            300 => 'HTTP/1.1 300 Multiple Choices',
            301 => 'HTTP/1.1 301 Moved Permanently',
            302 => 'HTTP/1.1 302 Found',
            303 => 'HTTP/1.1 303 See Other',
            304 => 'HTTP/1.1 304 Not Modified',
            305 => 'HTTP/1.1 305 Use Proxy',
            307 => 'HTTP/1.1 307 Temporary Redirect',
            400 => 'HTTP/1.1 400 Bad Request',
            401 => 'HTTP/1.1 401 Unauthorized',
            402 => 'HTTP/1.1 402 Payment Required',
            403 => 'HTTP/1.1 403 Forbidden',
            404 => 'HTTP/1.1 404 Not Found',
            405 => 'HTTP/1.1 405 Method Not Allowed',
            406 => 'HTTP/1.1 406 Not Acceptable',
            407 => 'HTTP/1.1 407 Proxy Authentication Required',
            408 => 'HTTP/1.1 408 Request Time-out',
            409 => 'HTTP/1.1 409 Conflict',
            410 => 'HTTP/1.1 410 Gone',
            411 => 'HTTP/1.1 411 Length Required',
            412 => 'HTTP/1.1 412 Precondition Failed',
            413 => 'HTTP/1.1 413 Request Entity Too Large',
            414 => 'HTTP/1.1 414 Request-URI Too Large',
            415 => 'HTTP/1.1 415 Unsupported Media Type',
            416 => 'HTTP/1.1 416 Requested Range Not Satisfiable',
            417 => 'HTTP/1.1 417 Expectation Failed',
            500 => 'HTTP/1.1 500 Internal Server Error',
            501 => 'HTTP/1.1 501 Not Implemented',
            502 => 'HTTP/1.1 502 Bad Gateway',
            503 => 'HTTP/1.1 503 Service Unavailable',
            504 => 'HTTP/1.1 504 Gateway Time-out',
            505 => 'HTTP/1.1 505 HTTP Version Not Supported',
        );
     
        header($http[$num]);
     
        return
            array(
                'code' => $num,
                'error' => $http[$num],
            );
    }
}