<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\User;
use app\index\model\Order;

class InsuranceController extends IsSignInController
{
    public function index()
    {
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);

        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('index_z');
        }
    }

    public function payFor($insuranceId = 0)
    {
        //check login

        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        $this->assign("insuranceId", $insuranceId);
        if (session("language") == 1) {
            return $this->fetch();
        } else {
            return $this->fetch('pay_for_z');
        }
    }

    public function insertOrder($insuranceId)
    {

        $userId = session("userId");
        $result = Order::insertOrder($userId, $insuranceId);


        return $this->success("Pay for success", url('index/index/index'));
    }

    public function changeLanguage($lang = 1)
    {
        User::setLanguage($lang);
        $this->redirect("index/insurance/index");
    }

    public function changeLanguageP($lang = 1)
    {
        User::setLanguage($lang);
        $this->redirect("index/insurance/payFor");
    }

}
