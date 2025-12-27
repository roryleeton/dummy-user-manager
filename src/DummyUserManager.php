<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Service\APIProcessorFactory;

final class DummyUserManager 
{
	public function __construct(
		private string $token
	) {}

	public function createUser(string $firstname, string $lastname): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make('create-user');
			$processor->setAuthToken($this->token);
		} catch (\Exception $e) {
			
		}
	}

	public function getUser(string $id): UserResponse
	{
		try {
			$processor = APIProcessorFactory::make('get-user');
			$processor->setAuthToken($this->token)
					  ->setUserID($id);
		} catch (\Exception $e) {

		}
	}

	public function getUsers(): array
	{
		try {
			$processor = APIProcessorFactory::make('get-users');
			$processor->setAuthToken($this->token);
		} catch (\Exception $e) {
			
		}
	}
}