<?php

namespace  app\controllers;

use app\interfaces\IMenu;

use app\model\Menu;

class MenuController extends Controller implements IMenu
{
    public $menu;

    public  function __construct()
    {
        $this->menu = $this->renderMenu();
    }

    public  function renderMenu()
    {
        return Menu::renderMenu();
        // echo $this->renderLayouts('menu',['menu'=>$menu]) ;
    }
}
