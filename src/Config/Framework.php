<?php

namespace StoyanTodorov\Core\Config;

class Framework extends Config
{
    protected array $data = [
        'hasTemplateEngine' => true,
        'templateEngine'    => 'Smarty',
    ];
}