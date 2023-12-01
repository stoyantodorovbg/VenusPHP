<?php

namespace StoyanTodorov\Core;

use StoyanTodorov\Core\Kernel\Interfaces\KernelInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class Bootstrapper
{
    public function __construct(private KernelInterface $kernel)
    {
    }

    public function bootstrap(): Response|bool|null
    {
        $this->kernel->addBinders();
        $this->kernel->registerBinders();
        $mode = $this->kernel->mode();

        return $this->$mode();
    }

    private function http(): Response|bool|null
    {
        if (config('framework-conf', ['hasTemplateEngine'])) {
            $templateEngine = instance(config('framework-conf', ['templateEngine']) . '-template-service')->setup();
            $this->kernel->setTemplateEngine($templateEngine);
        }

        return $this->kernel->handleRequest();
    }

    private function console(): void
    {
        $this->kernel->handle();
    }
}