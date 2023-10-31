<?php

namespace StoyanTodorov\Core\Container\Exceptions;

use \Exception;
use Psr\Container\ContainerExceptionInterface;

class ServiceNotFoundException extends Exception implements ContainerExceptionInterface
{

}