<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\NetworkException;
use RoryLeeton\DummyUserManager\Service\APIAction;
use RoryLeeton\DummyUserManager\Service\APIProcessorFactory;
use RoryLeeton\DummyUserManager\Service\APIProcessors\CreateUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUsersProcessor;

/**
 * Client for managing users via the DummyJSON API.
 *
 * This class provides methods to create, retrieve, and list users through
 * the DummyJSON API service. All methods may throw APIException or
 * NetworkException in case of errors.
 */
final class DummyUserManager 
{
	/**
	 * Creates a new user with the provided details.
	 *
	 * @param string $firstName The user's first name
	 * @param string $lastName The user's last name
	 * @param string $email The user's email address
	 * @return UserResponse The created user response
	 * @throws APIException When the API returns an error status code
	 * @throws NetworkException When a network error occurs during the request
	 */
	public function createUser(string $firstName, string $lastName, string $email): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::CREATE_USER);
			/** @var CreateUserProcessor $processor */
			$processor->setUserRequestData($firstName, $lastName, $email);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Retrieves a user by their ID.
	 *
	 * @param int $id The unique identifier of the user
	 * @return UserResponse The user response data
	 * @throws APIException When the API returns an error status code
	 * @throws NetworkException When a network error occurs during the request
	 */
	public function getUser(int $id): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::GET_USER);
			/** @var GetUserProcessor $processor */
			$processor->setUserID($id);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Retrieves a paginated list of users.
	 *
	 * @return UsersResponse The collection of users
	 * @throws APIException When the API returns an error status code
	 * @throws NetworkException When a network error occurs during the request
	 */
	public function getUsers(): UsersResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::GET_USERS);
			/** @var GetUsersProcessor $processor */
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}
}