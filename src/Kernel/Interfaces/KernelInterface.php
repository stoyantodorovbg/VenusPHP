<?php

namespace StoyanTodorov\Core\Kernel\Interfaces;

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

    /**
     * Kernel mode
     *
     * @return string
     */
    public function mode(): string;
}