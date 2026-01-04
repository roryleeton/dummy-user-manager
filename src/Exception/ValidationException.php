<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

final class ValidationException extends APIException
{
	public function __construct(string $message = "Invalid data", ?int $statusCode = 422, ?\Throwable $previous = null)
	{
		return parent::__construct($message, $statusCode, $previous);
	}
}