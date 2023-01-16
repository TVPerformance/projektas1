<?php

use Mano\App;

define('URL', 'http://mano.lt/');

require __DIR__ . '/../vendor/autoload.php';


$response = App::start();
echo $response;