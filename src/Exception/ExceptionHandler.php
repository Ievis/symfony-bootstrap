<?php

declare(strict_types=1);

namespace App\Exception;

use ErrorException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ExceptionHandler
{
    /**
     * @return void
     */
    public function init(): void
    {
        set_exception_handler([$this, 'handleException']);
        set_error_handler([$this, 'handleError']);
        register_shutdown_function([$this, 'handleShutdown']);
    }

    /**
     * @param Throwable $exception
     * @return void
     */
    public function handleException(Throwable $exception): void
    {
        $response = new Response(
            $exception->getMessage(),
            500,
        );
        $response->send();
    }

    /**
     * @return void
     */
    public function handleShutdown(): void
    {
        $error = error_get_last();
        if (! isset($error['message'])) {
            return;
        }
        $response = new Response(
            $error['message'],
            500,
        );
        $response->send();
    }

    /**
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @return void
     * @throws ErrorException
     */
    public function handleError(
        int    $errno,
        string $errstr,
        string $errfile,
        int    $errline,
    ): void
    {
        throw new ErrorException(
            $errstr,
            $errno,
            1,
            $errfile,
            $errline,
        );
    }
}