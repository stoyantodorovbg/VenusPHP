<?php

namespace StoyanTodorov\Core\Services\TemplateEngine;

use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineServiceInterface;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;

class TemplateEngineService implements TemplateEngineServiceInterface
{
    public function __construct(protected TemplateEngineInterface $templateEngine)
    {
    }

    public function setup(): TemplateEngineInterface
    {
        return $this->templateEngine->setup();
    }
}