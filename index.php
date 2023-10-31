<?php

require __DIR__.'/vendor/autoload.php';

use StoyanTodorov\Core\Container\Container;
use StoyanTodorov\Core\Services\Test\DependencyDependencyService;
use StoyanTodorov\Core\Services\Test\DependencyService;
use StoyanTodorov\Core\Services\Test\TestService;

printf('index');

$container = Container::getInstance();

$container->set('dependency-dependency-service',DependencyDependencyService::class);
$container->set('dependency-service',DependencyService::class, ['dependency-dependency-service']);
$container->set('test-service',TestService::class, ['dependency-service']);
$testService = $container->get('test-service');
//$testService->test();