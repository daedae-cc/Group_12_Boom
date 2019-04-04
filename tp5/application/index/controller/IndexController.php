<?php
namespace app\index\controller;

use think\Controller;

class IndexController extends Controller
{

    /**
     * This is the Homepage
     */
    public function index()
    {
        return $this->fetch();
    }

    public function about(){
        return $this->fetch();
    }

    public function contact(){
        return $this->fetch();
    }
}
