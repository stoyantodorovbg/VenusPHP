<?php

namespace StoyanTodorov\Core\Kernel\Interfaces;

use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;
use Symfony\Component\HttpFoundation\Response;

interface HttpKernelInterface
{
    /**
     * Handle HTTP request
     *
     * @return Response|bool|null
     */
    public function handleRequest(): Response|bool|null;

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