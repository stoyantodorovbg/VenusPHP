<?php

namespace StoyanTodorov\Core\Services\Handler;

use StoyanTodorov\Core\Exceptions\ApiRouteException;
use StoyanTodorov\Core\Exceptions\TemplateRouteException;
use StoyanTodorov\Core\HTTP\Controllers\TemplateErrorsController;
use StoyanTodorov\Core\Services\Handler\Interfaces\HttpRequestHandlerInterface;
use StoyanTodorov\Core\Services\Http\Request\RequestInterface;
use StoyanTodorov\Core\Services\Http\Route\Config\Api;
use StoyanTodorov\Core\Services\Http\Route\Config\Web;
use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouteServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class HttpRequestHandler implements HttpRequestHandlerInterface
{
    public function __construct(
        protected RequestInterface $request,
        protected RouteServiceInterface $routeService,
    )
    {
    }

    private array $routerExceptionMap = [
        Web::class => TemplateRouteException::class,
        Api::class => ApiRouteException::class,
    ];

    public function handle(): Response|bool|null
    {
        foreach ($this->routeService->getRouters() as $router) {
            try {
                if ($response = $router->getResponse($this->request->method(), $this->request->path())) {
                    return $response;
                }
            } catch (\Throwable $e) {
                $exceptionName = $this->routerExceptionMap[$router::class];
                throw new $exceptionName(
                    $e->getMessage() . ':' . $e->getTraceAsString(),
                    $e->getCode(),
                );
            }
        }

        (new TemplateErrorsController())->error(404);

        return false;
    }
}