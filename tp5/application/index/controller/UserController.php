<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/2
 * Time: 13:48
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Url;
use app\index\model\User;

class UserController extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function profile()
    {
        $user = User::findUser();
        $this->assign('user', $user);
        return $this->fetch();
    }

    public function edit()
    {

        $user= User::findUser();
        // 将数据传给V层
        $this->assign('user',$user);

        // 获取封装好的V层内容

        // 将封装好的V层内容返回给用户
        return $this->fetch();
    }

    public function update(){
        $postData = Request::instance()->post();
       User::updateUser($postData);
        return  $this->redirect("index/user/profile");
    }
}