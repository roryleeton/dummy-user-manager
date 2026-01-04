<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Service\APIAction;
use RoryLeeton\DummyUserManager\Service\APIProcessorFactory;

final class DummyUserManager 
{
	public function __construct(
		public string $token
	) {}

	public function createUser(string $firstname, string $lastname, string $email): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::CREATE_USER);
			$processor->setAuthToken($this->token);
			$processor->setUserRequestData($firstname, $lastname, $email);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function getUser(string $id): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::GET_USER);
			$processor->setAuthToken($this->token);
			$processor->setUserID($id);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function getUsers(): array
	{
		try {
			$processor = APIProcessorFactory::make(APIAction::GET_USERS);
			$processor->setAuthToken($this->token);
			return $processor->process();
		} catch (\Exception $e) {
			throw $e;
		}
	}
}