<?php

namespace app\interfaces;

interface IRender {
   public static function renderVeiws($template, $params = []);
}