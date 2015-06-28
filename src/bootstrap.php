<?php
require __DIR__ . "/../vendor/autoload.php";

$routes = require_once "routes.php";

$routing = new \MPWAR\Routing($routes);

$app = new \MPWAR\AppKernel($routing);

return $app;
