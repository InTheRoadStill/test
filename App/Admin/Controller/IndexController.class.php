<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    public function index(){
        $this->display();
    }

    public function ui_elements()
    {
    	$this->display();
    }
}