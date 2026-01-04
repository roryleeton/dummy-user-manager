<?php

namespace RoryLeeton\DummyUserManager\Exception;

use RuntimeException;
use Throwable;

class APIException extends RuntimeException
{
    public function __construct(string $message = "API error", private ?int $statusCode = null, ?Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }
}