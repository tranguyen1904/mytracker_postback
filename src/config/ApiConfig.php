<?php
// namespace API\config;

class ApiConfig
{
    const DBConfig = [
        "host"=> "localhost",
        "port"=> "3307",
        "username"=> "root",
        "password"=> "root",
        "database"=> "khanhtn2",
    ];

    const postbackFields = [
        "IFA"           => ["type"=>'string', 'require'=>true],
        "IP"            => ["type"=>'string', 'require'=>true],
        "CountryCode"   => ["type"=>'string', 'require'=>false],
        "CampaignID"    => ["type"=>'string', 'require'=>false],
        "CampaignName"  => ["type"=>'string', 'require'=>false],
        "SourceAppId"   => ["type"=>'string', 'require'=>false],
        "CreativePack"  => ["type"=>'string', 'require'=>false],
        "CreativePackId"=> ["type"=>'string', 'require'=>false],
        "DeviceModel"   => ["type"=>'string', 'require'=>false],
        "CPI"           => ["type"=>'string', 'require'=>false],
    ];

    const controllerMap = [
        "postback"=>"PostbackController",
        "mytracker/postback"=>"PostbackController"
    ];

    const urlPrefix = "postback.php";

    // -------------------------------------------------

    const listDB = [
        "db1" => [
            "host"=> "localhost",
            "port"=> "3307",
            "username"=> "root",
            "password"=> "root",
            "database"=> "khanhtn2",
        ],
        "db2" => [
            "host"=> '10.11.165.10',
            "port"=> "3306",
            "username"=> "khanhtn2",
            "password"=> "vqODpGFl2qgv",
            "database"=> "khanhtn2",
        ]
    ];

}