<?php

namespace StoyanTodorov\Core\Container\Exceptions;

use \Exception;
use Psr\Container\NotFoundExceptionInterface;

class ServiceNotFoundException extends Exception implements NotFoundExceptionInterface
{

}