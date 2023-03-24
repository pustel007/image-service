<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

final class Router
{
    private array $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function getRouteFromRequest(Request $request): ?array
    {
        foreach ($this->routes as $route) {
            if (preg_match($route['regex'], $request->server('REQUEST_URI'))) {
                return $route;
            }
        }

        return null;
    }
}
