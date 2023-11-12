<?php

namespace StoyanTodorov\Core\Services\Http\Response;

use StoyanTodorov\Core\Services\Http\Response\Factories\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class ResponseService implements ResponseServiceInterface
{
    public function __construct(protected ResponseFactory $responseFactory)
    {
    }

    public function createResponse(object|array $data, int $status = 200, array $headers = []): Response
    {
        return $this->responseFactory->create($data, $status, $headers);
    }
}