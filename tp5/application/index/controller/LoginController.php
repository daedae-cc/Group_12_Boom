<?php
namespace app\index\controller;

class LoginController extends Controller
{
    // 用户登录表单
    public function index()
    {
        // 显示登录表单
        return $this->fetch();
    }


    // 处理用户提交的登录数据
    public function login()
    {
        return 'login';
    }
}
