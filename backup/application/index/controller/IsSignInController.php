<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/4
 * Time: 5:16
 */

namespace app\index\controller;


use app\index\model\User;
use think\Controller;

class IsSignInController extends Controller
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        // 验证用户是否登陆
        if (!User::isLogin()) {
            return $this->error('please login first', url('index/signIn/index'));
        }
    }

    public function index()
    {
    }

}