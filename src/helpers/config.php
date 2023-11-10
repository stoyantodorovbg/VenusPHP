<?php

function config(string $configClass, $keys): mixed
{
    return instance($configClass)->get($keys);
}

function env(string $key, string $default = ''): string
{
    return parse_ini_file(basePath() . '.env')[$key] ?? $default;
}