<?php

namespace app\controllers;

use app\model\Orders;
use app\model\Users;

class OrdersController extends Controller
{
    public function actionOrders()
    {
        $id = $_SESSION['id'];

        // проверяю адимн пользователь или нет
        if (isset($id)) {
            $is_admin = Users::getOne($id)->is_admin();
        } else {
            $is_admin = false;
        }

        //если админ вывожу все заказы, если пользователь только заказы пользователя
        if($is_admin){
            $orders = Orders::getAll();
        }else{
            $orders = Orders::getAllOrders($id);
        }

        echo $this->renderLayouts("orders", [
            "orders" => $orders,
            "is_admin"=>$is_admin
        ]);
    }

    public function actionOrder()
    {
        $id = $_GET["id"];
        $order = Orders::getOneArray($id);

        echo $this->renderLayouts("order", [
            "order" => $order
        ]);
    }
}
