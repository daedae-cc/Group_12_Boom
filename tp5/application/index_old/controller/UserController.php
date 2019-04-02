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
use think\Url;

class UserController extends Controller
{

    // 获取用户数据列表并输出 version 1
//    public function index()
//    {
////        //1';
////        //for test use
////        return 'hello User
//
////        //2
////        // 获取教师表中的所有数据
////        $users = Db::name('User')->select();
////
////        // 查看获取的数据
////        var_dump($users);
//
////        //4
////        $user = new User;//User is the model object link to database(User)
////        $users = $user->select();
//
////        var_dump($users);
//        try {
//            $get_name = Request::instance()->get('name');
//
//            $pageSize = 5; // 每页显示5条数据
//
//            //实例化
//            $user = new User;
////            $users = $user->select();
//
//            if (!empty($get_name)) {
//                $user->where('name', 'like', '%' . $get_name . '%');
//            }
//
//            // 按条件查询数据并调用分页
//            $users = $user->paginate($pageSize, false, [
//                'query'=>[
//                    'name' => $get_name,
//                ],
//            ]);
//            // 向V层传数据
//            $this->assign('users', $users);
//            $this->assign('search_name',$get_name);
//
//            // 取回打包后的数据
//            $htmls = $this->fetch();
//
//            // 将数据返回给用户
//            return $htmls;
//        } catch (\Exception $e) {
//            // 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下代码的注释去掉。
////             throw $e;
//            return '系统错误' . $e->getMessage();
//
//        }

//        //3
//        $list = UserModel::all();
//        $this->assign('list', $list);
//        $this->assign('count', count($list));
//        return $this->fetch();
//    }
    //version 2
    public function index($result = '')
    {

        // 获取查询信息
        $get_name = Request::instance()->get('name');

        $pageSize = 5; // 每页显示5条数据

        // 实例化Teacher
        $user = new User;

        // 按条件查询数据并调用分页
        $users = $user->where('name', 'like', '%' . $get_name . '%')->paginate($pageSize, false, [
            'query' => [
                'name' => $get_name,
            ],
        ]);

        // 向V层传数据
        $this->assign('users', $users);
        $this->assign('result', $result);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    public function insert()
    {
//        //test url
//        return 'hello insert';

//        //test input
//        var_dump($_POST);
//        return ;    // 提前返回

        $message = '';  // 提示信息

        // Request::instance()返回了一个对象，调用这个对象的post()方法，得到post数据
        $postData = Request::instance()->post();
        // 实例化User空对象
//        $result = User::insertUser($postData);

        // 实例化User空对象
        $user = new User();

        $user->name = $postData['name'];
        $user->username = $postData['username'];
        $user->password = $postData['password'];
        $user->sex = $postData['sex'];
        $user->email = $postData['email'];

        // 新增对象至数据表
        $result = $user->validate(true)->save($user->getData());
        // 提示操作成功，并跳转至教师管理列表

        if($result){
            return $this->redirect('index',['result'=>true]);
        }
        else{
            return $this->error($user->getError());
        }
    }


    // 新增用户数据
    public
    function add()
    {
        try {
//        //test
//        return 'hello add';
            $htmls = $this->fetch();
            return $htmls;
        } catch (\Exception $e) {
//            throw $e;
            return '系统错误' . $e->getMessage();
        }
    }

    public
    function delete()
    {
        try {
            // 实例化请求类
            $Request = Request::instance();

            // 获取get数据
            $id = Request::instance()->param('id/d');

            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 获取要删除的对象
            $user = User::get($id);

            // 要删除的对象存在
            if (is_null($user)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$user->delete()) {
                return $this->error('删除失败:' . $user->getError());
            }


            // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

            // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        // 进行跳转
        return $this->success('删除成功', $Request->header('referer'));
//        return $this->success('删除成功', url('index'));
//        return $this->redirect(Url::build('@index/User/index'));

    }

    public
    function edit()
    {
        try {
            //        var_dump(Request::instance()->param());
            // 获取传入ID
            $param_id = Request::instance()->param('id/d');

            // 在User表模型中获取当前记录
            if (is_null($user = User::get($param_id))) {
                return '系统未找到ID为' . $param_id . '的记录';
            }

            // 将数据传给V层
            $this->assign('user', $user);

            // 获取封装好的V层内容
            $htmls = $this->fetch();

            // 将封装好的V层内容返回给用户
            return $htmls;// 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;
            // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public
    function update()
    {
//        var_dump(Request::instance()->post());
        try {
            // 接收数据，获取要更新的关键字信息
            $post_id = Request::instance()->post('id/d');
            $message = '更新成功';

            // 获取当前对象
            $user = user::get($post_id);

            if (!is_null($user)) {
                // 写入要更新的数据
                $user->name = Request::instance()->post('name');
                $user->username = Request::instance()->post('username');
                $user->sex = Request::instance()->post('sex/d');
                $user->email = Request::instance()->post('email');

                // 更新
                if (false === $user->validate(true)->save()) {
                    $message = '更新失败' . $user->getError();
                }
            } else {
                throw new \Exception("所更新的记录不存在", 1);   // 调用PHP内置类时，需要在前面加上 \
            }
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

            // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        }

//        return $message;
//        return $this->redirect(Url::build('@index/User/index'));
        return $this->success('操作成功', url('index'));
    }
}
