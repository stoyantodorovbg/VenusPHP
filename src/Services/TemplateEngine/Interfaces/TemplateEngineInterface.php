<?php

namespace StoyanTodorov\Core\Services\TemplateEngine\Interfaces;

interface TemplateEngineInterface
{
    /**
     * Setup template engine
     *
     * @return self
     */
    public function setup(): self;

    /**
     * @param string $templatePath
     * @param array  $variables
     * @return void
     */
    public function render(string $templatePath, array $variables = []): void;
}