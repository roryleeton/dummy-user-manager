<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use RoryLeeton\DummyUserManager\Data\Request\CreateUser;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;

class CreateUserProcessor implements APIProcessor
{
	private string $token;
	private CreateUser $userRequestData;

	public function setAuthToken(string $token): void
	{
		$this->token = $token;
	}

	public function getAuthToken(): string
	{
		return $this->token;
	}

	public function setUserRequestData(string $firstname, string $lastname, string $email): void
	{
		$this->userRequestData = new CreateUser(
			$firstname,
			$lastname,
			$email
		);
	}

	public function getUserRequestData(): CreateUser
	{
		return $this->userRequestData;
	}

	public function process(): UserResponse
	{
		return new UserResponse(1, 'ph', 'ph', 'ph');
	}
}