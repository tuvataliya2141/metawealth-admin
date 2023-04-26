<?php

namespace App\Exceptions;

use Exception;

class CustomHttpException extends Exception
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface) {
            if ($exception->getStatusCode() == 403) {
                return response()->view('errors.403', [], 403);
            }
        }

        return parent::render($request, $exception);
    }

}
