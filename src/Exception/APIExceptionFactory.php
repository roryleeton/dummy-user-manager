<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Exception;

use Psr\Http\Message\ResponseInterface;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\BadRequestException;
use RoryLeeton\DummyUserManager\Exception\ForbiddenException;
use RoryLeeton\DummyUserManager\Exception\NotFoundException;
use RoryLeeton\DummyUserManager\Exception\ServerErrorException;
use RoryLeeton\DummyUserManager\Exception\UnauthorizedException;
use RoryLeeton\DummyUserManager\Exception\ValidationException;

final class APIExceptionFactory
{
    public static function fromResponse(ResponseInterface $response): APIException
    {
        return match (true) {
			$response->getStatusCode() === 400 => new BadRequestException('Bad request', 400),
            $response->getStatusCode() === 401 => new UnauthorizedException('Unauthorized request', 401),
			$response->getStatusCode() === 403 => new ForbiddenException('Forbidden', 403),
            $response->getStatusCode() === 404 => new NotFoundException('Not found', 404),
            $response->getStatusCode() === 422 => new ValidationException('Invalid data', 422),
			$response->getStatusCode() >=  500 => new ServerErrorException('Server failed to process request', $response->getStatusCode()),
            default => new APIException(
                'API error',
                $response->getStatusCode()
            ),
        };
    }
}