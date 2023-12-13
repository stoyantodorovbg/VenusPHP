<?php

namespace StoyanTodorov\Core\DI;

use StoyanTodorov\Core\Services\DB\Query\Interfaces\PreparedQueryInterface;
use StoyanTodorov\Core\Services\DB\Query\PreparedQuery;
use StoyanTodorov\Core\Services\Handler\HttpRequestHandler;
use StoyanTodorov\Core\Services\Handler\Interfaces\HttpRequestHandlerInterface;
use StoyanTodorov\Core\Services\Http\Request\Request;
use StoyanTodorov\Core\Services\Http\Request\RequestInterface;
use StoyanTodorov\Core\Services\Http\Response\Factories\JsonResponseFactory;
use StoyanTodorov\Core\Services\Http\Response\ResponseService;
use StoyanTodorov\Core\Services\Http\Route\Factories\RouteFactory;
use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouteFactoryInterface;
use StoyanTodorov\Core\Services\Http\Route\Interfaces\RouteServiceInterface;
use StoyanTodorov\Core\Services\Http\Route\RouteService;
use StoyanTodorov\Core\Services\Log\LoggerService;
use StoyanTodorov\Core\Services\Log\LoggerServiceInterface;
use StoyanTodorov\Core\Services\ORM\Converter\EntityConverter;
use StoyanTodorov\Core\Services\ORM\Converter\Interfaces\EntityConverterInterface;
use StoyanTodorov\Core\Services\Resolve\Resolver;
use StoyanTodorov\Core\Services\Resolve\ResolverInterface;
use StoyanTodorov\Core\Services\String\Interfaces\StringConverterInterface;
use StoyanTodorov\Core\Services\String\StringConverter;
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
        [RouteServiceInterface::class, RouteService::class],
        [RequestInterface::class, Request::class],
        [RouteFactoryInterface::class, RouteFactory::class],
        [EntityConverterInterface::class, EntityConverter::class],
        [StringConverterInterface::class, StringConverter::class],
        [PreparedQueryInterface::class, PreparedQuery::class],
    ];
}