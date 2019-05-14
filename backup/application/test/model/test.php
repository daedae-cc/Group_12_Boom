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

class Test extends Model
{
    //this is teh dastabase operater
    public function insert($postData)
    {
        //with the $postData
        $test= new Test($postData);
        return $test->allowField(true)->save();


    }
}