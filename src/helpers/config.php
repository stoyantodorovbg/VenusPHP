<?php

function config(string $configClass, $keys): mixed
{
    return instance($configClass)->get($keys);
}