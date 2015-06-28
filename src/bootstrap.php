<?php

function dd($arg) {
	die(var_dump($arg));
}

require __DIR__ . "/../vendor/autoload.php";
require_once "routes.php";

$routing = new \MPWAR\Routing\Routing();

$app = new \MPWAR\AppKernel($routing);

return $app;
