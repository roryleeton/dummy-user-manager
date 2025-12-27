<?php

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;

class GetUserProcessor implements APIProcessor
{
	private string $token;
	private string $userID;

	public function setAuthToken(string $token): void
	{
		$this->token = $token;
	}

	public function getAuthToken(): string
	{
		return $this->token;
	}

	public function setUserID(string $userID): void
	{
		$this->userID = $userID;
	}

	public function getUserID(): string
	{
		return $this->userID;
	}

	public function process(): UserResponse
	{
		
	}
}