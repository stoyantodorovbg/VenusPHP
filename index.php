<?php

require __DIR__.'/vendor/autoload.php';

use StoyanTodorov\Core\Bootstrapper;
use StoyanTodorov\Core\Controllers\ErrorsController;

try {
    (new Bootstrapper(httpKernel(), 'http'))->bootstrap();
} catch (\Exception $e) {
    config('framework-conf', ['debug']) ?
        throw $e :
        (new ErrorsController())->errorPage(500);
}