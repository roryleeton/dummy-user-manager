<?php

namespace RoryLeeton\DummyUserManager\Service;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\APIExceptionFactory;
use RoryLeeton\DummyUserManager\Exception\NetworkException;

/**
 * HTTP client for making API requests with error handling.
 *
 * This client wraps PSR-18 HTTP client interfaces and provides methods for
 * making GET and POST requests. It automatically converts HTTP error responses
 * into appropriate exception types and handles network errors.
 */
class APIClient
{
	/**
	 * @param ClientInterface $client The PSR-18 HTTP client implementation
	 * @param RequestFactoryInterface $requestFactory Factory for creating HTTP requests
	 * @param StreamFactoryInterface $streamFactory Factory for creating request body streams
	 */
	public function __construct(
		private ClientInterface $client, 
		private RequestFactoryInterface $requestFactory,
		private StreamFactoryInterface $streamFactory
	) {}
	
	/**
	 * Makes a GET request to the specified URL.
	 *
	 * @param string $url The URL to send the GET request to
	 * @return ResponseInterface The HTTP response
	 * @throws APIException When the API returns an error status code (>= 400)
	 * @throws NetworkException When a network error occurs during the request
	 */
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

	/**
	 * Makes a POST request to the specified URL with the given body.
	 *
	 * @param string $url The URL to send the POST request to
	 * @param string $body The request body content
	 * @return ResponseInterface The HTTP response
	 * @throws APIException When the API returns an error status code (>= 400)
	 * @throws NetworkException When a network error occurs during the request
	 */
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