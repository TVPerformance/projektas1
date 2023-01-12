<?php

namespace Mano\Controllers;
use Mano\App;
use Mano\DB\FileReader as FR;

class Grybas {

    public function index()
    {

    $grybai = (new FR('grybai'))->showAll();
    $pageTitle = 'Grybai | Sarasas';
    return App::view('Grybas-list', compact('grybai', 'pageTitle'));

    }
}