<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/4
 * Time: 4:20
 */

namespace app\employee\controller;


use think\Controller;
use app\index\Model\User;
class WorkController extends Controller
{
    public function index(){
        $user = new User();
        $users = $user->select();
        $this->assign('users', $users);
        // 取回打包后的数据
        return $this->fetch();
    }
    public function showUser(){

    }
}