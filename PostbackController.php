<?php



class PostbackController
{
    const tableName = "";

    public function __construct(){
        echo "<br>PostbackController<br>";
        
        $this->__context = new APIContext();
    }

    public function create($param){
        echo "<br>PostbackController create<br>";
        $postbackData = [];
        $postbackFields = array_keys(ApiConfig::postbackFields);
        foreach ($param as $key=>$value){
            if(in_array($key, $postbackFields)){
                $postbackData[$key] = $value;
            }
        }

        $listItem = "`".implode("`,`", array_keys($postbackData))."`";
        $listValue = "'".implode("','", array_values($postbackData))."'";
        $sql = "insert into ".self::tableName."(".$listItem.") values (".$listValue.")";
        $query = $this->__context->querySQL($sql);
        if(!$query){
            $res['detail']="Writing database fail";
            $res['success'] = FALSE;
            $res['response']='500';
        }else {
            $res['detail'] = "Success";
        }
        return $res;
    }
}