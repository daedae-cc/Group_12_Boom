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

    public function test(){
        $postData = Request::instance()->post();
        return var_dump($postData);
    }

    public function signUp(){
        $postData = Request::instance()->post();

        if(User::exist($postData["username"])){
            return $this->error('username exist', url('index/signIn/index'));
        }
        else{
            if($postData["password"] == $postData["confirmPassword"]){
                $result = User::insertUser($postData);


                if($result==0){
                    return $this->error('sign up fail', url('index/signIn/index'));
                }
                else{
                    $user = User::get(['username' => $postData["username"]]);
                    session('userId', $user->getData('id'));
//                    signIn($postData["username"], $postData["password"]);
                    return $this->success("success sign up and auto sign in",url('index/index/index'));
                }
            }
            else{
                return $this->error('password not the same', url('index/signIn/index'));
            }
        }
    }

    public function emailVerification(){
        return  $this ->fetch();
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


}
