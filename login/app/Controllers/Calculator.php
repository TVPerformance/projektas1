<?php

namespace Mano\Controllers;
use Mano\App;

class Calculator {


    public function sum($a, $b)
    {
       $result = $a + $b;
       $pageTitle = 'Calculator | Sum';
      // return App::view('calculator', ['result' => $result]);
       return App::view('calculator', compact('result', 'pageTitle'));
    }

    public function diff($a, $b)
    { 
      $result = $a - $b;
      $pageTitle = 'Calculator | Diff';
      return App::view('calculator_diff', compact('result', 'pageTitle'));
    }

    public function mult($a, $b)
    {
      $result = $a * $b;
      $pageTitle = 'Calculator | Mult';

      return App::view('calculator', compact('result', 'pageTitle'));
    }

    public function div($a, $b)
    {
      $result = $a / $b;
      $pageTitle = 'Calculator | Div';

      return App::view('calculator', compact('result', 'pageTitle'));
    }
}