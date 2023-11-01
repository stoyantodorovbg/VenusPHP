<?php

require __DIR__.'/vendor/autoload.php';

use StoyanTodorov\Core\Container\Container;
use StoyanTodorov\Core\Kernel;

$kernel = Kernel::getInstance();
$kernel->addBinders();
$kernel->registerBinders();

$container = Container::getInstance();

$testService = $container->get('test-service');
$testService->test();