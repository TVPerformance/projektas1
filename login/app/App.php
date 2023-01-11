<?php

namespace Mano;
use Mano\Controllers\Calculator;

class App {

    public static function start()
    {
      $url = explode('/', $_SERVER['REQUEST_URI']);
      array_shift($url);
      return self::router($url);
    }

    private static function router(array $url)
    {
        if($url[0] == 'calculator' && in_array($url[1], ['add', 'diff', 'mult', 'div']) && count($url) == 4){
         return (new Calculator)->{$url[1]}($url[2], $url[3]);
        }
    }
}