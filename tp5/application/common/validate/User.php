<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class User extends Validate
{
    protected $rule = [
        'username' => 'require|unique:user|length:4,25',
        'name'  => 'require|length:2,25',
        'sex' => 'in:0,1',
        'email' => 'email',
    ];
}