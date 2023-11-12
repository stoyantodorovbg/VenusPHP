<?php

namespace StoyanTodorov\Core\Services\Log;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use ReflectionClass;
use StoyanTodorov\Core\Config\Framework;

class LoggerService implements LoggerServiceInterface
{
    public function getLogger(string $level = 'debug'): Logger
    {
        $envMode = config(Framework::class, ['envMode']);
        $logger = new Logger($envMode);
        $logger->pushHandler(new StreamHandler(logsPath($envMode . '.log'), $this->getLevel($level)));

        return $logger;
    }

    public function log(string|array|object|null $message, array $context = [], string $type = 'debug'): void
    {
        $this->$type($message, $context);
    }

    public function debug(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'debug');
    }

    public function info(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'info');
    }

    public function notice(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'notice');
    }

    public function warning(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'warning');
    }

    public function error(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'error');
    }

    public function critical(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'critical');
    }

    public function alert(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'alert');
    }

    public function emergency(string|array|object|null $message, array $context = []): void
    {
        $this->processLog($message, $context, 'emergency');
    }

    protected function processLog(string|array|object|null $message, array $context, string $type): void
    {
        $this->getLogger($type)->$type($this->processMessage($message), $context);
    }

    protected function processMessage(string|array|object|null $message): string
    {
        if ($message === null) {
            return '';
        }

        if (is_array($message)) {
            return "Array: \n" . implode("\n", $message) . "\n";
        }

        if (is_object($message) && ! method_exists($message, '__toString')) {
            return serialize($message);
        }

        return $message;
    }

    protected function getLevel(string $level)
    {
        return (new ReflectionClass(Level::class))->getConstants()[ucfirst($level)];
    }
}