<?php

require __DIR__.'/vendor/autoload.php';

use StoyanTodorov\Core\Kernel;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$kernel = Kernel::getInstance();
$kernel->addBinders();
$kernel->registerBinders();
$kernel->handleRequest();

//$container = Container::getInstance();

//$testService = $container->get('test-service');
//$testService->test();