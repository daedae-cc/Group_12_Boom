<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/3/26
 * Time: 17:38
 */

namespace app\index\controller;

use app\index\model\User;
use think\Controller;
use think\Db;
use think\Request;

class UserController extends Controller
{
    // 获取用户数据列表并输出
    public function index()
    {
//        //1';
//        //for test use
//        return 'hello Teacher

//        //2
//        // 获取教师表中的所有数据
//        $users = Db::name('user')->select();
//
//        // 查看获取的数据
//        var_dump($users);

//        //4
//        $user = new User;//User is the model object link to database(user)
//        $users = $user->select();
//        var_dump($users);

        $user = new User;
        $users = $user->select();

        // 向V层传数据
        $this->assign('users', $users);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;

//        //3
//        $list = UserModel::all();
//        $this->assign('list', $list);
//        $this->assign('count', count($list));
//        return $this->fetch();
    }

    public function insert()
    {
//        //test url
//        return 'hello insert';

//        //test input
//        var_dump($_POST);
//        return ;    // 提前返回


        // Request::instance()返回了一个对象，调用这个对象的post()方法，得到post数据
        $postData = Request::instance()->post();
        // 实例化Teacher空对象
        $user = new User();

        $user->name = $postData['name'];
        $user->username = $postData['username'];
        $user->sex = $postData['sex'];
        $user->email = $postData['email'];

        // 新增对象至数据表
        $result = $user->validate(true)->save($user->getData());

        // 反馈结果
        if (false === $result) {
            return '新增失败:' . $user->getError();
        } else {
            return '新增成功。新增ID为:' . $user->id;
        }

    }


    // 新增用户数据
    public function add()
    {
//        //test
//        return 'hello add';
        $htmls = $this->fetch();
        return $htmls;
    }


    public function addList()
    {
        $user = new UserModel;
        $list = [
            ['nickname' => '张三', 'email' => 'zhanghsan@qq.com', 'birthday' => strtotime('1988-01-15')],
            ['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-09-19')],
        ];
        if ($user->saveAll($list)) {
            return '用户批量新增成功';
        } else {
            return $user->getError();
        }
    }

    // 读取用户数据
    public function read1($id = '')
    {
        $user = UserModel::get($id);
        echo $user->nickname . '<br/>';
        echo $user->email . '<br/>';
        echo date('Y/m/d', $user->birthday) . '<br/>';
    }

// 根据email读取用户数据
    public function read2()
    {
        $user = UserModel::getByEmail('thinkphp@qq.com');
        echo $user->nickname . '<br/>';
        echo $user->email . '<br/>';
        echo date('Y/m/d', $user->birthday) . '<br/>';
    }

    public function read($id = '')
    {
        $list = UserModel::all();
        return view('read', ['list' => $list]);
    }

    // 获取用户数据列表
    public function all()
    {
        $list = UserModel::all();
        foreach ($list as $user) {
            echo $user->nickname . '<br/>';
            echo $user->email . '<br/>';
            echo date('Y/m/d', $user->birthday) . '<br/>';
            echo '----------------------------------<br/>';
        }
    }


}
