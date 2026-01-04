<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;
use RoryLeeton\DummyUserManager\Service\APIAction;
use RoryLeeton\DummyUserManager\Service\APIProcessorFactory;

final class DummyUserManager 
{
	public function __construct(
		public string $token
	) {}

	public function createUser(string $firstName, string $lastName, string $email): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::CREATE_USER);
			$processor->setUserRequestData($firstName, $lastName, $email);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function getUser(string $id): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::GET_USER);
			$processor->setUserID($id);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function getUsers(): UsersResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::GET_USERS);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}
}