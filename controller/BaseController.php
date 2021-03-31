<?php

class BaseController {

    public function __construct(){

    }

    public function create($param){
        return null;
    }

    public function validateRequest($request){
        return true;
    }

    public function validateData($data){
        return true;
    }
}