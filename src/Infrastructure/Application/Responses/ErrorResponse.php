<?php

namespace Src\Infrastructure\Application\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResponse extends JsonResource
{
    /** @var string */
    public static $wrap = '';

    /** @var string */
    public string $errorCode;

    /** @var string */
    public string $message;

    /** @var mixed|null */
    public mixed $errors;

    /**
     * @param string $errorCode
     * @param string $message
     * @param mixed $errors
     * @param mixed $resource
     */
    public function __construct(
        string $errorCode,
        string $message,
        mixed $errors = null,
        mixed $resource = null
    )
    {
        $this->errorCode = $errorCode;
        $this->message = $message;
        $this->errors = $errors;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array{error_code: string, message: string, errors?: mixed}
     */
    public function toArray($request): array
    {
        $response = [
            "error_code" => $this->errorCode,
            "message" => $this->message,
        ];

        if ($this->errors !== null) {
            $response['errors'] = $this->errors;
        }

        return $response;
    }
}
