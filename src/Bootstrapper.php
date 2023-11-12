<?php

namespace StoyanTodorov\Core;

use StoyanTodorov\Core\Kernel\KernelInterface;
use Symfony\Component\HttpFoundation\Response;

class Bootstrapper
{
    public function __construct(
        readonly private KernelInterface $kernel,
        readonly private string $mode,
    )
    {
    }

    public function bootstrap(): Response|null
    {
        $this->kernel->addBinders();
        $this->kernel->registerBinders();
        $mode = $this->mode;

        return $this->$mode();
    }

    private function http(): Response|null
    {
        if (config('framework-conf', ['hasTemplateEngine'])) {
            $templateEngine = instance(config('framework-conf', ['templateEngine']) . '-template-service')->setup();
            $this->kernel->setTemplateEngine($templateEngine);
        }

        return $this->kernel->handleRequest();
    }

    private function console(): void
    {

    }
}