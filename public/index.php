<?php

declare(strict_types=1);

use Pustel007\ImageService\Application\Config;
use Pustel007\ImageService\Application\Request;
use Pustel007\ImageService\Application\Router;
use Pustel007\ImageService\Application\Action;
use Pustel007\ImageService\Application\View;
use Pustel007\ImageService\Application\ViewRenderer;

require '../vendor/autoload.php';

$request = new Request($_SERVER);

$router = new Router(Config::ROUTES);
$route = $router->getRouteFromRequest($request);

$action = new Action($request, $route);
$response = $action->getResponse();

$view = new View(new ViewRenderer());
$view->handle($response);
