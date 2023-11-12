<?php

namespace StoyanTodorov\Core\Services\Handler\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface HttpRequestHandlerInterface
{
    /**
     * Handle a request
     *
     * @return Response|bool|null
     */
    public function handle(): Response|bool|null;
}