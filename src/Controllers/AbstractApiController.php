<?php

namespace StoyanTodorov\Core\Controllers;

abstract class AbstractApiController extends AbstractController
{
    public function jsonResponse(object|array $data, int $status = 200, array $headers = [])
    {
        return $this->getContainer()
            ->get('json-response-service')
            ->createResponse($data, $status, $headers);
    }
}