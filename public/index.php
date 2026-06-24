<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new \Simple\Application();
$app->boot(dirname(__DIR__) . '/app/Config');

$url = \Simple\url_init();

require '../app/Routes.php';
\Simple\Routing\Router::dispatch($url);
