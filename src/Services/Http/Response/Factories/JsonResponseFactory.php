<?php

namespace StoyanTodorov\Core\Services\Http\Response\Factories;

use Symfony\Component\HttpFoundation\Response;

class JsonResponseFactory extends ResponseFactory
{
    public function create(object|array $data, int $status = 200, array $headers = []): Response
    {
        return new Response(
            content: json_encode($data),
            status: $status,
            headers: array_merge($headers, ['Content-Type' => 'application/json;charset=UTF-8'])
        );
    }
}