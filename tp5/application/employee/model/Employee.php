<?php
/**
 * Created by PhpStorm.
 * Employee: wxhke
 * Date: 2019/4/4
 * Time: 4:31
 */

namespace app\employee\Model;

use think\Model;
use think\Request;

class Employee extends Model
{
    static public function signIn($username, $password)
    {
        // 验证用户是否存在
        //查询语句
        $employee = Employee::get(['username' => $username]);
        if (!is_null($employee)) {
            // 验证密码是否正确
//            if ($user->checkPassword($password)) {
            if ($employee->getData('password') == $password) {
                // 登录
                session('employeeId', $employee->getData('id'));
//                cookie('employeeId', $employee->getData('id'));
                return true;
            }
        }
        return false;
    }

    static public function exist($username)
    {
        $employee = Employee::get(['username' => $username]);
        if (!is_null($employee)) {
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
}