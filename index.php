<?php

require __DIR__.'/vendor/autoload.php';

use StoyanTodorov\Core\Bootstrapper;
use StoyanTodorov\Core\Exceptions\ApiRouteException;
use StoyanTodorov\Core\Exceptions\TemplateRouteException;
use StoyanTodorov\Core\Kernel\HttpKernel;
use StoyanTodorov\Core\Services\Handler\Exceptions\ApiExceptionHandler;
use StoyanTodorov\Core\Services\Handler\Exceptions\ExceptionHandler;
use StoyanTodorov\Core\Services\Handler\Exceptions\TemplateExceptionHandler;
use Symfony\Component\HttpFoundation\Response;

try {
    $response = (new Bootstrapper(HttpKernel::getInstance()))->bootstrap();
    if ($response instanceof Response) {
        $response->send();
    };
} catch (TemplateRouteException $e)  {
    (new TemplateExceptionHandler())->handle($e);
} catch (ApiRouteException $e)  {
    (new ApiExceptionHandler())->handle($e);
} catch (Throwable $e) {
    (new ExceptionHandler())->handle($e);
}