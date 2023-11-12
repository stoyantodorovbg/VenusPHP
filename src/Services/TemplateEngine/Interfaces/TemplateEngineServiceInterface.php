<?php

namespace StoyanTodorov\Core\Services\TemplateEngine\Interfaces;

interface TemplateEngineServiceInterface
{
    /**
     * @return TemplateEngineInterface
     */
    public function setup(): TemplateEngineInterface;
}