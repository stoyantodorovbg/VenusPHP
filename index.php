<?php

global $kernel;
require __DIR__.'/vendor/autoload.php';

use StoyanTodorov\Core\Bootstrapper;

(new Bootstrapper(httpKernel(), 'http'))->bootstrap();

print_r('index');
print_r(__DIR__);
//$container = Container::getInstance();

//$testService = $container->get('test-service');
//$testService->test();