<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/2
 * Time: 13:50
 */

namespace app\index\model;

use think\Model;
use think\Request;

class User extends Model
{

    /**
     * 用户登录
     * @param  string $username username
     * @param  string $password password
     * @return bool  Username and password match：true
     *               Username and password not match：false
     */
    static public function signIn($username, $password)
    {
        // 验证用户是否存在
        //查询语句
        $user = User::get(['username' => $username]);
        if (!is_null($user)) {
            // 验证密码是否正确
//            if ($user->checkPassword($password)) {
            if ($user->getData('password') == $password) {
                // 登录
                session('userId', $user->getData('id'));
//                cookie('userId', $user->getData('id'), 3000);
                return true;
            }
        }
        return false;
    }

    static public function exist($username)
    {
        $user = User::get(['username' => $username]);
        if (!is_null($user)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 验证密码是否正确
     * @param  string $password 密码
     * @return bool
     */
    public function checkPassword($password)
    {
        if ($this->getData('password') === $this::encryptPassword($password)) {
            return true;
        } else {
            return false;
        }
    }


    static public function insertUser($postData)
    {
        $user = new User($postData);
        return $user->allowField(true)->save();
    }

    static public function findUser()
    {
        $id = Request::instance()->session("userId");
        $user = User::get($id);
        return $user;
    }

    static public function updateUser($postData)
    {

        $id = Request::instance()->session("userId");

        $user = new User();

// 过滤post数组中的非数据表字段数据
        $result=  $user->allowField(true)->save($postData,['id' => $id]);
        return $result ;


    }

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

    /**
     * 注销
     * @return bool  成功true，失败false。
     * @author panjie
     */
    static public function logOut()
    {
        // 销毁session中数据
        session('userId', null);
        return true;
    }

}