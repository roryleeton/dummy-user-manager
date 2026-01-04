<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

final class ForbiddenException extends APIException
{
	public function __construct(string $message = "Forbidden", ?int $statusCode = 403, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}