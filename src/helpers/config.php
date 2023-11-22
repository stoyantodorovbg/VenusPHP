<?php

function config(string $configClass, $keys): mixed
{
    return instance($configClass)->get($keys);
}

function env(string $key, string|null $default = null): string
{
    return parse_ini_file(basePath() . '.env')[$key] ?? $default;
}