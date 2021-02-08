<?php

session_start();

include_once "../config/config.php";

include_once "../engine/Autoload.php";

require_once '../vendor/autoload.php';

use app\engine\{Autoload,DefaultRender, TwigRender};
use app\controllers\{MenuController,AuthController};

spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET["c"] ?: "index";
$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . "Controller";

$actionName = $_GET["a"] ?: $controllerName;
$actionMethod = "action" . ucfirst($actionName);

if (class_exists($controllerClass)) {
    $controllerClass = new $controllerClass(new TwigRender(),new MenuController(),new AuthController());
    if (method_exists($controllerClass, $actionMethod)) {
        $controllerClass->$actionMethod();
    } else {
        die("Такого метода не существует");
    }
} else {
    die("Такой страницы не существует");
}

