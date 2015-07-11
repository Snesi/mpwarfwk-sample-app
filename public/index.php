<?php
$app = require_once __DIR__ . "/../src/bootstrap.php";

$request = MPWAR\IOManager::captureHttpRequest();

$response = $app->handle($request);

MPWAR\IOManager::sendHttpResponse($response);
