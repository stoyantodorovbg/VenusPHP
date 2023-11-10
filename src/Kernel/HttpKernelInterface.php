<?php

namespace StoyanTodorov\Core\Kernel;

use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;
use Symfony\Component\HttpFoundation\Response;

interface HttpKernelInterface
{
    /**
     * Handle HTTP request
     *
     * @return Response
     */
    public function handleRequest();

    /**
     * Get template instance
     *
     * @return TemplateEngineInterface
     */
    public function getTemplateEngine(): TemplateEngineInterface;

    /**
     * Set template instance
     *
     * @param TemplateEngineInterface $templateEngine
     * @return void
     */
    public function setTemplateEngine(TemplateEngineInterface $templateEngine): void;
}