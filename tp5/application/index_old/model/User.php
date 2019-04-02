<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/3/26
 * Time: 17:40
 */

namespace app\index\model;

use think\Model;
use think\Request;

class User extends Model
{
    /**
     * 用户登录
     * @param  string $username 用户名
     * @param  string $password 密码
     * @return bool  成功返回true，失败返回false。
     */
    static public function login($username, $password)
    {
        // 验证用户是否存在
        $map = array('username' => $username);
        $user = self::get($map);

        if (!is_null($user)) {
            // 验证密码是否正确
            if ($user->checkPassword($password)) {
                // 登录
                session('teacherId', $user->getData('id'));
                return true;
            }
        }
        return false;
    }

    /**
     * 验证密码是否正确
     * @param  string $password 密码
     * @return bool
     */
    public function checkPassword($password)
    {
        if ($this->getData('password') === $this::encryptPassword($password))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 密码加密算法
     * @param    string                   $password 加密前密码
     * @return   string                             加密后密码
     * @author panjie@yunzhiclub.com http://www.mengyunzhi.com
     * @DateTime 2016-10-21T09:26:18+0800
     */
    static public function encryptPassword($password)
    {
        if (!is_string($password)) {
            throw new \RuntimeException("传入变量类型非字符串，错误码2", 2);
        }

        // 实际的过程中，我还还可以借助其它字符串算法，来实现不同的加密。
        return sha1(md5($password) . 'mengyunzhi');
    }

    public static function test()
    {
        echo User::encryptPassword('aaaa');
    }

    /**
     * 注销
     * @return bool  成功true，失败false。
     * @author panjie
     */
    static public function logOut()
    {
        // 销毁session中数据
        session('teacherId', null);
        return true;
    }

    /**
     * 判断用户是否已登录
     * @return boolean 已登录true
     * @author  panjie <panjie@yunzhiclub.com>
     */
    static public function isLogin()
    {
        $userId = session('userId');

        // isset()和is_null()是一对反义词
        if (isset($userId)) {
            return true;
        } else {
            return false;
        }
    }

    static public function insertUser($postData){
        //test url
//        return 'hello insert';

//        //test input
//        var_dump($_POST);
//        return ;    // 提前返回

        $message = '';  // 提示信息

            // Request::instance()返回了一个对象，调用这个对象的post()方法，得到post数据

            // 实例化User空对象
            $user = new User();

            $user->name = $postData['name'];
            $user->username = $postData['username'];
            $user->password = $postData['password'];
            $user->sex = $postData['sex'];
            $user->email = $postData['email'];

            // 新增对象至数据表
            $result = $user->validate(true)->save($user->getData());
//        $result= $user->save($user->getData());
           return  $result;
    }


}
