<?php

declare(strict_types=1);

use App\Application;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
$app     = new Application();
$app->initExceptionHandler();
$app->loadRoutes();
$response = $app->handle($request);
$response->send();
$app->terminate($request, $response);
