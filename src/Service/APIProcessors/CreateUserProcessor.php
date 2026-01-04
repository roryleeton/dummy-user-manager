<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use Nyholm\Psr7\Factory\Psr17Factory;
use RoryLeeton\DummyUserManager\Data\Request\CreateUser;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\NetworkException;
use RoryLeeton\DummyUserManager\Service\APIClient;
use Symfony\Component\HttpClient\Psr18Client;

/**
 * Processor for creating a new user via the API.
 *
 * This processor handles the CREATE_USER action, making a POST request to create
 * a new user and transforming the response into a UserResponse object.
 */
class CreateUserProcessor implements APIProcessor
{
	/** @var CreateUser The user data to be sent in the creation request */
	private CreateUser $userRequestData;

	/**
	 * Sets the user data for the creation request.
	 *
	 * @param string $firstName The user's first name
	 * @param string $lastName The user's last name
	 * @param string $email The user's email address
	 */
	public function setUserRequestData(string $firstName, string $lastName, string $email): void
	{
		$this->userRequestData = CreateUser::create($firstName, $lastName, $email);
	}

	/**
	 * Gets the user data that will be sent in the creation request.
	 *
	 * @return CreateUser The user request data
	 */
	public function getUserRequestData(): CreateUser
	{
		return $this->userRequestData;
	}

	/**
	 * Processes the API request to create a new user.
	 *
	 * @return UserResponse The created user response data
	 * @throws APIException When the API returns an error status code
	 * @throws NetworkException When a network error occurs during the request
	 */
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