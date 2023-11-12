<?php

namespace StoyanTodorov\Core\Services\Log;

use Monolog\Logger;

interface LoggerServiceInterface
{
    /**
     * Get logger instance
     *
     * @param string $level
     * @return Logger
     */
    public function getLogger(string $level = 'debug'): Logger;

    /**
     * Log message and context at a certain level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @param string                   $type
     * @return void
     */
    public function log(string|array|object|null $message, array $context = [], string $type = 'debug'): void;

    /**
     * Log message and context at debug level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function debug(string|array|object|null $message, array $context = []): void;

    /**
     * Log message and context at info level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function info(string|array|object|null $message, array $context = []): void;

    /**
     * Log message and context at notice level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function notice(string|array|object|null $message, array $context = []): void;

    /**
     * Log message and context at warning level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function warning(string|array|object|null $message, array $context = []): void;

    /**
     * Log message and context at error level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function error(string|array|object|null $message, array $context = []): void;

    /**
     * Log message and context at critical level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function critical(string|array|object|null $message, array $context = []): void;

    /**
     * Log message and context at alert level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function alert(string|array|object|null $message, array $context = []): void;

    /**
     * Log message and context at emergency level.
     *
     * @param string|array|object|null $message
     * @param array                    $context
     * @return void
     */
    public function emergency(string|array|object|null $message, array $context = []): void;
}