<?php

namespace Src\Infrastructure\Application\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResponse extends JsonResource
{
    /** @var string */
    public string $message;

    /**
     * Success response constructor.
     *
     * @param mixed $resource
     * @param string $message
     */
    public function __construct(mixed $resource = null, string $message = 'Successful')
    {
        $this->message = $message;
        parent::__construct($resource);
    }

    /**
     * @param $request
     *
     * @return array{message: string}
     */
    public function with($request): array
    {
        return [
            'message' => $this->message,
        ];
    }

    public function toArray(Request $request)
    {
        if (is_null($this->resource)) {
            return [];
        }

        return $this->resource;
    }
}
