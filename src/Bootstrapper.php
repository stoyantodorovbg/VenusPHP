<?php

namespace StoyanTodorov\Core;

use StoyanTodorov\Core\Kernel\KernelInterface;

class Bootstrapper
{
    public function __construct(
        readonly private KernelInterface $kernel,
        readonly private string $mode,
    )
    {
    }

    public function bootstrap(): void
    {
        $this->kernel->addBinders();
        $this->kernel->registerBinders();
        $mode = $this->mode;
        $this->$mode();
    }

    private function http() :void
    {
        if (config('framework-conf', ['hasTemplateEngine'])) {
            $this->kernel->setTemplateEngine(instance('template-service')->getTemplateEngine());
        }
        $this->kernel->handleRequest();
    }

    private function console(): void
    {

    }
}