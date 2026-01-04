<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

/**
 * Exception thrown when the API returns a 404 Not Found status code.
 *
 * This exception indicates that the requested resource could not be found
 * on the server.
 */
final class NotFoundException extends APIException
{
	/**
	 * @param string $message The error message
	 * @param int|null $statusCode The HTTP status code (defaults to 404)
	 * @param \Throwable|null $previous The previous exception for exception chaining
	 */
	public function __construct(string $message = "Not found", ?int $statusCode = 404, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}