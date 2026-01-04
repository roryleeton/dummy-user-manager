<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

use RuntimeException;
use Throwable;

/**
 * Exception thrown when a network error occurs during API communication.
 *
 * This exception is thrown when the HTTP client encounters a network-level
 * error (e.g., connection timeout, DNS failure) rather than an HTTP error
 * response from the server. It extends RuntimeException rather than APIException
 * because it represents a transport layer issue, not an API-level error.
 */
final class NetworkException extends RuntimeException
{
	/**
	 * @param string $message The error message
	 * @param Throwable|null $previous The previous exception for exception chaining
	 */
	public function __construct(string $message = "Network error while comminicating with API", ?Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}
}