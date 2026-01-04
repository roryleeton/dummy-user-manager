<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

/**
 * Exception thrown when the API returns a 400 Bad Request status code.
 *
 * This exception indicates that the server cannot process the request due to
 * invalid syntax or malformed request data.
 */
final class BadRequestException extends APIException
{
	/**
	 * @param string $message The error message
	 * @param int|null $statusCode The HTTP status code (defaults to 400)
	 * @param \Throwable|null $previous The previous exception for exception chaining
	 */
	public function __construct(string $message = "Bad request", ?int $statusCode = 400, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}