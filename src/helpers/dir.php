<?php

function basePath(): string
{
    return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
}

function path(string $path = '', bool $isDirectory = false): string
{
    $path = basePath() . $path;
    if ($isDirectory) {
        $path .= DIRECTORY_SEPARATOR;
    }

    return $path;
}

function templatesPath(string $path = '', bool $isDirectory = false): string
{
    $path = basePath() .
        strtolower(config('framework-conf', ['templateEngine'])) .
        DIRECTORY_SEPARATOR .
        $path;
    if ($isDirectory) {
        $path .= DIRECTORY_SEPARATOR;
    }

    return $path;
}

function logsPath(string $path = '', bool $isDirectory = false): string
{
    $path = basePath() . 'logs' . DIRECTORY_SEPARATOR . $path;
    if ($isDirectory) {
        $path .= DIRECTORY_SEPARATOR;
    }

    return $path;
}
