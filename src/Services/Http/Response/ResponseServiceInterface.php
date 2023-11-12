<?php

namespace StoyanTodorov\Core\Services\Http\Response;

use Symfony\Component\HttpFoundation\Response;

interface ResponseServiceInterface
{
    /**
     * Create a response
     *
     * @param object|array $data
     * @param int          $status
     * @param array        $headers
     * @return Response
     */
    public function createResponse(object|array $data, int $status = 200, array $headers = []): Response;
}