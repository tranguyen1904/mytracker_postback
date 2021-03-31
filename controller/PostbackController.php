<?php

class PostbackController extends BaseController
{
    public function __construct(){
        $this->__context = new APIContext();
        $this->fields = ApiConfig::postbackFields;
        $this->tableName = "postback";
        echo "<br>PostbackController<br>";
    }

    public function create($param){
        echo "<br>PostbackController create<br>";

        $postbackData = [];
        foreach ($param as $key=>$value){
            if(in_array($key, $this->fields)){
                $postbackData[$key] = $value;
            }
        }

        if (!$this->validateData($postbackData)){
            echo "<br>PostbackController validateData<br>";
            return APIResponse::getResponse('400');
        }

        $listItem = "`".implode("`,`", array_keys($postbackData))."`";
        $listValue = "'".implode("','", array_values($postbackData))."'";
        $sql = "insert into ".$this->tableName."(".$listItem.") values (".$listValue.")";
        echo "<br>".$sql;
        $query = $this->__context->querySQL($sql);
        if(!$query){
            $res = APIResponse::getResponse('500', "Writing database error");
        }else {
            $res = APIResponse::getResponse('200');
        }
        return $res;
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