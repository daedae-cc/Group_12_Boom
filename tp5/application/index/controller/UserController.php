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

class UserController extends IsSignInController
{
    public function index()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        $user = User::findUser();
        $this->assign('user', $user);
        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('index_z');
        }
    }

    public function edit()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);

        $user = User::findUser();
        // 将数据传给V层
        $this->assign('user', $user);

        // 获取封装好的V层内容

        // 将封装好的V层内容返回给用户
        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('edit_z');
        }
    }

    public function update()
    {
        $postData = Request::instance()->post();
        User::updateUser($postData);
        return $this->redirect("index/user/index");
//        return var_dump(User::updateUser($postData));
    }

    public function changeLanguage($lang = 1)
    {
        User::setLanguage($lang);
        $this->redirect("index/user/index");
    }

    public function changeLanguageE($lang = 1)
    {
        User::setLanguage($lang);
        $this->redirect("index/user/edit");
    }

}