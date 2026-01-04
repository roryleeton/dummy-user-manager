<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

final class BadRequestException extends APIException
{
	public function __construct(string $message = "Bad request", ?int $statusCode = 400, ?\Throwable $previous = null)
	{
		parent::__construct($message, $statusCode, $previous);
	}
}