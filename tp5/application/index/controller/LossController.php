<?php

namespace app\index\controller;

use app\index\model\Loss;
use think\Controller;

use think\Request;

class LossController extends Controller
{
    public function index()
    {
        return $this->fetch();

    }

    public function test()
    {
        $postData = Request::instance()->post();
        return var_dump($postData);
    }

    public function insertLoss()
    {
        $postData = Request::instance()->post();

        $result = Loss::insertLoss($postData);

        if ($result==true)
            return $this->success("submite successful" , "index/index/index");
        else{
            return $this->error("there are some problem",'index/index/index');
        }

    }


}