<?php

use Psr\Container\ContainerInterface;
use StoyanTodorov\Core\Container\Container;

function container(): ContainerInterface
{
    return Container::getInstance();
}