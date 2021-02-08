<?php

namespace app\controllers;

use app\model\Basket;

class BasketController extends Controller
{
    public function actionBasket()
    {
        $id_session = $_SESSION['id'];
        $basket = Basket::getAlltoId($id_session);
        var_dump($basket);
        echo $this->renderLayouts("basket", [
            "basket" => $basket
        ]);
    }
}
