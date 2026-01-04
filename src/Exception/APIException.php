<?php

namespace RoryLeeton\DummyUserManager\Exception;

use RuntimeException;
use Throwable;

/**
 * Base exception class for API-related errors.
 *
 * This exception serves as the base class for all API-related exceptions and
 * includes the HTTP status code associated with the error. Specific exception
 * types (BadRequestException, NotFoundException, etc.) extend this class.
 */
class APIException extends RuntimeException
{
    /**
     * @param string $message The error message
     * @param int|null $statusCode The HTTP status code associated with the error
     * @param Throwable|null $previous The previous exception for exception chaining
     */
    public function __construct(string $message = "API error", private ?int $statusCode = null, ?Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}

    /**
     * Gets the HTTP status code associated with this exception.
     *
     * @return int|null The HTTP status code, or null if not set
     */
    public function getStatusCode(): ?int
	{
        return $this->statusCode;
    }
}