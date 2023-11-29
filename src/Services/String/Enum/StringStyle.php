<?php

namespace StoyanTodorov\Core\Services\String\Enum;

enum StringStyle: string
{
    case PASCAL = 'pascal';
    case CAMEL = 'camel';
    case KEBAB = 'kebab';
    case SNAKE = 'snake';
}