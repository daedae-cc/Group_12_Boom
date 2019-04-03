<?php

namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\index\Controller\userController;
use app\index\model\User;
use think\Url;

class SignUpController extends Controller
{
    // 用户登录表单
    public function index()
    {
        // 显示登录表单
        $postData = Request::instance()->post();
        return var_dump($postData);
    }

    // 处理用户提交的登录数据
    public function login()
    {
        //1.direct use database
//        // 接收post信息
//        $postData = Request::instance()->post();
//
//        // 验证用户名是否存在
//        $map = array('username'  => $postData['username']);
//        $user = User::get($map);
//
//        // $user要么是一个对象，要么是null。
//        if (!is_null($user)) {
//            // 验证密码是否正确
//            if ($user->getData('password') !== $postData['password']) {
//                // 用户名密码错误，跳转到登录界面。
//                return $this->error('password incrrect', url('index'));
//            } else {
//                // 用户名密码正确，将user存session。
//                session('teacherId', $user->getData('id'));
//                return $this->success('login success', url('User/index'));
//            }
//
//        } else {
//            // 用户名不存在，跳转到登录界面。
//            return $this->error('username not exist', url('index'));
//    }
        //2. use M and make M to deal with the data
        // 接收post信息

        $postData = Request::instance()->post();
        return var_dump($postData);
        // 直接调用M层方法，进行登录。
        if (User::login($postData['username'], $postData['password'])) {
            return $this->success('login success', url('user/index'));
        } else {
            return $this->error('username or password incorrent', url('index'));
        }

    }

    // 注销
    public function logOut()
    {
        if (User::logOut()) {
            return $this->success('logout success', url('index'));
        } else {
            return $this->error('logout error', url('index'));
        }
    }

    public  function test(){
        User::test();
    }
}
