<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

final class NotFoundException extends APIException
{
	public function __construct(string $message = "Not found", ?int $statusCode = 404, ?\Throwable $previous = null)
	{
		return parent::__construct($message, $statusCode, $previous);
	}
}