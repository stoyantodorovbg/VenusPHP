<?php

use StoyanTodorov\Core\Kernel\HttpKernel;
use StoyanTodorov\Core\Kernel\HttpKernelInterface;

function httpKernel(): HttpKernelInterface
{
    return HttpKernel::getInstance();
}