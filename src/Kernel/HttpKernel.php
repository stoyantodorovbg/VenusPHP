<?php

namespace StoyanTodorov\Core\Kernel;

use StoyanTodorov\Core\DI\Config;
use StoyanTodorov\Core\DI\Core;
use StoyanTodorov\Core\DI\Routes;
use StoyanTodorov\Core\DI\Test;
use StoyanTodorov\Core\Interfaces\SingletonInterface;
use StoyanTodorov\Core\Services\Handler\Interfaces\HttpRequestHandlerInterface;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;
use StoyanTodorov\Core\Utilities\Singleton\Singleton;
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
    
    protected TemplateEngineInterface|null $templateEngine;

    public function handleRequest(): Response|bool|null
    {
        return $this->container->get(HttpRequestHandlerInterface::class)->handle();
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