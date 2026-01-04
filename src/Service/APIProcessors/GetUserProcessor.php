<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use Nyholm\Psr7\Factory\Psr17Factory;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Service\APIClient;
use Symfony\Component\HttpClient\Psr18Client;

class GetUserProcessor implements APIProcessor
{
	private string $userID;

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
		$api = new APIClient($client, $factory, $factory);

		$response = $api->get("https://dummyjson.com/user/{$this->userID}");
		// $response = $api->get("https://dummyjson.com/http/404/Hello_Peter");
		$responseBody = (string) $response->getBody();
		$userJson = json_decode($responseBody);
		$status = $response->getStatusCode();

		return UserResponse::create($userJson->id, $userJson->firstName, $userJson->lastName, $userJson->email);
	}
}