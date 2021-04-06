<?php
namespace PostbackAPI\controller;

use PostbackAPI\dbaccess\APIContext;
use PostbackAPI\config\ApiConfig;
use PostbackAPI\APIResponse;


class PostbackController extends BaseController
{
    public function __construct(){
        echo nl2br("PostbackController contructor\n");

        $this->__context = new APIContext('PostbackController');
        $this->fields = ApiConfig::postbackFields;
        $this->tableName = "postback";
    }

    public function create($param){
        $postbackData = [];
        foreach ($param as $key=>$value){
            if(isset($this->fields[$key])){
                $postbackData[$key] = $value;
            }
        }

        if (!$this->validateData($postbackData)){
            return APIResponse::getResponse('400');
        }

        $query = $this->__context->insert($postbackData, $this->tableName);
        
        if(!$query){
            $res = APIResponse::getResponse('500', "Writing database error");
        }else {
            $res = APIResponse::getResponse('200');
        }
        return $res;
    }

    public function get($param){
        return $this->create($param);
    }

    public function validateData($data)
    {
        foreach ($this->fields as $field => $fieldValue){
            if (isset($data[$field])){
                $value = $data[$field];
                $length = ($fieldValue['length']??false);
                if ($length && strlen($value)!==$length) return false;

                $type = ($fieldValue['type']??'string');
                switch ($type){
                    case 'int':
                        if (!is_int($value)) return false;
                    break;
                }
            } else{
                $require = ($fieldValue['require']??false);
                if ($require) return false;
            }
        }

        return true;
    }
}