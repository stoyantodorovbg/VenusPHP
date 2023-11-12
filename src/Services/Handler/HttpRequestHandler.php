<?php

namespace StoyanTodorov\Core\Services\Handler;

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Container;
use StoyanTodorov\Core\Controllers\TemplateErrorsController;
use StoyanTodorov\Core\Exceptions\ApiRouteException;
use StoyanTodorov\Core\Exceptions\TemplateRouteException;
use StoyanTodorov\Core\Services\Handler\Interfaces\HttpRequestHandlerInterface;
use StoyanTodorov\Core\Services\Http\Route\Api;
use StoyanTodorov\Core\Services\Http\Route\Web;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpRequestHandler implements HttpRequestHandlerInterface
{
    protected ContainerInterface $container;

    public function __construct()
    {
        $this->container = Container::getInstance();
    }

    private array $routers = [
        'web-router', 'api-router',
    ];

    private array $routerExceptionMap = [
        Web::class => TemplateRouteException::class,
        Api::class => ApiRouteException::class,
    ];

    public function handle(): Response|bool|null
    {
        $request = Request::createFromGlobals();
        foreach ($this->routers as $routerKey) {
            try {
                $router = $this->container->get($routerKey);

                if (($response = $router->match($request)) !== false) {
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