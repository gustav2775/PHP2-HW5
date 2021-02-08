<?php

namespace app\engine ;

use app\interfaces\IRender;

class TwigRender implements IRender
{
    static public function renderVeiws($template, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../viewTwig/');

        $twig = new \Twig\Environment($loader, [
            'debug'=>true
        ]);
        echo $twig->render($template.'.twig', $params);
    }
}
