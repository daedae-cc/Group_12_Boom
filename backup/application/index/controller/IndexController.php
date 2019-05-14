<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\User;

class IndexController extends Controller
{

    /**
     * This is the Homepage
     */
    public function index()
    {
        //check login
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        //output page
        return $this->fetch();
    }

    public function about()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        return $this->fetch();
    }

    public function contact()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        return $this->fetch();
    }

    public function test()
    {
        return var_dump(User::get(1));
    }
}
