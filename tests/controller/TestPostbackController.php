<?php

namespace Tests\controller;

use PostbackAPI\controller\PostbackController;
use PHPUnit\Framework\TestCase;

class MockPostbackController extends PostbackController{
    public function __construct()
    {
        parent::__construct();
        // $this->context =     
    }
}


class TestPostbackController extends TestCase{
    public $controller;
    public function __construct()
    {
        $this->controller = new PostbackController();
    }

    function testCreate(){

    }
}