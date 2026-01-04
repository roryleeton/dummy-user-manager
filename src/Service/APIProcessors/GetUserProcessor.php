<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use Nyholm\Psr7\Factory\Psr17Factory;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Service\APIClient;
use Symfony\Component\HttpClient\Psr18Client;

class GetUserProcessor implements APIProcessor
{
	private string $token;
	private string $userID;

	public function setAuthToken(string $token): void
	{
		$this->token = $token;
	}

	public function getAuthToken(): string
	{
		return $this->token;
	}

	public function setUserID(string $userID): void
	{
		$this->userID = $userID;
	}

	public function getUserID(): string
	{
		return $this->userID;
	}

	public function process(): UserResponse
	{
		$client = new Psr18Client();
		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory);

		$response = $api->get("https://dummyjson.com/user/{$this->userID}");
		$responseBody = (string) $response->getBody();
		$userJson = json_decode($responseBody);

		return new UserResponse($userJson->id, $userJson->firstName, $userJson->lastName, $userJson->email);
	}
}