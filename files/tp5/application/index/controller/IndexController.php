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
 
        $isLogin=User::isLogin();
        $this->assign("isLogin",$isLogin);
        return $this->fetch();
    }

    public function about(){
        return $this->fetch();
    }

    public function contact(){
        return $this->fetch();
    }
    public function test(){
        return var_dump(User::get(1));
    }
}
