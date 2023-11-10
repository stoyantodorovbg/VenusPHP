<?php

namespace StoyanTodorov\Core\Services\TemplateEngine\Interfaces;

interface TemplateServiceInterface
{
    /**
     * @return object
     */
    public function getTemplateEngine(): object;
}