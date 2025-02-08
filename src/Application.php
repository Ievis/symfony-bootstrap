<?php

declare(strict_types=1);

namespace App;

use App\Config\YamlRouteLoader;
use App\Exception\ExceptionHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\Routing\RouteCollection;

class Application implements HttpKernelInterface, TerminableInterface
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
        $this->yamlRouteLoader  = new YamlRouteLoader();
        $this->exceptionHandler = new ExceptionHandler();
        $this->logger           = new Logger('app');
        $this->logger->pushHandler(new StreamHandler(__DIR__. '/../logs/app.log', Level::Debug));
        $this->logger->info('Application created');
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
     * @param int $type
     * @param bool $catch
     * @return Response
     */
    public function handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): Response
    {
        $response = new Response('Hello from symfony');
        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function terminate(Request $request, Response $response): void
    {
        // TODO: Implement terminate() method.
    }
}