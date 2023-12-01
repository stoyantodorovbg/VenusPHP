<?php

namespace StoyanTodorov\Core\Kernel\Interfaces;

interface ConsoleKernelInterface
{
    /**
     * Handle Console
     *
     * @return void
     */
    public function handle(): void;
}