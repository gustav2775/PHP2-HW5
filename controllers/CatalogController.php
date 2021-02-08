<?php

namespace app\controllers;

use app\model\Catalog;
use app\model\Users;
use app\model\Feedback;

class CatalogController extends Controller
{
    public function actionCatalog()
    {
        $page = $_GET['page'] ?: 10;
        $catalog = Catalog::getAllLimit($page);

        $id = $_SESSION['id'];
        if ($id) {
            $is_admin = Users::getOne($id)->is_admin();
        } else {
            $is_admin = false;
        }

        echo $this->renderLayouts("catalog", [
            "catalog" => $catalog,
            'page' => $page,
            'is_admin' => $is_admin
        ]);
    }

    public function actionProduct()
    {
        $id = $_GET["id"];
        $catalog = Catalog::getOneArray($id);
        $feedback = Feedback::getAlltoId($id);

        echo $this->renderLayouts("product", [
            "item" => $catalog,
            "feedback" => $feedback
        ]);
    }

    public function actionSave()
    {
        $id = $_GET['id'];
        $catalog = new Catalog;

        if (isset($id)) {
            $catalog = Catalog::getOne($id);
            $keys = array_keys($_POST);
            foreach ($keys as $key) {
                $catalog->$key = $_POST[$key];
            }
            $catalog->update();
            header("location:/?c=catalog&a=product&id=$id");
        } else {
            $catalog = new Catalog($_POST['name'], $_POST['price'], $_POST['description']);
            $catalog->insert();
            header("location:/?c=catalog");
        }
    }

    public function actionDelete()
    {
        $catalog = Catalog::getOne($_GET['id']);
        $catalog->delete();

        header("location:/?c=catalog");
    }
}
