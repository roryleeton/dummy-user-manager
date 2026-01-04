<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

final class ServerErrorException extends APIException
{
	public function __construct(string $message = "Server error", ?int $statusCode = 500, ?\Throwable $previous = null)
	{
		return parent::__construct($message, $statusCode, $previous);
	}
}