<?php

declare(strict_types=1);

namespace App\Config;

use Symfony\Component\Routing\RouteCollection;

class YamlRouteLoader
{
    /**
     * @return RouteCollection
     */
    public function loadFromYml(): RouteCollection
    {
        $routeCollection = new RouteCollection();
        return $routeCollection;
    }
}