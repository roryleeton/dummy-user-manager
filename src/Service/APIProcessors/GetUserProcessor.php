<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use Nyholm\Psr7\Factory\Psr17Factory;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\NetworkException;
use RoryLeeton\DummyUserManager\Service\APIClient;
use Symfony\Component\HttpClient\Psr18Client;

/**
 * Processor for retrieving a single user by ID from the API.
 *
 * This processor handles the GET_USER action, making a request to retrieve
 * user data and transforming it into a UserResponse object.
 */
class GetUserProcessor implements APIProcessor
{
	/** @var int The ID of the user to retrieve */
	private int $userID;

	/**
	 * Sets the user ID to retrieve.
	 *
	 * @param int $userID The unique identifier of the user
	 */
	public function setUserID(int $userID): void
	{
		$this->userID = $userID;
	}

	/**
	 * Gets the user ID that will be retrieved.
	 *
	 * @return int The unique identifier of the user
	 */
	public function getUserID(): int
	{
		return $this->userID;
	}

	/**
	 * Processes the API request to retrieve a user by ID.
	 *
	 * @return UserResponse The user response data
	 * @throws APIException When the API returns an error status code
	 * @throws NetworkException When a network error occurs during the request
	 */
	public function process(): UserResponse
	{
		$client = new Psr18Client();
		$factory = new Psr17Factory();
		$api = new APIClient($client, $factory, $factory);

		$response = $api->get("https://dummyjson.com/user/{(string) $this->userID}");
		$responseBody = (string) $response->getBody();
		$userJson = json_decode($responseBody);
		$status = $response->getStatusCode();

		return UserResponse::create($userJson->id, $userJson->firstName, $userJson->lastName, $userJson->email);
	}
}