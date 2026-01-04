<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

/**
 * Exception thrown when the API returns a 422 Unprocessable Entity status code.
 *
 * This exception indicates that the request was well-formed but contains
 * semantic errors, typically validation failures.
 */
final class ValidationException extends APIException
{
	/**
	 * @param string $message The error message
	 * @param int|null $statusCode The HTTP status code (defaults to 422)
	 * @param \Throwable|null $previous The previous exception for exception chaining
	 */
	public function __construct(string $message = "Invalid data", ?int $statusCode = 422, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}