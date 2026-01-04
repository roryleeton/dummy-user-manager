<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

use RuntimeException;
use Throwable;

final class NetworkException extends RuntimeException
{
	public function __construct(string $message = "Network error while comminicating with API", ?Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}
}