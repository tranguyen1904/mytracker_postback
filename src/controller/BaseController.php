<?php

namespace API\controller;

class BaseController {

    public function __construct(){

    }

    public function create($arg){
        return null;
    }

    public function get($arg){
        return null;
    }

    public function update($arg){
        return null;
    } 

    public function delete($arg){
        return null;
    }

    public function validateRequest($request){
        return true;
    }

    public function validateData($data){
        return true;
    }
}