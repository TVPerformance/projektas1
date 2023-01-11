<?php

use Mano\App;

require __DIR__ . '/../vendor/autoload.php';


$response = App::start();
echo $response;