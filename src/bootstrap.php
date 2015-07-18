<?php

function dd($arg)
{
    die(var_dump($arg));
}

function initEnvironment()
{
    $envRawJson = file_get_contents(__DIR__.'/.env');
    $envArray = json_decode($envRawJson);
    foreach ($envArray as $env => $value) {
        putenv("$env=$value");
    }
}

function initTwig() {
    $loader = new Twig_Loader_Filesystem(__DIR__.'/views');
    return new Twig_Environment($loader, array(
        'cache' => __DIR__.'/views/cache',
    ));
}

function initSmarty() {
    $smarty = new Smarty();
    $smarty->setTemplateDir(__DIR__.'/views');
    $smarty->setCompileDir(__DIR__.'/views/compiled');
    $smarty->setConfigDir(__DIR__.'/config');
    $smarty->setCacheDir(__DIR__.'/views/cache');
    //** un-comment the following line to show the debug console
    //$smarty->debugging = true;
    return $smarty;
}

initEnvironment();

require __DIR__.'/../vendor/autoload.php';
require_once __DIR__."/config/app.php";
require_once __DIR__."/config/database.php";

require_once 'routes.php';

$routing = new \MPWAR\Routing\Routing();

// ------------------------------------------------
// Uncomment to use Smarty as your templating engine.
// ------------------------------------------------
// $smarty = initSmarty();
// $templateEngine = new \MPWAR\Templating\SmartyAdapter($smarty);

$twig = initTwig();

$templateEngine = new \MPWAR\Templating\TwigAdapter($twig);

$app = new \MPWAR\AppKernel($routing, $templateEngine);

if(\MPWAR\AppConfig::debug()) {
    return new \MPWAR\Debugger($app);
} else {
    return $app;
}
