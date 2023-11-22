<?php

namespace StoyanTodorov\Core\Services\Http\Route;

enum HttpMethod: string
{
    case GET = 'GET';
    case HEAD = 'HEAD';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case CONNECT = 'CONNECT';
    case OPTIONS = 'OPTIONS';
    case TRACE = 'TRACE';
    case PATCH = 'PATCH';

    public static function create(string $input): self
    {
        return match ($input) {
            'GET'     => self::GET,
            'HEAD'    => self::HEAD,
            'POST'    => self::POST,
            'PUT'     => self::PUT,
            'DELETE'  => self::DELETE,
            'CONNECT' => self::CONNECT,
            'OPTIONS' => self::OPTIONS,
            'TRACE'   => self::TRACE,
            'PATCH'   => self::PATCH,
        };
    }
}