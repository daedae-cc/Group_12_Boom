<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/2
 * Time: 13:50
 */

namespace  app\index\model;
use think\Model;
class User extends Model{

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
}