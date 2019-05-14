<?php

//this is the model for controller

//need namespace that as same as direction
namespace app\test\controller;

//use other module class
use think\Controller;
use app\index\model\User;

//name and extend
class IndexController extends Controller
{
    //this is the action, url: test/index/index to use
    public function index()
    {
        $v = 123456;
        //assign data to page
        $this->assign("v", $v);
        //output page
        return $this->fetch();//now see view index/index
    }

    public function database()
    {

    }

    //redirection with url
    public function tRedirection()
    {
        $page = 'redirection';
        $this->assign("page", $page);

        return $this->fetch('test@index/show');//use different module
//        return $this->fetch('show');//ues same controller
//        return $this->fetch('index/show');//templete
    }


    //database part
    public function databaseInsert()
    {
        $postData = Request::instance()->post();
        $result = Test::insert($postData);
        return $result;
    }

    public function databaseDelete()
    {

    }

    public function databaseUpdate()
    {

    }

    public function databaseSelect()
    {

    }
}
