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
use app\index\model\User;
use employee\model\employee;

class WorkController extends IsSignInController
{
    public function index()
    {

        $pageSize = 10; // 每页显示5条数据

        $user = new User();
        $users = $user->paginate($pageSize);
        $this->assign('users', $users);


        // 取回打包后的数据
        return $this->fetch();
    }

    public function showNewLoss()
    {
        $name = Request::instance()->get('name');
        $pageSize = 10; // 每次显示5条数据
        $loss = new Loss;
        $loss->where('status', '=', '0');        // 调用分页
        if (!empty($name)) {
            $loss->where('name', 'like', '%' . $name . '%');
        }
        $losses = $loss->paginate($pageSize);
        $this->assign('losses', $losses);
        return $this->fetch();
    }

    public function showProcessLoss()
    {
        $name = Request::instance()->get('name');
        $pageSize = 10; // 每次显示5条数据
        $loss = new Loss;
        $loss->where('status', '=', '1');        // 调用分页
        if (!empty($name)) {
            $loss->where('name', 'like', '%' . $name . '%');
        }
        $losses = $loss->paginate($pageSize);
        $this->assign('losses', $losses);
        return $this->fetch();
    }

    public function showFinishLoss()
    {
        // 定制查询信息
        $name = Request::instance()->get('name');
        $pageSize = 10; // 每次显示5条数据
        $loss = new Loss;
        $loss->where('status', '=', '2');        // 调用分页
        if (!empty($name)) {
            $loss->where('name', 'like', '%' . $name . '%');
        }
        $losses = $loss->paginate($pageSize);
        $this->assign('losses', $losses);
        return $this->fetch();
    }

    public function lossDetail($id)
    {
        $loss = Loss::get($id);
        $this->assign('loss', $loss);
        return $this->fetch();
    }


    public function userDetail($id)
    {
        $user = User::find($id);
        $this->assign('user', $user);
        return $this->fetch();
    }


    public function finishLoss($id)
    {
//        return $id;
        $serverData = Request::instance()->server();
        $postData = Request::instance()->post();
//        return $postData;
        //update the form from 0->2
        Loss::updateLossToFinish($id, $postData['pay']);
        return $this->redirect(url('employee/work/showProcessLoss'));
    }

    public function processLoss($id)
    {
        Loss::updateLossToProcess($id);
        return $this->redirect(url('employee/work/showProcessLoss'));
    }

    public function addProcessLoss($id)
    {
        Loss::updateLossToProcess($id);
        return $this->redirect(url('employee/work/showNewLoss'));
    }

}