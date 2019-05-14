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
        if (session('language') != 1 && session('language') != 2) {
            User::setLanguage();
        }
        //check login
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        //output page
        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('index_z');
        }
    }

    public function about()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('about_z');
        }
    }

    public function contact()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('contact_z');
        }
    }


    public function test()
    {
        return var_dump(User::get(1));
    }

    public function changeLanguage($lang = 1)
    {
        User::setLanguage($lang);
        $this->redirect("index/index/index");
    }
    public function changeLanguageA($lang = 1)
    {
        User::setLanguage($lang);
        $this->redirect("index/index/about");
    }
    public function changeLanguageC($lang = 1)
    {
        User::setLanguage($lang);
        $this->redirect("index/index/contact");
    }
}
