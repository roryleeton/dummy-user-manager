<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use Nyholm\Psr7\Factory\Psr17Factory;
use RoryLeeton\DummyUserManager\Service\APIClient;
use RoryLeeton\DummyUserManager\Data\Request\CreateUser;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use Symfony\Component\HttpClient\Psr18Client;

class CreateUserProcessor implements APIProcessor
{
	private CreateUser $userRequestData;

	public function setUserRequestData(string $firstName, string $lastName, string $email): void
	{
		$this->userRequestData = CreateUser::create($firstName, $lastName, $email);
	}

	public function getUserRequestData(): CreateUser
	{
		return $this->userRequestData;
	}

	public function process(): UserResponse
	{
		$client = new Psr18Client();
		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$response = $api->post("https://dummyjson.com/users/add", json_encode($this->userRequestData));
		$responseBody = (string) $response->getBody();
		$userJson = json_decode($responseBody);

		return UserResponse::create($userJson->id, $userJson->firstName, $userJson->lastName, $userJson->email);
	}
}