<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use Nyholm\Psr7\Factory\Psr17Factory;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;
use RoryLeeton\DummyUserManager\Service\APIClient;
use Symfony\Component\HttpClient\Psr18Client;

class GetUsersProcessor implements APIProcessor
{
	public function process(): UsersResponse
	{
		$client = new Psr18Client();
		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$response = $api->get("https://dummyjson.com/users");
		$responseBody = (string) $response->getBody();
		$usersJson = json_decode($responseBody);

		$users = [];
		foreach ($usersJson->users as $user) {
			$users[] = UserResponse::create($user->id, $user->firstName, $user->lastName, $user->email);
		}

		return UsersResponse::create($users);
	}
}