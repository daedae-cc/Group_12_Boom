<?php
/**
 * Created by PhpStorm.
 * User: wxhke
 * Date: 2019/4/3
 * Time: 23:23
 */

namespace app\index\model;

use think\Model;
use think\Cookie;
use think\Request;

class Loss extends Model
{
    static public function insertLoss($postDate)
    {
        $loss = new Loss($postDate);
        $session = Request::instance()->session();
        $loss->allowField(true);
        $loss->userId = $session['userId'];
       $result =  $loss->save();
        return $result;

    }
}