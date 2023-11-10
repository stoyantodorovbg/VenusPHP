<?php

namespace StoyanTodorov\Core\Kernel;

interface KernelInterface
{
    /**
     * Register DI binders
     *
     * @return void
     */
    public function registerBinders(): void;

    /**
     * Add DI binders
     *
     * @return void
     */
    public function addBinders(): void;
}