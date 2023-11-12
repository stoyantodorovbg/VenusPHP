<?php

namespace StoyanTodorov\Core\Services\Http\Response\Factories;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

abstract class ResponseFactory
{
    /**
     * Create Response instance
     *
     * @param object|array $data
     * @param int          $status
     * @param array        $headers
     * @return Response
     */
    abstract public function create(object|array $data, int $status = 200, array $headers = []): Response;
}