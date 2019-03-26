<?php

namespace app\index\controller;

use think\Db;

class Index
{
    public function index()
    {
        $result = Db::execute('delete from think_data where id = 5 ');
        dump($result);
        return $result;
    }
}
