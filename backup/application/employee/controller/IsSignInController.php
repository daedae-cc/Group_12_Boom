<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/4
 * Time: 5:16
 */

namespace app\employee\controller;


use app\employee\model\Employee;
use app\index\model\User;
use think\Controller;

class IsSignInController extends Controller
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        // 验证用户是否登陆
        if (!Employee::isLogin()) {
            return $this->error('please login first', url('employee/index/index'));
        }
    }

    public function index()
    {
    }

}