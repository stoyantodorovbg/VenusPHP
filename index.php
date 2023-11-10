<?php

global $kernel;
require __DIR__.'/vendor/autoload.php';

use StoyanTodorov\Core\Bootstrapper;

(new Bootstrapper(httpKernel(), 'http'))->bootstrap();