<?php

namespace StoyanTodorov\Core\Controllers;

use StoyanTodorov\Core\Config\Framework;

class TemplateErrorsController extends AbstractTemplateController
{
    public function error(int $code): void
    {
        $this->render('errors/error', [
            'code'    => $code,
            'message' => config(Framework::class, ['errorMessages', $code]),
        ]);
    }
}