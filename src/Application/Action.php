<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

final class Action
{
    private Request $request;
    private array $route = [];

    public function __construct(Request $request, array $route)
    {
        $this->request = $request;
        $this->route = $route;
    }

    public function getResponse(): Response
    {
        $controllerName = 'Pustel007\\ImageService\\Application\\Controller\\' . $this->route['controller'];
        $controller = new $controllerName();

        return $controller->{$this->route['action']}($this->request);
    }
}
