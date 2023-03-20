<?php

namespace Mano;
use Mano\Controllers\Calculator;
use Mano\Controllers\Grybas;
use Mano\Controllers\GrybasApi;
use Mano\Controllers\Api;

use function PHPSTORM_META\map;

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

        if($url[0] == 'grybai' && $url[1] == 'create' && count($url) == 2 && $method == 'GET') {
          return (new Grybas)->create();
        }

        if($url[0] == 'grybai' && $url[1] == 'save' && count($url) == 2 && $method == 'POST') {
          return (new Grybas)->save();
        }

        if($url[0] == 'grybai' && $url[1] == 'edit' && count($url) == 3 && $method == 'GET') {
          return (new Grybas)->edit($url[2]);
        }

        if($url[0] == 'grybai' && $url[1] == 'update' && count($url) == 3 && $method == 'POST') {
          return (new Grybas)->update($url[2]);
        }

        if($url[0] == 'grybai' && $url[1] == 'delete' && count($url) == 3 && $method == 'POST') {
          return (new Grybas)->delete($url[2]);
        }

        if($url[0] == 'users' && $url[1] == 'all' && count($url) == 2 && $method == 'GET') {
          return (new Api)->allUsers($url[1]);
        }

        if($url[0] == 'users' && $url[1] == 'js' && count($url) == 2 && $method == 'GET') {
          return (new Api)->jsUsers($url[1]);
        }

        // Grybas API

        if($url[0] == 'api' && $url[1] == 'grybai' && count($url) == 2 && $method == 'GET') {
          return (new GrybasApi)->index();
        }

        if($url[0] == 'grybai' && $url[1] == 'create' && count($url) == 2 && $method == 'GET') {
          return (new Grybas)->create();
        }

        if($url[0] == 'grybai' && $url[1] == 'save' && count($url) == 2 && $method == 'POST') {
          return (new Grybas)->save();
        }

        if($url[0] == 'grybai' && $url[1] == 'edit' && count($url) == 3 && $method == 'GET') {
          return (new Grybas)->edit($url[2]);
        }

        if($url[0] == 'grybai' && $url[1] == 'update' && count($url) == 3 && $method == 'POST') {
          return (new Grybas)->update($url[2]);
        }

        if($url[0] == 'grybai' && $url[1] == 'delete' && count($url) == 3 && $method == 'POST') {

         // print_r($url[2]);
          return (new Grybas)->delete($url[2]);
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

    // public static function url($url)
    // {
    //   return 'http://mano.lt/' . $url;
    // }

    public static function redirect($url)
    {
      header('Location: ' . URL . $url);
      return null;
    }
}