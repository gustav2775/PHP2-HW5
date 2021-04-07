<?php

namespace app\engine;

require_once '../vendor/autoload.php';

use app\interfaces\IRender;

class TwigRender implements IRender
{
    public static $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../viewTwig/');

        self::$twig = new \Twig\Environment($loader, [
            'debug' => true
        ]);
    }
    public static function renderVeiws($template, $params = [])
    {
        echo static::$twig->render($template . '.twig', $params);
    }
}
