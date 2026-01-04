<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

/**
 * Exception thrown when the API returns a 403 Forbidden status code.
 *
 * This exception indicates that the server understood the request but refuses
 * to authorize it, typically due to insufficient permissions.
 */
final class ForbiddenException extends APIException
{
	/**
	 * @param string $message The error message
	 * @param int|null $statusCode The HTTP status code (defaults to 403)
	 * @param \Throwable|null $previous The previous exception for exception chaining
	 */
	public function __construct(string $message = "Forbidden", ?int $statusCode = 403, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}