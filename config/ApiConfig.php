<?php


class ApiConfig
{

    const DBConfig = [
        "host"=> "localhost",
        "port"=> "3307",
        "user"=> "khanhtn2",
        "password"=> "root",
        "database"=> "root",
    ];

    const host = "";
    const subUri ="";

    const postbackFields = [
        "GameId"
    ];

    const controllerMap = [
        'GET|postback' => ['class' => 'PostbackController', 'function_name' => 'create'],
    ];
}