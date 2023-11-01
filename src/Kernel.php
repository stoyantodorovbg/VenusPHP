<?php

namespace StoyanTodorov\Core;

use StoyanTodorov\Core\DI\Binder;
use StoyanTodorov\Core\DI\Core;
use StoyanTodorov\Core\DI\Test;
use StoyanTodorov\Core\Infrastructure\Singleton;

class Kernel
{
    use Singleton;

    protected array $binders = [
        Core::class,
        Test::class,
    ];

    protected array $customBinders = [];

    public function registerBinders (): void
    {
        foreach ($this->binders as $binder) {
            $this->registerDI(new $binder);
        }
    }

    public function addBinders(): void
    {
        $this->binders = array_merge($this->binders, $this->customBinders);
    }

    protected function registerDI(Binder $binder): void
    {
        $binder->registerDI();
    }
}