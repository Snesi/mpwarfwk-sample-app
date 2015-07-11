<?php

function dd($arg)
{
    die(var_dump($arg));
}

require __DIR__.'/../vendor/autoload.php';
require_once 'routes.php';

$routing = new \MPWAR\Routing\Routing();

// Uncomment to use Smarty as your templating engine.
// $smarty = new Smarty();
// $smarty->setTemplateDir(__DIR__.'/views');
// $smarty->setCompileDir(__DIR__.'/views/compiled');
// $smarty->setConfigDir(__DIR__.'/config');
// $smarty->setCacheDir(__DIR__.'/views/cache');

//** un-comment the following line to show the debug console
//$smarty->debugging = true;
//$templateEngine = new \MPWAR\Templating\SmartyAdapter($smarty);

$loader = new Twig_Loader_Filesystem(__DIR__.'/views');
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__.'/views/cache',
));

$templateEngine = new \MPWAR\Templating\TwigAdapter($twig);

$app = new \MPWAR\AppKernel($routing, $templateEngine);

return $app;
