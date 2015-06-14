<?php
$app = require_once __DIR__ . "/../bootstrap.php";

$request = MPWAR\IOManager::captureHttpRequest();

$response = $app->handle($request);

$response->send();

MPWAR\IOManager::cacheHttpResponse($request, $response);