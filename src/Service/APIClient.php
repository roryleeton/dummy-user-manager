<?php

namespace RoryLeeton\DummyUserManager\Service;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use RoryLeeton\DummyUserManager\Exception\APIException;

class APIClient
{
	public function __construct(
		private ClientInterface $client, 
		private RequestFactoryInterface $requestFactory
	) {}
	
	public function get(string $url): ResponseInterface
	{
		$request = $this->requestFactory->createRequest('GET', $url);

		try {
			return $this->client->sendRequest($request);
		} catch (ClientExceptionInterface $e) {
			throw new APIException('Request failed because...', 0, $e);
		}
	}
}