<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/4
 * Time: 4:20
 */

namespace app\employee\controller;

use think\Request;
use app\index\model\Loss;
use think\Controller;
use app\index\Model\User;

class WorkController extends Controller
{
    public function index()
    {
        $pageSize = 5; // 每页显示5条数据

        $user = new User();
        $users = $user->paginate($pageSize);
        $this->assign('users', $users);
        // 取回打包后的数据
        return $this->fetch();
    }

    public function pending()
    {
        $name = Request::instance()->get('name');
        $pageSize = 5; // 每次显示5条数据
        $loss = new Loss;
        $loss->where('status', '=', '0');        // 调用分页
        if (!empty($name)) {
            $loss->where('name', 'like', '%' . $name . '%');
        }
        $losses = $loss->paginate($pageSize);
        $this->assign('losses', $losses);
        return $this->fetch();
    }

    public function processing()
    {
        $name = Request::instance()->get('name');
        $pageSize = 5; // 每次显示5条数据
        $loss = new Loss;
        $loss->where('status', '=', '1');        // 调用分页
        if (!empty($name)) {
            $loss->where('name', 'like', '%' . $name . '%');
        }
        $losses = $loss->paginate($pageSize);
        $this->assign('losses', $losses);
        return $this->fetch();
    }

    public function done()
    {
        // 定制查询信息
        $name = Request::instance()->get('name');
        $pageSize = 5; // 每次显示5条数据
        $loss = new Loss;
        $loss->where('status', '=', '2');        // 调用分页
        if (!empty($name)) {
            $loss->where('name', 'like', '%' . $name . '%');
        }
        $losses = $loss->paginate($pageSize);
        $this->assign('losses', $losses);
        return $this->fetch();
    }
}