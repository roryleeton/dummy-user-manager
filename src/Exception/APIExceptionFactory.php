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

/**
 * Factory for creating API exception instances based on HTTP response status codes.
 *
 * This factory maps HTTP status codes to appropriate exception types:
 * - 400: BadRequestException
 * - 401: UnauthorizedException
 * - 403: ForbiddenException
 * - 404: NotFoundException
 * - 422: ValidationException
 * - >= 500: ServerErrorException
 * - Other: APIException (generic)
 */
final class APIExceptionFactory
{
    /**
     * Creates an appropriate API exception based on the HTTP response status code.
     *
     * @param ResponseInterface $response The HTTP response containing the status code
     * @return APIException|BadRequestException|ForbiddenException|NotFoundException|ServerErrorException|UnauthorizedException|ValidationException The appropriate exception instance for the status code
     */
    public static function fromResponse(ResponseInterface $response): APIException
    {
        return match (true) {
			$response->getStatusCode() === 400 => new BadRequestException('Bad request', 400),
            $response->getStatusCode() === 401 => new UnauthorizedException('Unauthorized request', 401),
			$response->getStatusCode() === 403 => new ForbiddenException('Forbidden', 403),
            $response->getStatusCode() === 404 => new NotFoundException('Not found', 404),
            $response->getStatusCode() === 422 => new ValidationException('Invalid data', 422),
			$response->getStatusCode() >=  500 => new ServerErrorException('Server failed to process request', $response->getStatusCode()),
            default => new APIException('API error', $response->getStatusCode()),
        };
    }
}