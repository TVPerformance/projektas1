<?php

namespace Mano;
use Mano\Controllers\Calculator;
use Mano\Controllers\Grybas;

class App {

    public static function start()
    {
      $url = explode('/', $_SERVER['REQUEST_URI']);
      array_shift($url);
      return self::router($url);
    }

    private static function router(array $url)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($url[0] == 'calculator' && in_array($url[1], ['sum', 'diff', 'mult', 'div']) && count($url) == 4){
         return (new Calculator)->{$url[1]}($url[2], $url[3]);
        }
        
        if($url[0] == 'grybai' && count($url) == 1 && $method == 'GET') {
          return (new Grybas)->index();
        }

        return '404 NOT FOUND';
    }

    public static function view(string $_name, array $data)
    {
      ob_start();

      extract($data);

      require __DIR__ . '/../view/top.php';

      require __DIR__ . '/../view/'.$_name.'.php';

      require __DIR__ . '/../view/bottom.php';

      $out = ob_get_contents();
      ob_end_clean();

      return $out;
    }
}