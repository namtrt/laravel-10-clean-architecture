<?php

namespace Src\Infrastructure\Application\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Src\Domain\Exceptions\AppException;
use Src\Infrastructure\Application\Responses\ErrorResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AppException $e): JsonResponse {
            return $this->makeErrorResponse(
                $e->getCode(),
                $e->getErrorCode(),
                $e->getMessage(),
            );
        });
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse
     */
    protected function prepareJsonResponse($request, Throwable $e): JsonResponse
    {
        $statusCode = ($e instanceof HttpExceptionInterface) ? $e->getStatusCode() : 500;
        if (config('app.debug')) {
            return $this->makeErrorResponse(
                code: $statusCode,
                message: $e->getMessage(),
                errors: $this->convertExceptionToArray($e),
            );
        }

        return $this->makeErrorResponse(
            code: $statusCode,
            message: "Server error.",
        );
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param Request $request
     * @param ValidationException $exception
     * @return JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return $this->makeErrorResponse(
            code: $exception->status,
            message: $exception->getMessage(),
        );
    }

    /**
     * @param int $code
     * @param string $errorCode
     * @param string $message
     * @param array|null $errors
     * @param mixed $data
     *
     * @return JsonResponse
     */
    protected function makeErrorResponse(
        int    $code,
        string $errorCode = '02____',
        string $message = 'Bad request',
        ?array $errors = null,
        mixed  $data = null
    ): JsonResponse
    {
        return (new ErrorResponse($errorCode, $message, $errors, $data))->response()->setStatusCode($code);
    }
}
