<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;


class SignInController extends Controller
{
    // 用户登录表单
    public function index()
    {
        // 显示登录表单
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('index_z');
        }
    }


    // 处理用户提交的登录数据
    public function test()
    {
        $postData = Request::instance()->post();
        return var_dump($postData);
    }

    public function signIn()
    {

        //get the input of user
        $postData = Request::instance()->post();

        if (User::signIn($postData['username'], $postData['password'])) {
            return $this->redirect(url('index/index/index'));
//            return $this->redirect(url('index/index/index'));
//            return $this->redirect(url('index/index/index'),['message'=>'','pass'=>'1']);
        } else {
//            return $this->redirect(url('index/SignIn/index'),['message'=>'username or password incorrect','pass'=>'0']);
//            return $this->error(url('index/SignIn/index'));
            return $this->error('username or password incorrent', url('index/signIn/index'));

        }
    }

    public function logOut()
    {
        if (User::logOut()) {
            return $this->redirect(url('index/index/index'));
        } else {
            return $this->error('logout error', url('index/index/index'));
        }
    }

    //用户名校验
    function checkNM($name)
    {
        //在数据库中根据条件查询结果
        $info = User::exist($name);
        if ($info) {
            echo "<span style='color:red'>
         用户名已存在，请换一个
         </span>";
        } else {
            echo "<span style='color:green'>
         恭喜，用户名可以使用
         </span>";
        }
        exit;
    }


    public function signIn_old()
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

        // 直接调用M层方法，进行登录。
        if (User::signIn($postData['username'], $postData['password'])) {
            return $this->success('login success', url('user/index'));
        } else {
            return $this->error('username or password incorrent', url('index'));
        }

    }
    public function changeLanguage($lang = 1)
    {
        User::setLanguage($lang);
//        return $lang;
        $this->redirect("index/signIn/index");
    }
}
