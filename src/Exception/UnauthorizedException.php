<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

final class UnauthorizedException extends APIException
{
	public function __construct(string $message = "Unauthorised request", ?int $statusCode = 401, ?\Throwable $previous = null)
	{
		return parent::__construct($message, $statusCode, $previous);
	}
}