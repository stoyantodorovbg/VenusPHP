<?php

namespace StoyanTodorov\Core\Services\TemplateEngine;

use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateServiceInterface;

class TemplateService implements TemplateServiceInterface
{
    public function __construct(protected TemplateEngineInterface $templateEngine)
    {
    }

    public function getTemplateEngine(): TemplateEngineInterface
    {
        return $this->templateEngine->setup();
    }
}