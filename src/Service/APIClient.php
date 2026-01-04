<?php

namespace RoryLeeton\DummyUserManager\Service;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use RoryLeeton\DummyUserManager\Exception\APIExceptionFactory;
use RoryLeeton\DummyUserManager\Exception\NetworkException;

class APIClient
{
	public function __construct(
		private ClientInterface $client, 
		private RequestFactoryInterface $requestFactory,
		private StreamFactoryInterface $streamFactory
	) {}
	
	public function get(string $url): ResponseInterface
	{
		$request = $this->requestFactory->createRequest('GET', $url);

		try {
			$response = $this->client->sendRequest($request);
			$status = $response->getStatusCode();
			if ($status >= 400) {
				throw APIExceptionFactory::fromResponse($response);
			}
			return $response;
		} catch (ClientExceptionInterface $e) {
			throw new NetworkException(
				sprintf('Request to (GET) %s failed', (string) $request->getUri()),
				previous: $e
			);
		}
	}

	public function post(string $url, string $body): ResponseInterface
	{
		$request = $this->requestFactory->createRequest('POST', $url);
		$stream = $this->streamFactory->createStream($body);
		$request = $request->withHeader('Content-Type', 'application/json');
		$request = $request->withBody($stream);

		try {
			$response = $this->client->sendRequest($request);
			$status = $response->getStatusCode();
			if ($status >= 400) {
				throw APIExceptionFactory::fromResponse($response);
			}
			return $response;
		} catch (ClientExceptionInterface $e) {
			throw new NetworkException(
				sprintf('Request to (POST) %s failed', (string) $request->getUri()),
				previous: $e
			);
		}
	}
}