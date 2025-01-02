<?php

declare(strict_types=1);

namespace App;

use App\Config\YamlRouteLoader;
use App\Exception\ExceptionHandler;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class Application
{
    /**
     * @var RouteCollection
     */
    protected RouteCollection $routeCollection;
    /**
     * @var ExceptionHandler
     */
    protected ExceptionHandler $exceptionHandler;
    /**
     * @var YamlRouteLoader
     */
    protected YamlRouteLoader $yamlRouteLoader;
    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     * Application constructor
     */
    public function __construct()
    {
        $this->logger           = new Logger('app');
        $this->exceptionHandler = new ExceptionHandler();
    }

    /**
     * @return void
     */
    public function initExceptionHandler(): void
    {
        $this->exceptionHandler->init();
    }

    /**
     * @return void
     */
    public function loadRoutes(): void
    {
        $this->routeCollection = $this->yamlRouteLoader->loadFromYml();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function handle(Request $request): void
    {
        //
    }
}