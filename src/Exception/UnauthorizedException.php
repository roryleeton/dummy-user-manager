<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

/**
 * Exception thrown when the API returns a 401 Unauthorized status code.
 *
 * This exception indicates that the request requires authentication or the
 * provided authentication credentials are invalid or missing.
 */
final class UnauthorizedException extends APIException
{
	/**
	 * @param string $message The error message
	 * @param int|null $statusCode The HTTP status code (defaults to 401)
	 * @param \Throwable|null $previous The previous exception for exception chaining
	 */
	public function __construct(string $message = "Unauthorised request", ?int $statusCode = 401, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}