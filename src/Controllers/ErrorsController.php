<?php

namespace StoyanTodorov\Core\Controllers;

use Symfony\Component\HttpFoundation\Response;

class ErrorsController
{
    public function notFound(): Response
    {
        return new Response('Not found', 404);
    }
}