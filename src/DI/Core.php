<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\Handler\HttpRequestHandler;
use StoyanTodorov\Core\Services\Handler\Interfaces\HttpRequestHandlerInterface;
use StoyanTodorov\Core\Services\Http\Response\Factories\JsonResponseFactory;
use StoyanTodorov\Core\Services\Http\Response\ResponseService;
use StoyanTodorov\Core\Services\Log\LoggerService;
use StoyanTodorov\Core\Services\Log\LoggerServiceInterface;
use StoyanTodorov\Core\Services\Resolve\Resolver;
use StoyanTodorov\Core\Services\Resolve\ResolverInterface;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineServiceInterface;
use StoyanTodorov\Core\Services\TemplateEngine\SmartyTemplateEngine;
use StoyanTodorov\Core\Services\TemplateEngine\TemplateEngineService;
use StoyanTodorov\Core\Utilities\Singleton\SingletonInstance;
use StoyanTodorov\Core\Utilities\Singleton\SingletonInstanceInterface;

class Core extends Binder
{
    protected array $map = [
        ['smarty-template-engine', SmartyTemplateEngine::class],
        ['smarty-template-service', TemplateEngineService::class, ['smarty-template-engine']],
        [TemplateEngineServiceInterface::class, TemplateEngineService::class, ['smarty-template-engine']],
        ['logger-service', LoggerService::class],
        [LoggerServiceInterface::class, LoggerService::class],
        ['resolver', Resolver::class],
        [ResolverInterface::class, Resolver::class],
        ['json-response-factory', JsonResponseFactory::class],
        ['json-response-service', ResponseService::class, ['json-response-factory']],
        [HttpRequestHandlerInterface::class, HttpRequestHandler::class],
        [SingletonInstanceInterface::class, SingletonInstance::class],
    ];
}