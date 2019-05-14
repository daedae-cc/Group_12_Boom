<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
use app\index\model\Order;
class InsuranceController extends IsSignInController
{
    public function index(){
        return $this->fetch();
    }
    public function purchase(){
        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);

        return $this->fetch();
    }

    public function payFor($insuranceId=0){
        //check login

        $isLogin = User::isLogin();
        //send information
        $this->assign("isLogin", $isLogin);
        $this->assign("insuranceId", $insuranceId);
        return $this->fetch();
    }

    public function insertOrder($insuranceId){

        $userId=session("userId");
        $result = Order::insertOrder($userId,$insuranceId);


        return $this->success("Pay for success", url('index/index/index'));
    }
}
