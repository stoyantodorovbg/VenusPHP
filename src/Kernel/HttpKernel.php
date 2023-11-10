<?php

namespace StoyanTodorov\Core\Kernel;

use StoyanTodorov\Core\Controllers\ErrorsController;
use StoyanTodorov\Core\DI\Config;
use StoyanTodorov\Core\DI\Core;
use StoyanTodorov\Core\DI\Routes;
use StoyanTodorov\Core\DI\Test;
use StoyanTodorov\Core\Infrastructure\Singleton;
use StoyanTodorov\Core\Interfaces\SingletonInterface;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpKernel extends Kernel implements HttpKernelInterface, SingletonInterface
{
    use Singleton;

    protected array $binders = [
        Core::class,
        Config::class,
        Routes::class,
        Test::class,
    ];

    protected array $customBinders = [];

    private array $routes = [
        'web-router', 'api-router',
    ];
    
    protected TemplateEngineInterface|null $templateEngine;

    public function handleRequest(): void
    {
        $request = Request::createFromGlobals();
        $container = $this->getContainer();
        foreach ($this->routes as $routes) {
            if ($container->get($routes)->match($request)) {
                return;
            }
        }

        (new ErrorsController())->errorPage(404);
    }
    
    public function getTemplateEngine(): TemplateEngineInterface
    {
        return $this->templateEngine;
    }
    
    public function setTemplateEngine(TemplateEngineInterface $templateEngine): void
    {
        $this->templateEngine = $templateEngine;
    }
}