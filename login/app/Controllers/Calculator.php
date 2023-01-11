<?php

namespace Mano\Controllers;

class Calculator {


    public function add($a, $b)
    {
       return $a + $b;
    }

    public function diff($a, $b)
    { 
       return $a - $b;
    }

    public function mult($a, $b)
    {
       return $a * $b;
    }

    public function div($a, $b)
    {
       return $a / $b;
    }
}