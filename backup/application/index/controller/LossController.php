<?php

namespace app\index\controller;

use app\index\model\Loss;
use app\index\model\User;
use think\Controller;

use think\Request;

class LossController extends IsSignInController
{
    public function index()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);

        $name = Request::instance()->get('name');
        $pageSize = 10; // 每次显示5条数据
        $loss = new Loss;
        $loss->where('userId', '=', session('userId'));        // 调用分页\
        $losses = $loss->paginate($pageSize);
        $this->assign('losses', $losses);
        return $this->fetch();


    }

    public function lossDetail($id)
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        $loss = Loss::get($id);
        $this->assign('loss', $loss);
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
//        return var_dump($postData);

        $result = Loss::insertLoss($postData);

        if ($result == true)
            return $this->success("submite successful", "index/index/index");
        else {
            return $this->error("there are some problem", 'index/index/index');
        }

    }

    public function newLoss()
    {

//        return 'this is new loss';
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        return $this->fetch();
    }


}