<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\TemplateEngine\SmartyTemplateEngine;
use StoyanTodorov\Core\Services\TemplateEngine\TemplateService;

class Core extends Binder
{
    protected array $map = [
        ['smarty-template-engine', SmartyTemplateEngine::class],
        ['template-service', TemplateService::class, ['smarty-template-engine']],
    ];
}