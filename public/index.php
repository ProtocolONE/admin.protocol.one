<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/autoload.php';
require __DIR__ . '/../app/AppKernel.php';

$environment = SYMFONY_ENV_DEV === getenv(SYMFONY_ENV) ? SYMFONY_ENV_DEV : SYMFONY_ENV_PROD;
$isDev = SYMFONY_ENV_DEV === $environment;
$debug = getenv(SYMFONY_DEBUG) !== '0' && $environment !== SYMFONY_ENV_PROD;

if ($isDev) {
    Debug::enable();
} else {
    if (PHP_VERSION_ID < 70000) {
        include_once __DIR__ . '/../var/bootstrap.php.cache';
    }
}

$kernel = new AppKernel($environment, $debug);

if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}

//When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//$kernel = new AppCache($kernel);
//Request::enableHttpMethodParameterOverride();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
