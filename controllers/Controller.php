<?php

namespace app\controllers;

use app\interfaces\{ILogin, IRender, IMenu};

class Controller
{
    private $defaultLayouts = "index";
    protected $render;
    protected $menu;
    protected $login;

    public function __construct(IRender $render, IMenu $menu, ILogin $login)
    {
        $this->render = $render;
        $this->menu = $menu;
        $this->login = $login;
    }

    public function renderLayouts($template, $params = [])
    {

        return $this->render::renderVeiws(LAYOUTS . $this->defaultLayouts, [
            'login' => $this->render::renderVeiws('login', [
                'user' => $this->login->user,
                'auth' => $this->login->auth
            ]),
            'menu' => $this->render::renderVeiws('menu', [
                "menu" => $this->menu->menu
            ]),
            'content' => $this->render::renderVeiws($template, $params)
        ]);
    }
}
