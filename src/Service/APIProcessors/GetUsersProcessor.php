<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use Nyholm\Psr7\Factory\Psr17Factory;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\NetworkException;
use RoryLeeton\DummyUserManager\Service\APIClient;
use Symfony\Component\HttpClient\Psr18Client;

/**
 * Processor for retrieving a paginated list of users from the API.
 *
 * This processor handles the GET_USERS action, making a request to retrieve
 * all users and transforming them into a UsersResponse object.
 */
class GetUsersProcessor implements APIProcessor
{
	/**
	 * Processes the API request to retrieve paginated list of users.
	 *
	 * @return UsersResponse The collection of users
	 * @throws APIException When the API returns an error status code
	 * @throws NetworkException When a network error occurs during the request
	 */
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