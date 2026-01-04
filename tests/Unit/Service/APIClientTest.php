<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\BadRequestException;
use RoryLeeton\DummyUserManager\Exception\ForbiddenException;
use RoryLeeton\DummyUserManager\Exception\NetworkException;
use RoryLeeton\DummyUserManager\Exception\NotFoundException;
use RoryLeeton\DummyUserManager\Exception\ServerErrorException;
use RoryLeeton\DummyUserManager\Exception\UnauthorizedException;
use RoryLeeton\DummyUserManager\Exception\ValidationException;
use RoryLeeton\DummyUserManager\Service\APIClient;

class APIClientTest extends TestCase
{
	/*
	* Tests the GET request returns a success response
	*/
	public function testGetReturnsResponse(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(200, [], 'yes');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$response = $api->get('https://fake.com/endpoint');

		$this->assertSame(200, $response->getStatusCode());
		$this->assertSame('yes', (string) $response->getBody());
	}

	/*
	* Tests the POST request returns a success response
	*/
	public function testPostReturnsResponse(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(200, [], 'yes');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$response = $api->post('https://fake.com/endpoint', json_encode([]));

		$this->assertSame(200, $response->getStatusCode());
		$this->assertSame('yes', (string) $response->getBody());
	}



	/*
	* Tests the GET request returns a BadRequestException on 400 status
	*/
	public function testGetBadRequestException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(400, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(BadRequestException::class);
		$api->get('https://fake.com/endpoint');
	}

	/*
	* Tests the POST request returns a BadRequestException on 400 status
	*/
	public function testPostBadRequestException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(400, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(BadRequestException::class);
		$api->post('https://fake.com/endpoint', json_encode([]));
	}

	/*
	* Tests the GET request returns a ForbiddenException on 403 status
	*/
	public function testGetForbiddenException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(403, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(ForbiddenException::class);
		$api->get('https://fake.com/endpoint');
	}

	/*
	* Tests the POST request returns a ForbiddenException on 403 status
	*/
	public function testPostForbiddenException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(403, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(ForbiddenException::class);
		$api->post('https://fake.com/endpoint', json_encode([]));
	}



	/*
	* Tests the GET request returns a NotFoundException on 404 status
	*/
	public function testGetNotFoundException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(404, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(NotFoundException::class);
		$api->get('https://fake.com/endpoint');
	}

	/*
	* Tests the POST request returns a NotFoundException on 404 status
	*/
	public function testPostNotFoundException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(404, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(NotFoundException::class);
		$api->post('https://fake.com/endpoint', json_encode([]));
	}



	/*
	* Tests the GET request returns a ServerErrorException on 5xx status
	*/
	public function testGetServerErrorException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(500, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(ServerErrorException::class);
		$api->get('https://fake.com/endpoint');
	}

	/*
	* Tests the POST request returns a ServerErrorException on 5xx status
	*/
	public function testPostServerErrorException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(500, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(ServerErrorException::class);
		$api->post('https://fake.com/endpoint', json_encode([]));
	}



	/*
	* Tests the GET request returns an UnauthorisedException on 401 status
	*/
	public function testGetUnauthorisedErrorException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(401, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(UnauthorizedException::class);
		$api->get('https://fake.com/endpoint');
	}

	/*
	* Tests the POST request returns an UnauthorisedException on 401 status
	*/
	public function testPostUnauthorizedErrorException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(401, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(UnauthorizedException::class);
		$api->post('https://fake.com/endpoint', json_encode([]));
	}



	/*
	* Tests the GET request returns a ValidationException on 406 status
	*/
	public function testGetValidationException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(422, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(ValidationException::class);
		$api->get('https://fake.com/endpoint');
	}

	/*
	* Tests the GET request returns a ValidationException on 406 status
	*/
	public function testPostValidationException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(422, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$this->expectException(ValidationException::class);
		$api->post('https://fake.com/endpoint', json_encode([]));
	}



	/*
	* Tests the GET request returns an APIException on other 4xx status
	*/
	public function testGetGenericAPIException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(406, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		try {
			$api->get('https://fake.com/endpoint');
		} catch (APIException $e) {
			echo get_class($e)."\n";
			$this->assertInstanceOf(APIException::class, $e);
			$this->assertSame($e->getStatusCode(), 406);
		}
	}

	/*
	* Tests the POST request returns an APIException on other 4xx status
	*/
	public function testPostGenericAPIException(): void
	{
		$client = new class implements ClientInterface {
			public function sendRequest(RequestInterface $request): Response
			{
				return new Response(406, [], 'no');
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		try {
			$api->post('https://fake.com/endpoint', json_encode([]));
		} catch (APIException $e) {
			$this->assertInstanceOf(APIException::class, $e);
			$this->assertSame($e->getStatusCode(), 406);
		}

	}



	public function testGetPsr18Exception(): void
	{
		$originalException = new class('Timeout') extends \RuntimeException
			implements ClientExceptionInterface {};

		$client = new class($originalException) implements ClientInterface {
			public function __construct(
				private ClientExceptionInterface $exception
			) {}

			public function sendRequest(RequestInterface $request): never
			{
				throw $this->exception;
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);
		$uri = 'https://fake.com/endpoint';

		try {
			$api->get($uri);
		} catch (NetworkException $e) {
			$this->assertInstanceOf(
				ClientExceptionInterface::class,
				$e->getPrevious()
			);
			$this->assertSame(
				"Request to (GET) {$uri} failed",
				$e->getMessage()
			);
			$this->assertSame(
				$originalException,
				$e->getPrevious(),
				'Original PSR-18 exception should be preserved'
			);
		}
	}

	public function testPostPsr18Exception(): void
	{
		$originalException = new class('Timeout') extends \RuntimeException
			implements ClientExceptionInterface {};

		$client = new class($originalException) implements ClientInterface {
			public function __construct(
				private ClientExceptionInterface $exception
			) {}

			public function sendRequest(RequestInterface $request): never
			{
				throw $this->exception;
			}
		};

		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);
		$uri = 'https://fake.com/endpoint';

		try {
			$api->post($uri, json_encode([]));
		} catch (NetworkException $e) {
			$this->assertInstanceOf(
				ClientExceptionInterface::class,
				$e->getPrevious()
			);
			$this->assertSame(
				"Request to (POST) {$uri} failed",
				$e->getMessage()
			);
			$this->assertSame(
				$originalException,
				$e->getPrevious(),
				'Original PSR-18 exception should be preserved'
			);
		}
	}
}