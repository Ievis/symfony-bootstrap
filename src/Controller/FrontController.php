<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class FrontController
{
    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        return new Response();
    }
}