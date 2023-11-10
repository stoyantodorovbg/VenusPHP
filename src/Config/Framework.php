<?php

namespace StoyanTodorov\Core\Config;

class Framework extends Config
{
    protected function data(): array
    {
        return [
            'hasTemplateEngine' => env('HAS_TEMPLATE_ENGINE', 1),
            'templateEngine'    => env('TEMPLATE_ENGINE', 'Smarty'),
            'debug'             => env('DEBUG', 0)
        ];
    }
}