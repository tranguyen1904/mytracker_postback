<?php


class ApiConfig
{

    const DBConfig = [
        "host"=> "localhost",
        "port"=> "3307",
        "username"=> "root",
        "password"=> "root",
        "database"=> "khanhtn2",
    ];

    const host = "";
    const subUri ="";

    const postbackFields = [
        "IFA"           => ["type"=>'string', 'require'=>true],
        "IP"            => ["type"=>'string', 'require'=>true],
        "CountryCode"   => ["type"=>'string', 'require'=>true],
        "CampaignID"    => ["type"=>'string', 'require'=>true],
        "CampaignName"  => ["type"=>'string', 'require'=>true],
        "SourceAppId"   => ["type"=>'string', 'require'=>true],
        "CreativePack"  => ["type"=>'string', 'require'=>true],
        "CreativePackId"=> ["type"=>'string', 'require'=>true],
        "DeviceModel"   => ["type"=>'string', 'require'=>true],
        "CPI"           => ["type"=>'string', 'require'=>true],
    ];

    const controllerMap = [
        'GET|postback' => ['class' => 'PostbackController', 'function_name' => 'create'],
        'POST|postback' => ['class' => 'PostbackController', 'function_name' => 'create'],
        
    ];
}