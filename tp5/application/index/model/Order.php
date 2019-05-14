<?php
namespace app\index\model;
use think\Model;
use think\Cookie;
use think\Request;
class Order extends Model
{
    static public function insertOrder($userId,$insuranceId)
    {
        $order           = new Order;
        $order->userId     = $userId;
        $order->insuranceId    = $insuranceId;
        return $order->save();
    }
}