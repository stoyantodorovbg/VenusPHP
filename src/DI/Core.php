<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\Logs\LoggerService;
use StoyanTodorov\Core\Services\Logs\LoggerServiceInterface;
use StoyanTodorov\Core\Services\Resolve\Resolver;
use StoyanTodorov\Core\Services\Resolve\ResolverInterface;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateServiceInterface;
use StoyanTodorov\Core\Services\TemplateEngine\SmartyTemplateEngine;
use StoyanTodorov\Core\Services\TemplateEngine\TemplateService;

class Core extends Binder
{
    protected array $map = [
        ['smarty-template-engine', SmartyTemplateEngine::class],
        ['template-service', TemplateService::class, ['smarty-template-engine']],
        [TemplateServiceInterface::class, TemplateService::class, ['smarty-template-engine']],
        ['logger-service', LoggerService::class],
        [LoggerServiceInterface::class, LoggerService::class],
        ['resolver', Resolver::class],
        [ResolverInterface::class, Resolver::class],
    ];
}