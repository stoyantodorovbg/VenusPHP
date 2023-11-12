<?php

namespace StoyanTodorov\Core\Controllers;

use StoyanTodorov\Core\Kernel\HttpKernel;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;

class AbstractTemplateController extends AbstractController
{
    protected function getTemplateEngine(): TemplateEngineInterface
    {
        return singletonInstance(HttpKernel::class)->getTemplateEngine();
    }

    protected function render(string $template, array $variables): void
    {
        $this->getTemplateEngine()->render($template, $variables);
    }
}