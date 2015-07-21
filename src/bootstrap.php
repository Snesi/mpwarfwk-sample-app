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
        'cache' => __DIR__.'/cache/views',
    ));
}

function initSmarty() {
    $smarty = new Smarty();
    $smarty->setTemplateDir(__DIR__.'/views');
    $smarty->setCompileDir(__DIR__.'/views/compiled');
    $smarty->setConfigDir(__DIR__.'/config');
    $smarty->setCacheDir(__DIR__.'/cache/views');
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

$strings = require_once __DIR__."/locale/strings.php";

//$locale = new \MPWAR\i18n\Locale($strings);

// ------------------------------------------------
// Uncomment to use Smarty as your templating engine.
// ------------------------------------------------
// $smarty = initSmarty();
// $templateEngine = new \MPWAR\Templating\SmartyAdapter($smarty);

// // Set language to Spanish
// putenv('LC_ALL=es_ES');
// setlocale(LC_ALL, 'es_ES');
//
// // Specify the location of the translation tables
// bindtextdomain('messages', __DIR__.'/locale');
// bind_textdomain_codeset('messages', 'UTF-8');
//
// // Choose domain
// textdomain('messages');

$twig = initTwig();
//$twig->addExtension(new Twig_Extensions_Extension_I18n());
$templateEngine = new \MPWAR\Templating\TwigAdapter($twig);

$app = new \MPWAR\AppKernel($routing, $templateEngine, $strings);

if(\MPWAR\AppConfig::debug()) {
    return new \MPWAR\Debugger($app);
} else {
    return $app;
}
