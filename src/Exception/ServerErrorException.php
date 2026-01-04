<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

/**
 * Exception thrown when the API returns a 5xx Server Error status code.
 *
 * This exception indicates that the server encountered an error and was unable
 * to complete the request.
 */
final class ServerErrorException extends APIException
{
	/**
	 * @param string $message The error message
	 * @param int|null $statusCode The HTTP status code (defaults to 500)
	 * @param \Throwable|null $previous The previous exception for exception chaining
	 */
	public function __construct(string $message = "Server error", ?int $statusCode = 500, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}