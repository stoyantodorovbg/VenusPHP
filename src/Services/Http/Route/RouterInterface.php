<?php

namespace StoyanTodorov\Core\Services\Http\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface RouterInterface
{
    /**
     * Match the incoming request
     *
     * @param Request $request
     * @return Response|bool|null
     */
    public function match(Request $request): Response|bool|null;
}